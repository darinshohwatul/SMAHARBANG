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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cek apakah materi milik guru yang login
    $stmt = $conn->prepare("SELECT file FROM materi WHERE id = ? AND guru_id = ?");
    $stmt->execute([$id, $guru_id]);
    $materi = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($materi) {
        $filePath = "../../uploads/materi/" . $materi['file'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $delete = $conn->prepare("DELETE FROM materi WHERE id = ?");
        $delete->execute([$id]);
    }
}

header("Location: materi.php");
exit;
