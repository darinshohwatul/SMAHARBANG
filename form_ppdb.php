<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulir Pendaftaran SMA</title>
  <link rel="stylesheet" href="style_ppdb.css">
</head>
<body>
  <div class="container">
    <h2>Formulir Pendaftaran Siswa Baru</h2>
    <form id="pendaftaranForm" action="simpan_ppdb.php" method="POST" onsubmit="return validateForm()">
      <h3>Data Siswa</h3>
      <input type="text" name="tahun_ajaran" placeholder="Tahun Ajaran *">
      <select name="jurusan">
        <option value="">Pilih Jurusan *</option>
        <option value="MIPA">MIPA</option>
        <option value="IPS">IPS</option>
        <option value="BAHASA">BAHASA</option>
      </select>
      <input type="text" name="nisn" placeholder="NISN *">
      <input type="text" name="asal_sekolah" placeholder="Asal Sekolah *">
      <input type="text" name="nama_lengkap" placeholder="Nama Lengkap *">
      <input type="text" name="tempat_lahir" placeholder="Tempat Lahir *">
      <input type="date" name="tanggal_lahir">
      <select name="jenis_kelamin">
        <option value="">Jenis Kelamin *</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
      <input type="text" name="no_telepon" placeholder="No Telepon *">
      <select name="agama">
        <option value="">Agama *</option>
        <option>Islam</option>
        <option>Kristen</option>
        <option>Katolik</option>
        <option>Hindu</option>
        <option>Buddha</option>
        <option>Konghucu</option>
      </select>
      <input type="number" step="0.01" name="nilai_rata_rata" placeholder="Nilai Rata-Rata Raport *">
      <textarea name="alamat_lengkap" placeholder="Alamat Lengkap *"></textarea>
      <select name="sumber_informasi">
        <option value="">Sumber Informasi *</option>
        <option>Media Sosial</option>
        <option>Teman</option>
        <option>Guru</option>
        <option>Lainnya</option>
      </select>

      <h3>Nilai Raport</h3>
      <input type="number" step="0.01" name="ipa" placeholder="Nilai IPA *">
      <input type="number" step="0.01" name="b_indo" placeholder="Nilai B. Indonesia *">
      <input type="number" step="0.01" name="b_inggris" placeholder="Nilai B. Inggris *">
      <input type="number" step="0.01" name="mtk" placeholder="Nilai Matematika *">

      <div class="button-group">
        <button type="submit">Daftar Sekarang</button>
        <a href="home.php" class="back-button">Kembali ke Beranda</a>
      </div>
    </form>
  </div>

  <script src="script.js"></script>

  <script>
  function validateForm() {
  const fields = document.querySelectorAll("#pendaftaranForm input, #pendaftaranForm select, #pendaftaranForm textarea");
  for (const field of fields) {
    if (!field.value.trim()) {
      alert(`Harap isi semua kolom. Kolom "${field.name}" masih kosong.`);
      field.focus();
      return false;
    }

    if (field.name === "no_telepon" && !/^\d{1,20}$/.test(field.value)) {
      alert("No Telepon harus berupa angka maksimal 20 digit.");
      field.focus();
      return false;
    }
  }
  return true;
}
</script>

</body>
</html>
