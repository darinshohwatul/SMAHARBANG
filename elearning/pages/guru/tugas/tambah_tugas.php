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

$error = '';
$success = '';

$judul = '';
$deskripsi = '';
$jenis = '';
$mapel_id = '';
$kelas_id = '';
$deadline = '';
$file_name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input form
    $judul = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $jenis = $_POST['jenis'] ?? '';
    $mapel_id = $_POST['mapel_id'] ?? '';
    $kelas_id = $_POST['kelas_id'] ?? '';
    $deadline = $_POST['deadline'] ?? '';

    // Validasi sederhana
    if (!$judul || !$jenis || !$mapel_id || !$kelas_id || !$deadline) {
        $error = 'Judul, jenis, mata pelajaran, kelas, dan deadline harus diisi.';
    } else if (!in_array($jenis, ['essay', 'pilihan_ganda'])) {
        $error = 'Jenis tugas tidak valid.';
    } else {
        // Proses upload file jika ada
        if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
            $allowed_ext = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'zip', 'rar'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_orig_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_ext = strtolower(pathinfo($file_orig_name, PATHINFO_EXTENSION));

            if (!in_array($file_ext, $allowed_ext)) {
                $error = 'Format file tidak diperbolehkan. (pdf, doc, ppt, xls, zip, rar)';
            } else if ($file_size > 10 * 1024 * 1024) {
                $error = 'Ukuran file maksimal 10MB.';
            } else {
                // Buat nama file unik
                $file_name = uniqid('tugas_') . '.' . $file_ext;
                $upload_dir = ROOT_PATH . '/upload/tugas/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $upload_path = $upload_dir . $file_name;

                if (!move_uploaded_file($file_tmp, $upload_path)) {
                    $error = 'Gagal mengunggah file.';
                }
            }
        }

        if (!$error) {
            try {
                $stmt = $conn->prepare("INSERT INTO tugas 
                    (judul, deskripsi, jenis, file, mapel_id, guru_id, kelas_id, deadline) 
                    VALUES 
                    (:judul, :deskripsi, :jenis, :file, :mapel_id, :guru_id, :kelas_id, :deadline)");
                $stmt->execute([
                    ':judul' => $judul,
                    ':deskripsi' => $deskripsi,
                    ':jenis' => $jenis,
                    ':file' => $file_name,
                    ':mapel_id' => $mapel_id,
                    ':guru_id' => $guru_id,
                    ':kelas_id' => $kelas_id,
                    ':deadline' => $deadline,
                ]);

                $success = 'Tugas berhasil ditambahkan.';
                // Reset form
                $judul = $deskripsi = $jenis = $mapel_id = $kelas_id = $deadline = $file_name = '';
            } catch (PDOException $e) {
                $error = 'Gagal menyimpan tugas: ' . $e->getMessage();
                // Jika file sudah diupload tapi gagal simpan DB, hapus file supaya tidak tersisa
                if ($file_name && file_exists($upload_path)) {
                    unlink($upload_path);
                }
            }
        }
    }
}

// Ambil daftar mata pelajaran untuk dropdown
$stmtMapel = $conn->prepare("SELECT id, nama_mapel FROM mata_pelajaran ORDER BY nama_mapel ASC");
$stmtMapel->execute();
$mapelList = $stmtMapel->fetchAll(PDO::FETCH_ASSOC);

// Ambil daftar kelas untuk dropdown
$stmtKelas = $conn->prepare("SELECT id, nama_kelas FROM kelas ORDER BY nama_kelas ASC");
$stmtKelas->execute();
$kelasList = $stmtKelas->fetchAll(PDO::FETCH_ASSOC);

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<!-- Kontainer nempel kiri -->
<main class="p-6 max-w-screen-md">
        <h1 class="text-2xl font-bold mb-6">Tambah Tugas Baru</h1>

        <?php if ($error): ?>
            <div class="bg-red-200 text-red-800 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
        <?php elseif ($success): ?>
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="judul" class="block font-semibold mb-1">Judul Tugas</label>
                <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($judul) ?>" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($deskripsi) ?></textarea>
            </div>

            <div>
                <label for="jenis" class="block font-semibold mb-1">Jenis Tugas</label>
                <select id="jenis" name="jenis" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="essay" <?= $jenis === 'essay' ? 'selected' : '' ?>>Essay</option>
                    <option value="pilihan_ganda" <?= $jenis === 'pilihan_ganda' ? 'selected' : '' ?>>Pilihan Ganda</option>
                </select>
            </div>

            <div>
                <label for="mapel_id" class="block font-semibold mb-1">Mata Pelajaran</label>
                <select id="mapel_id" name="mapel_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    <?php foreach ($mapelList as $mapel): ?>
                        <option value="<?= $mapel['id'] ?>" <?= $mapel_id == $mapel['id'] ? 'selected' : '' ?>>
                          <?= htmlspecialchars($mapel['nama_mapel']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="kelas_id" class="block font-semibold mb-1">Kelas</label>
                <select id="kelas_id" name="kelas_id" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelasList as $kelas): ?>
                        <option value="<?= $kelas['id'] ?>" <?= $kelas_id == $kelas['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kelas['nama_kelas']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="deadline" class="block font-semibold mb-1">Deadline</label>
                <input type="datetime-local" id="deadline" name="deadline" value="<?= htmlspecialchars($deadline) ?>" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="file" class="block font-semibold mb-1">File Tugas (opsional)</label>
                <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar"
                    class="w-full" />
                <p class="text-sm text-gray-500 mt-1">Format: pdf, doc, ppt, xls, zip, rar. Maks 10MB.</p>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Simpan Tugas</button>
                <a href="tugas.php" class="ml-4 text-gray-700 hover:underline">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
