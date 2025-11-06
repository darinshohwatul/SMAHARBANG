<?php
$conn = new mysqli("localhost", "root", "", "db_psb");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$nisn = $_GET['nisn'] ?? '';

$query = $conn->query("SELECT * FROM pendaftar WHERE nisn='$nisn'");
$data = $query->fetch_assoc();

if (!$data) {
  echo "Data tidak ditemukan.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Konfirmasi Pendaftaran</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e6f0ff;
      color: #000;
      padding: 20px;
    }

    .container {
      background: #fff;
      padding: 30px;
      max-width: 800px;
      margin: auto;
      border-radius: 8px;
    }

    h2 {
      text-align: center;
      color: #365cf4;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    td {
      padding: 8px;
      vertical-align: top;
    }

    th {
      background-color: #365cf4;
      color: #fff;
      padding: 10px;
    }

    .buttons {
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
    }

    .btn {
      background-color: #365cf4;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
    }

    .btn:hover {
      background-color: #000;
    }

    @media print {
  .buttons { display: none; }
  
  /* Header khusus untuk cetak */
  .print-header {
    display: block;
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #365cf4;
  }
  
  .print-header h1 {
    margin: 0;
    font-size: 24px;
    color: #365cf4;
    font-weight: bold;
  }
  
  .print-header p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
  }
  
  /* Header ini hanya muncul saat di layar, disembunyikan saat print */
  .screen-only {
    display: none;
  }
}

/* Header ini disembunyikan di layar, hanya muncul saat print */
.print-only {
  display: none;
}

@media print {
  .print-only {
    display: block;
  }
}

.print-header {
  text-align: center;
  margin-bottom: 30px;
  border-bottom: 2px solid #333;
  padding-bottom: 15px;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}

.logo-section {
  flex-shrink: 0;
}

.school-logo {
  width: 80px;
  height: 80px;
  object-fit: contain;
  border-radius: 8px;
}

.school-info {
  flex: 1;
  text-align: center;
}

.school-info h1 {
  margin: 0 0 10px 0;
  font-size: 24px;
  font-weight: bold;
  color: #333;
}

.school-info p {
  margin: 5px 0;
  font-size: 14px;
  color: #666;
}

/* Untuk tampilan print */
@media print {
  .header-content {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
  }
  
  .school-logo {
    width: 60px !important;
    height: 60px !important;
  }
  
  .school-info h1 {
    font-size: 20px !important;
  }
  
  .school-info p {
    font-size: 12px !important;
  }
  
  .school-info {
    text-align: center !important;
  }
}
  </style>
</head>
<body>
  <div class="container">
    <div class="container">
  <!-- Header khusus untuk print -->
  <div class="print-only print-header">
    <div class="header-content">
      <div class="logo-section">
        <img src="img/smalogo1.jpg" alt="Logo SMA Harbang" class="school-logo">
      </div>
      <div class="school-info">
        <h1>SMA HARBANG</h1>
        <p>Jl. Alamat Sekolah, Kota, Kode Pos</p>
        <p>Telp: (021) 1234567 | Email: info@smaharbang.sch.id</p>
      </div>
    </div>
  </div>
</div>

  <h2>Bukti Pendaftaran Siswa Baru</h2>
  <!-- sisa konten... -->
    <!-- Tabel Informasi Umum -->
    <table>
      <tr><td><strong>NISN</strong></td><td>: <?= htmlspecialchars($data['nisn']) ?></td></tr>
      <tr><td><strong>Nama Lengkap</strong></td><td>: <?= htmlspecialchars($data['nama_lengkap']) ?></td></tr>
      <tr><td><strong>Jurusan</strong></td><td>: <?= htmlspecialchars($data['jurusan']) ?></td></tr>
      <tr><td><strong>Tahun Ajaran</strong></td><td>: <?= htmlspecialchars($data['tahun_ajaran']) ?></td></tr>
      <tr><td><strong>Asal Sekolah</strong></td><td>: <?= htmlspecialchars($data['asal_sekolah']) ?></td></tr>
      <tr><td><strong>Tempat, Tanggal Lahir</strong></td><td>: <?= htmlspecialchars($data['tempat_lahir']) ?>, <?= htmlspecialchars($data['tanggal_lahir']) ?></td></tr>
      <tr><td><strong>Jenis Kelamin</strong></td><td>: <?= htmlspecialchars($data['jenis_kelamin']) ?></td></tr>
      <tr><td><strong>Agama</strong></td><td>: <?= htmlspecialchars($data['agama']) ?></td></tr>
      <tr>
        <td><strong>Nilai Rata-Rata Raport</strong></td>
        <td>: <?= htmlspecialchars($data['nilai_rata_rata'] ?? 'Tidak ada data') ?></td> <!-- Pastikan nama kolom sesuai -->
      </tr>
      <tr><td><strong>Alamat Lengkap</strong></td><td>: <?= htmlspecialchars($data['alamat_lengkap']) ?></td></tr>
      <tr><td><strong>No. Telepon</strong></td><td>: <?= htmlspecialchars($data['no_telepon']) ?></td></tr>
    </table>

    <!-- Tabel Nilai Raport -->
    <h3 style="margin-top:30px; color:#365cf4;">Nilai Raport</h3>
    <table border="1">
      <tr>
        <th>IPA</th>
        <th>Bahasa Indonesia</th>
        <th>Bahasa Inggris</th>
        <th>Matematika</th>
      </tr>
      <tr>
        <td align="center"><?= htmlspecialchars($data['nilai_ipa'] ?? $data['ipa'] ?? 'Tidak ada data') ?></td>
        <td align="center"><?= htmlspecialchars($data['nilai_bindo'] ?? $data['B. Indonesia'] ?? $data['b_indo'] ?? 'Tidak ada data') ?></td>
        <td align="center"><?= htmlspecialchars($data['nilai_bing'] ?? $data['B. Inggris'] ?? $data['b_inggris'] ?? 'Tidak ada data') ?></td>
        <td align="center"><?= htmlspecialchars($data['nilai_mtk'] ?? $data['matematika'] ?? $data['mtk'] ?? 'Tidak ada data') ?></td>
      </tr>
    </table>

    <div class="buttons">
      <a href="#" class="btn" onclick="window.print()">Cetak Bukti</a>
      <a href="home.php" class="btn">Kembali ke Beranda</a>
    </div>
  </div>
  <script>
function printWithHeader() {
  // Simpan konten asli
  const originalContent = document.body.innerHTML;
  
  // Buat header
  const headerContent = `
    <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #365cf4;">
      <h1 style="margin: 0; font-size: 24px; color: #365cf4; font-weight: bold;">SMA HARBANG</h1>
      <p style="margin: 5px 0; font-size: 14px; color: #333;">Jl. Alamat Sekolah, Kota, Kode Pos</p>
      <p style="margin: 5px 0; font-size: 14px; color: #333;">Telp: (021) 1234567 | Email: info@smaharbang.sch.id</p>
    </div>
  `;
  
  // Ganti konten dengan header + konten container
  const containerContent = document.querySelector('.container').innerHTML;
  document.body.innerHTML = `
    <div class="container">
      ${headerContent}
      ${containerContent.replace('<h2>Bukti Pendaftaran Siswa Baru</h2>', '<h2>Bukti Pendaftaran Siswa Baru</h2>')}
    </div>
  `;
  
  // Cetak
  window.print();
  
  // Kembalikan konten asli setelah print dialog ditutup
  setTimeout(() => {
    document.body.innerHTML = originalContent;
  }, 1000);
}
</script>
</body>
</html>