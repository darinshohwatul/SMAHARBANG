<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../../login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: pengumuman.php");
    exit;
}

$id = (int) $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("DELETE FROM pengumuman WHERE id = ?");
$stmt->execute([$id]);

header("Location: pengumuman.php");
exit;
