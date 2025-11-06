<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: kelola_forum.php");
    exit;
}

// Ambil data forum beserta kelas, mapel, dan nama pembuat
$stmt = $conn->prepare("
    SELECT f.*, k.nama_kelas, m.nama_mapel, u.nama AS pembuat
    FROM forum f
    LEFT JOIN kelas k ON f.kelas_id = k.id
    LEFT JOIN mata_pelajaran m ON f.mapel_id = m.id
    LEFT JOIN users u ON f.dibuat_oleh = u.id
    WHERE f.id = ?
");
$stmt->execute([$id]);
$forum = $stmt->fetch();

if (!$forum) {
    header("Location: kelola_forum.php");
    exit;
}

// Ambil komentar untuk forum ini
$stmt = $conn->prepare("
    SELECT c.*, u.nama AS nama_user
    FROM komentar_forum c
    JOIN users u ON c.user_id = u.id
    WHERE c.forum_id = ?
    ORDER BY c.created_at ASC
");
$stmt->execute([$id]);
$komentars = $stmt->fetchAll();

// Proses tambah komentar
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['komentar'])) {
    $komentar = trim($_POST['komentar']);
    $user_id = $_SESSION['user_id'];

    if (!$komentar) {
        $errors[] = "Komentar tidak boleh kosong.";
    } else {
        $stmt = $conn->prepare("INSERT INTO komentar_forum (forum_id, user_id, komentar) VALUES (?, ?, ?)");
        $stmt->execute([$id, $user_id, $komentar]);
        header("Location: detail_forum.php?id=$id");
        exit;
    }
}

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-lg">
    <h1 class="text-3xl font-bold mb-4 text-blue-800"><?= htmlspecialchars($forum['topik']) ?></h1>

    <div class="mb-4 text-gray-700 whitespace-pre-line"><?= htmlspecialchars($forum['isi']) ?></div>

    <div class="mb-6 text-sm text-gray-500">
        <p><strong>Kelas:</strong> <?= $forum['nama_kelas'] ?? 'Semua Kelas' ?></p>
        <p><strong>Mata Pelajaran:</strong> <?= $forum['nama_mapel'] ?? 'Semua Mapel' ?></p>
        <p><strong>Dibuat oleh:</strong> <?= htmlspecialchars($forum['pembuat']) ?></p>
        <p><strong>Dibuat pada:</strong> <?= date('d M Y H:i', strtotime($forum['created_at'])) ?></p>
    </div>

    <hr class="mb-6">

    <h2 class="text-2xl font-semibold mb-4">Komentar (<?= count($komentars) ?>)</h2>

    <?php if ($komentars): ?>
        <div class="space-y-4 mb-8">
            <?php foreach ($komentars as $komentar): ?>
                <div class="border rounded p-4 bg-gray-50">
                    <div class="text-sm font-semibold text-blue-700"><?= htmlspecialchars($komentar['nama_user']) ?></div>
                    <div class="text-gray-700 whitespace-pre-line"><?= htmlspecialchars($komentar['komentar']) ?></div>
                    <div class="text-xs text-gray-400 mt-1"><?= date('d M Y H:i', strtotime($komentar['created_at'])) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-500 mb-8">Belum ada komentar.</p>
    <?php endif; ?>

    <h3 class="text-xl font-semibold mb-2">Tambah Komentar</h3>

    <?php if ($errors): ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <textarea name="komentar" rows="4" class="w-full border border-gray-300 rounded p-3 mb-4" placeholder="Tulis komentar kamu di sini..." required></textarea>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kirim Komentar</button>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
