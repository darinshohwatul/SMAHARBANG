<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();

$errors = [];
$success = '';

// Ambil daftar kelas
$kelasStmt = $conn->query("SELECT id, nama_kelas FROM kelas");
$daftarKelas = $kelasStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $nis = trim($_POST['nis'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $id_kelas = $_POST['kelas_id'] ?? '';

    if (!$nama) {
        $errors[] = "Nama harus diisi.";
    }
    if (!$nis) {
        $errors[] = "NIS harus diisi.";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email tidak valid.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Password dan konfirmasi password tidak cocok.";
    }
    if (!$id_kelas || !is_numeric($id_kelas)) {
        $errors[] = "Kelas harus dipilih.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR nis = ?");
        $stmt->execute([$email, $nis]);
        if ($stmt->fetch()) {
            $errors[] = "Email atau NIS sudah digunakan.";
        }
    }

    if (empty($errors)) {
        // Gunakan SHA2 hashing langsung di SQL
        $stmt = $conn->prepare("INSERT INTO users (nama, email, nis, password, role, kelas_id) VALUES (?, ?, ?, SHA2(?, 256), 'siswa', ?)");
        $stmt->execute([$nama, $email, $nis, $password, $id_kelas]);
        $success = "Registrasi berhasil. Silakan <a href='login.php' class='text-blue-600 underline'>login</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Register Siswa - E-Learning SMA</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-300 to-blue-600 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
<h2 class="text-3xl font-bold mb-6 text-center text-blue-700">Daftar Akun Siswa</h2>

<?php if ($errors): ?>
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
<ul class="list-disc pl-5">
<?php foreach ($errors as $e): ?>
<li><?=htmlspecialchars($e)?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<?php if ($success): ?>
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
<?= $success ?>
</div>
<?php endif; ?>

<form method="post" class="space-y-4" novalidate>
<input
type="text"
name="nama"
placeholder="Nama lengkap"
value="<?=htmlspecialchars($_POST['nama'] ?? '')?>"
required
class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
/>
<input
type="text"
name="nis"
placeholder="NIS"
value="<?=htmlspecialchars($_POST['nis'] ?? '')?>"
required
class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
/>
<input
type="email"
name="email"
placeholder="Email"
value="<?=htmlspecialchars($_POST['email'] ?? '')?>"
required
class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
/>

<!-- Dropdown Kelas -->
<select
  name="kelas_id"
  required
  class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
>
  <option value="">-- Pilih Kelas --</option>
  <?php foreach ($daftarKelas as $kelas): ?>
    <option value="<?= $kelas['id'] ?>" <?= (isset($_POST['kelas_id']) && $_POST['kelas_id'] == $kelas['id']) ? 'selected' : '' ?>>
      <?= htmlspecialchars($kelas['nama_kelas']) ?>
    </option>
  <?php endforeach; ?>
</select>

<input
type="password"
name="password"
placeholder="Password (min 8 karakter)"
required
class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
minlength="8"
/>
<input
type="password"
name="confirm_password"
placeholder="Konfirmasi Password"
required
class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
minlength="8"
/>

<button
type="submit"
class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-200"
>
Daftar
</button>
</form>

<div class="mt-6 text-center text-sm text-gray-700">
Sudah punya akun?
<a href="login.php" class="text-blue-600 hover:underline font-medium">Login di sini</a>
</div>
</div>
</body>
</html>
