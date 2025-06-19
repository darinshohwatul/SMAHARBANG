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

// Ambil data materi yang diunggah guru ini
$stmt = $conn->prepare("SELECT m.*, mp.nama_mapel, k.nama_kelas 
                        FROM materi m 
                        JOIN mata_pelajaran mp ON mp.id = m.mapel_id 
                        JOIN kelas k ON k.id = m.kelas_id 
                        WHERE m.guru_id = ?
                        ORDER BY m.created_at DESC");
$stmt->execute([$guru_id]);
$materiList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil daftar mapel dan kelas untuk form tambah materi
$mapel = $conn->query("SELECT * FROM mata_pelajaran")->fetchAll(PDO::FETCH_ASSOC);
$kelas = $conn->query("SELECT * FROM kelas")->fetchAll(PDO::FETCH_ASSOC);

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<!-- Container dengan max width dan posisi kiri (no mx-auto) -->
<div class="p-6 max-w-screen-md">
    <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-4">📚 Daftar Materi</h2>

        <!-- Form tambah materi -->
        <form action="proses_tambah_materi.php" method="POST" enctype="multipart/form-data" class="space-y-4 mb-6">
            <div>
                <label class="block font-medium">Judul Materi</label>
                <input type="text" name="judul" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium">Deskripsi</label>
                <textarea name="deskripsi" rows="3" required class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Mata Pelajaran</label>
                    <select name="mapel_id" required class="w-full border rounded px-3 py-2">
                        <option value="">-- Pilih Mapel --</option>
                        <?php foreach ($mapel as $m): ?>
                            <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nama_mapel']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block font-medium">Kelas</label>
                    <select name="kelas_id" required class="w-full border rounded px-3 py-2">
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($kelas as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama_kelas']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div>
                <label class="block font-medium">File Materi</label>
                <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.png" required class="w-full">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Materi
            </button>
        </form>

        <!-- Tabel materi -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2">Judul</th>
                        <th class="px-4 py-2">Mapel</th>
                        <th class="px-4 py-2">Kelas</th>
                        <th class="px-4 py-2">File</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($materiList as $m): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2"><?= htmlspecialchars($m['judul']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($m['nama_mapel']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($m['nama_kelas']) ?></td>
                            <td class="px-4 py-2">
                                <a href="../../uploads/materi/<?= htmlspecialchars($m['file']) ?>" target="_blank" class="text-blue-600 underline">
                                    Lihat
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                <a href="hapus_materi.php?id=<?= $m['id'] ?>" 
                                   onclick="return confirm('Yakin ingin menghapus materi ini?')" 
                                   class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($materiList)): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada materi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include '../../../includes/footer.php'; ?>
