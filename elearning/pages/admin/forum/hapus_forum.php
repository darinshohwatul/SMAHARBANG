<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if ($id) {
    $db = new Database();
    $conn = $db->getConnection();

    // Hapus forum berdasarkan id
    $stmt = $conn->prepare("DELETE FROM forum WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: kelola_forum.php");
exit;
