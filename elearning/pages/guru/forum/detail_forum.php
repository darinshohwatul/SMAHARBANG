<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$forum_id = $_GET['id'] ?? null;

if (!$forum_id) {
    header("Location: forum.php");
    exit;
}

$stmt = $conn->prepare("SELECT f.*, k.nama_kelas, m.nama_mapel, u.nama AS pembuat
    FROM forum f
    JOIN kelas k ON f.kelas_id = k.id
    JOIN mata_pelajaran m ON f.mapel_id = m.id
    JOIN users u ON f.dibuat_oleh = u.id
    WHERE f.id = ?");
$stmt->execute([$forum_id]);
$forum = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$forum) {
    echo "Forum tidak ditemukan."; exit;
}

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Komentar
$stmtKomentar = $conn->prepare("SELECT kf.*, u.nama FROM komentar_forum kf
    JOIN users u ON kf.user_id = u.id
    WHERE kf.forum_id = ?
    ORDER BY kf.created_at ASC");
$stmtKomentar->execute([$forum_id]);
$komentarList = $stmtKomentar->fetchAll(PDO::FETCH_ASSOC);

// Proses tambah komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isi_komentar = $_POST['komentar'];
    if (!empty($isi_komentar)) {
        $stmt = $conn->prepare("INSERT INTO komentar_forum (forum_id, user_id, komentar) VALUES (?, ?, ?)");
        $stmt->execute([$forum_id, $_SESSION['user_id'], $isi_komentar]);
        header("Location: detail_forum.php?id=$forum_id");
        exit;
    }
}

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<main class="p-6 max-w-screen-md">
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($forum['topik']) ?></h2>
    <p class="text-gray-700"><?= nl2br(htmlspecialchars($forum['isi'])) ?></p>
    <p class="text-sm text-gray-500 mt-2">
        Dibuat oleh: <?= htmlspecialchars($forum['pembuat']) ?> | Mapel: <?= htmlspecialchars($forum['nama_mapel']) ?> | Kelas: <?= htmlspecialchars($forum['nama_kelas']) ?>
    </p>

    <hr class="my-4">

    <h3 class="text-xl font-semibold mb-2">💬 Komentar</h3>
    <form method="post" class="mb-4">
        <textarea name="komentar" required rows="3" placeholder="Tulis komentar..." class="w-full border px-3 py-2 rounded focus:outline-none focus:ring"></textarea>
        <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Komentar</button>
    </form>

    <div class="space-y-3">    <a href="forum.php" class="ml-4 text-gray-700 hover:underline">Kembali</a>
        <?php foreach ($komentarList as $komentar): ?>
            <div class="bg-gray-100 p-3 rounded">
                <strong><?= htmlspecialchars($komentar['nama']) ?></strong> 
                <span class="text-sm text-gray-500">(<?= date('d M Y, H:i', strtotime($komentar['created_at'])) ?>)</span>
                <p class="text-gray-700"><?= nl2br(htmlspecialchars($komentar['komentar'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</main>

<?php include '../../../includes/footer.php'; ?>
