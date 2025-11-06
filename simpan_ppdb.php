<?php
$conn = new mysqli("localhost", "root", "", "db_psb");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Prepare the statement
$stmt = $conn->prepare("INSERT INTO pendaftar (
    tahun_ajaran, jurusan, nisn, asal_sekolah, nama_lengkap,
    tempat_lahir, tanggal_lahir, jenis_kelamin, no_telepon, agama,
    nilai_rata_rata, alamat_lengkap, sumber_informasi,
    ipa, b_indo, b_inggris, mtk
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssssssssdssdddd",
    $_POST["tahun_ajaran"],
    $_POST["jurusan"],
    $_POST["nisn"],
    $_POST["asal_sekolah"],
    $_POST["nama_lengkap"],
    $_POST["tempat_lahir"],
    $_POST["tanggal_lahir"],
    $_POST["jenis_kelamin"],
    $_POST["no_telepon"],
    $_POST["agama"],
    $_POST["nilai_rata_rata"],
    $_POST["alamat_lengkap"],
    $_POST["sumber_informasi"],
    $_POST["ipa"],
    $_POST["b_indo"],
    $_POST["b_inggris"],
    $_POST["mtk"]
);

// Execute the statement
if ($stmt->execute()) {
  header("Location: konfirmasi.php?nisn=" . $_POST["nisn"]);
  exit();
}


// Close the statement and connection
$stmt->close();
$conn->close();
?>
