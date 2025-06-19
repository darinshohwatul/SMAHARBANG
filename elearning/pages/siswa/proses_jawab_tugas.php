<?php
session_start();
require_once '../../config/db.php';

// Cek login dan role
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'siswa') {
    header("Location: ../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$userId = $_SESSION['user_id'];

// Ambil ID tugas dari GET
$tugasId = $_GET['tugas_id'] ?? null;
if (!$tugasId) {
    echo "Tugas tidak ditemukan.";
    exit;
}

// Ambil data user + nama kelas
$stmt = $conn->prepare("
    SELECT u.*, k.nama_kelas 
    FROM users u 
    LEFT JOIN kelas k ON u.kelas_id = k.id 
    WHERE u.id = ? AND u.role = 'siswa'
");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil data tugas (opsional, untuk tampil info tugas)
$stmt = $conn->prepare("
    SELECT t.*, mp.nama_mapel, u.nama AS nama_guru
    FROM tugas t
    JOIN mata_pelajaran mp ON mp.id = t.mapel_id
    JOIN users u ON u.id = t.guru_id
    WHERE t.id = ?
");
$stmt->execute([$tugasId]);
$tugas = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$tugas) {
    echo "Tugas tidak ditemukan.";
    exit;
}

// Cek apakah siswa sudah mengirim jawaban
$stmtJawaban = $conn->prepare("SELECT * FROM jawaban_tugas WHERE tugas_id = ? AND siswa_id = ?");
$stmtJawaban->execute([$tugasId, $userId]);
$jawaban = $stmtJawaban->fetch(PDO::FETCH_ASSOC);

$error = null;

// Proses kirim jawaban jika POST dan belum pernah jawab
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$jawaban) {
    $isiJawaban = trim($_POST['jawaban'] ?? '');
    $linkDrive = trim($_POST['drive_link'] ?? '');
    $uploadedFile = null;

    // Handle file upload jika ada file
    if (!empty($_FILES['file']['name'])) {
        $allowedTypes = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg'];
        $fileName = basename($_FILES['file']['name']);
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($ext, $allowedTypes)) {
            $newName = uniqid() . '.' . $ext;
            $uploadDir = __DIR__ . "/../../uploads/jawaban/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $uploadPath = $uploadDir . $newName;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
                $uploadedFile = $newName;
            } else {
                $error = "Gagal mengunggah file.";
            }
        } else {
            $error = "Format file tidak didukung. Hanya diperbolehkan: " . implode(", ", $allowedTypes);
        }
    }

    // Validasi minimal satu jawaban (teks, file, atau link)
    if (empty($isiJawaban) && empty($uploadedFile) && empty($linkDrive)) {
        $error = "Minimal satu jawaban harus diisi: teks, file, atau link Google Drive.";
    }

    if (!$error) {
        // Buat isi jawaban final dalam bentuk teks gabungan
        $finalJawaban = $isiJawaban;
        if ($uploadedFile) {
            $finalJawaban .= ($finalJawaban ? "\n" : "") . "[File]: uploads/jawaban/" . $uploadedFile;
        }
        if (!empty($linkDrive)) {
            $finalJawaban .= ($finalJawaban ? "\n" : "") . "[Google Drive]: " . $linkDrive;
        }

        // Insert jawaban ke database
        $stmtInsert = $conn->prepare("INSERT INTO jawaban_tugas (tugas_id, siswa_id, jawaban) VALUES (?, ?, ?)");
        $stmtInsert->execute([$tugasId, $userId, $finalJawaban]);

        // Redirect ke halaman tugas atau sukses
        header("Location: tugas.php");
        exit;
    }
}

// Include header dan navbar siswa
include '../../includes/header.php';
include '../../includes/navbar_siswa.php';
?>

<div class="p-6 max-w-4xl mx-leaft">
    <h1 class="text-2xl font-bold mb-4">📝 <?= htmlspecialchars($tugas['judul']) ?></h1>
    <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($tugas['nama_mapel']) ?> • Guru: <?= htmlspecialchars($tugas['nama_guru']) ?></p>
    <p class="text-sm text-gray-500 mb-4">Deadline: <?= date('d M Y H:i', strtotime($tugas['deadline'])) ?></p>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-2">Deskripsi Tugas:</h2>
        <p class="text-gray-700 whitespace-pre-line"><?= nl2br(htmlspecialchars($tugas['deskripsi'])) ?></p>
        <?php if ($tugas['file']): ?>
            <div class="mt-3">
                <a href="../../uploads/tugas/<?= htmlspecialchars($tugas['file']) ?>" target="_blank" class="text-blue-600 hover:underline">
                    📎 Unduh Lampiran
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($jawaban): ?>
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded">
            <h2 class="text-md font-semibold text-green-700 mb-2">✅ Anda telah mengerjakan tugas ini.</h2>
            <p class="text-gray-700 whitespace-pre-line"><strong>Jawaban:</strong><br><?= nl2br(htmlspecialchars($jawaban['jawaban'])) ?></p>
            <?php if (!is_null($jawaban['nilai'])): ?>
                <p class="mt-3 text-sm text-gray-600">Nilai: <span class="font-bold"><?= $jawaban['nilai'] ?></span></p>
            <?php else: ?>
                <p class="mt-3 text-sm text-yellow-600">Belum dinilai</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div>
            <h2 class="text-lg font-semibold mb-2">🖊️ Kirim Jawaban</h2>
            <?php if (!empty($error)): ?>
                <p class="text-red-500 text-sm mb-2"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <textarea name="jawaban" rows="5" class="w-full p-3 border rounded focus:outline-none focus:ring focus:border-blue-500" placeholder="Tulis jawabanmu (boleh kosong jika pakai file atau link)"></textarea>

                <label class="block text-sm font-medium text-gray-700">📁 Unggah File (pdf, doc, docx, png, jpg, jpeg):</label>
                <input type="file" name="file" class="block w-full text-sm border border-gray-300 rounded cursor-pointer" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">

                <label class="block text-sm font-medium text-gray-700">🔗 Link Google Drive:</label>
                <input type="url" name="drive_link" class="w-full p-2 border rounded" placeholder="https://drive.google.com/..." />

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Jawaban</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>
