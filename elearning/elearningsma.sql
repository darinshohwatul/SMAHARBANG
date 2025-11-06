-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2025 at 11:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearningsma`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int NOT NULL,
  `topik` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `mapel_id` int DEFAULT NULL,
  `kelas_id` int DEFAULT NULL,
  `dibuat_oleh` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `topik`, `isi`, `mapel_id`, `kelas_id`, `dibuat_oleh`, `created_at`) VALUES
(1, 'Diskusi Persamaan Kuadrat', 'Bagaimana cara menyelesaikan persamaan kuadrat dengan faktorisasi?', 1, 1, 5, '2025-06-02 16:11:11'),
(2, 'Teks Eksposisi Sulit', 'Saya kesulitan memahami bagian struktur teks eksposisi.', 2, 2, 6, '2025-06-02 16:11:11'),
(3, 'Hukum Newton Penjelasan', 'Bisakah guru menjelaskan contoh soal hukum Newton?', 3, 3, 7, '2025-06-02 16:11:11'),
(4, 'Latihan Grammar', 'Share latihan grammar bahasa Inggris yuk!', 6, 3, 6, '2025-06-02 16:11:11'),
(5, 'Sejarah Indonesia Modern', 'Diskusi tentang perkembangan sejarah Indonesia setelah kemerdekaan.', 5, 2, 5, '2025-06-02 16:11:11'),
(6, 'akar kuadrat', 'mari kita bahas ulang soal nomer 15', 1, 1, 2, '2025-06-06 14:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `guru_mapel`
--

CREATE TABLE `guru_mapel` (
  `id` int NOT NULL,
  `guru_id` int NOT NULL,
  `mapel_id` int NOT NULL,
  `kelas_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru_mapel`
--

INSERT INTO `guru_mapel` (`id`, `guru_id`, `mapel_id`, `kelas_id`) VALUES
(1, 2, 1, 1),
(2, 2, 4, 1),
(3, 3, 2, 2),
(4, 3, 5, 2),
(5, 4, 3, 3),
(6, 4, 6, 3),
(7, 2, 1, 4),
(8, 3, 2, 5),
(9, 4, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_tugas`
--

