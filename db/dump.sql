/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_penyewaan_kamera
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_penyewaan_kamera` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_penyewaan_kamera`;

/*Table structure for table `tb_alat` */

DROP TABLE IF EXISTS `tb_alat`;

CREATE TABLE `tb_alat` (
  `kode_alat` char(3) NOT NULL,
  `kode_merk` char(3) NOT NULL,
  `kode_jenis_alat` char(3) NOT NULL,
  `nama_alat` varchar(50) DEFAULT NULL,
  `harga_sewa_alat` bigint(20) DEFAULT NULL,
  `stok_alat` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_alat`),
  KEY `kode_merk` (`kode_merk`),
  KEY `kode_jenis_alat` (`kode_jenis_alat`),
  CONSTRAINT `tb_alat_ibfk_1` FOREIGN KEY (`kode_merk`) REFERENCES `tb_merk` (`kode_merk`),
  CONSTRAINT `tb_alat_ibfk_2` FOREIGN KEY (`kode_jenis_alat`) REFERENCES `tb_jenis_alat` (`kode_jenis_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_alat` */

insert  into `tb_alat`(`kode_alat`,`kode_merk`,`kode_jenis_alat`,`nama_alat`,`harga_sewa_alat`,`stok_alat`) values 
('A01','M01','J01','Canon EOS Rebel SL2',300000,40),
('A02','M01','J01','Canon EOS 90D',250000,87),
('A03','M01','J02','Canon M50 Mark  II',200000,0),
('A04','M02','J09','Tripod Sony Kaiser 234',50000,36),
('A05','M01','J10','',100000,130),
('A06','M03','J02','FujiFilm X-S10 Mirrorless',250000,41),
('A07','M02','J02','Sony Alpha A6000',350000,9),
('A08','M07','J03','GoPro Hero 9',150000,184),
('A09','M06','J05','Leica M10 Black',400000,42),
('A10','M05','J05','Olympus OM-D E-M10 Mark III',500000,90);

/*Table structure for table `tb_denda` */

DROP TABLE IF EXISTS `tb_denda`;

CREATE TABLE `tb_denda` (
  `kode_sewa` char(3) NOT NULL,
  `kode_denda` char(3) DEFAULT NULL,
  `biaya_denda` bigint(20) DEFAULT NULL,
  `keterangan_denda` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode_sewa`),
  CONSTRAINT `tb_denda_ibfk_1` FOREIGN KEY (`kode_sewa`) REFERENCES `tb_penyewaan` (`kode_sewa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_denda` */

insert  into `tb_denda`(`kode_sewa`,`kode_denda`,`biaya_denda`,`keterangan_denda`) values 
('R01','L01',1000000,'Pengembalian tidak lengkap'),
('R03','L02',50000,'Terlambat pengembalian'),
('R04','L03',50000,'Terlambat pengembalian'),
('R05','L04',1000000,'Pengembalian tidak lengkap'),
('R09','L05',50000,'Terlambat pengembalian'),
('R10','L06',50000,'Terlambat pengembalian'),
('R11','L07',50000,'Terlambat pengembalian'),
('R12','L08',50000,'Terlambat pengembalian'),
('R13','L09',50000,'Terlambat pengembalian'),
('R14','L10',50000,'Terlambat pengembalian'),
('R15','L11',50000,'Terlambat pengembalian'),
('R16','L12',50000,'Terlambat pengembalian');

/*Table structure for table `tb_detail_pemasokan` */

DROP TABLE IF EXISTS `tb_detail_pemasokan`;

CREATE TABLE `tb_detail_pemasokan` (
  `kode_pasok` char(3) NOT NULL,
  `kode_alat` char(3) NOT NULL,
  `jumlah_pasok` int(11) DEFAULT NULL,
  `harga_beli` bigint(20) DEFAULT NULL,
  KEY `kode_pasok` (`kode_pasok`),
  KEY `kode_alat` (`kode_alat`),
  CONSTRAINT `tb_detail_pemasokan_ibfk_1` FOREIGN KEY (`kode_pasok`) REFERENCES `tb_pemasokan` (`kode_pasok`),
  CONSTRAINT `tb_detail_pemasokan_ibfk_2` FOREIGN KEY (`kode_alat`) REFERENCES `tb_alat` (`kode_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_pemasokan` */

insert  into `tb_detail_pemasokan`(`kode_pasok`,`kode_alat`,`jumlah_pasok`,`harga_beli`) values 
('D01','A01',5,7500000),
('D01','A02',5,20000000),
('D02','A01',5,7500000),
('D02','A02',15,20000000),
('D03','A03',5,15000000),
('D03','A04',5,1000000),
('D04','A04',5,1000000),
('D04','A05',15,29000000),
('D05','A05',15,29000000),
('D05','A06',5,22000000),
('D06','A06',10,22000000),
('D07','A07',10,8000000),
('D08','A08',40,7000000),
('D09','A09',10,30000000),
('D10','A10',20,10000000),
('D11','A01',5,7500000),
('D11','A02',5,20000000),
('D12','A01',5,7500000),
('D12','A02',15,20000000),
('D13','A03',5,15000000),
('D13','A04',5,1000000),
('D14','A04',5,1000000),
('D14','A05',15,29000000),
('D15','A05',15,29000000),
('D15','A06',5,22000000),
('D16','A06',10,22000000),
('D17','A07',10,8000000),
('D18','A08',40,7000000),
('D19','A09',10,30000000),
('D20','A10',20,10000000),
('D21','A01',5,7500000),
('D21','A02',5,20000000),
('D22','A01',5,7500000),
('D22','A02',15,20000000),
('D23','A03',5,15000000),
('D23','A04',5,1000000),
('D24','A04',5,1000000),
('D24','A05',15,29000000),
('D25','A05',15,29000000),
('D25','A06',5,22000000),
('D26','A06',10,22000000),
('D27','A07',10,8000000),
('D28','A08',40,7000000),
('D29','A09',10,30000000),
('D30','A10',20,10000000),
('D31','A01',5,7500000),
('D31','A02',5,20000000),
('D32','A01',5,7500000),
('D32','A02',15,20000000),
('D33','A03',5,15000000),
('D33','A04',5,1000000),
('D34','A04',5,1000000),
('D34','A05',15,29000000),
('D35','A05',15,29000000),
('D35','A06',5,22000000),
('D36','A06',10,22000000),
('D37','A07',10,8000000),
('D38','A08',40,7000000),
('D39','A09',10,30000000),
('D40','A10',20,10000000),
('D41','A01',5,7500000),
('D41','A02',5,20000000),
('D42','A01',5,7500000),
('D42','A02',15,20000000),
('D43','A03',5,15000000),
('D43','A04',5,1000000),
('D44','A04',5,1000000),
('D44','A05',15,29000000),
('D45','A05',15,29000000),
('D45','A06',5,22000000),
('D46','A06',10,22000000),
('D47','A07',10,8000000),
('D48','A08',40,7000000),
('D49','A09',10,30000000),
('D50','A10',20,10000000);

/*Table structure for table `tb_detail_penyewaan` */

DROP TABLE IF EXISTS `tb_detail_penyewaan`;

CREATE TABLE `tb_detail_penyewaan` (
  `kode_sewa` char(3) NOT NULL,
  `kode_alat` char(3) NOT NULL,
  `jumlah_sewa` int(11) DEFAULT NULL,
  `harga_sewa` bigint(20) DEFAULT NULL,
  KEY `kode_sewa` (`kode_sewa`),
  KEY `kode_alat` (`kode_alat`),
  CONSTRAINT `tb_detail_penyewaan_ibfk_1` FOREIGN KEY (`kode_sewa`) REFERENCES `tb_penyewaan` (`kode_sewa`),
  CONSTRAINT `tb_detail_penyewaan_ibfk_2` FOREIGN KEY (`kode_alat`) REFERENCES `tb_alat` (`kode_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_penyewaan` */

insert  into `tb_detail_penyewaan`(`kode_sewa`,`kode_alat`,`jumlah_sewa`,`harga_sewa`) values 
('R01','A01',2,300000),
('R01','A02',2,250000),
('R02','A02',3,250000),
('R02','A03',2,200000),
('R03','A03',3,200000),
('R03','A04',1,50000),
('R04','A04',3,50000),
('R04','A05',3,100000),
('R05','A05',1,100000),
('R06','A06',5,250000),
('R06','A07',5,350000),
('R07','A07',8,350000),
('R08','A08',5,150000),
('R09','A09',1,400000),
('R10','A10',2,500000),
('R11','A01',2,300000),
('R12','A02',1,250000),
('R13','A03',5,200000),
('R14','A04',2,50000),
('R15','A05',4,100000),
('R16','A06',8,250000),
('R17','A07',5,350000),
('R18','A08',2,150000),
('R19','A09',2,400000),
('R20','A10',2,500000),
('R21','A01',2,300000),
('R21','A02',2,250000),
('R22','A02',3,250000),
('R22','A03',2,200000),
('R23','A03',3,200000),
('R23','A04',1,50000),
('R24','A04',3,50000),
('R24','A05',3,100000),
('R25','A05',1,100000),
('R26','A06',5,250000),
('R26','A07',5,350000),
('R27','A07',8,350000),
('R28','A08',5,150000),
('R29','A09',1,400000),
('R30','A10',2,500000),
('R31','A01',2,300000),
('R32','A02',1,250000),
('R33','A03',5,200000),
('R34','A04',2,50000),
('R35','A05',4,100000),
('R36','A06',8,250000),
('R37','A07',5,350000),
('R38','A08',2,150000),
('R39','A09',2,400000),
('R40','A10',2,500000),
('R41','A01',2,300000),
('R42','A02',1,250000),
('R43','A03',5,200000),
('R44','A04',2,50000),
('R45','A05',4,100000),
('R46','A06',8,250000),
('R47','A07',5,350000),
('R48','A08',2,150000),
('R49','A09',2,400000),
('R50','A10',2,500000);

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `kode_jabatan` char(3) NOT NULL,
  `nama_jabatan` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kode_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`kode_jabatan`,`nama_jabatan`) values 
('B01','Manager'),
('B02','Kasir'),
('B03','Teknisi'),
('B04','IT Support'),
('B05','Operasional Staff'),
('B06','Supply Chain Staff'),
('B07','IT Senior'),
('B08','Security'),
('B09','Accounting Staff'),
('B10','Office Boy');

/*Table structure for table `tb_jenis_alat` */

DROP TABLE IF EXISTS `tb_jenis_alat`;

CREATE TABLE `tb_jenis_alat` (
  `kode_jenis_alat` char(3) NOT NULL,
  `nama_jenis_alat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kode_jenis_alat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis_alat` */

insert  into `tb_jenis_alat`(`kode_jenis_alat`,`nama_jenis_alat`) values 
('J01','Kamera DSLR'),
('J02','Kamera Mirrorless'),
('J03','Action Camera'),
('J04','360 degree Camera'),
('J05','Digital Cinema Camera'),
('J06','Webcam'),
('J07','Drone'),
('J08','Baterai'),
('J09','Stand'),
('J10','Lensa');

/*Table structure for table `tb_kota` */

DROP TABLE IF EXISTS `tb_kota`;

CREATE TABLE `tb_kota` (
  `kode_kota` char(3) NOT NULL,
  `kode_provinsi` char(3) NOT NULL,
  `nama_kota` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kode_kota`),
  KEY `kode_provinsi` (`kode_provinsi`),
  CONSTRAINT `tb_kota_ibfk_1` FOREIGN KEY (`kode_provinsi`) REFERENCES `tb_provinsi` (`kode_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kota` */

insert  into `tb_kota`(`kode_kota`,`kode_provinsi`,`nama_kota`) values 
('T01','N01','Denpasar'),
('T02','N01','Badung'),
('T03','N01','Tabanan'),
('T04','N01','Buleleng'),
('T05','N01','Bangli'),
('T06','N01','Gianyar'),
('T07','N01','Klungkung'),
('T08','N01','Denpasar'),
('T09','N02','Surabaya'),
('T10','N03','Klaten');

/*Table structure for table `tb_merk` */

DROP TABLE IF EXISTS `tb_merk`;

CREATE TABLE `tb_merk` (
  `kode_merk` char(3) NOT NULL,
  `nama_merk` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kode_merk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_merk` */

insert  into `tb_merk`(`kode_merk`,`nama_merk`) values 
('M01','Canon'),
('M02','Sony'),
('M03','FujiFilm'),
('M04','Panasonic'),
('M05','Olympus'),
('M06','Leica'),
('M07','GoPro'),
('M08','Pentax'),
('M09','Kodak'),
('M10','Ricoh');

/*Table structure for table `tb_pegawai` */

DROP TABLE IF EXISTS `tb_pegawai`;

CREATE TABLE `tb_pegawai` (
  `kode_pegawai` char(3) NOT NULL,
  `kode_kota` char(3) NOT NULL,
  `kode_jabatan` char(3) NOT NULL,
  `nama_pegawai` varchar(30) DEFAULT NULL,
  `no_tlp_pegawai` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat_pegawai` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`kode_pegawai`),
  KEY `kode_kota` (`kode_kota`),
  KEY `kode_jabatan` (`kode_jabatan`),
  CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`kode_kota`) REFERENCES `tb_kota` (`kode_kota`),
  CONSTRAINT `tb_pegawai_ibfk_2` FOREIGN KEY (`kode_jabatan`) REFERENCES `tb_jabatan` (`kode_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pegawai` */

insert  into `tb_pegawai`(`kode_pegawai`,`kode_kota`,`kode_jabatan`,`nama_pegawai`,`no_tlp_pegawai`,`jenis_kelamin`,`alamat_pegawai`) values 
('P01','T01','B01','Selamet','081188997766','L','Denpasar'),
('P02','T02','B02','Budi Santo','081188997711','L','Badung'),
('P03','T06','B02','Wira','081188992222','L','Gianyar'),
('P04','T02','B03','hfhfghgh','081188994433','L','Badung'),
('P05','T01','B05','Wahyu','081188667777','L','Denpasar'),
('P06','T06','B06','Mahesa','081188998888','L','Gianyar'),
('P07','T01','B06','Agung','081188990000','L','Denpasar'),
('P08','T01','B07','Sekar','081188123465','P','Denpasar'),
('P09','T03','B07','Putri','081188994478','P','Tabanan'),
('P10','T02','B09','Nonik','081188991100','P','Badung');

/*Table structure for table `tb_pelanggan` */

DROP TABLE IF EXISTS `tb_pelanggan`;

CREATE TABLE `tb_pelanggan` (
  `kode_pelanggan` char(3) NOT NULL,
  `kode_kota` char(3) NOT NULL,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `no_tlp_pelanggan` varchar(15) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat_pelanggan` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`kode_pelanggan`),
  KEY `kode_kota` (`kode_kota`),
  CONSTRAINT `tb_pelanggan_ibfk_1` FOREIGN KEY (`kode_kota`) REFERENCES `tb_kota` (`kode_kota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pelanggan` */

insert  into `tb_pelanggan`(`kode_pelanggan`,`kode_kota`,`nama_pelanggan`,`no_tlp_pelanggan`,`jenis_kelamin`,`alamat_pelanggan`) values 
('K01','T01','Agung Wahyu','081188991111','L','Denpasar'),
('K02','T01','Ananda Pannadhika','081188992222','L','Denpasar'),
('K03','T06','Rai Pramana','081188993333','L','Gianyar'),
('K04','T06','Karcana Putra','081188994444','L','Gianyar'),
('K05','T02','Ade Wirajaya','081188665555','L','Badung'),
('K06','T02','Alex Bramartha','081188996666','L','Badung'),
('K07','T03','Krishna Mahardika','08118897777','L','Tabanan'),
('K08','T03','','081188128888','L','Tabanan'),
('K09','T07','Della Ariani','081188999999','P','Klungkung'),
('K10','T07','Nadia Maharani','081188990000','P','Klungkung');

/*Table structure for table `tb_pemasokan` */

DROP TABLE IF EXISTS `tb_pemasokan`;

CREATE TABLE `tb_pemasokan` (
  `kode_pasok` char(3) NOT NULL,
  `kode_pegawai` char(3) NOT NULL,
  `kode_supplier` char(3) NOT NULL,
  `tgl_pasok` date DEFAULT NULL,
  `total_pasok` int(11) DEFAULT NULL,
  `total_biaya_pasok` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`kode_pasok`),
  KEY `kode_pegawai` (`kode_pegawai`),
  KEY `kode_supplier` (`kode_supplier`),
  CONSTRAINT `tb_pemasokan_ibfk_1` FOREIGN KEY (`kode_pegawai`) REFERENCES `tb_pegawai` (`kode_pegawai`),
  CONSTRAINT `tb_pemasokan_ibfk_2` FOREIGN KEY (`kode_supplier`) REFERENCES `tb_supplier` (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pemasokan` */

insert  into `tb_pemasokan`(`kode_pasok`,`kode_pegawai`,`kode_supplier`,`tgl_pasok`,`total_pasok`,`total_biaya_pasok`) values 
('D01','P06','S01','2021-01-10',10,137500000),
('D02','P07','S02','2021-01-15',20,337500000),
('D03','P06','S03','2021-01-20',10,80000000),
('D04','P07','S04','2021-01-25',20,440000000),
('D05','P06','S05','2021-01-30',20,545000000),
('D06','P07','S06','2021-02-05',10,220000000),
('D07','P06','S07','2021-02-10',10,80000000),
('D08','P07','S08','2021-03-10',40,280000000),
('D09','P06','S09','2021-03-20',10,300000000),
('D10','P06','S01','2021-03-30',20,200000000),
('D11','P06','S01','2021-04-10',10,137500000),
('D12','P07','S02','2021-04-15',20,337500000),
('D13','P06','S03','2021-04-20',10,80000000),
('D14','P07','S04','2021-04-25',20,440000000),
('D15','P06','S05','2021-04-30',20,545000000),
('D16','P07','S06','2021-05-05',10,220000000),
('D17','P06','S07','2021-05-10',10,80000000),
('D18','P07','S08','2021-05-10',40,280000000),
('D19','P06','S09','2021-05-20',10,300000000),
('D20','P06','S01','2021-06-10',20,200000000),
('D21','P07','S02','2021-06-15',10,137500000),
('D22','P06','S03','2021-06-20',20,337500000),
('D23','P07','S04','2021-06-25',10,80000000),
('D24','P06','S05','2021-06-30',20,440000000),
('D25','P07','S06','2021-07-05',20,545000000),
('D26','P06','S07','2021-07-10',10,220000000),
('D27','P07','S08','2021-07-10',10,80000000),
('D28','P06','S09','2021-07-20',40,280000000),
('D29','P06','S01','2021-08-10',10,300000000),
('D30','P07','S02','2021-08-15',20,200000000),
('D31','P06','S03','2021-08-20',10,137500000),
('D32','P07','S04','2021-08-25',20,337500000),
('D33','P06','S05','2021-08-30',10,80000000),
('D34','P07','S06','2021-09-05',20,440000000),
('D35','P06','S07','2021-09-10',20,545000000),
('D36','P07','S08','2021-09-10',10,220000000),
('D37','P06','S09','2021-09-20',10,80000000),
('D38','P06','S01','2021-10-10',40,280000000),
('D39','P07','S02','2021-10-15',10,300000000),
('D40','P06','S03','2021-10-20',20,200000000),
('D41','P07','S04','2021-10-25',10,137500000),
('D42','P06','S05','2021-10-30',20,337500000),
('D43','P07','S06','2021-11-05',10,80000000),
('D44','P06','S07','2021-11-10',20,440000000),
('D45','P07','S08','2021-11-10',20,545000000),
('D46','P06','S09','2021-11-20',10,220000000),
('D47','P06','S01','2021-12-10',10,80000000),
('D48','P07','S02','2021-12-15',40,280000000),
('D49','P06','S03','2021-12-20',10,300000000),
('D50','P07','S04','2021-12-25',20,200000000);

/*Table structure for table `tb_penyewaan` */

DROP TABLE IF EXISTS `tb_penyewaan`;

CREATE TABLE `tb_penyewaan` (
  `kode_sewa` char(3) NOT NULL,
  `kode_pegawai` char(3) NOT NULL,
  `kode_pelanggan` char(3) NOT NULL,
  `tgl_sewa` date DEFAULT NULL,
  `tgl_jatuh_tempo` date DEFAULT NULL,
  `total_sewa` int(11) DEFAULT NULL,
  `total_biaya_sewa` bigint(20) DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `status_sewa` enum('Selesai','Belum Selesai') DEFAULT NULL,
  PRIMARY KEY (`kode_sewa`),
  KEY `kode_pegawai` (`kode_pegawai`),
  KEY `kode_pelanggan` (`kode_pelanggan`),
  CONSTRAINT `tb_penyewaan_ibfk_1` FOREIGN KEY (`kode_pegawai`) REFERENCES `tb_pegawai` (`kode_pegawai`),
  CONSTRAINT `tb_penyewaan_ibfk_2` FOREIGN KEY (`kode_pelanggan`) REFERENCES `tb_pelanggan` (`kode_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_penyewaan` */

insert  into `tb_penyewaan`(`kode_sewa`,`kode_pegawai`,`kode_pelanggan`,`tgl_sewa`,`tgl_jatuh_tempo`,`total_sewa`,`total_biaya_sewa`,`tgl_pengembalian`,`status_sewa`) values 
('R01','P02','K01','2021-05-01','2021-05-10',4,2100000,'2021-05-09','Selesai'),
('R02','P03','K02','2021-05-05','2021-05-15',5,1150000,'2021-05-14','Selesai'),
('R03','P02','K03','2021-05-08','2021-05-18',4,700000,'2021-05-19','Selesai'),
('R04','P03','K04','2021-05-10','2021-05-20',6,500000,'2021-05-21','Selesai'),
('R05','P02','K05','2021-05-12','2021-05-22',1,1100000,'2021-05-21','Selesai'),
('R06','P03','K06','2021-05-18','2021-05-28',10,3000000,'2021-05-27','Selesai'),
('R07','P02','K07','2021-05-25','2021-06-05',8,2800000,'2021-06-03','Selesai'),
('R08','P03','K08','2021-06-01','2021-06-10',5,750000,'2021-06-09','Selesai'),
('R09','P02','K09','2021-06-12','2021-06-22',1,450000,'2021-06-23','Selesai'),
('R10','P03','K10','2021-06-12','2021-06-23',2,1050000,'2021-06-24','Selesai'),
('R11','P02','K01','2021-06-13','2021-06-23',2,650000,'2021-06-24','Selesai'),
('R12','P03','K02','2021-06-13','2021-06-23',1,300000,'2021-06-24','Selesai'),
('R13','P02','K03','2021-06-14','2021-06-24',5,1050000,'2021-06-25','Selesai'),
('R14','P03','K04','2021-06-14','2021-06-24',2,150000,'2021-06-25','Selesai'),
('R15','P02','K05','2021-06-14','2021-06-24',4,450000,'2021-06-25','Selesai'),
('R16','P03','K06','2021-06-15','2021-06-25',8,2050000,'2021-06-26','Selesai'),
('R17','P02','K07','2021-06-15','2021-06-28',5,1750000,'2021-06-26','Selesai'),
('R18','P03','K08','2021-06-15','2021-06-28',2,300000,'2021-06-26','Selesai'),
('R19','P03','K08','2021-06-15','2021-06-28',2,800000,'2021-06-28','Selesai'),
('R20','P03','K08','2021-06-15','2021-06-28',2,1000000,'2021-06-28','Selesai'),
('R21','P02','K01','2021-07-01','2021-07-10',4,1100000,'2021-07-09','Selesai'),
('R22','P03','K02','2021-07-05','2021-07-15',5,1150000,'2021-07-14','Selesai'),
('R23','P02','K03','2021-07-08','2021-07-19',4,650000,'2021-07-19','Selesai'),
('R24','P03','K04','2021-07-10','2021-07-26',6,450000,'2021-07-21','Selesai'),
('R25','P02','K05','2021-07-12','2021-07-22',1,100000,'2021-07-21','Selesai'),
('R26','P03','K06','2021-07-18','2021-07-28',10,3000000,'2021-07-27','Selesai'),
('R27','P02','K07','2021-07-25','2021-08-05',8,2800000,'2021-08-03','Selesai'),
('R28','P03','K08','2021-08-01','2021-08-15',5,750000,'2021-08-09','Selesai'),
('R29','P02','K09','2021-08-12','2021-08-25',1,400000,'2021-08-23','Selesai'),
('R30','P03','K10','2021-08-12','2021-08-28',2,1000000,'2021-08-24','Selesai'),
('R31','P02','K01','2021-08-13','2021-08-28',2,600000,'2021-08-24','Selesai'),
('R32','P03','K02','2021-08-13','2021-08-28',1,250000,'2021-08-24','Selesai'),
('R33','P02','K03','2021-08-14','2021-08-28',5,1000000,'2021-08-25','Selesai'),
('R34','P03','K04','2021-08-14','2021-08-28',2,100000,'2021-08-25','Selesai'),
('R35','P02','K05','2021-08-14','2021-08-28',4,400000,'2021-08-25','Selesai'),
('R36','P03','K06','2021-08-15','2021-08-28',8,2000000,'2021-08-26','Selesai'),
('R37','P02','K07','2021-08-15','2021-08-28',5,1750000,'2021-08-26','Selesai'),
('R38','P03','K08','2021-08-15','2021-08-28',2,300000,'2021-08-26','Selesai'),
('R39','P03','K08','2021-08-15','2021-08-28',2,800000,'2021-08-28','Selesai'),
('R40','P03','K08','2021-08-15','2021-08-28',2,1000000,'2021-08-28','Selesai'),
('R41','P02','K01','2021-09-13','2021-09-26',2,600000,'2021-09-24','Selesai'),
('R42','P03','K02','2021-09-13','2021-09-26',1,250000,'2021-09-24','Selesai'),
('R43','P02','K03','2021-09-14','2021-09-26',5,1000000,'2021-09-25','Selesai'),
('R44','P03','K04','2021-09-14','2021-09-26',2,100000,'2021-09-25','Selesai'),
('R45','P02','K05','2021-09-14','2021-09-27',4,400000,'2021-09-25','Selesai'),
('R46','P03','K06','2021-09-15','2021-09-27',8,2000000,'2021-09-26','Selesai'),
('R47','P02','K07','2021-09-15','2021-09-27',5,1750000,'2021-09-26','Selesai'),
('R48','P03','K08','2021-09-15','2021-09-28',2,300000,'2021-09-26','Selesai'),
('R49','P03','K08','2021-09-15','2021-09-28',2,800000,'2021-09-28','Selesai'),
('R50','P03','K08','2021-09-15','2021-09-28',2,1000000,'2021-09-28','Selesai');

/*Table structure for table `tb_provinsi` */

DROP TABLE IF EXISTS `tb_provinsi`;

CREATE TABLE `tb_provinsi` (
  `kode_provinsi` char(3) NOT NULL,
  `nama_provinsi` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kode_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_provinsi` */

insert  into `tb_provinsi`(`kode_provinsi`,`nama_provinsi`) values 
('N01','Bali'),
('N02','Jawa Timur'),
('N03','Jawa Tengah'),
('N04','Yogyakarta'),
('N05','Jawa Barat'),
('N06','Aceh'),
('N07','Kalimantan Timur'),
('N08','Kalimantan Barat');

/*Table structure for table `tb_supplier` */

DROP TABLE IF EXISTS `tb_supplier`;

CREATE TABLE `tb_supplier` (
  `kode_supplier` char(3) NOT NULL,
  `kode_kota` char(3) NOT NULL,
  `nama_supplier` varchar(30) DEFAULT NULL,
  `no_tlp_supplier` varchar(15) DEFAULT NULL,
  `alamat_supplier` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`kode_supplier`),
  KEY `kode_kota` (`kode_kota`),
  CONSTRAINT `tb_supplier_ibfk_1` FOREIGN KEY (`kode_kota`) REFERENCES `tb_kota` (`kode_kota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_supplier` */

insert  into `tb_supplier`(`kode_supplier`,`kode_kota`,`nama_supplier`,`no_tlp_supplier`,`alamat_supplier`) values 
('S01','T01','PT. Wira Niaga Graha','0213924667','Denpasar'),
('S02','T01','PT. Panca Bakti Persada','061547370','Denpasar'),
('S03','T02','PT. Indah Anugrah Abadi','0215684735','Badung'),
('S04','T02','PT. Tiga Ombak','0217229045','Badung'),
('S05','T03','PT. Robina Anugerah Abadi','02145850647','Tabanan'),
('S06','T03','PT. Nindia Kasih Bersaudara','02175817966','Tabanan'),
('S07','T04','PT. Dwiguna Intijati','0217817290','Buleleng'),
('S08','T05','PT. Multi Indosaintifik','02145857848','Bangli'),
('S09','T06','test','0217355092','Gianyar'),
('S10','T07','PT. Disindo Utama','0222034400','Klungkung');

/* Trigger structure for table `tb_denda` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_denda` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_denda` AFTER INSERT ON `tb_denda` FOR EACH ROW BEGIN	
	UPDATE db_penyewaan_kamera.tb_penyewaan
	SET total_biaya_sewa = total_biaya_sewa + (new.biaya_denda)
	WHERE kode_sewa = new.kode_sewa;
    END */$$


DELIMITER ;

/* Trigger structure for table `tb_denda` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_denda_rubah` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_denda_rubah` AFTER UPDATE ON `tb_denda` FOR EACH ROW BEGIN
	UPDATE db_penyewaan_kamera.tb_penyewaan
	SET total_biaya_sewa = total_biaya_sewa + (new.biaya_denda)
	WHERE kode_sewa = new.kode_sewa;

	UPDATE db_penyewaan_kamera.tb_penyewaan
	SET total_biaya_sewa = total_biaya_sewa - (old.biaya_denda)
	WHERE kode_sewa = old.kode_sewa;
    END */$$


DELIMITER ;

/* Trigger structure for table `tb_denda` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_denda_kembalikan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_denda_kembalikan` BEFORE DELETE ON `tb_denda` FOR EACH ROW BEGIN
	UPDATE db_penyewaan_kamera.tb_penyewaan
	SET total_biaya_sewa = total_biaya_sewa - (old.biaya_denda)
	WHERE kode_sewa = old.kode_sewa;
    END */$$


DELIMITER ;

/* Trigger structure for table `tb_detail_pemasokan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_pasok` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_pasok` AFTER INSERT ON `tb_detail_pemasokan` FOR EACH ROW BEGIN
	UPDATE 	db_penyewaan_kamera.tb_alat
	SET stok_alat = stok_alat + new.jumlah_pasok
	WHERE kode_alat = new.kode_alat;

	UPDATE db_penyewaan_kamera.tb_pemasokan
	SET total_pasok = total_pasok + new.jumlah_pasok,
	total_biaya_pasok = total_biaya_pasok + (new.jumlah_pasok * new.harga_beli)
	WHERE kode_pasok = new.kode_pasok;
    END */$$


DELIMITER ;

/* Trigger structure for table `tb_detail_pemasokan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_pasok_rubah` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_pasok_rubah` AFTER UPDATE ON `tb_detail_pemasokan` FOR EACH ROW BEGIN	
	UPDATE 	db_penyewaan_kamera.tb_alat
	SET stok_alat = stok_alat + new.jumlah_pasok
	WHERE kode_alat = new.kode_alat;

	UPDATE db_penyewaan_kamera.tb_pemasokan
	SET total_pasok = total_pasok + new.jumlah_pasok,
	total_biaya_pasok = total_biaya_pasok + (new.jumlah_pasok * new.harga_beli)
	WHERE kode_pasok = new.kode_pasok;


	UPDATE 	db_penyewaan_kamera.tb_alat
	SET stok_alat = stok_alat - old.jumlah_pasok
	WHERE kode_alat = old.kode_alat;

	UPDATE db_penyewaan_kamera.tb_pemasokan
	SET total_pasok = total_pasok - old.jumlah_pasok,
	total_biaya_pasok = total_biaya_pasok - (old.jumlah_pasok * old.harga_beli)
	WHERE kode_pasok = old.kode_pasok;
    END */$$


DELIMITER ;

/* Trigger structure for table `tb_detail_pemasokan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_pasok_kembalikan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_pasok_kembalikan` BEFORE DELETE ON `tb_detail_pemasokan` FOR EACH ROW BEGIN
	UPDATE 	db_penyewaan_kamera.tb_alat
	SET stok_alat = stok_alat - old.jumlah_pasok
	WHERE kode_alat = old.kode_alat;

	UPDATE db_penyewaan_kamera.tb_pemasokan
	SET total_pasok = total_pasok - old.jumlah_pasok,
	total_biaya_pasok = total_biaya_pasok - (old.jumlah_pasok * old.harga_beli)
	WHERE kode_pasok = old.kode_pasok;
    END */$$


DELIMITER ;

/* Trigger structure for table `tb_detail_penyewaan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_sewa` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_sewa` AFTER INSERT ON `tb_detail_penyewaan` FOR EACH ROW BEGIN
	DECLARE v_harga INT DEFAULT 0;
	SELECT harga_sewa_alat INTO v_harga FROM tb_alat
	WHERE kode_alat = new.kode_alat;
	
	UPDATE 	db_penyewaan_kamera.tb_alat 
	SET stok_alat = stok_alat - new.jumlah_sewa
	WHERE kode_alat = new.kode_alat;
	
	UPDATE db_penyewaan_kamera.tb_penyewaan
	SET total_sewa = total_sewa + new.jumlah_sewa,
	total_biaya_sewa = total_biaya_sewa + (new.jumlah_sewa * v_harga)
	WHERE kode_sewa = new.kode_sewa;
    END */$$


DELIMITER ;

/* Trigger structure for table `tb_detail_penyewaan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tg_sewa_kembalikan` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tg_sewa_kembalikan` BEFORE DELETE ON `tb_detail_penyewaan` FOR EACH ROW BEGIN
    DECLARE v_harga INT DEFAULT 0;
	SELECT harga_sewa_alat INTO v_harga FROM tb_alat
	WHERE kode_alat = old.kode_alat;

	UPDATE 	db_penyewaan_kamera.tb_alat
	SET stok_alat = stok_alat + old.jumlah_sewa
	WHERE kode_alat = old.kode_alat;

	UPDATE db_penyewaan_kamera.tb_penyewaan
	SET total_sewa = total_sewa - old.jumlah_sewa,
	total_biaya_sewa = total_biaya_sewa - (old.jumlah_sewa * v_harga)
	WHERE kode_sewa = old.kode_sewa;
    END */$$


DELIMITER ;

/* Procedure structure for procedure `procs_harga_barang` */

/*!50003 DROP PROCEDURE IF EXISTS  `procs_harga_barang` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `procs_harga_barang`()
BEGIN
		UPDATE db_penyewaan_kamera.tb_detail_penyewaan AS sewd,
			db_penyewaan_kamera.tb_alat AS a
		SET sewd.harga_sewa = a.harga_sewa_alat
		WHERE sewd.kode_alat = a.kode_alat;
	END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
