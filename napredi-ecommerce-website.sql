-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 10:17 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `napredi-ecommerce-website`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `idKorisnik` int(11) NOT NULL,
  `uidKorisnik` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `emailKorisnik` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `pwdKorisnik` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnik`, `uidKorisnik`, `emailKorisnik`, `pwdKorisnik`) VALUES
(51, 'marko', 'marko@gmail.com', '$2y$10$6ejagyZdLYedSs8rSsn3KOX9f4sAbNFS3jLWo9nYLVAXAXfwrM0am'),
(62, 'Nikola', 'nikola@gmai.com', '$2y$10$Efc6Qr9zz2eVYK1uten/UeU9/to0RDJiVUHkal292lVS73qZhaBt2'),
(63, 'test', 'test@gmail.com', '$2y$10$P6QdF7yCfTmY5peTaZ.weOmTQ9xKLF/.QvqB3Me/JHyzoI2Zun3kW'),
(64, 'Vladimir', 'vladimir@gmail.com', '$2y$10$VyIqLeJnebdNVSFT/HIIy.b.hPzgfY9U7ZLN1gJV/p8hl/VxUU9gm');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbine`
--

CREATE TABLE `narudzbine` (
  `idPorudzbine` int(11) NOT NULL,
  `imeKorisnika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `emailKorisnika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `brojTelefona` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresaKorisnika` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gradKorisnika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postanskiBroj` int(11) NOT NULL,
  `metodaPlacanja` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `proizvodiPorudzbina` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cenaNarudzbine` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `sifraP` int(11) NOT NULL,
  `nazivP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slikaP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cenaP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opisP` varchar(8000) COLLATE utf8_unicode_ci NOT NULL,
  `kategorijaP` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `stanjeP` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`sifraP`, `nazivP`, `slikaP`, `cenaP`, `opisP`, `kategorijaP`, `stanjeP`) VALUES
(32, 'MSI Grafička karta AERO ITX 3G OC GTX 1060', './images/products/137069.jpg', '32999', 'Tip memorije: GDDR5<br>Količina memorije: 3072 MB<br>Interfejs: PCIe 3.0 x16 <br>Magistrala memorije: 192-bit <br>2x HDMI 2.0', 'Graficka', 2),
(57, 'AMD Procesor AMD RYZEN 5 2600', './images/products/132389.jpg', '27999', 'Podnožje: AMD® AM4 <br>Radna frekvencija: 3.4 GHz<br> L2 keš memorija: 3 MB <br>Broj jezgara: 6 <br>Threads: 12', 'Procesor', 1),
(58, 'INTEL Procesor CPU I7-8700', './images/products/132401.jpg', '50990', 'Podnožje: Intel® 1151 (8. gen.) <br>Tip procesora: Intel® Core™ i7 <br>Tehnologija izrade: 14 nm <br>Broj jezgara: 6 <br>Threads: 12', 'Procesor', 0),
(59, 'INTEL CORE I7 7700', './images/products/125957.jpg', '44390', 'Intel Socket 1151 <br>Broj jezgara 4<br> Radna frekvencija 3.6GHz<br> Turbo frekvencija 4.2GHz', 'Procesor', 1),
(60, 'MSI Grafička karta GTX 1080 TI X 11G', './images/products/133391.jpg', '124990', 'Tip memorije: GDDR5X <br>Količina memorije: 11 GB <br>Interfejs: PCI Express x16 3.0<br> Magistrala memorije: 352bit <br>GPU: Nvidia GeForce GTX 1080 Ti', 'Graficka', 8),
(61, 'ASUS Grafička karta NVD PH GTX 1050 2GB', './images/products/125790.jpg', '22990', 'Tip memorije: GDDR5<br> Količina memorije: 2GB <br>Magistrala memorije: 128bit<br> Brzina memorije: 7008 MHz <br>GPU Nvidia GeForce GTX 1050 <br>Brzina GPU GPU Boost Clock: 1455 MHz', 'Graficka', 3),
(62, 'AERO ITX 2G OCV1 GTX 1050', './images/products/137068.jpg', '18990', 'Tip memorije: GDDR5<br> Količina memorije: 2048 MB <br>Maksimalna rezolucija: 7680 x 4320 <br>HDMI <br>Magistrala memorije: 128-bit', 'Graficka', 10),
(63, 'DELL LED SE2219H 21.5\", IPS, 1920 x 1080 Full HD, 5ms', './images/products/142247_5ec2472b2a00e.png', '13990', 'Tip: IPS<br>Model: DELL SE2219H<br>Zakrivljeni ekran: Ne<br>Dijagonala ekrana: 21,5\"<br>Brzina osvežavanja: 60Hz<br>Osvetljenje: 250 cd/m2', 'Monitor', 4),
(64, 'SSD M.2 128GB Patriot Scorch NVMe 1700/415MB/s, PS128GPM280SSDR', './images/products/8613859.jpg', '3990', 'Brzina čitanja/pisanja: Čitanje : 1700MB/s, Upis : 415MB/s<br>Kontroler: Phison PS5008-E8<br>Model: PS128GPM280SSDR<br>Kapacitet: 128GB', 'SSD', 11),
(65, 'Memorija DIMM DDR4 16GB 2666MHz Kingston HyperX Predator CL13, HX426C13PB3/16', './images/products/152770_5ece4b977f485.jpg', '10990', ' EAN kod: 740617265910 <br>Tip: DDR4 <br>Model: HX426C13PB3/16<br>Kapacitet: 16GB <br>Brzina rada: 2666MHz <br>Latencija: L13', 'RAM', 8),
(66, 'AMD AM4 Ryzen 3 3100, 3.6GHz (3.9GHz) Box', './images/products/152606_5ecd1d9c595ce.jpg', '6990', 'Garancija proizvođača: 36meseci<br>Model: AMD Ryzen 3 3100<br>Radni takt procesora: 3.6GHz (3.9GHz turbo)<br>Broj jezgara: Cores : 4 / Threads : 8<br>Keš: 16MB L3, 2MB L2', 'Procesor', 21),
(67, 'KUĆIŠTE MS IRON', './images/products/kucisteMSIRON.png', '5000', 'Opis<br> MS INDUSTRIAL kućište MS IRON <br>Tip Midi Tower <br>Kompatibilnost Micro-ATX, ATX <br>Napajanje -NEMA <br>Hlađenje Pozadi: 1x 120 mm ARGB ring ventilator (ugrađen ARGB ventilator)<br> Napred: 2x 120 mm', 'Kućište', 5),
(68, 'REDRAGON Gejmerska tastatura KUMARA K552 (Crna)', './images/products/image57838d9c690ce.png', '6899', 'Boja: Crna <br>Tip: Gejmerska <br>Vrsta:  Mehanička Prilagođeni mehanički prekidači (Cherry Green ekvivalent) dizajnirani za dugovečnost, odziv i pouzdanost. <br>LED pozadinsko osvetljenje <br>ABS i aluminijumska konstrukcija ', 'Tastatura', 4),
(69, 'HP gejmerski miš OMEN 400 - 3ML38AA', './images/products/image5bf54f4b23bb3.png', '3500', 'EAN:192018880054 <br>Senzor:Optički <br>Rezolucija:5000dpi <br>Dizajn:Ergonomski dizajniran <br>Boja miša:Crna', 'Miš', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`idKorisnik`);

--
-- Indexes for table `narudzbine`
--
ALTER TABLE `narudzbine`
  ADD PRIMARY KEY (`idPorudzbine`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`sifraP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `idKorisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `narudzbine`
--
ALTER TABLE `narudzbine`
  MODIFY `idPorudzbine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `sifraP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
