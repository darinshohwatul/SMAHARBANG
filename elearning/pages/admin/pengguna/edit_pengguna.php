<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

// Validasi ID
if (!isset($_GET['id'])) {
    header("Location: kelola_pengguna.php");
    exit;
}
$id = $_GET['id'];

// Ambil data user
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Pengguna tidak ditemukan.";
    exit;
}

// Ambil data kelas (jika perlu)
$kelas_list = [];
if ($user['role'] === 'siswa') {
    $kelas_stmt = $conn->query("SELECT id, nama_kelas FROM kelas");
    $kelas_list = $kelas_stmt->fetchAll();
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nis = $_POST['nis'] ?? null;
    $nip = $_POST['nip'] ?? null;
    $kelas_id = $_POST['kelas_id'] ?? null;

    $stmt = $conn->prepare("UPDATE users SET nama = ?, email = ?, nis = ?, nip = ?, kelas_id = ? WHERE id = ?");
    $stmt->execute([$nama, $email, $nis, $nip, $kelas_id, $id]);

    header("Location: kelola_pengguna.php");
    exit;
}

include '../../../includes/header.php';
include '../../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-md">
    <h1 class="text-xl font-bold mb-6 text-blue-800">✏️ Edit Pengguna</h1>

    <form method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
        <!-- Nama -->
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="nama" required
                value="<?= htmlspecialchars($user['nama']) ?>"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" required
                value="<?= htmlspecialchars($user['email']) ?>"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>

        <!-- NIP untuk guru -->
        <?php if ($user['role'] === 'guru'): ?>
        <div>
            <label class="block text-sm font-medium mb-1">NIP</label>
            <input type="text" name="nip"
                value="<?= htmlspecialchars($user['nip']) ?>"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
        <?php endif; ?>

        <!-- NIS dan kelas untuk siswa -->
        <?php if ($user['role'] === 'siswa'): ?>
        <div>
            <label class="block text-sm font-medium mb-1">NIS</label>
            <input type="text" name="nis"
                value="<?= htmlspecialchars($user['nis']) ?>"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Kelas</label>
            <select name="kelas_id"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="">-- Pilih Kelas --</option>
                <?php foreach ($kelas_list as $kelas): ?>
                <option value="<?= $kelas['id'] ?>" <?= $kelas['id'] == $user['kelas_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($kelas['nama_kelas']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <!-- Tombol -->
        <div class="flex justify-between items-center mt-6">
            <a href="kelola_pengguna.php" class="text-blue-600 hover:underline"> Kembali</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Simpan Perubahan</button>
        </div>
    </form>
</div>
