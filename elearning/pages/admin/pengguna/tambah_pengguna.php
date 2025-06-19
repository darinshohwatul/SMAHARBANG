<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil semua kelas untuk dropdown
$stmt = $conn->query("SELECT id, nama_kelas FROM kelas");
$kelasList = $stmt->fetchAll();

// Proses simpan data
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $kelas_id = !empty($_POST['kelas_id']) ? $_POST['kelas_id'] : null;
    $nis = !empty($_POST['nis']) ? $_POST['nis'] : null;
    $nip = !empty($_POST['nip']) ? $_POST['nip'] : null;

    if ($role !== 'siswa') {
        $kelas_id = null;
        $nis = null;
    }

    if ($role !== 'guru') {
        $nip = null;
    }

    // Validasi sederhana
    if (!$nama || !$email || !$password || !$role) {
        $errors[] = "Semua field wajib diisi.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO users (nama, email, password, role, kelas_id, nis, nip) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nama, $email, $password, $role, $kelas_id, $nis, $nip]);

        header("Location: kelola_pengguna.php");
        exit;
    }
}



include '../../../includes/header.php';
include '../../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-md">
    <h2 class="text-xl font-bold text-blue-700 mb-4">➕ Tambah Pengguna Baru</h2>

    <?php if (!empty($errors)): ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?php foreach ($errors as $err): ?>
                <div><?= htmlspecialchars($err) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-4">
            <label class="block font-medium">Nama</label>
            <input type="text" name="nama" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Role</label>
            <select name="role" id="role" class="w-full border p-2 rounded" onchange="toggleField()" required>
                <option value="">-- Pilih Role --</option>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mb-4" id="kelas-field" style="display:none;">
            <label class="block font-medium">Kelas (khusus siswa)</label>
            <select name="kelas_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Kelas --</option>
                <?php foreach ($kelasList as $kelas): ?>
                  <option value="<?= $kelas['id'] ?>"><?= htmlspecialchars($kelas['nama_kelas']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4" id="nis-field" style="display:none;">
            <label class="block font-medium">NIS (khusus siswa)</label>
            <input type="text" name="nis" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4" id="nip-field" style="display:none;">
            <label class="block font-medium">NIP (khusus guru)</label>
            <input type="text" name="nip" class="w-full border p-2 rounded">
        </div>

        <div class="flex justify-between">
            <a href="kelola_pengguna.php" class="text-blue-600 hover:underline">Kembali</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>

<script>
function toggleField() {
    const role = document.getElementById("role").value;
    document.getElementById("kelas-field").style.display = role === "siswa" ? "block" : "none";
    document.getElementById("nis-field").style.display = role === "siswa" ? "block" : "none";
    document.getElementById("nip-field").style.display = role === "guru" ? "block" : "none";
}
</script>
