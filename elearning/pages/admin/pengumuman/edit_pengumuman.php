<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    header("Location: pengumuman.php");
    exit;
}

// Ambil data pengumuman berdasarkan id
$stmt = $conn->prepare("SELECT * FROM pengumuman WHERE id = ?");
$stmt->execute([$id]);
$pengumuman = $stmt->fetch();

if (!$pengumuman) {
    header("Location: pengumuman.php");
    exit;
}

$error = '';

// Proses update pengumuman
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';

    if ($judul && $isi) {
        $stmt = $conn->prepare("UPDATE pengumuman SET judul = ?, isi = ? WHERE id = ?");
        $stmt->execute([$judul, $isi, $id]);
        header("Location: pengumuman.php");
        exit;
    } else {
        $error = "Judul dan isi wajib diisi.";
    }
}

// Proses hapus dari halaman edit
if (isset($_POST['hapus'])) {
    $stmt = $conn->prepare("DELETE FROM pengumuman WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: pengumuman.php");
    exit;
}

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../includes/header.php';
include '../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-lg">
    <h1 class="text-2xl font-bold text-blue-800 mb-4">✏️ Edit Pengumuman</h1>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow">
        <label class="block font-medium mb-1">Judul</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($pengumuman['judul']) ?>" class="w-full border p-2 rounded mb-4" required>

        <label class="block font-medium mb-1">Isi</label>
        <textarea name="isi" rows="6" class="w-full border p-2 rounded mb-4" required><?= htmlspecialchars($pengumuman['isi']) ?></textarea>

        <div class="flex justify-between">    <div class="mt-4">
        <a href="pengumuman.php" class="text-blue-600 hover:underline"> Kembali </a>
    </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Update</button>
            
            </button>
        </div>
    </form>
</div>
