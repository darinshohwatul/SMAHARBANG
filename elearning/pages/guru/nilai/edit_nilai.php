<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$success = false;
$error = false;

// Ambil data jawaban
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID tidak valid.";
    exit;
}

$jawaban_id = $_GET['id'];

$stmt = $conn->prepare("SELECT jt.*, u.nama AS nama_siswa, t.judul AS judul_tugas 
                        FROM jawaban_tugas jt
                        JOIN users u ON jt.siswa_id = u.id
                        JOIN tugas t ON jt.tugas_id = t.id
                        WHERE jt.id = ?");
$stmt->execute([$jawaban_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Simpan perubahan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai = $_POST['nilai'] ?? null;
    $komentar = $_POST['komentar'] ?? '';

    // Validasi nilai: boleh kosong atau angka 0-100
    if ($nilai === '' || (is_numeric($nilai) && $nilai >= 0 && $nilai <= 100)) {
        $stmt = $conn->prepare("UPDATE jawaban_tugas SET nilai = ?, komentar = ? WHERE id = ?");
        if ($stmt->execute([$nilai === '' ? null : $nilai, $komentar, $jawaban_id])) {
            $success = true;
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }

    // Refresh data terbaru
    $stmt = $conn->prepare("SELECT jt.*, u.nama AS nama_siswa, t.judul AS judul_tugas 
                        FROM jawaban_tugas jt
                        JOIN users u ON jt.siswa_id = u.id
                        JOIN tugas t ON jt.tugas_id = t.id
                        WHERE jt.id = ?");
    $stmt->execute([$jawaban_id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nilai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white shadow-md rounded-lg p-8 max-w-xl w-full">
    <h1 class="text-2xl font-bold mb-4">📝 Edit Nilai Tugas</h1>

    <?php if ($success): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            Nilai berhasil diperbarui!
        </div>
    <?php elseif ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            Terjadi kesalahan saat menyimpan. Pastikan nilai antara 0 sampai 100 atau kosong.
        </div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <div>
            <label class="block font-semibold">Nama Siswa</label>
            <input type="text" value="<?= htmlspecialchars($data['nama_siswa']) ?>" disabled
                   class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Judul Tugas</label>
            <input type="text" value="<?= htmlspecialchars($data['judul_tugas']) ?>" disabled
                   class="w-full bg-gray-100 border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Nilai</label>
            <input type="number" name="nilai" min="0" max="100" step="1" 
                   value="<?= htmlspecialchars((string)$data['nilai']) ?>"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Komentar</label>
            <textarea name="komentar" rows="3"
                      class="w-full border border-gray-300 rounded px-3 py-2"><?= htmlspecialchars((string)($data['komentar'] ?? '')) ?></textarea>
        </div>

        <div class="flex justify-between items-center">
            <a href="nilai.php" class="text-gray-600 hover:text-blue-600">← Kembali</a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
                Simpan
            </button>
        </div>
    </form>
</div>

</body>
</html>
