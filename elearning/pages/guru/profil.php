<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$guruId = $_SESSION['user_id'];

// Ambil data guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$guruId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // boleh kosong

    if ($nama === '' || $email === '') {
        $errors[] = "Nama dan email wajib diisi.";
    }

    if (empty($errors)) {
        // Cek email unik (selain dirinya)
        $check = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $check->execute([$email, $guruId]);
        if ($check->fetch()) {
            $errors[] = "Email sudah digunakan oleh akun lain.";
        } else {
            if ($password !== '') {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET nama = ?, email = ?, password = ? WHERE id = ?");
                $stmt->execute([$nama, $email, $hashedPassword, $guruId]);
            } else {
                $stmt = $conn->prepare("UPDATE users SET nama = ?, email = ? WHERE id = ?");
                $stmt->execute([$nama, $email, $guruId]);
            }
            $success = true;

            // Refresh data user
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$guruId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}

include '../../includes/header.php';
include '../../includes/navbar_guru.php';
?>

<main class="p-6 max-w-screen-lg">
    <h1 class="text-2xl font-bold mb-6">👤 Profil Saya</h1>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 border border-green-400 px-4 py-3 rounded mb-4">
            Profil berhasil diperbarui.
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded shadow space-y-4">
        <div>
            <label for="nama" class="block font-medium mb-1">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label for="email" class="block font-medium mb-1">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium mb-1">NIP</label>
            <input type="text" value="<?= htmlspecialchars($user['nip']) ?>" class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600 cursor-not-allowed" disabled>
        </div>

        <div>
            <label for="password" class="block font-medium mb-1">Password Baru (Opsional)</label>
            <input type="password" id="password" name="password" placeholder="Biarkan kosong jika tidak diganti" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
    </form>
</main>

<?php include '../../includes/footer.php'; ?>
