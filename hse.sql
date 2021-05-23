-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2021 at 03:51 PM
-- Server version: 8.0.17
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hse`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `absen_id` int(11) NOT NULL,
  `absen_user` int(11) DEFAULT NULL,
  `absen_jenis` int(11) DEFAULT NULL,
  `absen_keterangan` text,
  `absen_waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`absen_id`, `absen_user`, `absen_jenis`, `absen_keterangan`, `absen_waktu`) VALUES
(1, 5, 1, NULL, '2021-05-23 22:25:31'),
(2, 2, 1, NULL, '2021-05-23 22:31:29'),
(3, 7, 1, NULL, '2021-05-23 22:34:43'),
(4, 8, 1, NULL, '2021-05-23 22:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `guru_id` int(11) NOT NULL,
  `guru_nip` varchar(255) DEFAULT NULL,
  `guru_nama` varchar(255) DEFAULT NULL,
  `guru_tmp_lahir` varchar(255) DEFAULT NULL,
  `guru_tgl_lahir` date DEFAULT NULL,
  `guru_jenis_kelamin` int(11) DEFAULT NULL,
  `guru_agama` varchar(255) DEFAULT NULL,
  `guru_alamat` text,
  `guru_nohp` varchar(255) DEFAULT NULL,
  `guru_foto` varchar(255) DEFAULT NULL,
  `guru_jenjang` int(11) DEFAULT NULL,
  `guru_jenjang_pendidikan` varchar(128) DEFAULT NULL,
  `guru_uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`guru_id`, `guru_nip`, `guru_nama`, `guru_tmp_lahir`, `guru_tgl_lahir`, `guru_jenis_kelamin`, `guru_agama`, `guru_alamat`, `guru_nohp`, `guru_foto`, `guru_jenjang`, `guru_jenjang_pendidikan`, `guru_uid`) VALUES
(1, '32012', 'Ariana Gultom', 'Jakarta', '1991-03-03', 2, 'Katolik', '.', '+62', 'user-default.png', 1, 'S1', 2),
(2, '31029', 'Nicolas Flamel', 'Bali', '1991-01-01', 1, 'Katolik', '.', '0', 'user-default.png', 2, 'S1', 3),
(3, '320159', 'Dolores Umbridge', 'Jepara', '1975-01-04', 2, 'Katolik', '.', '0', 'user-default.png', 3, 'S1', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `jadwal_hari` int(11) DEFAULT NULL,
  `jadwal_mulai` varchar(32) DEFAULT NULL,
  `jadwal_akhir` varchar(32) DEFAULT NULL,
  `jadwal_kelas` int(11) DEFAULT NULL,
  `jadwal_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`jadwal_id`, `jadwal_hari`, `jadwal_mulai`, `jadwal_akhir`, `jadwal_kelas`, `jadwal_mapel`) VALUES
