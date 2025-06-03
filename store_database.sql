-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 03, 2025 at 10:47 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_database`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `buildings`
--

CREATE TABLE `buildings` (
  `building_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `scale` varchar(10) NOT NULL,
  `producent` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`building_id`, `name`, `description`, `scale`, `producent`, `quantity`, `price`) VALUES
(1, 'Wieża Eiffla z iluminacją', 'Model z 12 000 elementów, w tym 634 fototrawionych przęseł.', '1:250', 'LEGO Architecture', 5, 1299.00),
(2, 'Dworek szlachecki z ogrodem', 'Polski dworek z XIX wieku z ruchomymi okiennicami.', '1:72', 'ModelWorks', 8, 459.00),
(3, 'Burj Khalifa z systemem LED', 'Najwyższy budynek świata z 163 piętrami.', '1:500', 'Trumpeter', 3, 899.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `civ_vehicles`
--

CREATE TABLE `civ_vehicles` (
  `civ_vehicle_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `type` enum('cars','motorcycles','buses','trucks','aircrafts','trains','ships') NOT NULL,
  `brand` varchar(50) NOT NULL,
  `scale` varchar(10) NOT NULL,
  `producent` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `civ_vehicles`
--

INSERT INTO `civ_vehicles` (`civ_vehicle_id`, `name`, `description`, `type`, `brand`, `scale`, `producent`, `quantity`, `price`) VALUES
(1, 'Syrena 104', 'Prototyp polskiego coupe z 1964 roku.', 'cars', 'FSO', '1:24', 'ModelWorks', 3, 349.00),
(2, 'VW Beetle 1967', 'Kultowy \"Garbus\" w wersji kabriolet.', 'cars', 'Volkswagen', '1:24', 'Revell', 12, 189.00),
(3, 'Tesla Cybertruck', 'Elektryczny pickup z panelami ze stali nierdzewnej.', 'cars', 'Tesla', '1:18', 'Model-Tech', 8, 499.00),
(4, 'Ferrari F40 LM', 'Wyścigowa wersja z aerokitem.', 'cars', 'Ferrari', '1:24', 'Italeri', 6, 299.00),
(5, 'BMW R75', 'Klasyczny motocykl z koszem bocznym.', 'motorcycles', 'BMW', '1:12', 'Tamiya', 9, 279.00),
(6, 'Indian Chief', 'Amerykański cruiser z sakwami.', 'motorcycles', 'Indian', '1:12', 'Revell', 7, 329.00),
(7, 'Kawasaki Ninja H2R', 'Supercharged sportbike z diodami LED.', 'motorcycles', 'Kawasaki', '1:12', 'Hasegawa', 5, 449.00),
(8, 'Junak M10', 'Polski motocykl z 1960 roku.', 'motorcycles', 'Junak', '1:16', 'IBG Models', 4, 199.00),
(9, 'Autosan H9-35 \"Sanok\"', 'Ikona polskich dróg z lat 80-tych.', 'buses', 'Autosan', '1:43', 'ModelWorks', 6, 159.00),
(10, 'Neoplan N138 Spaceliner', 'Luksusowy autokar piętrowy z figurkami pasażerów.', 'buses', 'Neoplan', '1:87', 'Herpa', 8, 229.00),
(11, 'London Routemaster', 'Czerwony autobus piętrowy z ruchomą platformą.', 'buses', 'AEC', '1:76', 'Oxford Diecast', 10, 129.00),
(12, 'Mercedes-Benz O405G', 'Przegubowy autobus miejski z systemem informacji pasażerskiej.', 'buses', 'Mercedes', '1:87', 'Faller', 12, 199.00),
(13, 'Star 266 z naczepą', 'Polska ciężarówka wojskowa w wersji cywilnej.', 'trucks', 'Star', '1:35', 'IBG Models', 5, 289.00),
(14, 'Volvo FH16 750 Globetrotter', 'Ciężarówka z silnikiem 750KM.', 'trucks', 'Volvo', '1:24', 'Italeri', 7, 399.00),
(15, 'Scania R500 V8', 'Ciężarówka z ruchomą kabiną.', 'trucks', 'Scania', '1:24', 'Revell', 4, 349.00),
(16, 'MAN TGX XXL', 'Kabina typu XXL z minikuchnią.', 'trucks', 'MAN', '1:50', 'Herpa', 9, 179.00),
(17, 'Boeing 737-800 LOT', 'Samolot w barwach \"Eurolotu\".', 'aircrafts', 'Boeing', '1:144', 'Revell', 8, 299.00),
(18, 'Airbus A380 Emirates', 'Dwupokładowy gigant z diodami LED.', 'aircrafts', 'Airbus', '1:200', 'Hogan', 5, 599.00),
(19, 'Cessna 172 Skyhawk', 'Szkolny samolot z ruchomymi lotkami.', 'aircrafts', 'Cessna', '1:48', 'Tamiya', 12, 159.00),
(20, 'Concorde British Airways', 'Samolot naddźwiękowy z ruchomym dziobem.', 'aircrafts', 'BAC/Aérospatiale', '1:72', 'Airfix', 3, 449.00),
(21, 'PKP EU07-001', 'Legenda polskich szlaków w malowaniu zielono-czerwonym.', 'trains', 'Pafawag', '1:87', 'Piko', 6, 399.00),
(22, 'Shinkansen E5 Hayabusa', 'Japoński pociąg z aktywnym przechyłem.', 'trains', 'Hitachi', '1:150', 'Kato', 4, 899.00),
(23, 'Orient Express 1920', 'Luksusowy skład z fototrawionymi żyrandolami.', 'trains', 'CIWL', '1:160', 'Märklin', 2, 1299.00),
(24, 'TGV Duplex Atlantique', 'Dwupiętrowy pociąg z systemem tiltingu.', 'trains', 'Alstom', '1:160', 'Hornby', 5, 799.00),
(25, 'RMS Titanic', 'Słynny transatlantyk z dioramą.', 'ships', 'Harland & Wolff', '1:400', 'Academy', 3, 999.00),
(26, 'MS Queen Mary 2', 'Największy transatlantyk świata z 15 pokładami.', 'ships', 'Cunard Line', '1:450', 'Revell', 4, 799.00),
(27, 'Ever Given', 'Słynny kontenerowiec zablokowany w Kanale Sueskim.', 'ships', 'Evergreen', '1:700', 'Aoshima', 2, 649.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `category` enum('tools','glues','paints') NOT NULL,
  `type` enum('blades','tweezers','brushes','pliers','for_plastic','epoxy','cyanoacrylate','foundations','acrylic','sets') NOT NULL,
  `producent` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `name`, `description`, `category`, `type`, `producent`, `quantity`, `price`) VALUES
(1, 'Nożyk modelarski Pro', 'Zestaw 10 ostrzy do cięcia plastiku.', 'tools', 'blades', 'Xuron', 25, 49.99),
(2, 'Pęseta precyzyjna', 'Stalowe szczypczyki do montażu mikroczęści.', 'tools', 'tweezers', 'Tamiya', 18, 89.00),
(3, 'Pędzel modelarski', 'Włosie sobolowe do nanoszenia farb.', 'tools', 'brushes', 'Rosemary & Co.', 12, 129.00),
(4, 'Cążki precyzyjne', 'Profesjonalne cążki do dokładnego cięcia.', 'tools', 'pliers', 'God Hand', 7, 199.00),
(5, 'Klej modelarski', 'Płynny cement w butelce z igłą.', 'glues', 'for_plastic', 'Tamiya', 30, 24.90),
(6, 'Klej epoksydowy', 'Dwuskładnikowa żywica do łączenia materiałów.', 'glues', 'epoxy', 'Loctite', 15, 39.00),
(7, 'Super Glue Pro', 'Cyjanoakrylat z przyspieszaczem.', 'glues', 'cyanoacrylate', 'Zap-a-Gap', 20, 59.00),
(8, 'Klej do drewna', 'Specjalistyczny klej do elementów drewnianych.', 'glues', 'for_plastic', 'Green Stuff World', 10, 34.50),
(9, 'Podkład czarny', 'Czarny podkład z cynkiem.', 'paints', 'foundations', 'Mr. Hobby', 22, 44.00),
(10, 'Zestaw farb metalicznych', 'Zestaw 6 odcieni metalu.', 'paints', 'acrylic', 'Vallejo', 14, 89.00),
(11, 'Zestaw do patynowania', '4 farby olejne + medium do spękań.', 'paints', 'sets', 'AK Interactive', 8, 119.00),
(12, 'Farba Winter Camo', 'Farba matowa do zimowego kamuflażu.', 'paints', 'acrylic', 'Humbrol', 17, 69.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `military`
--

CREATE TABLE `military` (
  `military_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `type` enum('tanks','vehicles','aircrafts','ships') NOT NULL,
  `nation` varchar(50) NOT NULL,
  `scale` varchar(10) NOT NULL,
  `producent` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `military`
--

INSERT INTO `military` (`military_id`, `name`, `description`, `type`, `nation`, `scale`, `producent`, `quantity`, `price`) VALUES
(1, 'Czołg M4A3E8 Sherman', 'Amerykański czołg średni z II wojny światowej.', 'tanks', 'USA', '1:35', 'Dragon', 7, 319.99),
(2, 'Czołg IS-2 Model 1944', 'Radziecki czołg ciężki z 122mm armatą.', 'tanks', 'ZSRR', '1:35', 'Zvezda', 5, 289.00),
(3, 'Leopard 2A5', 'Niemiecki czołg podstawowy z dodatkowym pancerzem.', 'tanks', 'Niemcy', '1:35', 'Revell', 10, 399.00),
(4, 'Japoński Type 10', 'Czołg IV generacji z aktywnym systemem ochrony.', 'tanks', 'Japonia', '1:35', 'Hasegawa', 3, 459.99),
(5, 'Opel Blitz z wyrzutnią Nebelwerfer', 'Niemiecka ciężarówka z wyrzutnią rakietową.', 'vehicles', 'Niemcy', '1:35', 'Tamiya', 8, 229.50),
(6, 'M3 Half-track', 'Pojazd amerykański z podwójnym działkiem.', 'vehicles', 'USA', '1:35', 'AFV Club', 6, 279.00),
(7, 'BRDM-2', 'Radziecki pojazd rozpoznawczy z rakietami.', 'vehicles', 'ZSRR', '1:35', 'MiniArt', 4, 349.99),
(8, 'Land Rover Wolf WMIK', 'Brytyjski pojazd patrolowy z karabinem maszynowym.', 'vehicles', 'Wielka Brytania', '1:35', 'ICM', 9, 199.00),
(9, 'PZL TS-11 Iskra bis DF', 'Polski samolot szkolno-bojowy.', 'aircrafts', 'Polska', '1:32', 'ModelWorks', 5, 419.00),
(10, 'F-16C Block 52+', 'Wersja polskich F-16 z zasobnikiem.', 'aircrafts', 'Polska', '1:48', 'Kinetic', 7, 379.99),
(11, 'Boeing B-17G', 'Amerykański bombowiec z II wojny światowej.', 'aircrafts', 'USA', '1:48', 'HKM', 3, 899.00),
(12, 'Su-57 Felon', 'Rosyjski myśliwiec 5. generacji.', 'aircrafts', 'Rosja', '1:72', 'Zvezda', 6, 259.00),
(13, 'USS Missouri BB-63', 'Amerykański pancernik z okresu II wojny.', 'ships', 'USA', '1:200', 'Trumpeter', 2, 1499.00),
(14, 'ORP Grom', 'Polski niszczyciel w konfiguracji przedwojennej.', 'ships', 'Polska', '1:400', 'Arma Hobby', 4, 599.00),
(15, 'IJN Akagi', 'Japoński lotniskowiec z ruchomymi windami.', 'ships', 'Japonia', '1:700', 'Fujimi', 5, 799.00),
(16, 'HMS Dreadnought', 'Brytyjski okręt pancerny z 560 częściami.', 'ships', 'Wielka Brytania', '1:350', 'Revell', 3, 699.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(65) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `e_mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `name`, `surname`, `e_mail`) VALUES
(1, 'a', '$2y$10$8RJX0UlKPKPFyNPYZtxXeu1WTrGqmvVDjEkMl04yYIoUrPgDvGNYO', 'a', 'a', 'a@a.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`building_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
