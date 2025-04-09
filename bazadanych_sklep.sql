-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Kwi 2025, 14:20
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `baza_testy_sklep`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `buildings`
--

INSERT INTO `buildings` (`building_id`, `name`, `description`, `scale`, `producent`, `quantity`, `price`) VALUES
(1, 'Wieża Eiffla z iluminacją', 'Model z 12 000 elementów, w tym 634 fototrawionych przęseł. Zawiera diody LED imitujące nocną iluminację.', '1:250', 'LEGO Architecture', 5, '1299.00'),
(2, 'Dworek szlachecki z ogrodem', 'Polski dworek z XIX wieku z ruchomymi okiennicami i dachem krytym gontem. W zestawie diorama ogrodu.', '1:72', 'ModelWorks', 8, '459.00'),
(3, 'Burj Khalifa z systemem LED', 'Najwyższy budynek świata z 163 piętrami. Model zawiera aluminiową konstrukcję szkieletową i podświetlany taras.', '1:500', 'Trumpeter', 3, '899.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `civ_vehices`
--

CREATE TABLE `civ_vehices` (
  `civ_vehice_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `type` enum('cars','motorcycles','buses','trucks','aircrafts','trains','ships') NOT NULL,
  `brand` varchar(50) NOT NULL,
  `scale` varchar(10) NOT NULL,
  `producent` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `civ_vehices`
--

INSERT INTO `civ_vehices` (`civ_vehice_id`, `name`, `description`, `type`, `brand`, `scale`, `producent`, `quantity`, `price`) VALUES
(1, 'Syrena 104', 'Prototyp polskiego sportowego coupe z 1964 roku. Model zawiera chromowane zderzaki, skórzaną tapicerkę i fototrawione logo FSO.', 'cars', 'FSO', '1:24', 'ModelWorks', 3, '349.00'),
(2, 'VW Beetle 1967', 'Kultowy \"Garbus\" w wersji kabriolet. Detale: składany dach z tkaniny, ruchome koła kierownicy i silnik w przekroju.', 'cars', 'Volkswagen', '1:24', 'Revell', 12, '189.00'),
(3, 'Tesla Cybertruck', 'Elektryczny pickup z fototrawionymi panelami ze stali nierdzewnej. Model zawiera otwierany bagażnik z ładowarką solarną.', 'cars', 'Tesla', '1:18', 'Model-Tech', 8, '499.00'),
(4, 'Ferrari F40 LM', 'Wyścigowa wersja z pełnym aerokitem. Detale: węglowe spojlery, fototrawione kratki wentylacyjne i silnik V8 w przekroju.', 'cars', 'Ferrari', '1:24', 'Italeri', 6, '299.00'),
(5, 'BMW R75', 'Klasyczny motocykl z aluminiowym koszem bocznym. Model zawiera ruchome zawieszenie Telelever i fototrawione logo BMW.', 'motorcycles', 'BMW', '1:12', 'Tamiya', 9, '279.00'),
(6, 'Indian Chief', 'Amerykański cruiser z skórzanymi sakwami i chromowanymi tłumikami. W zestawie figurka kierowcy w skórzanej kurtce.', 'motorcycles', 'Indian', '1:12', 'Revell', 7, '329.00'),
(7, 'Kawasaki Ninja H2R', 'Supercharged sportbike z fototrawionym ramieniem wahacza i diodami LED w reflektorach.', 'motorcycles', 'Kawasaki', '1:12', 'Hasegawa', 5, '449.00'),
(8, 'Junak M10', 'Polski motocykl z 1960 roku w wersji milicyjnej. Detale: syrena policyjna z fototrawionym gongiem.', 'motorcycles', 'Junak', '1:16', 'IBG Models', 4, '199.00'),
(9, 'Autosan H9-35 \"Sanok\"', 'Ikona polskich dróg z lat 80-tych. Model zawiera otwierane drzwi, fototrawione tablice rejestracyjne i wnętrze z 32 fotelami w deseniu \"żółte kwiatki\".', 'buses', 'Autosan', '1:43', 'ModelWorks', 6, '159.00'),
(10, 'Neoplan N138 Spaceliner', 'Luksusowy autokar piętrowy z fototrawionymi szybami panoramicznymi. W zestawie figurki pasażerów z bagażami i kierowcy w mundurze firmy Lux Express.', 'buses', 'Neoplan', '1:87', 'Herpa', 8, '229.00'),
(11, 'London Routemaster', 'Czerwony autobus piętrowy z ruchomą platformą wejściową. Detale: mosiężne poręcze i fototrawione reklamy z lat 60-tych.', 'buses', 'AEC', '1:76', 'Oxford Diecast', 10, '129.00'),
(12, 'Mercedes-Benz O405G', 'Przegubowy autobus miejski z systemem informacji pasażerskiej LED. Model zawiera 24 fototrawione siedzenia i schemat linii warszawskiego ZTM.', 'buses', 'Mercedes', '1:87', 'Faller', 12, '199.00'),
(13, 'Star 266 z naczepą', 'Polska ciężarówka wojskowa w wersji cywilnej. Zawiera 56 fototrawionych desek do budowy ładunku i figurki robotników z paletami.', 'trucks', 'Star', '1:35', 'IBG Models', 5, '289.00'),
(14, 'Volvo FH16 750 Globetrotter', 'Ciężarówka z silnikiem 750KM i fototrawionymi chromowanymi chłodnicami. W zestawie naczepa chłodnicza z otwieranymi drzwiami.', 'trucks', 'Volvo', '1:24', 'Italeri', 7, '399.00'),
(15, 'Scania R500 V8', 'Ciężarówka z fototrawionym silnikiem V8 w przekroju. Detale: ruchoma kabina z pełnym wnętrzem i podświetlany panel przyrządów.', 'trucks', 'Scania', '1:24', 'Revell', 4, '349.00'),
(16, 'MAN TGX XXL', 'Kabina typu XXL z łóżkiem i minikuchnią. Model zawiera fototrawione reflektory LED i system monitoringu 360° w formie naklejek.', 'trucks', 'MAN', '1:50', 'Herpa', 9, '179.00'),
(17, 'Boeing 737-800 LOT', 'Samolot w barwach \"Eurolotu\" z fototrawionymi silnikami CFM56. Wnętrze zawiera 144 foteli z nadrukiem logo i ruchome schody lotniskowe.', 'aircrafts', 'Boeing', '1:144', 'Revell', 8, '299.00'),
(18, 'Airbus A380 Emirates', 'Dwupokładowy gigant z diodami LED w oknach i fototrawionymi slotami skrzydeł. W zestawie figurki stewardess serwujących posiłki.', 'aircrafts', 'Airbus', '1:200', 'Hogan', 5, '599.00'),
(19, 'Cessna 172 Skyhawk', 'Szkolny samolot z ruchomymi lotkami i otwieraną tablicą przyrządów. Zawiera instrukcję malowania w 6 wersjach aeroklubowych.', 'aircrafts', 'Cessna', '1:48', 'Tamiya', 12, '159.00'),
(20, 'Concorde British Airways', 'Samolot naddźwiękowy z fototrawionymi dyszami silników Olympus. Model zawiera ruchomy dziób i system podświetlenia kabiny pilotów.', 'aircrafts', 'BAC/Aérospatiale', '1:72', 'Airfix', 3, '449.00'),
(21, 'PKP EU07-001', 'Legenda polskich szlaków w malowaniu zielono-czerwonym. Model zawiera fototrawione pantografy i wnętrze maszynisty z pulpitem EP09.', 'trains', 'Pafawag', '1:87', 'Piko', 6, '399.00'),
(22, 'Shinkansen E5 Hayabusa', 'Japoński pociąg z aktywnym przechyłem. Zawiera 12 wagonów, fototrawione złącza międzyczłonowe i diody LED w kształcie szybu.', 'trains', 'Hitachi', '1:150', 'Kato', 4, '899.00'),
(23, 'Orient Express 1920', 'Luksusowy skład z fototrawionymi żyrandolami i zastawą stołową w restauracji. W zestawie figurki pasażerów w strojach z epoki.', 'trains', 'CIWL', '1:160', 'Märklin', 2, '1299.00'),
(24, 'TGV Duplex Atlantique', 'Dwupiętrowy pociąg z systemem tiltingu. Model zawiera 18 ruchomych osi i fototrawione tablice elektroniczne z rozkładem jazdy.', 'trains', 'Alstom', '1:160', 'Hornby', 5, '799.00'),
(25, 'RMS Titanic', 'Słynny transatlantyk z dioramą \"Góra lodowa\". Detale: 1200 foteli ratunkowych, fototrawione schody pierwszej klasy.', 'ships', 'Harland & Wolff', '1:400', 'Academy', 3, '999.00'),
(26, 'MS Queen Mary 2', 'Największy transatlantyk świata z 15 pokładami pasażerskimi. Model zawiera fototrawione balkony kajut i ruchome śmigła.', 'ships', 'Cunard Line', '1:450', 'Revell', 4, '799.00'),
(27, 'Ever Given', 'Słynny kontenerowiec zablokowany w Kanale Sueskim. Detale: 20 000 fototrawionych kontenerów w skali, ruchome dźwigi.', 'ships', 'Evergreen', '1:700', 'Aoshima', 2, '649.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `materials`
--

INSERT INTO `materials` (`material_id`, `name`, `description`, `category`, `type`, `producent`, `quantity`, `price`) VALUES
(1, 'Nożyk modelarski Pro', 'Zestaw 10 ostrzy do cięcia plastiku i fototrawień. Rękojeść gumowana z regulacją kąta cięcia.', 'tools', 'blades', 'Xuron', 25, '49.99'),
(2, 'Pęseta precyzyjna', 'Stalowe szczypczyki z powłoką tytanową do montażu mikroczęści.', 'tools', 'tweezers', 'Tamiya', 18, '89.00'),
(3, 'Pędzel modelarski', 'Włosie sobolowe do nanoszenia farb metalicznych. Trzonek ergonomiczny.', 'tools', 'brushes', 'Rosemary & Co.', 12, '129.00'),
(4, 'Cążki precyzyjne', 'Profesjonalne cążki z nacięciem V dla dokładnego cięcia przy powierzchni.', 'tools', 'pliers', 'God Hand', 7, '199.00'),
(5, 'Klej modelarski', 'Płynny cement w butelce z precyzyjną igłą.', 'glues', 'for_plastic', 'Tamiya', 30, '24.90'),
(6, 'Klej epoksydowy', 'Dwuskładnikowa żywica do łączenia metalu i żywicy.', 'glues', 'epoxy', 'Loctite', 15, '39.00'),
(7, 'Super Glue Pro', 'Cyjanoakrylat z sprayem przyspieszającym wiązanie.', 'glues', 'cyanoacrylate', 'Zap-a-Gap', 20, '59.00'),
(8, 'Klej do drewna', 'Specjalistyczny klej niezawierający wody do elementów drewnianych.', 'glues', 'for_plastic', 'Green Stuff World', 10, '34.50'),
(9, 'Podkład czarny', 'Czarny podkład z nanocząsteczkami cynku.', 'paints', 'foundations', 'Mr. Hobby', 22, '44.00'),
(10, 'Zestaw farb metalicznych', 'Zestaw 6 odcieni metalu od chromu po miedź.', 'paints', 'acrylic', 'Vallejo', 14, '89.00'),
(11, 'Zestaw do patynowania', '4 farby olejne + medium do spękań.', 'paints', 'sets', 'AK Interactive', 8, '119.00'),
(12, 'Farba Winter Camo', 'Farba matowa z szablonem do natrysku zimowego kamuflażu.', 'paints', 'acrylic', 'Humbrol', 17, '69.00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `military`
--

INSERT INTO `military` (`military_id`, `name`, `description`, `type`, `nation`, `scale`, `producent`, `quantity`, `price`) VALUES
(1, 'Czołg M4A3E8 Sherman \"Easy Eight\"', 'Amerykański czołg średni z końcowego okresu II wojny światowej. Model zawiera ruchomą wieżyczkę, fototrawione osłony gąsienic i wymienne lufy armaty 76mm. W zestawie figurki załogi w mundurach US Army oraz naklejki z oznaczeniami 3. Dywizji Pancernej.', 'tanks', 'USA', '1:35', 'Dragon', 7, '319.99'),
(2, 'Czołg IS-2 Model 1944', 'Radziecki czołg ciężki z 122mm armatą. Detale obejmują odlewany pancerz wieży, metalowe koła jezdne i ruchome jarzmo karabinu maszynowego. W zestawie diorama \"Szturm Berlina\" z elementami zniszczonej zabudowy.', 'tanks', 'ZSRR', '1:35', 'Zvezda', 5, '289.00'),
(3, 'Leopard 2A5', 'Współczesny niemiecki czołg podstawowy z dodatkowym pancerzem modułowym. Model posiada otwierane włazy, elektrycznie sterowaną wieżyczkę (opcjonalny moduł) i precyzyjnie odwzorowane systemy termowizyjne.', 'tanks', 'Niemcy', '1:35', 'Revell', 10, '399.00'),
(4, 'Japoński Type 10', 'Czołg IV generacji z aktywnym systemem ochrony. Zawiera fototrawione panele ERA, diody LED symulujące systemy obserwacyjne i ruchome zawieszenie hydropneumatyczne.', 'tanks', 'Japonia', '1:35', 'Hasegawa', 3, '459.99'),
(5, 'Opel Blitz z wyrzutnią Nebelwerfer', 'Niemiecka ciężarówka z sześciolufową wyrzutnią rakietową. Model zawiera 48 fototrawionych części do rakiet, skrzynki amunicyjne i figurki obsługi w maskujących płaszczach.', 'vehicles', 'Niemcy', '1:35', 'Tamiya', 8, '229.50'),
(6, 'M3 Half-track', 'Pojazd amerykański z podwójnym działkiem 40mm Bofors. Detale: ruchoma platforma ogniowa, mosiężne lufy i skrzynki z amunicją w 3D.', 'vehicles', 'USA', '1:35', 'AFV Club', 6, '279.00'),
(7, 'BRDM-2', 'Radziecki pojazd rozpoznawczy z rakietami przeciwlotniczymi. W zestawie 4 fototrawione rakiety z możliwością prezentacji w pozycji startowej.', 'vehicles', 'ZSRR', '1:35', 'MiniArt', 4, '349.99'),
(8, 'Land Rover Wolf WMIK', 'Brytyjski pojazd patrolowy z karabinem maszynowym L7. Model zawiera plecione osłony na drzwi, kamery termowizyjne i figurki żołnierzy w mundurach MultiCam.', 'vehicles', 'Wielka Brytania', '1:35', 'ICM', 9, '199.00'),
(9, 'PZL TS-11 Iskra bis DF', 'Polski samolot szkolno-bojowy w malowaniu zespołu Żelazny. Model zawiera fototrawione kokpity, ruchome klapy i podwozie z detalami hydraulicznymi.', 'aircrafts', 'Polska', '1:32', 'ModelWorks', 5, '419.00'),
(10, 'F-16C Block 52+', 'Wersja polskich F-16 z zasobnikiem LITENING i rakietami AIM-120. W zestawie fototrawione anteny, wymienne pylony i diody LED.', 'aircrafts', 'Polska', '1:48', 'Kinetic', 7, '379.99'),
(11, 'Boeing B-17G', 'Amerykański bombowiec z okresu II wojny światowej. Model zawiera 654 części, w tym fototrawione pasy bezpieczeństwa i ruchome drzwi bombowe.', 'aircrafts', 'USA', '1:48', 'HKM', 3, '899.00'),
(12, 'Su-57 Felon', 'Rosyjski myśliwiec 5. generacji z wewnętrzną komorą bombową. Detale: chowane podwozie, elementy stealth i 6 rakiet R-77M w 3D.', 'aircrafts', 'Rosja', '1:72', 'Zvezda', 6, '259.00'),
(13, 'USS Missouri BB-63', 'Amerykański pancernik z okresu kapitulacji Japonii. Model zawiera 1200 części, w tym mosiężne działa 406mm i fototrawione platformy.', 'ships', 'USA', '1:200', 'Trumpeter', 2, '1499.00'),
(14, 'ORP Grom', 'Polski niszczyciel w konfiguracji przedwojennej. Detale: drewniany pokład, mosiężne kotwice i figurki marynarzy w mundurach z epoki.', 'ships', 'Polska', '1:400', 'Arma Hobby', 4, '599.00'),
(15, 'IJN Akagi', 'Japoński lotniskowiec. Model z ruchomymi windami lotniczymi i 24 samolotami Zero w skali. W zestawie fototrawione sieci przeciwokrętowe.', 'ships', 'Japonia', '1:700', 'Fujimi', 5, '799.00'),
(16, 'HMS Dreadnought', 'Brytyjski okręt pancerny. Zawiera 560 części, w tym mosiężne działa 12-calowe i fototrawione elementy opancerzenia.', 'ships', 'Wielka Brytania', '1:350', 'Revell', 3, '699.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `e_mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indeksy dla tabeli `civ_vehices`
--
ALTER TABLE `civ_vehices`
  ADD PRIMARY KEY (`civ_vehice_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `military`
--
ALTER TABLE `military`
  ADD PRIMARY KEY (`military_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `e_mail` (`e_mail`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `buildings`
--
ALTER TABLE `buildings`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `civ_vehices`
--
ALTER TABLE `civ_vehices`
  MODIFY `civ_vehice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `military`
--
ALTER TABLE `military`
  MODIFY `military_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