(1, 1, '07:30', '08:20', 1, 1),
(2, 1, '09:10', '10:50', 7, 5),
(3, 1, '08:30', '09:30', 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `jawaban_id` int(11) NOT NULL,
  `jawaban_soal` int(11) DEFAULT NULL,
  `jawaban_detail` text,
  `jawaban_benar` int(11) DEFAULT NULL,
  `jawaban_pembuat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`jawaban_id`, `jawaban_soal`, `jawaban_detail`, `jawaban_benar`, `jawaban_pembuat`) VALUES
(1, 1, '20', 0, 2),
(2, 1, '30', 1, 2),
(3, 1, '40', 0, 2),
(4, 1, '50', 0, 2),
(5, 1, '60', 0, 2),
(6, 2, '40', 0, 2),
(7, 2, '50', 0, 2),
(8, 2, '60', 0, 2),
(9, 2, '70', 1, 2),
(10, 2, '80', 0, 2),
(11, 3, '10', 0, 2),
(12, 3, '15', 1, 2),
(13, 3, '20', 0, 2),
(14, 3, '25', 0, 2),
(15, 3, '30', 0, 2),
(16, 4, '3', 0, 2),
(17, 4, '2', 0, 2),
(18, 4, '4', 1, 2),
(19, 4, '5', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenjang`
--

CREATE TABLE `tb_jenjang` (
  `jenjang_id` int(11) NOT NULL,
  `jenjang_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jenjang`
--

INSERT INTO `tb_jenjang` (`jenjang_id`, `jenjang_nama`) VALUES
(1, 'SD'),
(3, 'SMA'),
(2, 'SMP');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `jurusan_id` int(11) NOT NULL,
  `jurusan_nama` varchar(255) DEFAULT NULL,
  `jurusan_jenjang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kelas_id` int(11) NOT NULL,
  `kelas_jenjang` int(11) DEFAULT NULL,
  `kelas_tingkat` int(11) DEFAULT NULL,
  `kelas_jurusan` int(11) DEFAULT NULL,
  `kelas_nama` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kelas_id`, `kelas_jenjang`, `kelas_tingkat`, `kelas_jurusan`, `kelas_nama`) VALUES
(1, 1, 1, NULL, '1 SD'),
(2, 1, 2, NULL, '2 SD'),
(3, 1, 3, NULL, '3 SD'),
(4, 1, 4, NULL, '4 SD'),
(5, 1, 5, NULL, '5 SD'),
(6, 1, 6, NULL, '6 SD'),
(7, 2, 1, NULL, '1 SMP'),
(8, 2, 2, NULL, '2 SMP'),
(9, 2, 3, NULL, '3 SMP'),
(10, 3, 1, NULL, '1 SMA'),
(11, 3, 2, NULL, '2 SMA'),
(12, 3, 3, NULL, '3 SMA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `mapel_id` int(11) NOT NULL,
  `mapel_kode` varchar(255) DEFAULT NULL,
  `mapel_nama` varchar(255) DEFAULT NULL,
  `mapel_guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`mapel_id`, `mapel_kode`, `mapel_nama`, `mapel_guru`) VALUES
(1, 'K0011', 'Bahasa Indonesia', 1),
(2, 'K0021', 'Matematika', 1),
(3, 'K0030', 'Biologi', 1),
(5, 'K0022', 'Bahasa Inggris', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `pembayaran_jenis` int(11) DEFAULT NULL,
  `pembayaran_keterangan` varchar(255) DEFAULT NULL,
  `pembayaran_bukti` varchar(255) DEFAULT NULL,
  `pembayaran_status` int(11) DEFAULT NULL,
  `pembayaran_siswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`pembayaran_id`, `pembayaran_jenis`, `pembayaran_keterangan`, `pembayaran_bukti`, `pembayaran_status`, `pembayaran_siswa`) VALUES
(1, 1, 'Biaya untuk pendaftaran.', 'bukti.png', 1, 1),
(2, 1, 'Biaya untuk pendaftaran.', 'checklist.png', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengumuman`
--

CREATE TABLE `tb_pengumuman` (
  `pengumuman_id` int(11) NOT NULL,
  `pengumuman_jenjang` int(11) DEFAULT NULL,
  `pengumuman_isi` text,
  `pengumuman_waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pengumuman`
--

INSERT INTO `tb_pengumuman` (`pengumuman_id`, `pengumuman_jenjang`, `pengumuman_isi`, `pengumuman_waktu`) VALUES
(1, 1, '<h2 style=\"font-style:italic;\">Pengumuman Untuk Jenjang SD</h2>\r\n\r\n<p>&#39;m baby roof party you probably haven&#39;t heard of them lyft tumeric cronut health goth messenger bag dreamcatcher hexagon. Kickstarter +1 health goth poutine. Before they sold out VHS selfies, swag ugh asymmetrical neutra four dollar toast godard letterpress salvia retro prism flexitarian. Humblebrag fashion axe glossier fanny pack. Venmo biodiesel vexillologist, post-ironic fam <strong><em>YOLO keytar.</em></strong></p>\r\n\r\n<ol>\r\n <li>Satu</li>\r\n <li>Dua</li>\r\n  <li>Tiga</li>\r\n</ol>\r\n', '2021-05-23 22:04:51'),
(10, 2, '<h2><em>Pengumuman tentang Hari Sumpah Pemuda</em></h2>\r\n\r\n<p>I&#39;m baby roof party you probably haven&#39;t heard of them lyft tumeric cronut health goth messenger bag dreamcatcher hexagon. Kickstarter +1 health goth poutine. Before they sold out VHS selfies.</p>\r\n\r\n<p><em>Hari: Senin</em></p>\r\n\r\n<p>Swag ugh asymmetrical neutra four dollar toast godard letterpress salvia retro prism flexitarian. Humblebrag fashion axe glossier fanny pack. Venmo biodiesel vexillologist, post-ironic fam YOLO keytar.</p>\r\n', '2021-05-23 22:16:28'),
(11, 3, '<h2 style=\"font-style:italic;\"><strong>Pengumuman SMA</strong></h2>\r\n\r\n<p>Godard brooklyn vaporware hella meggings. Polaroid kombucha direct trade knausgaard mixtape fingerstache truffaut lo-fi ugh small batch. Sriracha hella bushwick pickled health goth lomo. Keffiyeh glossier air plant bespoke VHS YOLO</p>\r\n', '2021-05-23 22:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rapor`
--

CREATE TABLE `tb_rapor` (
  `rapor_id` int(11) NOT NULL,
  `rapor_semester` int(11) DEFAULT NULL,
  `rapor_file` varchar(255) DEFAULT NULL,
  `rapor_siswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_rapor`
--

INSERT INTO `tb_rapor` (`rapor_id`, `rapor_semester`, `rapor_file`, `rapor_siswa`) VALUES
(1, 1, 'rapor.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `siswa_id` int(11) NOT NULL,
  `siswa_nis` varchar(255) DEFAULT NULL,
  `siswa_nama` varchar(255) DEFAULT NULL,
  `siswa_tmp_lahir` varchar(255) DEFAULT NULL,
  `siswa_tgl_lahir` date DEFAULT NULL,
  `siswa_jenis_kelamin` int(11) DEFAULT NULL,
  `siswa_agama` varchar(255) DEFAULT NULL,
  `siswa_anak_ke` int(11) DEFAULT NULL,
  `siswa_alamat` text,
  `siswa_nama_ayah` varchar(255) DEFAULT NULL,
  `siswa_nama_ibu` varchar(255) DEFAULT NULL,
  `siswa_alamat_ortu` text,
  `siswa_nohp_ortu` varchar(255) DEFAULT NULL,
  `siswa_pekerjaan_ayah` varchar(255) DEFAULT NULL,
  `siswa_pekerjaan_ibu` varchar(255) DEFAULT NULL,
  `siswa_nama_wali` varchar(255) DEFAULT NULL,
  `siswa_nohp_wali` varchar(255) DEFAULT NULL,
  `siswa_alamat_wali` text,
  `siswa_pekerjaan_wali` varchar(255) DEFAULT NULL,
  `siswa_jenjang` int(11) DEFAULT NULL,
  `siswa_kelas` int(11) DEFAULT NULL,
  `siswa_semester` varchar(255) DEFAULT NULL,
  `siswa_foto` varchar(255) DEFAULT NULL,
  `siswa_uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`siswa_id`, `siswa_nis`, `siswa_nama`, `siswa_tmp_lahir`, `siswa_tgl_lahir`, `siswa_jenis_kelamin`, `siswa_agama`, `siswa_anak_ke`, `siswa_alamat`, `siswa_nama_ayah`, `siswa_nama_ibu`, `siswa_alamat_ortu`, `siswa_nohp_ortu`, `siswa_pekerjaan_ayah`, `siswa_pekerjaan_ibu`, `siswa_nama_wali`, `siswa_nohp_wali`, `siswa_alamat_wali`, `siswa_pekerjaan_wali`, `siswa_jenjang`, `siswa_kelas`, `siswa_semester`, `siswa_foto`, `siswa_uid`) VALUES
(1, '14002113', 'Yusuf Kamma', 'Makassar', '2004-03-19', 1, 'Islam', 3, '.', '-', '-', '.', '0', '-', '-', '-', '0', '.', '-', 1, 1, '1', 'user-default.png', 5),
(2, '1400239193', 'Susan Bones', 'Pontianak', '2005-03-21', 2, 'Islam', 3, '.', '-', '-', '.', '0', '-', '-', '-', '0', '.', '-', 2, 7, '1', 'user-default.png', 6),
(3, '0', 'Lazardi Amar', 'Jakarta', '2010-03-21', 1, 'Islam', 3, '.', '-', '-', '.', '0', '-', '-', '-', '0', '.', '-', 3, 10, '1', 'user-default.png', 7),
(4, '14002311', 'Aldo MA', 'Jakarta', '2007-03-21', 1, 'Islam', 3, '.', '-', '-', '.', '0', '-', '-', '-', '0', '.', '-', 1, 1, '1', 'user-default.png', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal`
--

CREATE TABLE `tb_soal` (
  `soal_id` int(11) NOT NULL,
  `soal_topik` int(11) DEFAULT NULL,
  `soal_detail` text,
  `soal_tipe` int(11) DEFAULT NULL,
  `soal_pembuat` int(11) DEFAULT NULL,
  `soal_gambar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_soal`
--

INSERT INTO `tb_soal` (`soal_id`, `soal_topik`, `soal_detail`, `soal_tipe`, `soal_pembuat`, `soal_gambar`) VALUES
(1, 1, '10 + 20 = ?', 1, 2, NULL),
(2, 1, '20 + 50 = ?', 1, 2, NULL),
(3, 1, '30 / 2 = ?', 1, 2, NULL),
(4, 1, 'Ada berapa bendera di foto berikut ?', 1, 2, 'nwss.jpg'),
(5, 1, 'Apa nama ibu kota Indonesia?', 2, 2, NULL),
(6, 1, 'Gambar apakah berikut ini?', 2, 2, 'checklist.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tingkat`
--

CREATE TABLE `tb_tingkat` (
  `tingkat_id` int(11) NOT NULL,
  `tingkat_nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_tingkat`
--

INSERT INTO `tb_tingkat` (`tingkat_id`, `tingkat_nama`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_topik`
--

CREATE TABLE `tb_topik` (
  `topik_id` int(11) NOT NULL,
  `topik_judul` varchar(255) DEFAULT NULL,
  `topik_deskripsi` text,
  `topik_status` int(11) DEFAULT NULL,
  `topik_pembuat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_topik`
--

INSERT INTO `tb_topik` (`topik_id`, `topik_judul`, `topik_deskripsi`, `topik_status`, `topik_pembuat`) VALUES
(1, 'Ujian SD 1', 'Ujian mingguan SD 1', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian`
--

CREATE TABLE `tb_ujian` (
  `ujian_id` int(11) NOT NULL,
  `ujian_judul` varchar(255) DEFAULT NULL,
  `ujian_deskripsi` text,
  `ujian_waktu_mulai` datetime DEFAULT NULL,
  `ujian_waktu_akhir` datetime DEFAULT NULL,
  `ujian_durasi` smallint(6) DEFAULT NULL COMMENT 'menit',
  `ujian_hasil_siswa` int(11) DEFAULT NULL,
  `ujian_detail_siswa` int(11) DEFAULT NULL,
  `ujian_nilai_benar` decimal(10,0) DEFAULT '1',
  `ujian_nilai_salah` decimal(10,2) DEFAULT '0.00',
  `ujian_nilai_kosong` decimal(10,2) DEFAULT '0.00',
  `ujian_nilai_maks` decimal(10,2) DEFAULT '0.00',
  `ujian_status` int(11) DEFAULT NULL,
  `ujian_pembuat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ujian`
--

INSERT INTO `tb_ujian` (`ujian_id`, `ujian_judul`, `ujian_deskripsi`, `ujian_waktu_mulai`, `ujian_waktu_akhir`, `ujian_durasi`, `ujian_hasil_siswa`, `ujian_detail_siswa`, `ujian_nilai_benar`, `ujian_nilai_salah`, `ujian_nilai_kosong`, `ujian_nilai_maks`, `ujian_status`, `ujian_pembuat`) VALUES
(1, 'Ujian SD 1', 'Ujian testing 1', '2021-05-23 08:00:00', '2021-05-27 08:00:00', 30, 1, 1, '1', '0.00', '0.00', '6.00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian_group`
--

CREATE TABLE `tb_ujian_group` (
  `group_ujian` int(11) DEFAULT NULL,
  `group_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ujian_group`
--

INSERT INTO `tb_ujian_group` (`group_ujian`, `group_kelas`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian_jawaban`
--

CREATE TABLE `tb_ujian_jawaban` (
  `uj_soal` int(11) NOT NULL,
  `uj_jawaban` int(11) NOT NULL,
  `uj_selected` int(11) DEFAULT NULL,
  `uj_order` int(11) DEFAULT NULL,
  `uj_posisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ujian_jawaban`
--

INSERT INTO `tb_ujian_jawaban` (`uj_soal`, `uj_jawaban`, `uj_selected`, `uj_order`, `uj_posisi`) VALUES
(3, 16, 0, 4, 0),
(3, 17, 0, 3, 0),
(3, 18, 1, 2, 1),
(3, 19, 0, 1, 0),
(4, 11, 0, 5, 0),
(4, 12, 1, 4, 1),
(4, 13, 0, 3, 0),
(4, 14, 0, 2, 0),
(4, 15, 0, 1, 0),
(5, 6, 0, 5, 0),
(5, 7, 0, 4, 0),
(5, 8, 0, 3, 0),
(5, 9, 1, 2, 1),
(5, 10, 0, 1, 0),
(6, 1, 0, 5, 0),
(6, 2, 1, 4, 1),
(6, 3, 0, 3, 0),
(6, 4, 0, 2, 0),
(6, 5, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian_soal`
--

CREATE TABLE `tb_ujian_soal` (
  `us_id` int(11) NOT NULL,
  `us_users` int(11) DEFAULT NULL,
  `us_soal` int(11) DEFAULT NULL,
  `us_jawaban_teks` text,
  `us_nilai` decimal(10,0) DEFAULT NULL,
  `us_order` tinyint(4) DEFAULT NULL,
  `us_waktu_diubah` datetime DEFAULT NULL,
  `us_ragu` tinyint(4) DEFAULT NULL,
  `us_komentar` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ujian_soal`
--

INSERT INTO `tb_ujian_soal` (`us_id`, `us_users`, `us_soal`, `us_jawaban_teks`, `us_nilai`, `us_order`, `us_waktu_diubah`, `us_ragu`, `us_komentar`) VALUES
(1, 1, 6, 'gambar ceklis', '1', 1, '2021-05-23 22:46:27', 0, 'sudah dikoreksi'),
(2, 1, 5, 'Jakarta', '1', 2, '2021-05-23 22:46:35', 0, 'sudah dikoreksi'),
(3, 1, 4, NULL, '1', 3, '2021-05-23 22:46:42', 0, NULL),
(4, 1, 3, NULL, '1', 4, '2021-05-23 22:46:45', 0, NULL),
(5, 1, 2, NULL, '1', 5, '2021-05-23 22:46:48', 0, NULL),
(6, 1, 1, NULL, '1', 6, '2021-05-23 22:46:51', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian_topik`
--

CREATE TABLE `tb_ujian_topik` (
  `ut_id` int(11) NOT NULL,
  `ut_ujian` int(11) DEFAULT NULL,
  `ut_topik` int(11) DEFAULT NULL,
  `ut_tipe` int(11) DEFAULT '0' COMMENT '0 = semua, 1 = pilihan ganda, 2 = essai',
  `ut_total_soal` int(11) DEFAULT NULL,
  `ut_total_jawaban` int(11) DEFAULT NULL,
  `ut_jawaban_acak` int(11) DEFAULT NULL,
  `ut_soal_acak` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ujian_topik`
--

INSERT INTO `tb_ujian_topik` (`ut_id`, `ut_ujian`, `ut_topik`, `ut_tipe`, `ut_total_soal`, `ut_total_jawaban`, `ut_jawaban_acak`, `ut_soal_acak`) VALUES
(1, 1, 1, 0, 6, 19, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ujian_users`
--

CREATE TABLE `tb_ujian_users` (
  `users_id` int(11) NOT NULL,
  `users_ujian` int(11) DEFAULT NULL,
  `users_siswa` int(11) DEFAULT NULL,
  `users_status` int(11) DEFAULT NULL COMMENT '1 = sedang dikerjakan, 3 = waktu habis, 4 = selesai',
  `users_tgl_pengerjaan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ujian_users`
--

INSERT INTO `tb_ujian_users` (`users_id`, `users_ujian`, `users_siswa`, `users_status`, `users_tgl_pengerjaan`) VALUES
(1, 1, 4, 4, '2021-05-23 22:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT '0' COMMENT '1 = admin, 2 = guru, 3 = siswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@hse.com', '$2y$10$5rGIKVdbLy.c6m59qVUhB.3IjA1igME3TqQujrROovRQYq9u0mZI6', 1),
(2, 'gurusd', 'gurusd@hse.com', '$2y$10$d9IxbhxgRd9t5sCgRCvyq.5lG9XHWKRjui51hn6l0s9bSDAjnMWH6', 2),
(3, 'gurusmp', 'gurusmp@hse.com', '$2y$10$cUFyvt97h3fdksXfXRzYQeQ5EOG4LCNN3MvrjomelFz8Uj1PCRGgW', 2),
(4, 'gurusma', 'gurusma@hse.com', '$2y$10$HhwNNkRAIjO8oXgu67V5PuppojneSw0Iui0W.aKe8SoS0SmIEjjy2', 2),
(5, 'siswasd', 'siswasd@hse.com', '$2y$10$Frk1PrnjpcIs8JgpOD/eyOzOOjnTqliKTgPTDQgHSrdx8pVJE/Udq', 3),
(6, 'siswasmp', 'siswasmp@hse.com', '$2y$10$Uw2mXCcuSVa7HvBBag/Us.lm5QVLuoyIDFyIU9Aiy/8gXYwS0JNjy', 3),
(7, 'siswasma', 'siswasma@hse.com', '$2y$10$5riHUTcO496xyXIinlBF6.5sj0UStQ1Zrzq3auINayk6nYqZC6I7a', 3),
(8, 'aldo', 'aldo@hse.com', '$2y$10$y/N8tUgULldYze84089tRewI/3tLH07XBukKr9hhf83B1HaYa3kLC', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`absen_id`),
  ADD KEY `absen_user` (`absen_user`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`guru_id`),
  ADD KEY `guru_jenjang` (`guru_jenjang`),
  ADD KEY `guru_uid` (`guru_uid`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`jadwal_id`),
  ADD KEY `jadwal_kelas` (`jadwal_kelas`),
  ADD KEY `jadwal_mapel` (`jadwal_mapel`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`jawaban_id`),
  ADD KEY `jawaban_soal` (`jawaban_soal`);

--
-- Indexes for table `tb_jenjang`
--
ALTER TABLE `tb_jenjang`
  ADD PRIMARY KEY (`jenjang_id`),
  ADD UNIQUE KEY `jenjang_nama` (`jenjang_nama`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`jurusan_id`),
  ADD UNIQUE KEY `jurusan_nama` (`jurusan_nama`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kelas_id`),
  ADD UNIQUE KEY `kelas_nama` (`kelas_nama`),
  ADD KEY `kelas_jenjang` (`kelas_jenjang`),
  ADD KEY `kelas_tingkat` (`kelas_tingkat`),
  ADD KEY `kelas_jurusan` (`kelas_jurusan`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`mapel_id`),
  ADD UNIQUE KEY `mapel_kode` (`mapel_kode`),
  ADD KEY `mapel_guru` (`mapel_guru`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD KEY `pembayaran_siswa` (`pembayaran_siswa`);

--
-- Indexes for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD PRIMARY KEY (`pengumuman_id`),
  ADD KEY `pengumuman_jenjang` (`pengumuman_jenjang`);

--
-- Indexes for table `tb_rapor`
--
ALTER TABLE `tb_rapor`
  ADD PRIMARY KEY (`rapor_id`),
  ADD KEY `rapor_siswa` (`rapor_siswa`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`siswa_id`),
  ADD KEY `siswa_jenjang_pendidikan` (`siswa_jenjang`),
  ADD KEY `siswa_kelas` (`siswa_kelas`),
  ADD KEY `siswa_uid` (`siswa_uid`);

--
-- Indexes for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`soal_id`),
  ADD KEY `soal_pembuat` (`soal_pembuat`),
  ADD KEY `soal_topik` (`soal_topik`);

--
-- Indexes for table `tb_tingkat`
--
ALTER TABLE `tb_tingkat`
  ADD PRIMARY KEY (`tingkat_id`),
  ADD UNIQUE KEY `tingkat_nama` (`tingkat_nama`);

--
-- Indexes for table `tb_topik`
--
ALTER TABLE `tb_topik`
  ADD PRIMARY KEY (`topik_id`),
  ADD KEY `topik_pembuat` (`topik_pembuat`);

--
-- Indexes for table `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD PRIMARY KEY (`ujian_id`),
  ADD KEY `ujian_pembuat` (`ujian_pembuat`);

--
-- Indexes for table `tb_ujian_group`
--
ALTER TABLE `tb_ujian_group`
  ADD KEY `group_ujian` (`group_ujian`),
  ADD KEY `group_kelas` (`group_kelas`);

--
-- Indexes for table `tb_ujian_jawaban`
--
ALTER TABLE `tb_ujian_jawaban`
  ADD PRIMARY KEY (`uj_soal`,`uj_jawaban`),
  ADD KEY `uj_jawaban` (`uj_jawaban`),
  ADD KEY `uj_soal` (`uj_soal`);

--
-- Indexes for table `tb_ujian_soal`
--
ALTER TABLE `tb_ujian_soal`
  ADD PRIMARY KEY (`us_id`),
  ADD UNIQUE KEY `us_users_us_soal` (`us_users`,`us_soal`),
  ADD KEY `us_soal` (`us_soal`),
  ADD KEY `us_users` (`us_users`);

--
-- Indexes for table `tb_ujian_topik`
--
ALTER TABLE `tb_ujian_topik`
  ADD PRIMARY KEY (`ut_id`),
  ADD KEY `ut_ujian` (`ut_ujian`),
  ADD KEY `ut_topik` (`ut_topik`);

--
-- Indexes for table `tb_ujian_users`
--
ALTER TABLE `tb_ujian_users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_ujian_users_siswa_users_status` (`users_ujian`,`users_siswa`,`users_status`),
  ADD KEY `users_siswa` (`users_siswa`),
  ADD KEY `users_ujian` (`users_ujian`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `jawaban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_jenjang`
--
ALTER TABLE `tb_jenjang`
  MODIFY `jenjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `jurusan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `mapel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `pengumuman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_rapor`
--
ALTER TABLE `tb_rapor`
  MODIFY `rapor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `soal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_tingkat`
--
ALTER TABLE `tb_tingkat`
  MODIFY `tingkat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_topik`
--
ALTER TABLE `tb_topik`
  MODIFY `topik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_ujian`
--
ALTER TABLE `tb_ujian`
  MODIFY `ujian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_ujian_soal`
--
ALTER TABLE `tb_ujian_soal`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_ujian_topik`
--
ALTER TABLE `tb_ujian_topik`
  MODIFY `ut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_ujian_users`
--
ALTER TABLE `tb_ujian_users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD CONSTRAINT `tb_absen_ibfk_2` FOREIGN KEY (`absen_user`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD CONSTRAINT `tb_guru_ibfk_3` FOREIGN KEY (`guru_jenjang`) REFERENCES `tb_jenjang` (`jenjang_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_guru_ibfk_4` FOREIGN KEY (`guru_uid`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`jadwal_kelas`) REFERENCES `tb_kelas` (`kelas_id`),
  ADD CONSTRAINT `tb_jadwal_ibfk_3` FOREIGN KEY (`jadwal_mapel`) REFERENCES `tb_mapel` (`mapel_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD CONSTRAINT `tb_jawaban_ibfk_2` FOREIGN KEY (`jawaban_soal`) REFERENCES `tb_soal` (`soal_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`kelas_jenjang`) REFERENCES `tb_jenjang` (`jenjang_id`),
  ADD CONSTRAINT `tb_kelas_ibfk_2` FOREIGN KEY (`kelas_tingkat`) REFERENCES `tb_tingkat` (`tingkat_id`),
  ADD CONSTRAINT `tb_kelas_ibfk_3` FOREIGN KEY (`kelas_jurusan`) REFERENCES `tb_jurusan` (`jurusan_id`);

--
-- Constraints for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD CONSTRAINT `tb_mapel_ibfk_2` FOREIGN KEY (`mapel_guru`) REFERENCES `tb_guru` (`guru_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_2` FOREIGN KEY (`pembayaran_siswa`) REFERENCES `tb_siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD CONSTRAINT `tb_pengumuman_ibfk_1` FOREIGN KEY (`pengumuman_jenjang`) REFERENCES `tb_jenjang` (`jenjang_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_rapor`
--
ALTER TABLE `tb_rapor`
  ADD CONSTRAINT `tb_rapor_ibfk_2` FOREIGN KEY (`rapor_siswa`) REFERENCES `tb_siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`siswa_jenjang`) REFERENCES `tb_jenjang` (`jenjang_id`),
  ADD CONSTRAINT `tb_siswa_ibfk_2` FOREIGN KEY (`siswa_kelas`) REFERENCES `tb_kelas` (`kelas_id`),
  ADD CONSTRAINT `tb_siswa_ibfk_4` FOREIGN KEY (`siswa_uid`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD CONSTRAINT `tb_soal_ibfk_2` FOREIGN KEY (`soal_topik`) REFERENCES `tb_topik` (`topik_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_topik`
--
ALTER TABLE `tb_topik`
  ADD CONSTRAINT `tb_topik_ibfk_2` FOREIGN KEY (`topik_pembuat`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_ujian_group`
--
ALTER TABLE `tb_ujian_group`
  ADD CONSTRAINT `tb_ujian_group_ibfk_7` FOREIGN KEY (`group_ujian`) REFERENCES `tb_ujian` (`ujian_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_ujian_group_ibfk_8` FOREIGN KEY (`group_kelas`) REFERENCES `tb_kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_ujian_jawaban`
--
ALTER TABLE `tb_ujian_jawaban`
  ADD CONSTRAINT `tb_ujian_jawaban_ibfk_3` FOREIGN KEY (`uj_soal`) REFERENCES `tb_ujian_soal` (`us_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_ujian_jawaban_ibfk_4` FOREIGN KEY (`uj_jawaban`) REFERENCES `tb_jawaban` (`jawaban_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_ujian_soal`
--
ALTER TABLE `tb_ujian_soal`
  ADD CONSTRAINT `tb_ujian_soal_ibfk_3` FOREIGN KEY (`us_users`) REFERENCES `tb_ujian_users` (`users_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_ujian_soal_ibfk_4` FOREIGN KEY (`us_soal`) REFERENCES `tb_soal` (`soal_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_ujian_topik`
--
ALTER TABLE `tb_ujian_topik`
  ADD CONSTRAINT `tb_ujian_topik_ibfk_3` FOREIGN KEY (`ut_ujian`) REFERENCES `tb_ujian` (`ujian_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_ujian_topik_ibfk_5` FOREIGN KEY (`ut_topik`) REFERENCES `tb_topik` (`topik_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `tb_ujian_users`
--
ALTER TABLE `tb_ujian_users`
  ADD CONSTRAINT `tb_ujian_users_ibfk_3` FOREIGN KEY (`users_siswa`) REFERENCES `tb_siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_ujian_users_ibfk_5` FOREIGN KEY (`users_ujian`) REFERENCES `tb_ujian` (`ujian_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
