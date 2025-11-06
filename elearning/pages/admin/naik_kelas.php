<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

// Ambil daftar kelas
$stmt = $conn->query("SELECT id, nama_kelas FROM kelas ORDER BY nama_kelas ASC");
$kelasList = $stmt->fetchAll();

$info = '';
$error = '';
$siswaList = [];

$kelas_asal = $_POST['kelas_asal'] ?? '';
$kelas_tujuan = $_POST['kelas_tujuan'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lihat_siswa'])) {
        if ($kelas_asal && $kelas_tujuan && $kelas_asal !== $kelas_tujuan) {
            $stmt = $conn->prepare("SELECT id, nama, nis FROM users WHERE kelas_id = ? AND role = 'siswa'");
            $stmt->execute([$kelas_asal]);
            $siswaList = $stmt->fetchAll();
        } else {
            $error = "Silakan pilih kelas asal dan tujuan yang berbeda.";
        }
    }

    if (isset($_POST['konfirmasi_naikkan'])) {
        if ($kelas_asal && $kelas_tujuan && isset($_POST['siswa_ids'])) {
            $siswa_ids = $_POST['siswa_ids'];
            $placeholders = implode(',', array_fill(0, count($siswa_ids), '?'));
            $query = "UPDATE users SET kelas_id = ? WHERE id IN ($placeholders) AND role = 'siswa'";
            $stmt = $conn->prepare($query);
            $stmt->execute(array_merge([$kelas_tujuan], $siswa_ids));
            $jumlah = $stmt->rowCount();
            $info = "✅ Berhasil menaikkan $jumlah siswa ke kelas tujuan.";
        } else {
            $error = "Tidak ada siswa yang dipilih atau data tidak lengkap.";
        }
    }
}

// Ambil user admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../includes/header.php';
include '../../includes/navbar_admin.php';
?>

<div class="p-6 max-w-screen-lg">
    <h2 class="text-2xl font-semibold text-blue-700 mb-4">📚 Naikkan Kelas Siswa</h2>

    <?php if ($info): ?>
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4"><?= htmlspecialchars($info) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow space-y-4">
        <input type="hidden" name="kelas_asal" value="<?= htmlspecialchars($kelas_asal) ?>">
        <input type="hidden" name="kelas_tujuan" value="<?= htmlspecialchars($kelas_tujuan) ?>">

        <div>
            <label class="block font-medium">Kelas Asal</label>
            <select name="kelas_asal" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Kelas Asal --</option>
                <?php foreach ($kelasList as $kelas): ?>
                    <option value="<?= $kelas['id'] ?>" <?= $kelas['id'] == $kelas_asal ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kelas['nama_kelas']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block font-medium">Kelas Tujuan</label>
            <select name="kelas_tujuan" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Kelas Tujuan --</option>
                <?php foreach ($kelasList as $kelas): ?>
                    <option value="<?= $kelas['id'] ?>" <?= $kelas['id'] == $kelas_tujuan ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kelas['nama_kelas']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" name="lihat_siswa" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lihat Siswa</button>
        </div>

        <?php if ($siswaList): ?>
            <hr class="my-4">
            <h3 class="text-lg font-semibold mb-2">📋 Pilih Siswa yang Akan Dinaikkan:</h3>
            <div class="max-h-64 overflow-y-auto border rounded bg-gray-50">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-2">Pilih</th>
                            <th class="p-2">Nama</th>
                            <th class="p-2">NIS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswaList as $siswa): ?>
                            <tr class="border-t">
                                <td class="p-2">
                                    <input type="checkbox" name="siswa_ids[]" value="<?= $siswa['id'] ?>" checked>
                                </td>
                                <td class="p-2"><?= htmlspecialchars($siswa['nama']) ?></td>
                                <td class="p-2"><?= htmlspecialchars($siswa['nis']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-right">
                <button type="submit" name="konfirmasi_naikkan" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Naikkan yang Dipilih</button>
            </div>
        <?php endif; ?>
    </form>
</div>
