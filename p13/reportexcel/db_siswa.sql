CREATE DATABASE IF NOT EXISTS `db_siswa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_siswa`;

--
-- Table structure for table `tb_siswa`
--

DROP TABLE IF EXISTS `tb_siswa`;
CREATE TABLE IF NOT EXISTS `tb_siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `KELAS` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `nama`, `KELAS`, `alamat`) VALUES
(1, 'Budi Susanto', '1MM3', 'Sedati Gede'),
(2, 'Dita Anggraini', '1MM2', 'Rungkut'),
(3, 'Riska Nur Aini', '3MM1', 'Wonocolo'),
(2, 'Shuya', '1TKJ1', 'Jl. Batas Dunia');

--
-- Indeks untuk tabel `tb_siswa`
--

ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--

ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;