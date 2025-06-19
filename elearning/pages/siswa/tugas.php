<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'siswa') {
    header("Location: ../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$userId = $_SESSION['user_id'];

// Ambil data user + nama kelas
$stmt = $conn->prepare("
    SELECT u.*, k.nama_kelas 
    FROM users u 
    LEFT JOIN kelas k ON u.kelas_id = k.id 
    WHERE u.id = ? AND u.role = 'siswa'
");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil semua tugas untuk kelas siswa
$stmtTugas = $conn->prepare("
    SELECT t.*, mp.nama_mapel, u.nama AS nama_guru 
    FROM tugas t
    JOIN mata_pelajaran mp ON mp.id = t.mapel_id
    JOIN users u ON u.id = t.guru_id
    WHERE t.kelas_id = ?
    ORDER BY t.deadline ASC
");
$stmtTugas->execute([$user['kelas_id']]);
$tugasList = $stmtTugas->fetchAll(PDO::FETCH_ASSOC);

// Ambil tugas yang sudah dijawab
$stmtJawaban = $conn->prepare("SELECT tugas_id FROM jawaban_tugas WHERE siswa_id = ?");
$stmtJawaban->execute([$userId]);
$tugasSelesai = $stmtJawaban->fetchAll(PDO::FETCH_COLUMN);

include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-4xl mx-leaft">
  <h1 class="text-2xl font-bold mb-4">📝 Daftar Tugas</h1>
  <p class="text-gray-600 mb-6">
    Kelas: <?= htmlspecialchars($user['nama_kelas'] ?? 'Tidak diketahui') ?> • 
    NIS: <?= htmlspecialchars($user['nis']) ?>
  </p>

  <?php if (count($tugasList) > 0): ?>
    <div class="space-y-4">
      <?php foreach ($tugasList as $tugas): 
        $selesai = in_array($tugas['id'], $tugasSelesai);
      ?>
        <div class="bg-white rounded shadow p-4 border-l-4 <?= $selesai ? 'border-green-500' : 'border-red-500' ?>">
          <div class="flex justify-between items-center">
            <div>
              <h2 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($tugas['judul']) ?></h2>
              <p class="text-sm text-gray-600 mb-1"><?= htmlspecialchars($tugas['nama_mapel']) ?> • Guru: <?= htmlspecialchars($tugas['nama_guru']) ?></p>
              <p class="text-xs text-gray-500">Deadline: <?= date('d M Y H:i', strtotime($tugas['deadline'])) ?></p>
            </div>
            <span class="text-sm px-2 py-1 rounded-full text-white <?= $selesai ? 'bg-green-500' : 'bg-red-500' ?>">
              <?= $selesai ? 'Selesai' : 'Belum Dikerjakan' ?>
            </span>
          </div>
          <p class="text-gray-700 mt-3"><?= nl2br(htmlspecialchars(substr($tugas['deskripsi'], 0, 150))) ?>...</p>
          <?php if ($tugas['file']): ?>
            <a href="../../upload/tugas/<?= htmlspecialchars($tugas['file']) ?>" target="_blank" class="inline-block mt-2 text-blue-600 hover:underline">
              📎 Lihat Lampiran
            </a>
          <?php endif; ?>
          <div class="mt-3">
            <a href="proses_jawab_tugas.php?tugas_id=<?= $tugas['id'] ?>" class="inline-block bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 text-sm">
              <?= $selesai ? 'Lihat Jawaban' : 'Kerjakan Tugas' ?>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-gray-500">Belum ada tugas untuk kelas Anda.</p>
  <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>
