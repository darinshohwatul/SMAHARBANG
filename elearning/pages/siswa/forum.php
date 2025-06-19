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

// Ambil data user
$stmt = $conn->prepare("
    SELECT u.*, k.nama_kelas 
    FROM users u 
    LEFT JOIN kelas k ON u.kelas_id = k.id 
    WHERE u.id = ? AND u.role = 'siswa'
");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil forum sesuai kelas
$stmtForum = $conn->prepare("
    SELECT f.*, u.nama AS pembuat, mp.nama_mapel 
    FROM forum f
    LEFT JOIN users u ON f.dibuat_oleh = u.id
    LEFT JOIN mata_pelajaran mp ON mp.id = f.mapel_id
    WHERE f.kelas_id = ?
    ORDER BY f.created_at DESC
");
$stmtForum->execute([$user['kelas_id']]);
$forums = $stmtForum->fetchAll(PDO::FETCH_ASSOC);

// Handle komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forum_id'], $_POST['komentar'])) {
    $forum_id = $_POST['forum_id'];
    $komentar = trim($_POST['komentar']);

    if (!empty($komentar)) {
        $stmtKomentar = $conn->prepare("INSERT INTO komentar_forum (forum_id, user_id, komentar) VALUES (?, ?, ?)");
        $stmtKomentar->execute([$forum_id, $userId, $komentar]);
        header("Location: forum.php");
        exit;
    }
}
include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-screen-md">
    <h1 class="text-2xl font-bold mb-4">💬 Forum Diskusi Kelas</h1>
    <?php foreach ($forums as $forum): ?>
        <div class="bg-white shadow rounded border-l-4 border-blue-600 mb-6 p-4">
            <h2 class="text-xl font-semibold text-blue-800"><?= htmlspecialchars($forum['topik']) ?></h2>
            <p class="text-gray-700"><?= nl2br(htmlspecialchars($forum['isi'])) ?></p>
            <p class="text-sm text-gray-500 mt-2">
                Mapel: <?= htmlspecialchars($forum['nama_mapel']) ?> • Oleh: <?= htmlspecialchars($forum['pembuat']) ?> • <?= date('d M Y H:i', strtotime($forum['created_at'])) ?>
            </p>

            <!-- Komentar -->
            <div class="p-6 max-w-screen-md">
                <h3 class="text-sm font-semibold text-gray-600 mb-2">💭 Komentar:</h3>
                <?php
                $stmtKomentar = $conn->prepare("
                    SELECT k.*, u.nama 
                    FROM komentar_forum k 
                    JOIN users u ON u.id = k.user_id 
                    WHERE k.forum_id = ? 
                    ORDER BY k.created_at ASC
                ");
                $stmtKomentar->execute([$forum['id']]);
                $komentars = $stmtKomentar->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php if ($komentars): ?>
                    <div class="space-y-2 mb-4">
                        <?php foreach ($komentars as $komentar): ?>
                            <div class="bg-gray-100 rounded p-2">
                                <p class="text-sm"><span class="font-semibold"><?= htmlspecialchars($komentar['nama']) ?>:</span> <?= nl2br(htmlspecialchars($komentar['komentar'])) ?></p>
                                <p class="text-xs text-gray-500"><?= date('d M Y H:i', strtotime($komentar['created_at'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-sm text-gray-400">Belum ada komentar.</p>
                <?php endif; ?>

                <!-- Form Komentar -->
                <form method="POST" class="mt-2 flex gap-2">
                    <input type="hidden" name="forum_id" value="<?= $forum['id'] ?>">
                    <input type="text" name="komentar" placeholder="Tulis komentar..." class="w-full border rounded px-3 py-1 text-sm focus:outline-none focus:ring focus:border-blue-400" required>
                    <button type="submit" class="bg-blue-600 text-white text-sm px-4 py-1 rounded hover:bg-blue-700">Kirim</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include '../../includes/footer.php'; ?>
