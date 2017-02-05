/*
SQLyog Professional v12.09 (64 bit)
MySQL - 10.1.13-MariaDB : Database - globalindo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`globalindo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `globalindo`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(25) NOT NULL,
  `harga` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `tgl_diterima` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`nama`,`harga`,`qty`,`gambar`,`tgl_diterima`,`id_supplier`,`ip_address`,`timestamp`,`id_user`) values (2,'blue monster',20000,20000,'file_Barang1_1486216248.jpg','2017-02-04',1,'::1','2017-02-04 21:03:19',1),(6,'boneka monster',400000,30,'file_boneka_monster_1486193928.jpg','2017-02-20',1,'::1','2017-02-04 14:38:48',6);

/*Table structure for table `nota` */

DROP TABLE IF EXISTS `nota`;

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `no_nota` varchar(25) NOT NULL,
  `tgl_buat` date NOT NULL,
  `id_sales` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `total_jual` int(25) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `id_sales` (`id_sales`,`id_toko`),
  KEY `id_toko` (`id_toko`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id_sales`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nota_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `nota` */

insert  into `nota`(`id_nota`,`no_nota`,`tgl_buat`,`id_sales`,`id_toko`,`total_jual`,`ip_address`,`timestamp`,`id_user`) values (1,'43dwsv353','2017-02-22',4,1,650000,'::1','2017-02-05 18:18:27',1),(3,'923918jdiajwi','2017-02-06',2,1,300000,'::1','2017-02-05 18:18:40',1),(4,'kmawd/sda/3423','2017-02-15',2,1,500000,'::1','2017-02-05 18:24:51',1);

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `kondisi` varchar(20) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_pengembalian`),
  KEY `id_barang` (`id_barang`),
  KEY `id_toko` (`id_toko`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengembalian_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengembalian` */

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sales` varchar(100) NOT NULL,
  `alamat_sales` varchar(300) NOT NULL,
  `nik` int(25) NOT NULL,
  `no_telp_sales` varchar(25) NOT NULL,
  `email` varchar(200) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_sales`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `sales` */

insert  into `sales`(`id_sales`,`nama_sales`,`alamat_sales`,`nik`,`no_telp_sales`,`email`,`ip_address`,`timestamp`,`id_user`) values (2,'Sales1','jogja',1239128931,'081192832322','sales1@com.com','::1','2017-02-02 22:50:15',1),(4,'Sales2','solo',122121,'2939129','sales2@com.com','::1','2017-02-03 00:05:44',1);

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_supplier`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `supplier` */

insert  into `supplier`(`id_supplier`,`nama_supplier`,`alamat`,`no_telp`,`ip_address`,`timestamp`,`id_user`) values (1,'Supplier1','jakarta','3423434234','::1','2017-02-04 11:56:33',1);

/*Table structure for table `toko` */

DROP TABLE IF EXISTS `toko`;

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(100) NOT NULL,
  `alamat_toko` varchar(100) NOT NULL,
  `no_telp_toko` varchar(25) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_toko`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `toko` */

insert  into `toko`(`id_toko`,`nama_toko`,`alamat_toko`,`no_telp_toko`,`ip_address`,`timestamp`,`id_user`) values (1,'Toko Boneka','jogja','4534543','::1','2017-02-05 10:07:38',1);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `laba` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `diskon` int(3) NOT NULL,
  `id_nota` int(11) NOT NULL,
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_barang` (`id_barang`,`id_toko`,`id_nota`),
  KEY `id_toko` (`id_toko`),
  KEY `id_nota` (`id_nota`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_nota`) REFERENCES `nota` (`id_nota`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`id_barang`,`harga_jual`,`id_toko`,`laba`,`qty`,`diskon`,`id_nota`,`ip_address`,`timestamp`,`id_user`) values (1,2,50000,1,30000,5,0,1,'::1','2017-02-05 12:38:08',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(5) NOT NULL,
  `sales` varchar(100) DEFAULT '0',
  `ip_address` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  KEY `id_sales` (`sales`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`level`,`sales`,`ip_address`,`timestamp`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','0','','2017-02-02 22:43:58'),(4,'charly','8ddf878039b70767c4a5bcf4f0c4f65e','sales','Sales1','::1','2017-02-04 10:33:27'),(6,'admin2','47bce5c74f589f4867dbd57e9ca9f808','admin','0','::1','2017-02-04 11:28:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