CREATE TABLE `jawaban_tugas` (
  `id` int NOT NULL,
  `tugas_id` int DEFAULT NULL,
  `siswa_id` int DEFAULT NULL,
  `jawaban` text,
  `nilai` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `feedback` text,
  `komentar` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jawaban_tugas`
--

INSERT INTO `jawaban_tugas` (`id`, `tugas_id`, `siswa_id`, `jawaban`, `nilai`, `created_at`, `feedback`, `komentar`) VALUES
(1, 1, 5, 'Jawaban pilihan ganda persamaan kuadrat', 85, '2025-06-02 16:11:11', NULL, NULL),
(2, 1, 6, 'Jawaban pilihan ganda persamaan kuadrat', 90, '2025-06-02 16:11:11', NULL, NULL),
(3, 2, 5, 'Essay tentang teks eksposisi ...', 80, '2025-06-02 16:11:11', NULL, NULL),
(4, 3, 7, 'Jawaban soal hukum Newton', 88, '2025-06-02 16:11:11', NULL, NULL),
(5, 4, 5, 'Laporan reaksi kimia saya ...', 92, '2025-06-02 16:11:11', NULL, 'okee lumayan'),
(6, 5, 6, 'Jawaban quiz sejarah Indonesia', 87, '2025-06-02 16:11:11', NULL, NULL),
(7, 6, 7, 'Latihan grammar jawaban', 75, '2025-06-02 16:11:11', NULL, NULL),
(8, 7, 5, 'Essay fungsi trigonometri', 85, '2025-06-02 16:11:11', NULL, NULL),
(9, 2, 6, 'iyaaa', NULL, '2025-06-05 16:15:31', NULL, NULL),
(10, 9, 5, '[File]: uploads/jawaban/6842b83725583.docx', 100, '2025-06-06 09:43:19', NULL, 'bagus sekali dan sangat mudah dipahami');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`) VALUES
(1, 'X IPA 1'),
(2, 'XI IPA 2'),
(3, 'XII IPS 1'),
(4, 'X IPS 2'),
(5, 'XI IPS 3'),
(6, 'XII IPA 3');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_forum`
--

CREATE TABLE `komentar_forum` (
  `id` int NOT NULL,
  `forum_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `komentar` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komentar_forum`
--

INSERT INTO `komentar_forum` (`id`, `forum_id`, `user_id`, `komentar`, `created_at`) VALUES
(1, 1, 2, 'Coba pakai rumus abc untuk faktorisasi.', '2025-06-02 16:11:11'),
(2, 1, 5, 'Terima kasih, akan saya coba.', '2025-06-02 16:11:11'),
(3, 2, 3, 'Saya juga kesulitan, mungkin kita belajar bareng.', '2025-06-02 16:11:11'),
(4, 3, 4, 'Saya akan coba jelaskan di kelas nanti.', '2025-06-02 16:11:11'),
(5, 4, 7, 'Ini latihan yang saya buat kemarin.', '2025-06-02 16:11:11'),
(6, 5, 6, 'Menarik, kita bisa diskusi lebih lanjut.', '2025-06-02 16:11:11'),
(7, 5, 2, 'Saya tambahkan beberapa referensi sejarah.', '2025-06-02 16:11:11'),
(8, 2, 6, 'adi bagaimana ya bu', '2025-06-05 16:48:40'),
(9, 6, 2, 'okee kita lanjutkan soal berikutnya', '2025-06-06 14:59:47'),
(10, 6, 5, 'pak untuk yang bagian x^2 itu bagi mana ya?', '2025-06-09 08:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` int NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `nama_mapel`) VALUES
(1, 'Matematika'),
(2, 'Bahasa Indonesia'),
(3, 'Fisika'),
(4, 'Kimia'),
(5, 'Sejarah'),
(6, 'Bahasa Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  `file` varchar(255) DEFAULT NULL,
  `mapel_id` int DEFAULT NULL,
  `guru_id` int DEFAULT NULL,
  `kelas_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `judul`, `deskripsi`, `file`, `mapel_id`, `guru_id`, `kelas_id`, `created_at`) VALUES
(1, 'Persamaan Kuadrat', 'Materi tentang persamaan kuadrat dan penyelesaiannya', 'materi/persamaan_kuadrat.pdf', 1, 2, 1, '2025-06-02 16:11:11'),
(2, 'Teks Eksposisi', 'Memahami struktur teks eksposisi', 'materi/teks_eksposisi.pdf', 2, 3, 2, '2025-06-02 16:11:11'),
(3, 'Hukum Newton', 'Pembahasan tentang hukum Newton dalam fisika', 'materi/hukum_newton.pdf', 3, 4, 3, '2025-06-02 16:11:11'),
(4, 'Reaksi Kimia', 'Dasar-dasar reaksi kimia dan jenisnya', 'materi/reaksi_kimia.pdf', 4, 2, 1, '2025-06-02 16:11:11'),
(5, 'Sejarah Indonesia', 'Sejarah Indonesia dari masa penjajahan hingga kemerdekaan', 'materi/sejarah_indonesia.pdf', 5, 3, 2, '2025-06-02 16:11:11'),
(6, 'Grammar Dasar', 'Pengantar grammar bahasa Inggris', 'materi/grammar_dasar.pdf', 6, 4, 3, '2025-06-02 16:11:11'),
(7, 'Fungsi Trigonometri', 'Materi fungsi trigonometri lengkap', 'materi/fungsi_trigonometri.pdf', 1, 2, 4, '2025-06-02 16:11:11'),
(8, 'Cerita Pendek', 'Analisis cerita pendek dalam bahasa Indonesia', 'materi/cerita_pendek.pdf', 2, 3, 5, '2025-06-02 16:11:11'),
(9, 'Energi dan Usaha', 'Konsep energi dan usaha dalam fisika', 'materi/energi_usaha.pdf', 3, 4, 6, '2025-06-02 16:11:11'),
(10, 'Kalimat Pasif', 'Mengenal kalimat pasif dalam bahasa Inggris', 'materi/kalimat_pasif.pdf', 6, 4, 6, '2025-06-02 16:11:11'),
(12, 'Bahasa Kalbu', '.....', '1749369186_684541623cdde.pdf', 5, 4, 4, '2025-06-08 07:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi` text NOT NULL,
  `dibuat_oleh` int DEFAULT NULL,
  `ditujukan_untuk` enum('semua','siswa','guru') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `dibuat_oleh`, `ditujukan_untuk`, `created_at`) VALUES
