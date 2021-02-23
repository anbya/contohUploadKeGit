-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2019 at 03:27 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masterisoidepos`
--

-- --------------------------------------------------------

--
-- Table structure for table `crmpoint`
--

CREATE TABLE `crmpoint` (
  `notrans` varchar(25) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `outlet` varchar(25) NOT NULL,
  `id_member` varchar(25) NOT NULL,
  `point` varchar(25) NOT NULL,
  `tgl` varchar(25) NOT NULL,
  `jam` varchar(25) NOT NULL,
  `last_user` varchar(25) NOT NULL,
  `last_modify` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_import`
--

CREATE TABLE `data_import` (
  `terminal_id` varchar(25) NOT NULL,
  `import_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_void`
--

CREATE TABLE `item_void` (
  `notrans` varchar(25) NOT NULL,
  `terminal_id` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL,
  `kd_item` varchar(25) NOT NULL,
  `additional` varchar(25) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `price` varchar(100) NOT NULL,
  `status_void` varchar(250) NOT NULL,
  `alasan_void` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `localvoucher`
--

CREATE TABLE `localvoucher` (
  `vouchernumber` varchar(25) NOT NULL,
  `namavoucher` varchar(250) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `expdate` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `createdate` varchar(25) NOT NULL,
  `useddate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` varchar(25) NOT NULL,
  `nama_member` varchar(250) NOT NULL,
  `tanggal_lahir` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `referal` varchar(50) NOT NULL,
  `no_kartu` varchar(100) NOT NULL,
  `point` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `statusmembership` varchar(25) NOT NULL,
  `tahun_daftar` varchar(25) NOT NULL,
  `tanggal_daftar` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `otentikasi`
--

CREATE TABLE `otentikasi` (
  `id_voucher` varchar(25) NOT NULL,
  `otp` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` varchar(25) NOT NULL,
  `nama_outlet` varchar(50) NOT NULL,
  `LastUser` varchar(20) NOT NULL,
  `last_modify` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama_outlet`, `LastUser`, `last_modify`) VALUES
('NHO2018000001', 'NAHM HO', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000002', 'NAHM ATRIUM', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000003', 'NAHM PIM1', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000004', 'NAHM MKG', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000005', 'NAHM SMS', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000006', 'NAHM BLOK-M', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000007', 'ISOIDE ATRIUM', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000008', 'ISOIDE PLUIT VILLAGE', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000009', 'ISOIDE BANDUNG INDAH PLAZA', 'ANBYA', '2019-01-01 00:00:00'),
('NHO2018000010', 'NAHM PARIS VAN JAVA', 'ANBYA', '2019-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pointredemption`
--

CREATE TABLE `pointredemption` (
  `id_pointredemption` varchar(25) NOT NULL,
  `id_member` varchar(25) NOT NULL,
  `id_promo` varchar(25) NOT NULL,
  `point` varchar(25) NOT NULL,
  `redeemdate` varchar(25) NOT NULL,
  `outlet` varchar(25) NOT NULL,
  `lastuser` varchar(50) NOT NULL,
  `lastmodify` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_item`
--

CREATE TABLE `pos_item` (
  `kditem` varchar(25) NOT NULL DEFAULT '',
  `nmitem` varchar(150) NOT NULL,
  `price` varchar(100) NOT NULL,
  `kdsubcategory` varchar(25) DEFAULT NULL,
  `kdcategory` varchar(25) NOT NULL,
  `additional` varchar(500) NOT NULL,
  `LastUser` varchar(20) DEFAULT NULL,
  `last_modify` varchar(25) DEFAULT NULL,
  `state` varchar(25) NOT NULL,
  `outlet_paremeter` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_item`
--

INSERT INTO `pos_item` (`kditem`, `nmitem`, `price`, `kdsubcategory`, `kdcategory`, `additional`, `LastUser`, `last_modify`, `state`, `outlet_paremeter`) VALUES
('193001', 'Miso Ramen Chicken / Beef', '30000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193002', 'Soyu Ramen Chicken / Beef', '30000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193003', 'Spicy Ramen Chicken / Beef', '30000', '192001', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193004', 'Green Curry Ramen Chicken / Beef', '30000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193005', 'Miso Ramen and Fry Mix A', '37000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193006', 'Soyu Ramen and Fry Mix A', '37000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193007', 'Spicy Ramen and Fry Mix B', '37000', '192001', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193008', 'Green Curry Ramen and Fry Mix B', '37000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193009', 'Miso Ramen and Chicken Katsu', '40000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193010', 'Soyu Ramen and Chicken Katsu', '40000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193011', 'Spicy Ramen and Chicken Katsu', '40000', '192001', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193012', 'Green Curry Ramen and Chicken Katsu', '40000', '192001', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193013', 'Spicy Dry Ramen Chicken / Beef', '33000', '192002', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193014', 'Soyu Dry Ramen Chicken / Beef', '33000', '192002', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193015', 'Salmon Dry Ramen', '33000', '192002', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193016', 'Spicy Dry Ramen and Fry Mix A', '37000', '192002', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193017', 'Soyu Dry Ramen and Fry Mix B', '37000', '192002', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193018', 'Salmon Dry Ramen and Fry Mix B', '37000', '192002', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193019', 'Spicy Dry Ramen and Chicken Katsu', '40000', '192002', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193020', 'Soyu Dry Ramen and Chicken Katsu', '40000', '192002', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193021', 'Salmon Dry Ramen and Chicken Katsu', '40000', '192002', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193022', 'Beef Teriyaki + Fry Mix A + Sayuran Mix + Nasi', '30000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193023', 'Chicken Teriyaki + Fry Mix A + Sayuran Mix + Nasi', '30000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193024', 'Beef Yakiniku + Fry Mix B + Sayuran Mix + Nasi', '30000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193025', 'Chicken Yakiniku + Fry Mix B + Sayuran Mix + Nasi', '30000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193026', 'Unagi + Fry Mix A + Sayuran Mix + Nasi', '35000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193027', 'Bento Set I', '43000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193028', 'Bento Set II', '43000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193029', 'Beef Yakiniku Japanese Bowl', '27000', '192004', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193030', 'Beef Teriyaki Japanese Bowl', '27000', '192004', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193031', 'Unagi Japanese Bowl', '30000', '192004', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193032', 'Chicken Karage Japanese Bowl', '30000', '192004', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193033', 'Chicken Katsu Curry Rice', '42000', '192005', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193034', 'Beef Curry Rice', '37000', '192005', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193035', 'Seafood Yakimesi', '32000', '192006', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193036', 'Chicken Katsu Yakimesi', '36000', '192006', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193037', 'Ebi Katsu Yakimesi', '36000', '192006', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193038', 'Ebi Fry Yakimesi', '36000', '192006', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193039', 'Chicken Karage Yakimesi', '36000', '192006', '191001', 'ORIGINAL,PEDAS', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193040', 'Nasi + Fry Mix A + Sayuran Mix', '20000', '192008', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193041', 'Nasi + Fry Mix B + Sayuran Mix', '20000', '192008', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193042', 'Nasi + Gyosa + Sayuran Mix', '25000', '192008', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193043', 'Donburi A', '25000', '192008', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193044', 'Donburi B', '25000', '192008', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193045', 'Nasi + Chicken Katsu Cheese + Sayuran Mix', '27000', '192008', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193046', 'Hot Ocha', '8000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193047', 'Cold Ocha', '8000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193048', 'Mineral Water', '8000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193049', 'Teh Pucuk ', '10000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193050', 'Jus Melon', '20000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193051', 'Jus Strawberry', '20000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193052', 'Jus Alpukat', '20000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193053', 'Jus Semangka', '20000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193054', 'Fresh Orange', '20000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193055', 'Lemon Tea', '17000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193056', 'Milky Green tea', '17000', '192010', '191002', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193066', 'FREE TEH PUCUK HARUM', '0', '192011', '191003', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL'),
('193067', 'NASI PUTIH', '7000', '192003', '191001', '', 'ANBYA', '2019-01-01 00:00:00', 'ACTIVE', 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `pos_itemtemp`
--

CREATE TABLE `pos_itemtemp` (
  `transtemp` varchar(25) NOT NULL,
  `kditem` varchar(25) NOT NULL,
  `kdcategory` varchar(25) NOT NULL,
  `kdsubcategory` varchar(25) NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `subtotal` varchar(25) NOT NULL,
  `disc` varchar(25) NOT NULL,
  `grandprice` varchar(50) NOT NULL,
  `squence` varchar(25) NOT NULL,
  `bill` varchar(25) NOT NULL,
  `squenceorder` varchar(25) NOT NULL,
  `terminal_id` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL,
  `paidstatus` varchar(25) NOT NULL,
  `note` varchar(500) NOT NULL,
  `additional` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_kategoryitem`
--

CREATE TABLE `pos_kategoryitem` (
  `kdcategory` varchar(25) NOT NULL DEFAULT '',
  `nmcategory` varchar(150) DEFAULT NULL,
  `lastuser` varchar(20) DEFAULT NULL,
  `last_modify` varchar(25) DEFAULT NULL,
  `outlet_paremeter` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_kategoryitem`
--

INSERT INTO `pos_kategoryitem` (`kdcategory`, `nmcategory`, `lastuser`, `last_modify`, `outlet_paremeter`) VALUES
('191001', 'FOOD', 'ANBYA', '2018-04-26 00:00:00', 'ALL'),
('191002', 'BEVERAGES', 'ANBYA', '2018-04-26 00:00:00', 'ALL'),
('191003', 'FREE ITEM', 'ANBYA', '2018-04-26 00:00:00', 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `pos_other_payment_prm`
--

CREATE TABLE `pos_other_payment_prm` (
  `id_other_payment` varchar(25) NOT NULL,
  `nama_other_payment` varchar(250) NOT NULL,
  `jumlah_other_payment` varchar(25) NOT NULL,
  `last_modify` varchar(25) NOT NULL,
  `outlet_parameter` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_other_payment_prm`
--

INSERT INTO `pos_other_payment_prm` (`id_other_payment`, `nama_other_payment`, `jumlah_other_payment`, `last_modify`, `outlet_parameter`) VALUES
('P0001', 'TRAVELOKA EATS 50K', '50000', '', ''),
('P0002', 'ISOIDE OPENING VOUCHER 25K', '25000', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_parameter`
--

CREATE TABLE `pos_parameter` (
  `id_parameter` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL,
  `prefix` varchar(5) NOT NULL,
  `counter_trans_temp` varchar(25) NOT NULL,
  `counter_pos` varchar(25) NOT NULL,
  `tax` varchar(25) NOT NULL,
  `service_charge` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_payment`
--

CREATE TABLE `pos_payment` (
  `NoTrans` varchar(25) DEFAULT NULL,
  `JnsTrans` varchar(25) DEFAULT NULL,
  `JnsCard` varchar(25) DEFAULT NULL,
  `Jumlah` varchar(25) DEFAULT NULL,
  `LastUser` varchar(25) DEFAULT NULL,
  `LastModify` varchar(25) DEFAULT NULL,
  `Bank` varchar(25) DEFAULT NULL,
  `vouchernumber` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_paymenttemp`
--

CREATE TABLE `pos_paymenttemp` (
  `NoTrans` varchar(25) DEFAULT NULL,
  `JnsTrans` varchar(25) DEFAULT NULL,
  `JnsCard` varchar(25) DEFAULT NULL,
  `jumlah_bayar` varchar(25) NOT NULL,
  `Jumlah` varchar(25) DEFAULT NULL,
  `LastUser` varchar(25) DEFAULT NULL,
  `LastModify` varchar(25) DEFAULT NULL,
  `Bank` varchar(25) DEFAULT NULL,
  `bill` varchar(25) NOT NULL,
  `vouchernumber` varchar(25) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `terminal_id` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_promotion_d`
--

CREATE TABLE `pos_promotion_d` (
  `transtemp` varchar(25) NOT NULL,
  `id_promotion` varchar(25) NOT NULL,
  `promotion_type` varchar(50) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `bill` varchar(25) NOT NULL,
  `kditem` varchar(25) NOT NULL,
  `squence` varchar(25) NOT NULL,
  `disc` varchar(25) NOT NULL,
  `terminal_id` varchar(25) NOT NULL,
  `paid_status` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_promotion_h`
--

CREATE TABLE `pos_promotion_h` (
  `notrans` varchar(25) NOT NULL,
  `id_promotion` varchar(25) NOT NULL,
  `promotion_type` varchar(50) NOT NULL,
  `bill` varchar(25) NOT NULL,
  `disc` varchar(25) NOT NULL,
  `disc_desk` varchar(500) NOT NULL,
  `terminal_id` varchar(25) NOT NULL,
  `paid_status` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_salesd`
--

CREATE TABLE `pos_salesd` (
  `transtemp` varchar(25) NOT NULL,
  `kditem` varchar(25) NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `grandprice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_salesh`
--

CREATE TABLE `pos_salesh` (
  `notrans` varchar(25) NOT NULL,
  `opnid` varchar(25) NOT NULL,
  `id_member` varchar(25) NOT NULL,
  `custqty` varchar(10) NOT NULL,
  `sales` varchar(25) NOT NULL,
  `tax` varchar(25) NOT NULL,
  `netsales` varchar(25) NOT NULL,
  `jumlah_bayar` varchar(25) NOT NULL,
  `opndate` varchar(25) NOT NULL,
  `opntime` varchar(25) NOT NULL,
  `opnuser` varchar(25) NOT NULL,
  `lastuser` varchar(25) NOT NULL,
  `lastdate` varchar(25) NOT NULL,
  `lasttime` varchar(25) NOT NULL,
  `kdoutlet` varchar(25) NOT NULL,
  `tahun` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_salestemp`
--

CREATE TABLE `pos_salestemp` (
  `notrans` varchar(25) NOT NULL,
  `member` varchar(250) NOT NULL,
  `custqty` varchar(10) NOT NULL,
  `gross_sales` varchar(25) NOT NULL,
  `disc` varchar(25) NOT NULL,
  `tax` varchar(250) NOT NULL,
  `service_charge` varchar(25) NOT NULL,
  `nett_sales` varchar(25) NOT NULL,
  `jumlah_bayar` varchar(25) NOT NULL,
  `date` varchar(25) NOT NULL,
  `time` varchar(25) NOT NULL,
  `close_date` varchar(25) NOT NULL,
  `close_time` varchar(25) NOT NULL,
  `close_user` varchar(25) NOT NULL,
  `meja` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `jumbill` varchar(25) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `bill_number` varchar(25) NOT NULL,
  `refund_date` varchar(25) NOT NULL,
  `refund_time` varchar(25) NOT NULL,
  `refund_user` varchar(25) NOT NULL,
  `refund_bill_num` varchar(25) NOT NULL,
  `terminal_id` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pos_subcategory`
--

CREATE TABLE `pos_subcategory` (
  `kdsubcategory` varchar(25) NOT NULL,
  `nmsubcategory` varchar(150) NOT NULL,
  `kdcategory` varchar(25) NOT NULL,
  `lastuser` varchar(20) NOT NULL,
  `last_modify` varchar(25) NOT NULL,
  `outlet_paremeter` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_subcategory`
--

INSERT INTO `pos_subcategory` (`kdsubcategory`, `nmsubcategory`, `kdcategory`, `lastuser`, `last_modify`, `outlet_paremeter`) VALUES
('192001', 'Ramen', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192002', 'Dry Ramen', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192003', 'Set Menu', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192004', 'Japanese Bowl', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192005', 'Curry Race', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192006', 'Yakimesi', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192007', 'Suki and BBQ', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192008', 'Paket Hemat', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192009', 'Sushi', '191001', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192010', 'MINUMAN', '191002', 'ANBYA', '2019-01-01 00:00:00', 'ALL'),
('192011', 'FREE ITEM', '191003', 'ANBYA', '2019-01-01 00:00:00', 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `pos_table`
--

CREATE TABLE `pos_table` (
  `id_table` varchar(25) NOT NULL,
  `nama_table` varchar(250) NOT NULL,
  `notrans` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_table`
--

INSERT INTO `pos_table` (`id_table`, `nama_table`, `notrans`) VALUES
('tbl0001', 'meja 1', ''),
('tbl0002', 'meja 2', ''),
('tbl0003', 'meja 3', ''),
('tbl0004', 'meja 4', ''),
('tbl0005', 'meja 5', ''),
('tbl0006', 'meja 6', ''),
('tbl0007', 'meja 7', ''),
('tbl0008', 'meja 8', ''),
('tbl0009', 'meja 9', ''),
('tbl0010', 'meja 10', ''),
('tbl0011', 'meja 11', ''),
('tbl0012', 'meja 12', ''),
('tbl0013', 'meja 13', ''),
('tbl0014', 'meja 14', ''),
('tbl0015', 'meja 15', ''),
('tbl0016', 'meja 16', ''),
('tbl0017', 'meja 17', ''),
('tbl0018', 'meja 18', ''),
('tbl0019', 'meja 19', ''),
('tbl0020', 'meja 20', ''),
('tbl0021', 'meja 21', ''),
('tbl0022', 'meja 22', ''),
('tbl0023', 'meja 23', ''),
('tbl0024', 'meja 24', ''),
('tbl0025', 'meja 25', ''),
('tbl0026', 'meja 26', ''),
('tbl0027', 'meja 27', ''),
('tbl0028', 'meja 28', ''),
('tbl0029', 'meja 29', ''),
('tbl0030', 'meja 30', ''),
('tbl0031', 'meja 31', ''),
('tbl0032', 'meja 32', ''),
('tbl0033', 'meja 33', ''),
('tbl0034', 'meja 34', ''),
('tbl0035', 'meja 35', ''),
('tbl0036', 'meja 36', ''),
('tbl0037', 'meja 37', ''),
('tbl0038', 'meja 38', ''),
('tbl0039', 'meja 39', ''),
('tbl0040', 'meja 40', ''),
('tbl0041', 'meja 41', ''),
('tbl0042', 'meja 42', ''),
('tbl0043', 'meja 43', ''),
('tbl0044', 'meja 44', ''),
('tbl0045', 'meja 45', ''),
('tbl0046', 'meja 46', ''),
('tbl0047', 'meja 47', ''),
('tbl0048', 'meja 48', ''),
('tbl0049', 'meja 49', ''),
('tbl0050', 'meja 50', '');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` varchar(25) NOT NULL,
  `nama_promo` varchar(50) NOT NULL,
  `isi_promo` varchar(500) NOT NULL,
  `promoparameter` varchar(25) NOT NULL,
  `status_promo` varchar(25) NOT NULL,
  `point` varchar(25) NOT NULL,
  `img_link` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promotion_d`
--

CREATE TABLE `promotion_d` (
  `id_promotion` varchar(25) NOT NULL,
  `kditem` varchar(25) NOT NULL,
  `last_modify` varchar(25) NOT NULL,
  `outlet_parameter` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion_d`
--

INSERT INTO `promotion_d` (`id_promotion`, `kditem`, `last_modify`, `outlet_parameter`) VALUES
('NPRM18000001', '300001', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_h`
--

CREATE TABLE `promotion_h` (
  `id_promotion` varchar(25) NOT NULL,
  `promotion_name` varchar(250) NOT NULL,
  `promotion_type` varchar(50) NOT NULL,
  `value_disc` varchar(25) NOT NULL,
  `value_amount` varchar(25) NOT NULL,
  `min_qty` varchar(25) NOT NULL,
  `max_qty` varchar(25) NOT NULL,
  `min_amount` varchar(25) NOT NULL,
  `max_amount` varchar(25) NOT NULL,
  `datefrom` varchar(25) NOT NULL,
  `dateto` varchar(25) NOT NULL,
  `timefrom` varchar(25) NOT NULL,
  `timeto` varchar(25) NOT NULL,
  `days` varchar(500) NOT NULL,
  `last_modify` varchar(25) NOT NULL,
  `outlet_parameter` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion_h`
--

INSERT INTO `promotion_h` (`id_promotion`, `promotion_name`, `promotion_type`, `value_disc`, `value_amount`, `min_qty`, `max_qty`, `min_amount`, `max_amount`, `datefrom`, `dateto`, `timefrom`, `timeto`, `days`, `last_modify`, `outlet_parameter`) VALUES
('NPRM18000001', 'minuman disc 70%', 'DISC ITEM', '70', '', 'none', 'none', 'none', 'none', '2019-01-01', '2019-12-30', '01:00', '23:59', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', '', ''),
('NPRM18000002', 'test disc 70%', 'DISC ALL', '70', '', 'none', 'none', 'none', 'none', '2019-01-01', '2019-12-30', '01:00', '23:59', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', '', ''),
('NPRM18000003', 'test disc 50%', 'DISC ALL', '50', '', 'none', 'none', 'none', 'none', '2019-01-01', '2019-12-30', '01:00', '23:59', 'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `qr`
--

CREATE TABLE `qr` (
  `code` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `redemption`
--

CREATE TABLE `redemption` (
  `id_redemption` varchar(25) NOT NULL,
  `id_voucher` varchar(25) NOT NULL,
  `redeemdate` varchar(25) NOT NULL,
  `outlet` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setupparameter`
--

CREATE TABLE `setupparameter` (
  `kodeai` varchar(50) NOT NULL,
  `ActivePeriode` varchar(6) DEFAULT NULL,
  `KdOutlet` varchar(10) NOT NULL,
  `Prefix` varchar(5) DEFAULT NULL,
  `CounterPOS` decimal(19,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setupparameter`
--

INSERT INTO `setupparameter` (`kodeai`, `ActivePeriode`, `KdOutlet`, `Prefix`, `CounterPOS`) VALUES
('1', '201804', 'M0004', 'ATR', '1.0000');

-- --------------------------------------------------------

--
-- Table structure for table `terminal_parameter`
--

CREATE TABLE `terminal_parameter` (
  `terminal_id` varchar(25) NOT NULL,
  `openterminal` varchar(25) NOT NULL,
  `closeterminal` varchar(25) NOT NULL,
  `openuser` varchar(25) NOT NULL,
  `closeuser` varchar(25) NOT NULL,
  `modal` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminal_parameter`
--

INSERT INTO `terminal_parameter` (`terminal_id`, `openterminal`, `closeterminal`, `openuser`, `closeuser`, `modal`) VALUES
('NHO0205191003', '2019-05-02 10:03:29', '2019-05-02 13:06:29', 'BPU000001', 'BPU000001', '0'),
('NHO0305190945', '2019-05-03 09:45:41', '2019-05-03 09:52:32', 'BPU000001', 'BPU000001', '0'),
('NHO0305191319', '2019-05-03 13:19:18', '2019-05-03 13:39:45', 'BPU000001', 'BPU000001', '0'),
('NHO0305191343', '2019-05-03 13:43:32', '2019-05-03 14:02:14', 'BPU000001', 'BPU000001', '300000'),
('NHO0305191405', '2019-05-03 14:05:09', '2019-05-03 14:16:35', 'BPU000001', 'BPU000001', '100000'),
('NHO0305191423', '2019-05-03 14:23:03', '2019-05-03 14:31:05', 'BPU000001', 'BPU000001', '100000'),
('NHO0305191431', '2019-05-03 14:31:55', '2019-05-03 14:51:09', 'BPU000001', 'BPU000001', '100000'),
('NHO0305191525', '2019-05-03 15:25:22', '2019-05-03 16:51:02', 'BPU000001', 'BPU000001', '0'),
('NHO0605190041', '2019-05-06 00:41:56', '2019-05-15 05:57:34', 'BPU000001', 'ISU000001', '0');

-- --------------------------------------------------------

--
-- Table structure for table `testquery`
--

CREATE TABLE `testquery` (
  `param1` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testquery`
--

INSERT INTO `testquery` (`param1`) VALUES
('1000'),
('-1000'),
('3000'),
('2500'),
('-500');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(10) NOT NULL,
  `nama_user` varchar(250) NOT NULL,
  `pass_user` varchar(50) NOT NULL,
  `previlage` varchar(25) NOT NULL,
  `outlet` varchar(25) NOT NULL,
  `last_modify` varchar(25) NOT NULL,
  `outlet_parameter` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `pass_user`, `previlage`, `outlet`, `last_modify`, `outlet_parameter`) VALUES
('ISU000001', 'test kasir', '11111', 'CASHIER', 'NHO2018000007', '2019-01-01 00:00:00', 'ALL'),
('ISU000002', 'test waiter', '22222', 'WAITER', 'NHO2018000007', '2019-01-01 00:00:00', 'ALL'),
('ISU000003', 'test spv', '33333', 'SUPERVISOR', 'NHO2018000007', '2019-01-01 00:00:00', 'ALL'),
('IPVU00002', 'AINI', '1901', 'SUPERVISOR', 'NHO2018000008', '2019-01-01 00:00:00', 'ALL'),
('IPVU00001', 'DENNY', '1234', 'SUPERVISOR', 'NHO2018000008', '2019-01-01 00:00:00', 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `vouchernahmpos`
--

CREATE TABLE `vouchernahmpos` (
  `vouchernumber` varchar(25) NOT NULL,
  `namavoucher` varchar(250) NOT NULL,
  `id_member` varchar(25) NOT NULL,
  `amount` varchar(25) NOT NULL,
  `expdate` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `createdate` varchar(25) NOT NULL,
  `useddate` varchar(25) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `pict` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vouchernahmredemption`
--

CREATE TABLE `vouchernahmredemption` (
  `vouchernumber` varchar(25) NOT NULL,
  `redemptiondate` varchar(25) NOT NULL,
  `id_outlet` varchar(25) NOT NULL,
  `id_user` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `localvoucher`
--
ALTER TABLE `localvoucher`
  ADD PRIMARY KEY (`vouchernumber`) USING BTREE;

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `pos_item`
--
ALTER TABLE `pos_item`
  ADD PRIMARY KEY (`kditem`);

--
-- Indexes for table `pos_kategoryitem`
--
ALTER TABLE `pos_kategoryitem`
  ADD PRIMARY KEY (`kdcategory`);

--
-- Indexes for table `pos_other_payment_prm`
--
ALTER TABLE `pos_other_payment_prm`
  ADD PRIMARY KEY (`id_other_payment`);

--
-- Indexes for table `pos_parameter`
--
ALTER TABLE `pos_parameter`
  ADD PRIMARY KEY (`id_parameter`);

--
-- Indexes for table `pos_salestemp`
--
ALTER TABLE `pos_salestemp`
  ADD PRIMARY KEY (`notrans`);

--
-- Indexes for table `pos_subcategory`
--
ALTER TABLE `pos_subcategory`
  ADD PRIMARY KEY (`kdsubcategory`);

--
-- Indexes for table `pos_table`
--
ALTER TABLE `pos_table`
  ADD PRIMARY KEY (`id_table`);

--
-- Indexes for table `promotion_h`
--
ALTER TABLE `promotion_h`
  ADD PRIMARY KEY (`id_promotion`);

--
-- Indexes for table `qr`
--
ALTER TABLE `qr`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `setupparameter`
--
ALTER TABLE `setupparameter`
  ADD PRIMARY KEY (`kodeai`);

--
-- Indexes for table `terminal_parameter`
--
ALTER TABLE `terminal_parameter`
  ADD PRIMARY KEY (`terminal_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `vouchernahmpos`
--
ALTER TABLE `vouchernahmpos`
  ADD PRIMARY KEY (`vouchernumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
