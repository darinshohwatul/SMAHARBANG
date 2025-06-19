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

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Hitung jumlah materi
$stmt = $conn->prepare("SELECT COUNT(*) FROM materi WHERE guru_id = ?");
$stmt->execute([$guruId]);
$jumlahMateri = $stmt->fetchColumn();

// Hitung jumlah tugas
$stmt = $conn->prepare("SELECT COUNT(*) FROM tugas WHERE guru_id = ?");
$stmt->execute([$guruId]);
$jumlahTugas = $stmt->fetchColumn();

// Hitung jumlah pengumuman yang dibuat oleh guru
$stmt = $conn->prepare("SELECT COUNT(*) FROM pengumuman WHERE dibuat_oleh = ?");
$stmt->execute([$guruId]);
$jumlahPengumuman = $stmt->fetchColumn();

// Hitung jumlah forum yang dibuat oleh guru
$stmt = $conn->prepare("SELECT COUNT(*) FROM forum WHERE dibuat_oleh = ?");
$stmt->execute([$guruId]);
$jumlahForum = $stmt->fetchColumn();

// Ambil pengumuman terbaru
$stmt = $conn->prepare("
    SELECT p.*, u.nama AS pembuat 
    FROM pengumuman p
    JOIN users u ON p.dibuat_oleh = u.id
    WHERE p.ditujukan_untuk IN ('guru', 'semua')
    ORDER BY p.created_at DESC
    LIMIT 5
");
$stmt->execute();
$pengumumanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil forum terbaru
$stmt = $conn->prepare("
    SELECT f.*, u.nama AS pembuat 
    FROM forum f
    JOIN users u ON f.dibuat_oleh = u.id
    WHERE f.dibuat_oleh = ?
    ORDER BY f.created_at DESC
    LIMIT 5
");
$stmt->execute([$guruId]);
$forumList = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../../includes/header.php';
include '../../includes/navbar_guru.php';
?>

<div class="p-6 max-w-screen-lg">

 <h1 class="text-2xl font-bold text-blue-800 mb-6">📊 Dashboard Guru</h1>

<!-- Kartu Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white shadow rounded p-4 border-l-4 border-blue-500">
        <h2 class="text-sm font-semibold text-blue-800">📚 Materi</h2>
        <p class="text-xl font-bold"><?= $jumlahMateri ?></p>
    </div>
    <div class="bg-white shadow rounded p-4 border-l-4 border-green-500">
        <h2 class="text-sm font-semibold text-green-800">📝 Tugas</h2>
        <p class="text-xl font-bold"><?= $jumlahTugas ?></p>
    </div>
    <div class="bg-white shadow rounded p-4 border-l-4 border-yellow-500">
        <h2 class="text-sm font-semibold text-yellow-800">📢 Pengumuman</h2>
        <p class="text-xl font-bold"><?= $jumlahPengumuman ?></p>
    </div>
    <div class="bg-white shadow rounded p-4 border-l-4 border-purple-500">
        <h2 class="text-sm font-semibold text-purple-800">💬 Forum Diskusi</h2>
        <p class="text-xl font-bold"><?= $jumlahForum ?></p>
    </div>
</div>

<!-- Daftar Terbaru -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    <!-- Pengumuman -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-semibold mb-3">📢 Pengumuman Terbaru</h2>
        <?php if (empty($pengumumanList)): ?>
            <p class="text-sm text-gray-600">Belum ada pengumuman.</p>
        <?php else: ?>
            <?php foreach ($pengumumanList as $p): ?>
                <div class="border-l-4 border-blue-600 pl-3 mb-3">
                    <h3 class="font-medium text-blue-800"><?= htmlspecialchars($p['judul']) ?></h3>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars(substr($p['isi'], 0, 100)) ?>...</p>
                    <p class="text-xs text-gray-400 mt-1">Oleh: <?= $p['pembuat'] ?> • <?= ucfirst($p['ditujukan_untuk']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Forum Diskusi -->
    <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-semibold mb-3">💬 Forum Diskusi</h2>
        <?php if (empty($forumList)): ?>
            <p class="text-sm text-gray-600">Belum ada forum yang Anda buat.</p>
        <?php else: ?>
            <?php foreach ($forumList as $f): ?>
                <div class="border-b pb-2 mb-2">
                    <h3 class="font-medium text-blue-800"><?= htmlspecialchars($f['topik']) ?></h3>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars(substr($f['isi'], 0, 100)) ?>...</p>
                    <p class="text-xs text-gray-400 mt-1">Oleh: <?= $f['pembuat'] ?> • <?= $f['created_at'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<?php include '../../includes/footer.php'; ?>
