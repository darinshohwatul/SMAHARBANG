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

$filter_kelas = $_GET['kelas_id'] ?? '';
$filter_tugas = $_GET['tugas_id'] ?? '';

// Ambil daftar kelas
$stmtKelas = $conn->prepare("SELECT DISTINCT k.id, k.nama_kelas FROM kelas k
    JOIN tugas t ON t.kelas_id = k.id
    WHERE t.guru_id = :guru_id ORDER BY k.nama_kelas ASC");
$stmtKelas->execute([':guru_id' => $guru_id]);
$kelasList = $stmtKelas->fetchAll(PDO::FETCH_ASSOC);

// Ambil daftar tugas
$tugasList = [];
if ($filter_kelas) {
    $stmtTugas = $conn->prepare("SELECT id, judul FROM tugas WHERE guru_id = :guru_id AND kelas_id = :kelas_id ORDER BY judul ASC");
    $stmtTugas->execute([':guru_id' => $guru_id, ':kelas_id' => $filter_kelas]);
    $tugasList = $stmtTugas->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil data nilai
$whereClauses = ['t.guru_id = :guru_id'];
$params = [':guru_id' => $guru_id];

if ($filter_kelas) {
    $whereClauses[] = 't.kelas_id = :kelas_id';
    $params[':kelas_id'] = $filter_kelas;
}
if ($filter_tugas) {
    $whereClauses[] = 'jt.tugas_id = :tugas_id';
    $params[':tugas_id'] = $filter_tugas;
}

$whereSQL = implode(' AND ', $whereClauses);
$sql = "SELECT jt.id AS jawaban_id, u.nama AS nama_siswa, t.judul AS judul_tugas, jt.nilai, jt.jawaban, 
        k.nama_kelas, jt.created_at, jt.komentar
        FROM jawaban_tugas jt
        JOIN tugas t ON jt.tugas_id = t.id
        JOIN users u ON jt.siswa_id = u.id
        JOIN kelas k ON t.kelas_id = k.id
        WHERE $whereSQL
        ORDER BY k.nama_kelas, t.judul, u.nama";

$stmtNilai = $conn->prepare($sql);
$stmtNilai->execute($params);
$nilaiList = $stmtNilai->fetchAll(PDO::FETCH_ASSOC);

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<main class="p-6 max-w-screen-lg">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

        <?php if (isset($_SESSION['flash_success'])): ?>
            <div class="bg-green-100 text-green-800 border border-green-400 px-4 py-3 rounded mb-4">
                <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
            </div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold text-gray-800 mb-6">📊 Daftar Nilai Tugas</h1>

        <form method="get" class="flex flex-wrap gap-4 mb-6">
            <div>
                <label class="block mb-1 font-medium text-gray-700" for="kelas_id">Kelas</label>
                <select name="kelas_id" id="kelas_id" onchange="this.form.submit()"
                    class="w-48 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                    <option value="">-- Semua Kelas --</option>
                    <?php foreach ($kelasList as $kelas): ?>
                        <option value="<?= $kelas['id'] ?>" <?= $filter_kelas == $kelas['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kelas['nama_kelas']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700" for="tugas_id">Tugas</label>
                <select name="tugas_id" id="tugas_id" onchange="this.form.submit()" <?= !$filter_kelas ? 'disabled' : '' ?>
                    class="w-56 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500">
                    <option value="">-- Semua Tugas --</option>
                    <?php foreach ($tugasList as $tugas): ?>
                        <option value="<?= $tugas['id'] ?>" <?= $filter_tugas == $tugas['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tugas['judul']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-300 rounded">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 border">Kelas</th>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">Judul Tugas</th>
                        <th class="px-4 py-2 border">Nilai</th>
                        <th class="px-4 py-2 border">Jawaban</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Komentar</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php if (!$nilaiList): ?>
                        <tr><td colspan="8" class="text-center py-4 text-gray-500">Belum ada data nilai.</td></tr>
                    <?php else: ?>
                        <?php foreach ($nilaiList as $nilai): ?>
                            <tr class="hover:bg-gray-50 border-t">
                                <td class="px-4 py-2"><?= htmlspecialchars($nilai['nama_kelas']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($nilai['nama_siswa']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($nilai['judul_tugas']) ?></td>
                                <td class="px-4 py-2 text-center">
                                    <?= $nilai['nilai'] !== null ? htmlspecialchars($nilai['nilai']) : '<em class="text-gray-500">Belum dinilai</em>' ?>
                                </td>
                                <td class="px-4 py-2 whitespace-pre-line">
                                    <?php
                                    $jawabanLines = explode("\n", $nilai['jawaban']);
                                    foreach ($jawabanLines as $line) {
                                        $line = trim($line);
                                        if (str_starts_with($line, '[File]:')) {
                                            $file = trim(str_replace('[File]:', '', $line));
                                            $safePath = htmlspecialchars('../../' . $file);
                                            echo "<a href='$safePath' target='_blank' class='text-blue-600 hover:underline'>📎 Lihat File</a><br>";
                                        } elseif (str_starts_with($line, '[Google Drive]:')) {
                                            $link = trim(str_replace('[Google Drive]:', '', $line));
                                            echo "<a href='$link' target='_blank' class='text-green-600 hover:underline'>🔗 Google Drive</a><br>";
                                        } else {
                                            echo htmlspecialchars($line) . "<br>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="px-4 py-2"><?= htmlspecialchars($nilai['created_at']) ?></td>
                                <td class="px-4 py-2">
                                    <?= !empty($nilai['komentar']) ? nl2br(htmlspecialchars($nilai['komentar'])) : '<em class="text-gray-500">Belum ada</em>' ?>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="edit_nilai.php?id=<?= $nilai['jawaban_id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../../../includes/footer.php'; ?>
