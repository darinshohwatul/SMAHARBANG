<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

// Proses hapus pengumuman
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM pengumuman WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: pengumuman.php");
    exit;
}

// Proses tambah pengumuman
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';

    if ($judul && $isi) {
        $stmt = $conn->prepare("INSERT INTO pengumuman (judul, isi, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$judul, $isi]);
        header("Location: pengumuman.php");
        exit;
    } else {
        $error = "Judul dan isi wajib diisi.";
    }
}

// Ambil semua pengumuman
$stmt = $conn->prepare("SELECT * FROM pengumuman ORDER BY created_at DESC");
$stmt->execute();
$pengumumanList = $stmt->fetchAll();

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-lg">
    <h1 class="text-2xl font-bold text-blue-800 mb-4">📢 Kelola Pengumuman</h1>

    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Form Tambah Pengumuman -->
    <form method="POST" class="mb-6 bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-2">Tambah Pengumuman Baru</h2>

        <label class="block font-medium mb-1">Judul</label>
        <input type="text" name="judul" class="w-full border p-2 rounded mb-4" required>

        <label class="block font-medium mb-1">Isi</label>
        <textarea name="isi" rows="4" class="w-full border p-2 rounded mb-4" required></textarea>

        <button type="submit" name="tambah" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>

    <!-- Daftar Pengumuman -->
    <div class="bg-white rounded shadow p-4">
        <?php if (empty($pengumumanList)): ?>
            <p class="text-gray-500">Belum ada pengumuman.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($pengumumanList as $pengumuman): ?>
                    <li class="border-b py-3 flex justify-between items-center">
                        <div>
                            <strong><?= htmlspecialchars($pengumuman['judul']) ?></strong>
                            <p class="text-sm text-gray-600"><?= nl2br(htmlspecialchars(substr($pengumuman['isi'], 0, 150))) ?>...</p>
                            <small class="text-gray-400"><?= date('d M Y H:i', strtotime($pengumuman['created_at'])) ?></small>
                        </div>
                        <div>
                            <a href="edit_pengumuman.php?id=<?= $pengumuman['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Edit</a>
                            <a href="?hapus=<?= $pengumuman['id'] ?>" onclick="return confirm('Yakin hapus pengumuman ini?')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
