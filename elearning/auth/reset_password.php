<?php
require_once '../config/db.php';
session_start();

$db = new Database();
$pdo = $db->getConnection();

$token = $_GET['token'] ?? '';

if (!$token) {
    // Token kosong, tampilkan error
    die("<div class='max-w-md mx-auto mt-20 p-6 bg-red-100 text-red-700 rounded text-center'>Token tidak ditemukan.</div>");
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch();

if (!$user || strtotime($user['reset_token_expiry']) < time()) {
    die("<div class='max-w-md mx-auto mt-20 p-6 bg-red-100 text-red-700 rounded text-center'>Token tidak valid atau sudah kedaluwarsa.</div>");
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (strlen($password) < 8) {
        $errors[] = "Password harus minimal 8 karakter.";
    }

    if ($password !== $confirm) {
        $errors[] = "Konfirmasi password tidak cocok.";
    }

    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
        $stmt->execute([$hashed, $user['id']]);
        $_SESSION['success'] = "Password berhasil direset. Silakan login.";
        header("Location: login.php");
        exit;
    }
}

?>

<?php
$page_title = 'Reset Password';
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-200 to-blue-500 min-h-screen flex items-center justify-center">
  <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Reset Password</h2>

    <?php if (!empty($errors)): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4" role="alert">
        <ul class="list-disc list-inside text-sm">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
        <input type="password" name="password" id="password" required minlength="8"
               class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
      </div>

      <div class="mb-4">
        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required
               class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
      </div>

      <button type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300">
        Reset Password
      </button>
    </form>
  </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>

