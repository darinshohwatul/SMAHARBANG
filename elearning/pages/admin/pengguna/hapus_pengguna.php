<?php
require_once '../../../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: kelola_pengguna.php");
    exit;
}

$id = $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: kelola_pengguna.php");
exit;
