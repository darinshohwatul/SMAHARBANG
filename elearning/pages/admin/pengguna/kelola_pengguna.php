<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

// Hapus pengguna
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: kelola_pengguna.php");
    exit;
}

// Ambil filter
$search = $_GET['search'] ?? '';
$filterRole = $_GET['role'] ?? '';

$query = "SELECT * FROM users WHERE 1=1";
$params = [];

if ($search) {
    $query .= " AND (nama LIKE :search OR email LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}

if ($filterRole) {
    $query .= " AND role = :role";
    $params[':role'] = $filterRole;
}

$query .= " ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll();

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-lg">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-blue-800">👥 Kelola Pengguna</h1>
        <a href="tambah_pengguna.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">+ Tambah Pengguna</a>
    </div>

    <!-- Form Pencarian dan Filter -->
    <form method="GET" class="flex flex-wrap items-center gap-2 mb-4">
        <input type="text" name="search" placeholder="Cari nama/email..." value="<?= htmlspecialchars($search) ?>"
            class="border border-gray-300 rounded px-3 py-2 w-48" />

        <select name="role" class="border border-gray-300 rounded px-3 py-2">
            <option value="">Semua Role</option>
            <option value="admin" <?= $filterRole === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="guru" <?= $filterRole === 'guru' ? 'selected' : '' ?>>Guru</option>
            <option value="siswa" <?= $filterRole === 'siswa' ? 'selected' : '' ?>>Siswa</option>
        </select>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Terapkan</button>
    </form>

    <!-- Tabel Pengguna -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border border-gray-200">
            <thead class="bg-blue-100 text-blue-900">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Role</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $i => $user): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border"><?= $i + 1 ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($user['nama']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($user['email']) ?></td>
                        <td class="p-2 border"><?= ucfirst($user['role']) ?></td>
                        <td class="p-2 border">
                            <a href="edit_pengguna.php?id=<?= $user['id'] ?>" class="text-blue-600 hover:underline mr-2">Edit</a>
                            <a href="?hapus=<?= $user['id'] ?>" onclick="return confirm('Yakin hapus pengguna ini?')" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($users)): ?>
                    <tr><td colspan="5" class="text-center text-gray-500 py-4">Belum ada pengguna.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
