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

// Ambil semua pengumuman yang dibuat oleh guru ini (urut terbaru)
$stmt = $conn->prepare("SELECT * FROM pengumuman WHERE dibuat_oleh = ? ORDER BY created_at DESC");
$stmt->execute([$guruId]);
$pengumumanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data user guru
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND role = 'guru'");
$stmt->execute([$guruId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../../../includes/header.php';
include '../../../includes/navbar_guru.php';
?>

<div class="p-6 max-w-screen-md">
    <h1 class="text-2xl font-bold mb-6">📢 Daftar Pengumuman</h1>

    <a href="pengumuman_tambah.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">+ Tambah Pengumuman</a>

    <?php if (count($pengumumanList) === 0): ?>
        <p class="text-gray-600">Belum ada pengumuman yang dibuat.</p>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($pengumumanList as $p): ?>
                <div class="border border-gray-300 rounded p-4 bg-white shadow">
                    <h2 class="text-xl font-semibold"><?= htmlspecialchars($p['judul']) ?></h2>
                    <p class="text-gray-700 mt-1 whitespace-pre-line"><?= htmlspecialchars($p['isi']) ?></p>
                    <p class="text-sm text-gray-500 mt-2">Ditujukan untuk: <strong><?= htmlspecialchars($p['ditujukan_untuk']) ?></strong></p>
                    <p class="text-xs text-gray-400 mt-1">Dibuat: <?= date('d M Y H:i', strtotime($p['created_at'])) ?></p>
                    
                    <div class="mt-3 space-x-3">
                        <a href="pengumuman_edit.php?id=<?= $p['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                        <a href="pengumuman_hapus.php?id=<?= $p['id'] ?>" 
                           class="text-red-600 hover:underline"
                           onclick="return confirm('Yakin ingin menghapus pengumuman ini?');">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