(1, 'Libur Nasional', 'Besok hari libur nasional, semua kegiatan belajar diliburkan. sampai tanggal yang ditentuka!!', 1, 'semua', '2025-06-02 16:11:11'),
(2, 'Ujian Akhir Semester', 'Ujian akhir semester akan dimulai tanggal 1 Juli.', 1, 'semua', '2025-06-02 16:11:11'),
(3, 'Rapat Guru', 'Rapat wajib bagi semua guru di ruang guru.', 1, 'guru', '2025-06-02 16:11:11'),
(4, 'Pengumpulan Tugas', 'Tugas harus dikumpulkan tepat waktu.', 2, 'siswa', '2025-06-02 16:11:11'),
(5, 'amoeba', 'tau ga sih plankton adalah sumber oksigen terbesar di bumi', 4, 'siswa', '2025-06-09 08:22:44');

-- --------------------------------------------------------
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  `jenis` enum('essay','pilihan_ganda') NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `mapel_id` int DEFAULT NULL,
  `guru_id` int DEFAULT NULL,
  `kelas_id` int DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `judul`, `deskripsi`, `jenis`, `file`, `mapel_id`, `guru_id`, `kelas_id`, `deadline`, `created_at`) VALUES
(1, 'Latihan Persamaan Kuadrat', 'Kerjakan soal-soal persamaan kuadrat yang diberikan', 'pilihan_ganda', NULL, 1, 2, 1, '2025-06-15 23:59:59', '2025-06-02 16:11:11'),
(2, 'Essay tentang Teks Eksposisi', 'Buat essay tentang pentingnya teks eksposisi', 'essay', NULL, 2, 3, 2, '2025-06-17 23:59:59', '2025-06-02 16:11:11'),
(3, 'Soal Hukum Newton', 'Jawab soal pilihan ganda tentang hukum Newton', 'pilihan_ganda', NULL, 3, 4, 3, '2025-06-18 23:59:59', '2025-06-02 16:11:11'),
(4, 'Laporan Reaksi Kimia', 'Buat laporan reaksi kimia sederhana', 'essay', NULL, 4, 2, 1, '2025-06-19 23:59:59', '2025-06-02 16:11:11'),
(5, 'Quiz Sejarah Indonesia', 'Kerjakan quiz tentang sejarah Indonesia', 'pilihan_ganda', NULL, 5, 3, 2, '2025-06-20 23:59:59', '2025-06-02 16:11:11'),
(6, 'Latihan Grammar', 'Kerjakan latihan grammar bahasa Inggris', 'pilihan_ganda', NULL, 6, 4, 3, '2025-06-21 23:59:59', '2025-06-02 16:11:11'),
(7, 'Tugas Fungsi Trigonometri', 'Kerjakan soal essay fungsi trigonometri', 'essay', NULL, 1, 2, 4, '2025-06-22 23:59:59', '2025-06-02 16:11:11'),
(9, 'hhhh', 'hhhh', 'essay', '', 2, 2, 1, '2025-06-30 21:33:00', '2025-06-06 09:33:35'),
(10, 'hhhh', 'hhh', 'essay', '', 1, 2, 3, '2025-06-28 16:34:00', '2025-06-06 09:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','guru','admin') NOT NULL,
  `kelas_id` int DEFAULT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `kelas_id`, `nis`, `nip`, `reset_token`, `reset_token_expiry`, `created_at`) VALUES
