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

// Ambil data user + nama_kelas
$stmt = $conn->prepare("
    SELECT u.*, k.nama_kelas 
    FROM users u 
    LEFT JOIN kelas k ON u.kelas_id = k.id 
    WHERE u.id = ? AND u.role = 'siswa'
");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Pastikan user memiliki kelas yang valid
$kelasId = $user['kelas_id'] ?? null;
$materiList = [];

if ($kelasId) {
    $stmtMateri = $conn->prepare("
        SELECT m.*, mp.nama_mapel 
        FROM materi m 
        JOIN mata_pelajaran mp ON mp.id = m.mapel_id 
        WHERE m.kelas_id = ? 
        ORDER BY m.created_at DESC
    ");
    $stmtMateri->execute([$kelasId]);
    $materiList = $stmtMateri->fetchAll(PDO::FETCH_ASSOC);
}

include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-screen-md">
  <h1 class="text-2xl font-bold mb-4">📚 Materi Pelajaran</h1>
  <p class="text-gray-600 mb-6">
    Kelas: <?= htmlspecialchars($user['nama_kelas'] ?? 'Tidak diketahui') ?> • 
    NIS: <?= htmlspecialchars($user['nis'] ?? '-') ?>
  </p>

  <?php if ($kelasId && count($materiList) > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($materiList as $materi): ?>
        <div class="bg-white shadow rounded p-4 border-l-4 border-blue-500">
          <h2 class="text-lg font-semibold text-blue-800"><?= htmlspecialchars($materi['judul']) ?></h2>
          <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars(substr($materi['deskripsi'], 0, 100)) ?>...</p>
          <p class="text-xs text-gray-400">Mapel: <?= htmlspecialchars($materi['nama_mapel']) ?></p>
          <a href="../../uploads/materi/<?= htmlspecialchars($materi['file']) ?>" target="_blank" class="mt-3 inline-block text-sm text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
            📥 Unduh Materi
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php elseif (!$kelasId): ?>
    <p class="text-red-500">Anda belum tergabung dalam kelas manapun. Silakan hubungi admin.</p>
  <?php else: ?>
    <p class="text-gray-500">Belum ada materi yang tersedia untuk kelas Anda.</p>
  <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>
