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

// Ambil kelas & mapel yang diajar guru dari tabel tugas
$stmtKelas = $conn->prepare("SELECT DISTINCT k.id, k.nama_kelas FROM kelas k
    JOIN tugas t ON t.kelas_id = k.id
    WHERE t.guru_id = ?");
$stmtKelas->execute([$guru_id]);
$kelasList = $stmtKelas->fetchAll(PDO::FETCH_ASSOC);

$stmtMapel = $conn->prepare("SELECT DISTINCT m.id, m.nama_mapel FROM mata_pelajaran m
    JOIN tugas t ON t.mapel_id = m.id
    WHERE t.guru_id = ?");
$stmtMapel->execute([$guru_id]);
$mapelList = $stmtMapel->fetchAll(PDO::FETCH_ASSOC);

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<main class="p-6 max-w-screen-md">
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">📝 Buat Forum Diskusi Baru</h1>

    <form action="proses_tambah_forum.php" method="POST" class="space-y-4">
        <div>
            <label for="topik" class="block font-semibold mb-1">Topik</label>
            <input type="text" id="topik" name="topik" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="isi" class="block font-semibold mb-1">Isi Diskusi</label>
            <textarea id="isi" name="isi" rows="6" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div>
            <label for="kelas_id" class="block font-semibold mb-1">Kelas</label>
            <select id="kelas_id" name="kelas_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Kelas --</option>
                <?php foreach ($kelasList as $kelas): ?>
                    <option value="<?= $kelas['id'] ?>"><?= htmlspecialchars($kelas['nama_kelas']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="mapel_id" class="block font-semibold mb-1">Mata Pelajaran</label>
            <select id="mapel_id" name="mapel_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Mapel --</option>
                <?php foreach ($mapelList as $mapel): ?>
                    <option value="<?= $mapel['id'] ?>"><?= htmlspecialchars($mapel['nama_mapel']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Simpan Forum</button>
            <a href="forum.php" class="ml-4 text-gray-700 hover:underline">Kembali</a>
        </div>
    </form>

</div>
</main>

<?php include '../../../includes/footer.php'; ?>
