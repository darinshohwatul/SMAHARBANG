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

// Ambil data user + kelas
$stmt = $conn->prepare("
    SELECT u.*, k.nama_kelas 
    FROM users u 
    LEFT JOIN kelas k ON u.kelas_id = k.id 
    WHERE u.id = ? AND u.role = 'siswa'
");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$success = '';
$error = '';

// Proses update profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($nama) || empty($email)) {
        $error = "Nama dan email tidak boleh kosong.";
    } else {
        $query = "UPDATE users SET nama = ?, email = ?";
        $params = [$nama, $email];

        if (!empty($password)) {
            $query .= ", password = ?";
            $params[] = password_hash($password, PASSWORD_BCRYPT);
        }

        $query .= " WHERE id = ?";
        $params[] = $userId;

        $stmtUpdate = $conn->prepare($query);
        if ($stmtUpdate->execute($params)) {
            $success = "Profil berhasil diperbarui.";
            // Refresh data
            $stmt->execute([$userId]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $error = "Gagal memperbarui profil.";
        }
    }
}

include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-screen-md">
    <h1 class="text-2xl font-bold mb-4">👤 Profil Saya</h1>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= $success ?></div>
    <?php elseif ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required class="mt-1 p-2 w-full border rounded focus:outline-none focus:ring focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required class="mt-1 p-2 w-full border rounded focus:outline-none focus:ring focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Ganti Password (opsional)</label>
            <input type="password" name="password" placeholder="Isi jika ingin mengganti password" class="mt-1 p-2 w-full border rounded focus:outline-none focus:ring focus:border-blue-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">NIS</label>
            <input type="text" value="<?= htmlspecialchars($user['nis']) ?>" readonly class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600 cursor-not-allowed" disabled>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kelas</label>
            <input type="text" value="<?= htmlspecialchars($user['nama_kelas'] ?? 'Tidak diketahui') ?>" readonly class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 text-gray-600 cursor-not-allowed" disabled>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">💾 Simpan Perubahan</button>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
