-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 Ara 2021, 17:45:58
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `spechy`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `tax_no` varchar(255) DEFAULT NULL,
  `tax_circle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `phone`, `tax_no`, `tax_circle`) VALUES
(1, 'Ulric Branch', 'ut@hotmail.ca', '(481) 704-5431', '347E9C2F-5CA3-22F1-D129-9685989DE97F', 'Sed Molestie Consulting'),
(2, 'Christian Lancaster', 'vivamus.sit.amet@icloud.ca', '1-764-262-3606', '13239E7F-544E-E1BB-2809-49E7511A5369', 'Et Lacinia Vitae Corporation'),
(3, 'Jaden Snider', 'class.aptent@protonmail.com', '1-882-841-2240', '62376946-E874-B5FC-26A1-BB2F519D14A3', 'Feugiat Placerat Company'),
(4, 'Darryl Gross', 'egestas.aliquam@yahoo.com', '1-666-762-0866', '23F5BE98-6917-7388-7335-EFAE3229A816', 'Sed Consulting'),
(6, 'spechy', 'spech@gmail.com', '12345678912', '12345689584568', 'istanbul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`id`, `name`, `lastname`, `email`, `password`, `phone`) VALUES
(1, 'Namık', 'Ekin', 'namık.ekin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '5443689555'),
(2, 'Byron', 'Indira', 'lobortis.augue@protonmail.net', 'e10adv3949ba59abbe56e057f20f883e', '(258) 863-7611'),
(4, 'Uriah', 'Claudia', 'quam.dignissim@hotmail.net', 'e10ads3949ba59abbe56e057f20f883e', '1-622-378-8434'),
(7, 'birisi', 'example', 'birisi@example.com', '25f9e794323b453885f5181f1b624d0b', '12345678911'),
(8, 'hayati', 'inanç', 'hayat@gmail.com', 'b3957233dd5294cbf47d95fb3f584239', '12345678912');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer_package`
--

CREATE TABLE `customer_package` (
  `id` int(10) NOT NULL,
  `package_id` int(10) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `agreement` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `customer_package`
--

INSERT INTO `customer_package` (`id`, `package_id`, `customer_id`, `agreement`) VALUES
(1, 2, 1, 12),
(2, 8, 1, 12);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer_payment`
--

CREATE TABLE `customer_payment` (
  `id` int(10) NOT NULL,
  `customer_package_id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `paided` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `customer_payment`
--

INSERT INTO `customer_payment` (`id`, `customer_package_id`, `name`, `price`, `paided`) VALUES
(1, 1, 'Namık:normal 1. payment', 34.99, 0),
(2, 1, 'Namık:normal 2. payment', 34.99, 0),
(3, 1, 'Namık:normal 3. payment', 34.99, 0),
(4, 1, 'Namık:normal 4. payment', 34.99, 0),
(5, 1, 'Namık:normal 5. payment', 34.99, 0),
(6, 1, 'Namık:normal 6. payment', 34.99, 0),
(7, 1, 'Namık:normal 7. payment', 34.99, 0),
(8, 1, 'Namık:normal 8. payment', 34.99, 0),
(9, 1, 'Namık:normal 9. payment', 34.99, 0),
(10, 1, 'Namık:normal 10. payment', 34.99, 0),
(11, 1, 'Namık:normal 11. payment', 34.99, 0),
(12, 1, 'Namık:normal 12. payment', 34.99, 0),
(13, 2, 'Namık:daha güzel 1. payment', 68.99, 0),
(14, 2, 'Namık:daha güzel 2. payment', 68.99, 0),
(15, 2, 'Namık:daha güzel 3. payment', 68.99, 0),
(16, 2, 'Namık:daha güzel 4. payment', 68.99, 0),
(17, 2, 'Namık:daha güzel 5. payment', 68.99, 0),
(18, 2, 'Namık:daha güzel 6. payment', 68.99, 0),
(19, 2, 'Namık:daha güzel 7. payment', 68.99, 0),
(20, 2, 'Namık:daha güzel 8. payment', 68.99, 0),
(21, 2, 'Namık:daha güzel 9. payment', 68.99, 0),
(22, 2, 'Namık:daha güzel 10. payment', 68.99, 0),
(23, 2, 'Namık:daha güzel 11. payment', 68.99, 0),
(24, 2, 'Namık:daha güzel 12. payment', 68.99, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `package`
--

CREATE TABLE `package` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `package`
--

INSERT INTO `package` (`id`, `name`, `price`, `company_id`) VALUES
(1, 'lite', 26.99, 2),
(2, 'normal', 34.99, 3),
(3, 'pro', 89.99, 3),
(5, 'güzel paket', 22.99, 1),
(6, 'iadere eder', 3.56, 2),
(7, 'hızlı sonuç', 45.99, 3),
(8, 'daha güzel', 68.99, 4),
(9, 'awsome', 65.99, 6);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `customer_package`
--
ALTER TABLE `customer_package`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `customer_package`
--
ALTER TABLE `customer_package`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `customer_payment`
--
ALTER TABLE `customer_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `package`
--
ALTER TABLE `package`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
