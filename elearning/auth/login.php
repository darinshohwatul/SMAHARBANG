<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifier = trim($_POST['identifier'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$identifier || !$password) {
        $error = "Email, NIS, atau NIP dan password harus diisi.";
    } else {
        // Cek berdasarkan email atau NIS atau NIP
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR nis = ? OR nip = ?");
        $stmt->execute([$identifier, $identifier, $identifier]);
        $user = $stmt->fetch();

        if ($user && hash('sha256', $password) === $user['password']) {
            // Login sukses, simpan session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nama'] = $user['nama'];
            $_SESSION['user_role'] = $user['role'];

            if ($user['role'] === 'siswa') {
                $_SESSION['user_nis'] = $user['nis'];
            } elseif ($user['role'] === 'guru') {
                $_SESSION['user_nip'] = $user['nip'];
            }

            // Arahkan ke dashboard sesuai role
            switch ($user['role']) {
                case 'admin':
                    header("Location: ../pages/admin/dashboard.php");
                    exit;
                case 'guru':
                    header("Location: ../pages/guru/dashboard.php");
                    exit;
                case 'siswa':
                    header("Location: ../pages/siswa/dashboard.php");
                    exit;
                default:
                    session_destroy();
                    $error = "Role pengguna tidak dikenali.";
            }
        } else {
            $error = "Email / NIS / NIP atau password salah.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - E-Learning SMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 to-blue-700 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-3xl font-semibold text-center text-blue-700 mb-6">Login E-Learning SMA</h2>

        <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4"><?=htmlspecialchars($error)?></div>
        <?php endif; ?>

        <form method="post" class="space-y-5" novalidate>
            <input
                type="text"
                name="identifier"
                placeholder="Email / NIS / NIP"
                value="<?=htmlspecialchars($_POST['identifier'] ?? '')?>"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            />

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            />

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition duration-200"
            >
                Login
            </button>
        </form>

        <div class="mt-4 text-center text-sm text-gray-700">
            Belum punya akun siswa? 
            <a href="register.php" class="text-blue-600 hover:underline font-medium">Daftar di sini</a>
        </div>

        <div class="mt-2 text-center text-sm">
            <a href="forgot_password.php" class="text-blue-600 hover:underline">Lupa password?</a>
        </div>
    </div>
</body>
</html>
