<?php
session_start();
require_once '../../../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guru') {
    header("Location: ../../../login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();
$guruId = $_SESSION['user_id'];

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: pengumuman.php");
    exit;
}

// Pastikan pengumuman memang milik guru ini
$stmt = $conn->prepare("SELECT id FROM pengumuman WHERE id = ? AND dibuat_oleh = ?");
$stmt->execute([$id, $guruId]);
$exists = $stmt->fetch();

if (!$exists) {
    header("Location: pengumuman.php");
    exit;
}

// Hapus pengumuman
$stmt = $conn->prepare("DELETE FROM pengumuman WHERE id = ? AND dibuat_oleh = ?");
$stmt->execute([$id, $guruId]);

header("Location: pengumuman.php");
exit;
