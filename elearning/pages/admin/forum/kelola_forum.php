<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

// Ambil data filter dari GET
$search = $_GET['search'] ?? '';
$filterKelas = $_GET['kelas'] ?? '';
$filterMapel = $_GET['mapel'] ?? '';
$filterGuru = $_GET['guru'] ?? '';

// Ambil data kelas, mata_pelajaran, dan guru untuk filter dropdown
$kelasList = $conn->query("SELECT id, nama_kelas FROM kelas")->fetchAll();
$mapelList = $conn->query("SELECT id, nama_mapel FROM mata_pelajaran")->fetchAll();
$guruList = $conn->prepare("SELECT id, nama FROM users WHERE role = 'guru'");
$guruList->execute();
$guruList = $guruList->fetchAll();

// Buat query utama dengan join
$query = "SELECT f.*, k.nama_kelas, m.nama_mapel, u.nama AS nama_guru
          FROM forum f
          LEFT JOIN kelas k ON f.kelas_id = k.id
          LEFT JOIN mata_pelajaran m ON f.mapel_id = m.id
          LEFT JOIN users u ON f.dibuat_oleh = u.id
          WHERE 1=1";

$params = [];

// Filter pencarian topik dan isi
if ($search) {
    $query .= " AND (f.topik LIKE :search OR f.isi LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}

// Filter kelas
if ($filterKelas) {
    $query .= " AND f.kelas_id = :kelas_id";
    $params[':kelas_id'] = $filterKelas;
}

// Filter mapel
if ($filterMapel) {
    $query .= " AND f.mapel_id = :mapel_id";
    $params[':mapel_id'] = $filterMapel;
}

// Filter guru
if ($filterGuru) {
    $query .= " AND f.dibuat_oleh = :guru_id";
    $params[':guru_id'] = $filterGuru;
}

$query .= " ORDER BY f.created_at DESC";

$stmt = $conn->prepare($query);
$stmt->execute($params);
$forums = $stmt->fetchAll();

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-lg">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-800">💬 Kelola Forum Diskusi</h1>
    </div>

    <!-- Form Filter -->
    <form method="GET" class="flex flex-wrap items-center gap-3 mb-6">
        <input type="text" name="search" placeholder="Cari topik/isi forum..." value="<?= htmlspecialchars($search) ?>"
            class="border border-gray-300 rounded px-3 py-2 flex-grow" />

        <select name="kelas" class="border border-gray-300 rounded px-3 py-2">
            <option value="">-- Filter Kelas --</option>
            <?php foreach ($kelasList as $kelas): ?>
                <option value="<?= $kelas['id'] ?>" <?= ($filterKelas == $kelas['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($kelas['nama_kelas']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="mapel" class="border border-gray-300 rounded px-3 py-2">
            <option value="">-- Filter Mata Pelajaran --</option>
            <?php foreach ($mapelList as $mapel): ?>
                <option value="<?= $mapel['id'] ?>" <?= ($filterMapel == $mapel['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($mapel['nama_mapel']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="guru" class="border border-gray-300 rounded px-3 py-2">
            <option value="">-- Filter Guru --</option>
            <?php foreach ($guruList as $guru): ?>
                <option value="<?= $guru['id'] ?>" <?= ($filterGuru == $guru['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($guru['nama']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Tabel Daftar Forum -->
    <div class="overflow-x-auto border border-gray-200 rounded shadow-sm">
        <table class="min-w-full text-sm border-collapse">
            <thead class="bg-blue-100 text-blue-900">
                <tr>
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Topik</th>
                    <th class="p-3 border">Kelas</th>
                    <th class="p-3 border">Mata Pelajaran</th>
                    <th class="p-3 border">Guru</th>
                    <th class="p-3 border">Dibuat Pada</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($forums): ?>
                    <?php foreach ($forums as $i => $forum): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border"><?= $i + 1 ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($forum['topik']) ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($forum['nama_kelas'] ?? '-') ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($forum['nama_mapel'] ?? '-') ?></td>
                            <td class="p-3 border"><?= htmlspecialchars($forum['nama_guru'] ?? '-') ?></td>
                            <td class="p-3 border"><?= date('d M Y H:i', strtotime($forum['created_at'])) ?></td>
                            <td class="p-3 border whitespace-nowrap">
                                <a href="detail_forum.php?id=<?= $forum['id'] ?>" class="text-blue-600 hover:underline mr-2">Lihat</a>
                                <a href="hapus_forum.php?id=<?= $forum['id'] ?>" onclick="return confirm('Yakin hapus forum ini?')"
                                   class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center text-gray-500 py-6">Belum ada forum diskusi.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../../includes/footer.php'; ?>
