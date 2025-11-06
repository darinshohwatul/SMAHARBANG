<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'siswa') {
    header("Location: ../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$siswaId = $_SESSION['user_id'];

// Ambil data user
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'siswa'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


// Ambil nilai dari jawaban_tugas
$stmtNilai = $conn->prepare("
    SELECT jt.*, t.judul, t.jenis, t.deadline, mp.nama_mapel 
    FROM jawaban_tugas jt
    JOIN tugas t ON jt.tugas_id = t.id
    LEFT JOIN mata_pelajaran mp ON t.mapel_id = mp.id
    WHERE jt.siswa_id = ?
    ORDER BY jt.created_at DESC
");
$stmtNilai->execute([$siswaId]);
$nilaiList = $stmtNilai->fetchAll(PDO::FETCH_ASSOC);

include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-screen-md">
  <h1 class="text-2xl font-bold mb-4">📊 Nilai Saya</h1>
  <p class="text-gray-600 mb-6">
    Kelas: <?= htmlspecialchars($user['nama_kelas'] ?? 'Tidak diketahui') ?> • 
    NIS: <?= htmlspecialchars($user['nis']) ?>
  </p>

  <?php if (count($nilaiList) > 0): ?>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
        <thead>
          <tr class="bg-blue-600 text-white text-left">
            <th class="px-4 py-2">Judul Tugas</th>
            <th class="px-4 py-2">Mapel</th>
            <th class="px-4 py-2">Jenis</th>
            <th class="px-4 py-2">Deadline</th>
            <th class="px-4 py-2">Nilai</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($nilaiList as $nilai): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="px-4 py-2"><?= htmlspecialchars($nilai['judul']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($nilai['nama_mapel'] ?? '-') ?></td>
              <td class="px-4 py-2 capitalize"><?= htmlspecialchars($nilai['jenis']) ?></td>
              <td class="px-4 py-2"><?= date('d/m/Y H:i', strtotime($nilai['deadline'])) ?></td>
              <td class="px-4 py-2 font-bold text-center text-blue-700">
                <?= is_null($nilai['nilai']) ? 'Belum Dinilai' : $nilai['nilai'] ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p class="text-gray-500">Belum ada tugas atau nilai yang tersedia.</p>
  <?php endif; ?>
</div>





