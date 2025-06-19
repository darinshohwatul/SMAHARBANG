<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

// Ambil data statistik
$jumlahGuru = $conn->query("SELECT COUNT(*) FROM users WHERE role = 'guru'")->fetchColumn();
$jumlahSiswa = $conn->query("SELECT COUNT(*) FROM users WHERE role = 'siswa'")->fetchColumn();
$jumlahKelas = $conn->query("SELECT COUNT(*) FROM kelas")->fetchColumn();
$jumlahPengumuman = $conn->query("SELECT COUNT(*) FROM pengumuman")->fetchColumn();

// Ambil pengumuman terbaru
$stmt = $conn->prepare("
    SELECT p.*, u.nama AS pembuat 
    FROM pengumuman p 
    JOIN users u ON p.dibuat_oleh = u.id 
    ORDER BY p.created_at DESC 
    LIMIT 5
");
$stmt->execute();
$pengumumanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../includes/header.php';
include '../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-lg">
    <h1 class="text-2xl font-bold text-blue-800 mb-6">📊 Dashboard Admin</h1>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded p-4 border-l-4 border-blue-500">
            <h2 class="text-sm font-semibold text-blue-800">👨‍🏫 Guru</h2>
            <p class="text-xl font-bold"><?= $jumlahGuru ?></p>
        </div>
        <div class="bg-white shadow rounded p-4 border-l-4 border-green-500">
            <h2 class="text-sm font-semibold text-green-800">👩‍🎓 Siswa</h2>
            <p class="text-xl font-bold"><?= $jumlahSiswa ?></p>
        </div>
        <div class="bg-white shadow rounded p-4 border-l-4 border-yellow-500">
            <h2 class="text-sm font-semibold text-yellow-800">🏫 Kelas</h2>
            <p class="text-xl font-bold"><?= $jumlahKelas ?></p>
        </div>
        <div class="bg-white shadow rounded p-4 border-l-4 border-purple-500">
            <h2 class="text-sm font-semibold text-purple-800">📢 Pengumuman</h2>
            <p class="text-xl font-bold"><?= $jumlahPengumuman ?></p>
        </div>
    </div>

    <!-- Grid Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Pengumuman Terbaru -->
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold mb-4">📢 Pengumuman Terbaru</h2>
            <?php if (empty($pengumumanList)): ?>
                <p class="text-sm text-gray-600">Belum ada pengumuman terbaru.</p>
            <?php else: ?>
                <?php foreach ($pengumumanList as $p): ?>
                    <div class="mb-3 border-l-4 border-blue-600 pl-3">
                        <h3 class="text-blue-800 font-medium"><?= htmlspecialchars($p['judul']) ?></h3>
                        <p class="text-sm text-gray-600"><?= htmlspecialchars(substr($p['isi'], 0, 80)) ?>...</p>
                        <p class="text-xs text-gray-400 mt-1">Oleh: <?= $p['pembuat'] ?> • <?= ucfirst($p['ditujukan_untuk']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


    </div>
</div>

<?php include '../../includes/footer.php'; ?>
