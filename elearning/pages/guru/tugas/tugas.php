<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$guruId = $_SESSION['user_id'];

// Ambil data semua tugas yang dibuat oleh guru
$stmt = $conn->prepare("
    SELECT t.*, m.nama_mapel, k.nama_kelas 
    FROM tugas t
    JOIN mata_pelajaran m ON t.mapel_id = m.id
    JOIN kelas k ON t.kelas_id = k.id
    WHERE t.guru_id = ?
    ORDER BY t.created_at DESC
");
$stmt->execute([$guruId]);
$tugasList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<!-- Kontainer nempel kiri -->
<main class="p-6 max-w-screen-lg">
  <h1 class="text-2xl font-bold text-gray-800 mb-6">📝 Daftar Tugas</h1>

  <a href="tambah_tugas.php" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">+ Tambah Tugas</a>

  <div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full table-auto text-sm">
      <thead class="bg-gray-200 text-gray-700">
        <tr>
          <th class="p-3 text-left">Judul</th>
          <th class="p-3 text-left">Mapel</th>
          <th class="p-3 text-left">Kelas</th>
          <th class="p-3 text-left">Jenis</th>
          <th class="p-3 text-left">Deadline</th>
          <th class="p-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tugasList as $tugas): ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="p-3"><?= htmlspecialchars($tugas['judul']) ?></td>
            <td class="p-3"><?= htmlspecialchars($tugas['nama_mapel']) ?></td>
            <td class="p-3"><?= htmlspecialchars($tugas['nama_kelas']) ?></td>
            <td class="p-3 capitalize"><?= htmlspecialchars($tugas['jenis']) ?></td>
            <td class="p-3"><?= date('d-m-Y H:i', strtotime($tugas['deadline'])) ?></td>
            <td class="p-3 text-center">
              <a href="edit_tugas.php?id=<?= $tugas['id'] ?>" class="text-blue-600 hover:underline mr-2">Edit</a>
              <a href="hapus_tugas.php?id=<?= $tugas['id'] ?>" onclick="return confirm('Yakin ingin menghapus tugas ini?')" class="text-red-600 hover:underline">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (empty($tugasList)): ?>
          <tr>
            <td colspan="6" class="text-center p-4 text-gray-500">Belum ada tugas.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php include '../../../includes/footer.php'; ?>
