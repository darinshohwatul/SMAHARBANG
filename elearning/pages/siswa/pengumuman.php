<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'siswa') {
    header("Location: ../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'siswa'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil pengumuman yang ditujukan untuk semua atau siswa
$stmt = $conn->prepare("
    SELECT p.*, u.nama AS nama_pembuat 
    FROM pengumuman p
    LEFT JOIN users u ON p.dibuat_oleh = u.id
    WHERE p.ditujukan_untuk IN ('semua', 'siswa')
    ORDER BY p.created_at DESC
");
$stmt->execute();
$pengumumanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-5xl-screen-md">
    <h1 class="text-2xl font-bold mb-4">📢 Pengumuman</h1>

    <?php if (count($pengumumanList) > 0): ?>
        <div class="space-y-4">
            <?php foreach ($pengumumanList as $pengumuman): ?>
                <div class="bg-white border-l-4 border-yellow-500 shadow p-4 rounded">
                    <h2 class="text-lg font-semibold text-yellow-700"><?= htmlspecialchars($pengumuman['judul']) ?></h2>
                    <p class="text-sm text-gray-600 mb-2">Oleh: <?= htmlspecialchars($pengumuman['nama_pembuat'] ?? 'Admin') ?> • <?= date('d M Y H:i', strtotime($pengumuman['created_at'])) ?></p>
                    <p class="text-gray-800"><?= nl2br(htmlspecialchars($pengumuman['isi'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-500">Belum ada pengumuman saat ini.</p>
    <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>
