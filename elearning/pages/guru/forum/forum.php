<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$guru_id = $_SESSION['user_id'];

// Ambil filter dari GET
$filter_kelas = $_GET['kelas_id'] ?? '';
$filter_mapel = $_GET['mapel_id'] ?? '';

// Ambil daftar kelas dan mapel dari tugas yang dibuat guru
$stmtKelas = $conn->prepare("SELECT DISTINCT k.id, k.nama_kelas FROM kelas k
    JOIN tugas t ON t.kelas_id = k.id
    WHERE t.guru_id = :guru_id");
$stmtKelas->execute([':guru_id' => $guru_id]);
$kelasList = $stmtKelas->fetchAll(PDO::FETCH_ASSOC);

$stmtMapel = $conn->prepare("SELECT DISTINCT m.id, m.nama_mapel FROM mata_pelajaran m
    JOIN tugas t ON t.mapel_id = m.id
    WHERE t.guru_id = :guru_id");
$stmtMapel->execute([':guru_id' => $guru_id]);
$mapelList = $stmtMapel->fetchAll(PDO::FETCH_ASSOC);

// Query forum
$where = ['f.dibuat_oleh = :guru_id'];
$params = [':guru_id' => $guru_id];

if ($filter_kelas) {
    $where[] = 'f.kelas_id = :kelas_id';
    $params[':kelas_id'] = $filter_kelas;
}
if ($filter_mapel) {
    $where[] = 'f.mapel_id = :mapel_id';
    $params[':mapel_id'] = $filter_mapel;
}

$whereSQL = implode(' AND ', $where);
$sql = "SELECT f.*, k.nama_kelas, m.nama_mapel 
        FROM forum f
        LEFT JOIN kelas k ON f.kelas_id = k.id
        LEFT JOIN mata_pelajaran m ON f.mapel_id = m.id
        WHERE $whereSQL
        ORDER BY f.created_at DESC";

$stmtForum = $conn->prepare($sql);
$stmtForum->execute($params);
$forumList = $stmtForum->fetchAll(PDO::FETCH_ASSOC);

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$guru_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<main class="p-6 max-w-4xl mx-leaft">
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <div class="flex justify-between items-leaft mb-6">
        <h1 class="text-3xl font-bold">💬 Forum Diskusi</h1>
        <a href="tambah_forum.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Forum
        </a>
    </div>

    <form method="get" class="flex gap-4 mb-6 flex-wrap">
        <div>
            <label for="kelas_id" class="block text-sm font-semibold mb-1">Filter Kelas</label>
            <select id="kelas_id" name="kelas_id" onchange="this.form.submit()"
                class="border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Semua Kelas --</option>
                <?php foreach ($kelasList as $kelas): ?>
                    <option value="<?= $kelas['id'] ?>" <?= ($filter_kelas == $kelas['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kelas['nama_kelas']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="mapel_id" class="block text-sm font-semibold mb-1">Filter Mapel</label>
            <select id="mapel_id" name="mapel_id" onchange="this.form.submit()"
                class="border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Semua Mapel --</option>
                <?php foreach ($mapelList as $mapel): ?>
                    <option value="<?= $mapel['id'] ?>" <?= ($filter_mapel == $mapel['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($mapel['nama_mapel']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <?php if (empty($forumList)): ?>
        <div class="text-center text-gray-500">Belum ada forum yang dibuat.</div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($forumList as $forum): ?>
                <div class="border border-gray-300 rounded p-4 bg-gray-50 hover:shadow transition">
                    <div class="flex justify-between items-center mb-1">
                        <h2 class="text-xl font-bold text-blue-700"><?= htmlspecialchars($forum['topik']) ?></h2>
                        <span class="text-sm text-gray-500"><?= date('d M Y H:i', strtotime($forum['created_at'])) ?></span>
                    </div>
                    <div class="text-sm text-gray-600 mb-2">
                        📘 <?= htmlspecialchars($forum['nama_mapel']) ?> | 🏫 <?= htmlspecialchars($forum['nama_kelas']) ?>
                    </div>
                    <p class="text-gray-800"><?= nl2br(htmlspecialchars(substr($forum['isi'], 0, 200))) ?>...</p>
                    <a href="detail_forum.php?id=<?= $forum['id'] ?>" class="text-blue-600 hover:underline text-sm mt-2 inline-block">Lihat Diskusi</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
</main>

<?php include '../../../includes/footer.php'; ?>
