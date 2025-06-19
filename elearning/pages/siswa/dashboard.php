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
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'siswa'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil pengumuman terbaru
$stmtPengumuman = $conn->prepare("SELECT p.*, u.nama AS pembuat FROM pengumuman p JOIN users u ON u.id = p.dibuat_oleh WHERE p.ditujukan_untuk IN ('siswa', 'semua') ORDER BY p.id DESC LIMIT 5");
$stmtPengumuman->execute();
$pengumumanList = $stmtPengumuman->fetchAll(PDO::FETCH_ASSOC);

// Ambil forum diskusi terakhir
$stmtForum = $conn->prepare("SELECT * FROM forum ORDER BY id DESC LIMIT 5");
$stmtForum->execute();
$forumList = $stmtForum->fetchAll(PDO::FETCH_ASSOC);

// Ambil semua tugas
$stmtTugas = $conn->prepare("SELECT t.*, m.nama_mapel FROM tugas t JOIN mata_pelajaran m ON m.id = t.mapel_id WHERE t.kelas_id = ?");
$stmtTugas->execute([$user['kelas_id']]);
$semuaTugas = $stmtTugas->fetchAll(PDO::FETCH_ASSOC);

// Ambil tugas yang sudah dijawab
$stmtJawaban = $conn->prepare("SELECT tugas_id FROM jawaban_tugas WHERE siswa_id = ?");
$stmtJawaban->execute([$userId]);
$tugasSelesai = $stmtJawaban->fetchAll(PDO::FETCH_COLUMN);

include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-screen-lg">
    
    <!-- Grid Tiga Bagian -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Pengumuman -->
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-lg font-semibold mb-3">📢 Pengumuman Terbaru</h2>
            <?php foreach ($pengumumanList as $p): ?>
                <div class="border-l-4 border-blue-600 pl-3 mb-3">
                    <h3 class="font-medium text-blue-800"><?= htmlspecialchars($p['judul']) ?></h3>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars(substr($p['isi'], 0, 80)) ?>...</p>
                    <p class="text-xs text-gray-400 mt-1">Oleh: <?= $p['pembuat'] ?> • <?= ucfirst($p['ditujukan_untuk']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Forum -->
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-lg font-semibold mb-3">💬 Forum Diskusi</h2>
            <?php foreach ($forumList as $f): ?>
                <div class="mb-3">
                    <h3 class="font-medium text-gray-800"><?= htmlspecialchars($f['topik']) ?></h3>
                    <p class="text-sm text-gray-600"><?= htmlspecialchars(substr($f['isi'], 0, 80)) ?>...</p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Tugas -->
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-lg font-semibold mb-3">📝 Tugas</h2>
            <ul class="space-y-2">
                <?php foreach ($semuaTugas as $t): 
                    $selesai = in_array($t['id'], $tugasSelesai);
                ?>
                <li class="flex justify-between items-center border p-2 rounded <?= $selesai ? 'bg-green-100' : 'bg-red-100' ?>">
                    <div>
                        <p class="font-medium"><?= htmlspecialchars($t['judul']) ?></p>
                        <span class="text-sm text-gray-600"><?= $t['nama_mapel'] ?> • Deadline: <?= $t['deadline'] ?></span>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full <?= $selesai ? 'bg-green-500 text-white' : 'bg-red-500 text-white' ?>">
                        <?= $selesai ? 'Selesai' : 'Belum' ?>
                    </span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</div>
  </div> <!-- End Main Content -->
</div> <!-- End Flex -->

<?php include '../../includes/footer.php'; ?>
