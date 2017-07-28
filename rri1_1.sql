-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2017 pada 18.37
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `rri1_1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `ID_BERITA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` varchar(100) DEFAULT NULL,
  `ID_REWARD` int(11) DEFAULT NULL,
  `ID_KATEGORI` int(11) DEFAULT NULL,
  `JUDUL` text,
  `ISI` text,
  `CONTENT` text,
  `TANGGAL_PEMBUATAN` datetime DEFAULT NULL,
  `TANGGAL_EDIT` datetime DEFAULT NULL,
  `TANGGAL_DISETUJUI` datetime DEFAULT NULL,
  `PATH_REKAMAN` text,
  `HOT_NEWS` varchar(100) DEFAULT NULL,
  `STATUS_REVISI` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ID_BERITA`),
  KEY `FK_RELATIONSHIP_1` (`ID_USER`),
  KEY `FK_RELATIONSHIP_2` (`ID_KATEGORI`),
  KEY `FK_RELATIONSHIP_3` (`ID_REWARD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`ID_BERITA`, `ID_USER`, `ID_REWARD`, `ID_KATEGORI`, `JUDUL`, `ISI`, `CONTENT`, `TANGGAL_PEMBUATAN`, `TANGGAL_EDIT`, `TANGGAL_DISETUJUI`, `PATH_REKAMAN`, `HOT_NEWS`, `STATUS_REVISI`) VALUES
(1, 'jojo', 1, 3, 'Juventus Menang Tipis Atas Intermilan ()', '<p style="text-align: left;">Juventus d''Italia berakhir untuk kemenangan Juventus. Tampil di depan pendukungnya sendiri, Senin (6/2) dini hari WIB, Juve menang tipis 1-0 lewat gol Juan Cuadrado. Ini jadi kekalahan Inter Milan dalam dua laga beruntun. Di sisi lain Juventus berhasil membalaskan dendamnya setelah di pertemuan pertama lalu, mereka keok 0-1. Tim asuhan Pioli untuk sementara harus rela bertengger di urutan lima klasemen. Mereka memiliki 42 poin, tertinggal 12 angka dari Juventus yang kokoh di singgasana.</p>', NULL, '2017-02-07 10:00:00', '2017-02-25 04:23:57', '2017-02-25 04:24:21', NULL, '1', 'DISETUJUI OLEH REDAKSI'),
(2, 'jojo', 1, 2, 'Agus Yudhoyono Ada di Rumah Mega Kuningan Saat Mahasiswa Berdemo', '<p>Jakarta - Calon DKI urut 1, Agus Harimurti Yudhoyono bercerita soal kondisi kediaman SBY di Mega Kuningan saat ''digeruduk'' massa. Agus mengaku sedang berada di lokasi saat kejadian berlangsung.</p>\r\n<p>"Saya ada, saya ada di rumah (Mega Kuningan)," ujar Agus di kawasan Patal Senayan, Jakarta, Selasa (7/2/2017).</p>\r\n<p>Saat ''penggerudukan'' berlangsung, Agus mengaku memantau situasi. Dia berkomunikasi dengan pihak keamanan untuk memastikan keamanan.</p>\r\n<p>"Saya memantau, tetap berkomunikasi, tentunya kita bertanya pada pihak keamanan ada apa, kenapa tiba-tiba ada massa yang bergerak dari arah tertentu menggunakan, kalau gak salah, 11 bus, melakukan orasi dan demonstrasi di kediaman atau rumah pribadi (SBY)," tuturnya.</p>\r\n<p>Meski demikian, Agus berkata suasana di rumah SBY di Mega Kuningan dan sekitarnya tidak terlalu mengkhawatirkan. Namun, dia berharap kejadian serupa tidak terjadi di tempat lain.</p>\r\n<p>"Suasananya sebenarnya enggak terlalu seperti yang dikhawatirkan. Tetapi, kami hanya berharap ini tidak terjadi di tempat-tempat lain. Kalau di kediaman mantan presiden RI terjadi seperti itu, bagaimana dengan warga lainnya?" ujarnya.</p>\r\n<p>Agus akan mengembalikan persoalan ini kepada pihak yang berwajib. Ditekankannya, demokrasi harus terus dipelihara namun harus kembali kepada hukum yang berlaku.</p>\r\n<p>"Saya kembalikan sepenuhnya kepada penegak hukum. Mudah-mudahan ada titik terangnya dan kita semua bisa belajar, memahami bahwa demokrasi harus kita perjuangkan dan harus kita pelihara karena basisnya adalah hukum," tutupnya.</p>', NULL, '2017-02-22 10:29:54', '2017-02-25 05:27:36', '2017-03-15 03:36:37', NULL, NULL, 'DISETUJUI OLEH REDAKSI'),
(3, 'vito', 4, 1, 'tes123', '<p>12312</p>', NULL, '2017-02-25 05:24:47', '2017-02-26 14:14:37', '2017-03-15 03:37:12', NULL, NULL, 'DISETUJUI OLEH REDAKSI'),
(4, 'vito', 4, 4, 'tes', '<p>red</p>', NULL, '2017-02-25 06:15:06', '2017-02-25 06:16:53', '2017-03-15 03:36:45', NULL, '1', 'DISETUJUI OLEH REDAKSI'),
(5, 'vito', 4, 1, 'Ga jadi deh', '<p>Wowowo0w0123</p>', NULL, '2017-02-26 14:06:04', '2017-02-26 14:15:15', '2017-03-15 03:37:19', NULL, '1', 'DISETUJUI OLEH REDAKSI'),
(6, 'adam', 4, 2, 'Sarapan Ahok vs Sarapan Anies sebelum kampanye', '<p>Menurut sumber terpercaya. Menu sarapan ahok sebelum kampanye adalah oatmeal dan gula aren.</p>\n<p>Lalu menu sarapan anies adalah nasi telur ceplok dan tempe tahu.</p>', NULL, '2017-03-15 03:33:28', NULL, '2017-03-15 03:36:55', NULL, '1', 'DISETUJUI OLEH REDAKSI'),
(7, 'pri', 4, 4, 'Balita terlindas mobil di Mall. Orang Tua bisa jadi tersangka', '<p>Hari Senin 13 Maret 2017 terdapat kericuhan di salah satu mall yang terletak di lokasi&nbsp;Roxy Jakarta.</p>\r\n<p>Tak lain adalah karena ada balita yang meninggal karena terlindas mobil fortuner. Menurut polisi setempat, orang tua bisa jadi tersangka karena kelalaian menjaga anaknya.</p>', NULL, '2017-03-15 03:36:01', NULL, '2017-03-15 03:37:04', NULL, NULL, 'DISETUJUI OLEH REDAKSI'),
(8, 'pakpo', 4, 4, 'Wanita ini makan mie lewat hidung', '<p>Seperti dilansir CNN senin lalu, wanita berasal dari Guangzhou china melakukan atraksi memakan mie melalui hidung.</p>', NULL, '2017-03-15 04:23:32', NULL, '2017-03-15 04:27:13', NULL, NULL, 'DISETUJUI OLEH REDAKSI'),
(9, 'jojo', 4, 8, 'Grup Pedofil Terungkap', '<p>Senin lalu, grup pedofil yang beraktivitas di media sosial FB diringkus petugas kepolisian. BLA BLA</p>', NULL, '2017-03-21 05:22:37', '2017-03-23 05:05:44', '2017-03-23 05:20:37', NULL, '1', 'DISETUJUI OLEH REDAKSI'),
(10, 'adam', 4, 6, 'Dollar Naik Lagi Pengusaha Bingung', '<p>Per tanggal 17 April 2017, kurs dollar melonjak lagi hingga Rp 18.000 per dollar nya. Hal ini membuat pengusaha ada yang senang dan juga ada yang terancam gulung tikar.</p>', NULL, '2017-03-23 05:19:23', NULL, '2017-03-23 05:20:47', NULL, '1', 'DISETUJUI OLEH REDAKSI'),
(11, 'vito', 4, 1, 'Tes', '<p>Lorem ipsum</p>', 'Lorem ipsum', '2017-07-28 18:36:38', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `ID_KATEGORI` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_KATEGORI` varchar(500) DEFAULT NULL,
  `STATUS_KATEGORI` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_KATEGORI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `STATUS_KATEGORI`) VALUES
