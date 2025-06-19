<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: tugas.php");
    exit;
}

$tugas_id = (int) $_GET['id'];
$guru_id = $_SESSION['user_id'];

$db = new Database();
$conn = $db->getConnection();

// Ambil data tugas untuk dapat nama file
$stmt = $conn->prepare("SELECT file FROM tugas WHERE id = :id AND guru_id = :guru_id");
$stmt->execute([':id' => $tugas_id, ':guru_id' => $guru_id]);
$tugas = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tugas) {
    header("Location: tugas.php");
    exit;
}

try {
    // Hapus file jika ada
    if ($tugas['file']) {
        $file_path = ROOT_PATH . '/uploads/tugas/' . $tugas['file'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Hapus data tugas
    $stmtDel = $conn->prepare("DELETE FROM tugas WHERE id = :id AND guru_id = :guru_id");
    $stmtDel->execute([':id' => $tugas_id, ':guru_id' => $guru_id]);

} catch (PDOException $e) {
    // Bisa tambahkan log error jika perlu
}

// Redirect kembali ke daftar tugas
header("Location: tugas.php");
exit;
