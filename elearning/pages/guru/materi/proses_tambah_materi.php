<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$mapel_id = $_POST['mapel_id'];
$kelas_id = $_POST['kelas_id'];
$guru_id = $_SESSION['user_id'];

$uploadDir = "../../../upload/materi/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$fileName = $_FILES['file']['name'];
$tmpName = $_FILES['file']['tmp_name'];
$ext = pathinfo($fileName, PATHINFO_EXTENSION);
$newFileName = time() . '_' . uniqid() . '.' . $ext;
$uploadPath = $uploadDir . $newFileName;

if (move_uploaded_file($tmpName, $uploadPath)) {
    $stmt = $conn->prepare("INSERT INTO materi (judul, deskripsi, mapel_id, kelas_id, guru_id, file, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$judul, $deskripsi, $mapel_id, $kelas_id, $guru_id, $newFileName]);

    header("Location: materi.php");
    exit;
} else {
    echo "Gagal mengunggah file!";
}