(1, 'INTERNASIONAL', 'Aktif'),
(2, 'POLITIK', 'Aktif'),
(3, 'OLAHRAGA', 'Aktif'),
(4, 'LAIN-LAIN', 'Aktif'),
(5, 'BUDAYA', 'Aktif'),
(6, 'EKONOMI', 'Aktif'),
(7, 'SOSIAL', 'Aktif'),
(8, 'KRIMINAL', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reward`
--

CREATE TABLE IF NOT EXISTS `reward` (
  `ID_REWARD` int(11) NOT NULL AUTO_INCREMENT,
  `JUMLAH_REWARD` decimal(12,0) DEFAULT NULL,
  `TIMESTAMP_REWARD` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_REWARD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `reward`
--

INSERT INTO `reward` (`ID_REWARD`, `JUMLAH_REWARD`, `TIMESTAMP_REWARD`) VALUES
(1, 7500, '2017-02-22 10:00:00'),
(2, 8000, '2017-02-24 06:03:45'),
(3, 15000, '2017-02-24 07:58:48'),
(4, 7500, '2017-02-24 07:58:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` varchar(100) NOT NULL,
  `NAMA_USER` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(1000) DEFAULT NULL,
  `JABATAN` varchar(100) DEFAULT NULL,
  `STATUS_PEGAWAI` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_USER`, `NAMA_USER`, `PASSWORD`, `JABATAN`, `STATUS_PEGAWAI`, `EMAIL`) VALUES
('adam', 'Adam Triamukti', '123', 'Reporter', 'PBPNS', 'adam@rri.id'),
('apit', 'Zulfikar', '123', 'Reporter', 'PBPNS', 'apit@rri.id'),
('bayu', 'Bayu Wikan', '123', 'Editor', 'PNS', 'bayu@rri.id'),
('bima', 'Adhitya Bhima', '123', 'Reporter', 'PBPNS', 'bima@rri.id'),
('deni', 'Deni Rizky', '123', 'Kabid', 'PNS', 'dunny@rri.net'),
('jojo', 'Vians Joe', '123', 'Reporter', 'PNS', 'viansjoe@rri.id'),
('nyoman', 'Nyoman Frastyawan', '123', 'Reporter', 'PBPNS', 'nyoman@rri.id'),
('pakpo', 'Aldy Hafil Ananda', '123', 'Reporter', 'PBPNS', 'pakpo@rri.id'),
('pri', 'Priyanggoro', '123', 'Reporter', 'PBPNS', 'pri@rri.id'),
('vito', 'Vito Ganesha', '123', 'Reporter', 'PBPNS', 'vito@rri.id'),
('wahyu', 'Wahyu Septiono', '123', 'Reporter', 'PBPNS', 'wahyu@rri.id'),
('yoga', 'Yoga Adhi', '123', 'Reporter', 'PBPNS', 'yoga@rri.id');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`),
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_REWARD`) REFERENCES `reward` (`ID_REWARD`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
