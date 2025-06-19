<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topik = trim($_POST['topik']);
    $isi = trim($_POST['isi']);
    $kelas_id = $_POST['kelas_id'];
    $mapel_id = $_POST['mapel_id'];
    $dibuat_oleh = $_SESSION['user_id'];

    if ($topik && $isi && $kelas_id && $mapel_id) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO forum (topik, isi, mapel_id, kelas_id, dibuat_oleh)
                                VALUES (:topik, :isi, :mapel_id, :kelas_id, :dibuat_oleh)");

        $result = $stmt->execute([
            ':topik' => $topik,
            ':isi' => $isi,
            ':mapel_id' => $mapel_id,
            ':kelas_id' => $kelas_id,
            ':dibuat_oleh' => $dibuat_oleh
        ]);

        if ($result) {
            $_SESSION['flash_success'] = "Forum berhasil ditambahkan.";
        } else {
            $_SESSION['flash_error'] = "Gagal menambahkan forum. Coba lagi.";
        }
    } else {
        $_SESSION['flash_error'] = "Semua field wajib diisi.";
    }
}

header("Location: forum.php");
exit;
