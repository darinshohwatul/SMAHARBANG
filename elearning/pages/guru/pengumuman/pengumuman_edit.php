<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$guruId = $_SESSION['user_id'];

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: pengumuman.php");
    exit;
}

// Ambil data pengumuman berdasarkan id dan dibuat_oleh guru yang login
$stmt = $conn->prepare("SELECT * FROM pengumuman WHERE id = ? AND dibuat_oleh = ?");
$stmt->execute([$id, $guruId]);
$pengumuman = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pengumuman) {
    header("Location: pengumuman.php");
    exit;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $isi = trim($_POST['isi'] ?? '');
    $ditujukan_untuk = $_POST['ditujukan_untuk'] ?? '';

    if ($judul === '') {
        $errors[] = "Judul pengumuman wajib diisi.";
    }
    if ($isi === '') {
        $errors[] = "Isi pengumuman wajib diisi.";
    }
    if (!in_array($ditujukan_untuk, ['semua', 'siswa', 'guru'])) {
        $errors[] = "Pilihan 'Ditujukan untuk' tidak valid.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE pengumuman SET judul = ?, isi = ?, ditujukan_untuk = ? WHERE id = ? AND dibuat_oleh = ?");
        $stmt->execute([$judul, $isi, $ditujukan_untuk, $id, $guruId]);
        $success = true;
        // Refresh data setelah update
        $pengumuman['judul'] = $judul;
        $pengumuman['isi'] = $isi;
        $pengumuman['ditujukan_untuk'] = $ditujukan_untuk;
    }
}

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$guruId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<div class="p-6 max-w-screen-md">
    <h1 class="text-2xl font-bold mb-6">Edit Pengumuman</h1>

    <?php if ($success): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            Pengumuman berhasil diperbarui.
        </div>
        <a href="pengumuman.php" class="text-blue-600 hover:underline">Kembali ke Daftar Pengumuman</a>
    <?php else: ?>
        <?php if ($errors): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4 bg-white p-6 rounded shadow">
            <div>
                <label for="judul" class="block font-medium mb-1">Judul</label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($pengumuman['judul']) ?>" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label for="isi" class="block font-medium mb-1">Isi Pengumuman</label>
                <textarea id="isi" name="isi" rows="6" class="w-full border border-gray-300 rounded px-3 py-2" required><?= htmlspecialchars($pengumuman['isi']) ?></textarea>
            </div>

            <div>
                <label for="ditujukan_untuk" class="block font-medium mb-1">Ditujukan Untuk</label>
                <select id="ditujukan_untuk" name="ditujukan_untuk" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Pilih --</option>
                    <option value="semua" <?= ($pengumuman['ditujukan_untuk'] === 'semua') ? 'selected' : '' ?>>Semua</option>
                    <option value="siswa" <?= ($pengumuman['ditujukan_untuk'] === 'siswa') ? 'selected' : '' ?>>Siswa</option>
                    <option value="guru" <?= ($pengumuman['ditujukan_untuk'] === 'guru') ? 'selected' : '' ?>>Guru</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
            <a href="pengumuman.php" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </form>
    <?php endif; ?>
</div>

<?php include '../../../includes/footer.php'; ?>
