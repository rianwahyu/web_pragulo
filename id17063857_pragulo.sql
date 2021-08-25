-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Agu 2021 pada 11.09
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id17063857_pragulo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(2, 'Meja'),
(3, 'Kursi'),
(5, 'Allmari'),
(6, 'Pintu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `installment`
--

CREATE TABLE `installment` (
  `id` int(11) NOT NULL,
  `orderID` varchar(15) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `status` enum('unpaid','paid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `installment`
--

INSERT INTO `installment` (`id`, `orderID`, `amount`, `dueDate`, `status`) VALUES
(2, 'ORD0000002', 166666.67, '2021-09-03', 'paid'),
(3, 'ORD0000002', 166666.67, '2021-10-03', 'unpaid'),
(4, 'ORD0000002', 166666.67, '2021-11-03', 'unpaid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemDescription` text NOT NULL,
  `price` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`itemID`, `itemName`, `itemDescription`, `price`, `categoryID`) VALUES
(1, 'Meja Lipat', 'Ini adalah meja lipat', 250000, 2),
(3, 'Kursi Panjang', 'Ini adalah kursi klasik dan panjang', 350000, 3),
(4, 'Lemari Keren', 'Ini adalah lemari keren', 500000, 5),
(5, 'testing', 'testing', 1234567, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `orderID` varchar(15) NOT NULL,
  `type` enum('Cash','Cicilan') DEFAULT NULL,
  `installment` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerAddress` varchar(100) NOT NULL,
  `customerPhone` varchar(15) NOT NULL,
  `dateOrder` date NOT NULL,
  `dateFinish` date NOT NULL,
  `statusPembayaran` enum('unpaid','paid') NOT NULL,
  `batalOrder` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`orderID`, `type`, `installment`, `status`, `customerName`, `customerAddress`, `customerPhone`, `dateOrder`, `dateFinish`, `statusPembayaran`, `batalOrder`) VALUES
('ORD0000001', 'Cash', 0, 'Proses', 'Rian Wahyu', 'Malang', '08123460399', '2021-07-18', '2021-07-21', 'paid', 0),
('ORD0000002', 'Cicilan', 3, 'Proses', 'Yusliana Gadis', 'Malang', '081231581628', '2021-08-03', '2021-08-10', 'unpaid', 0),
('ORD0000003', 'Cash', 0, 'Proses', 'Rian', 'Mlg', '08123460399', '2021-08-06', '2021-08-13', 'paid', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `orderID` varchar(15) DEFAULT NULL,
  `itemID` int(11) DEFAULT NULL,
  `quantity` decimal(5,2) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `itemtype` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_item`
--

INSERT INTO `order_item` (`id`, `orderID`, `itemID`, `quantity`, `price`, `itemtype`, `keterangan`, `prod`) VALUES
(11, 'ORD0000001', 3, 1.00, 350000.00, 'onStock', 'Ok Jual', 0),
(12, 'ORD0000001', 1, 2.00, 250000.00, 'onStock', 'Ok Jual', 0),
(13, 'ORD0000002', 4, 1.00, 500000.00, 'onStock', 'Warna Putih', 0),
(14, 'ORD0000003', 4, 1.00, 500000.00, 'onOrder', 'OK Pesan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `orderID` varchar(15) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id`, `orderID`, `amount`, `status`) VALUES
(1, 'ORD0000001', 850000.00, 'success'),
(2, 'ORD0000002', 166667.00, 'success');

-- --------------------------------------------------------

--
-- Struktur dari tabel `production`
--

CREATE TABLE `production` (
  `productionID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `orderID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `itemID` int(11) NOT NULL,
  `dateIn` date NOT NULL,
  `dateFinish` date DEFAULT NULL,
  `type` enum('local','jati') COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `production`
--

INSERT INTO `production` (`productionID`, `orderID`, `itemID`, `dateIn`, `dateFinish`, `type`, `status`) VALUES
('2108001', 'ORD0000003', 4, '2021-08-06', '2021-08-08', 'local', 'finishing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_order`
--

CREATE TABLE `temp_order` (
  `id` int(11) NOT NULL,
  `itemID` int(11) DEFAULT NULL,
  `quantity` decimal(5,2) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `itemtype` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `temp_order`
--

INSERT INTO `temp_order` (`id`, `itemID`, `quantity`, `price`, `itemtype`, `keterangan`) VALUES
(2, 1, 1.00, 250000.00, 'Pilih Jenis Barang', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `timeline`
--

CREATE TABLE `timeline` (
  `timelineID` int(11) NOT NULL,
  `productionID` varchar(20) DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `username` varchar(10) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `timeline`
--

INSERT INTO `timeline` (`timelineID`, `productionID`, `note`, `username`, `date`) VALUES
(4, '2108001', 'Barang telah di konfirmasi', 'admin', '2021-08-06 14:06:40'),
(6, '2108001', 'Sedang dirakit', 'tukang1', '2021-08-08 12:12:57'),
(7, '2108001', 'Sedang dilakukan proses pengamplasan', 'tukang1', '2021-08-08 12:15:35'),
(8, '2108001', 'Sedang dilakukan proses penyemprotan', 'tukang1', '2021-08-08 12:22:02'),
(10, '2108001', 'Proses Produksi Selesai', 'tukang1', '2021-08-08 13:13:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `role` enum('Admin','Manajer','Karyawan','') NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userID`, `fullname`, `username`, `password`, `role`, `dateCreated`) VALUES
(1, 'Rian Wahyu', 'rianwahyu', 'b7c16b1afb8f46023bcc249b597090b0', 'Admin', '2021-06-28 22:01:13'),
(2, 'Admin Test Pragulo', 'admin', '0192023a7bbd73250516f069df18b500', 'Admin', '2021-08-03 20:33:30'),
(3, 'Tes Tukang 1', 'tukang1', '268fc362d34a398b38475a45a0b253f6', 'Karyawan', '2021-08-08 04:27:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indeks untuk tabel `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemID`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indeks untuk tabel `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderID` (`orderID`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`productionID`);

--
-- Indeks untuk tabel `temp_order`
--
ALTER TABLE `temp_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`timelineID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `temp_order`
--
ALTER TABLE `temp_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `timeline`
--
ALTER TABLE `timeline`
  MODIFY `timelineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