(1, 'Admin Utama1', 'admin@sma.id', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin', NULL, NULL, NULL, NULL, NULL, '2025-06-02 16:11:11'),
(2, 'Guru Aji', 'aji@guru.sma.id', '285601e837fe0103f0f97f140b51e4f5db0c3e174b2dce72c493ee2dd6dc8f81', 'guru', NULL, NULL, '1987654321', NULL, NULL, '2025-06-02 16:11:11'),
(3, 'Guru Budi', 'budi@guru.sma.id', '02e23c0278a5ca69b4176c82bc430e0cdad80d8517ebc52869ca4e153f380fc9', 'guru', NULL, NULL, '1987654322', NULL, NULL, '2025-06-02 16:11:11'),
(4, 'Guru Citra', 'citra@guru.sma.id', '533ecf6f9998addff46b404cfca146bb55646043abd1159686756ce5b7bce3c4', 'guru', NULL, NULL, '1987654323', NULL, NULL, '2025-06-02 16:11:11'),
(5, 'Siswa Andi', 'andi@siswa.sma.id', 'c2e084f190596590eda06ca76456ac70fe97e6af504398e64ea13d51160e86a4', 'siswa', 1, '1234567890', NULL, NULL, NULL, '2025-06-02 16:11:11'),
(6, 'Siswa Bina', 'bina@siswa.sma.id', 'a9a46e4fd12f4212a83f40d0a182f4d83d917ff5270f2870da9b7c3d58821031', 'siswa', 2, '1234567891', NULL, NULL, NULL, '2025-06-02 16:11:11'),
(7, 'Siswa Caca', 'caca@siswa.sma.id', 'be6ab4ecf373df4aa2a4930b6f73d9bdcc1635b55777c541eb030258ccbfb88d', 'siswa', 5, '1234567892', NULL, NULL, NULL, '2025-06-02 16:11:11'),
(9, 'darin', 'darin@harbang.com', '$2y$10$M5JSeov5wIaRlY53.Or7TO9LWTsiO61nSkG8krn59Qf3xoyLgy3oG', 'siswa', 1, '14022200001', NULL, NULL, NULL, '2025-06-08 14:31:47'),
(10, 'aulia', 'aulia@harbang.com', '$2y$10$RMXaSy3W6xGXG/EjIjgZYeJIkbNq5vEx.NcXTTl6PExefZ6Sb7bhm', 'siswa', 1, '14022200002', NULL, NULL, NULL, '2025-06-08 14:32:38'),
(11, 'putri', 'putri@harbang.com', '$2y$10$6hb5BcA1EBXYTlAwhJ4LeumXcjCbqeGYMJoC8MH3kuEyARQV2hHnG', 'siswa', 6, '14022200003', NULL, NULL, NULL, '2025-06-08 14:33:08'),
(12, 'angel', 'angel@harbang.com', '$2y$10$GMhw6b0iz3i9of0fX9ZZne8OrSLTmtehOUg0BYD1naCt7dwDrnnCy', 'siswa', 6, '14022200004', NULL, NULL, NULL, '2025-06-08 14:33:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapel_id` (`mapel_id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `mapel_id` (`mapel_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tugas_id` (`tugas_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar_forum`
--
ALTER TABLE `komentar_forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapel_id` (`mapel_id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `ppdb_pendaftar`
--
ALTER TABLE `ppdb_pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapel_id` (`mapel_id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_kelas` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `komentar_forum`
--
ALTER TABLE `komentar_forum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ppdb_pendaftar`
--
ALTER TABLE `ppdb_pendaftar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `forum_ibfk_3` FOREIGN KEY (`dibuat_oleh`) REFERENCES `users` (`id`);

--
-- Constraints for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD CONSTRAINT `guru_mapel_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `guru_mapel_ibfk_2` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `guru_mapel_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD CONSTRAINT `jawaban_tugas_ibfk_1` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`),
  ADD CONSTRAINT `jawaban_tugas_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `komentar_forum`
--
ALTER TABLE `komentar_forum`
  ADD CONSTRAINT `komentar_forum_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`),
  ADD CONSTRAINT `komentar_forum_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `materi_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`dibuat_oleh`) REFERENCES `users` (`id`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tugas_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
