-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2025 at 08:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_production`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `General_Objectives` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Specific_Objectives` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Target_Group` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Competency_Aspects` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `facilitator_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `title`, `description`, `image`, `price`, `General_Objectives`, `Specific_Objectives`, `Target_Group`, `Competency_Aspects`, `facilitator_id`) VALUES
(1, 'Excel 101: Kuasai Microsoft Excel Dasar dengan Mudah ', 'Dalam pelatihan ini, Peserta akan diajarkan tentang kemampuan dasar pengoperasian Microsoft Excel, yang sangat dibutuhkan di berbagai okupasi seiring dengan meningkatnya kebutuhan analisis data di Indonesia, seperti yang diungkapkan dalam Indonesia Online Vacancy Outlook (IOVO) Tahun 2020. ', '1735986823-AS 4.png', 800000, 'Peserta Pelatihan dapat mengoperasikan rumus dasar di Microsoft Excel melalui studi kasus yang diberikan di Unjuk Keterampilan serta mencapai nilai indikator minimal 80%              ', 'C2 Mengenal Microsoft Excel                \r\nC3 Menggunakan formula dalam Microsoft Excel\r\nC3 Melakukan managemen data pada Microsoft Excel                \r\nC3 Menggunakan PivotTable pada Microsoft Excel                \r\nC3 Membuat grafik pada Microsoft Excel untuk visualisasi data', 'Lulusan SMP\r\nBerusia 18 s/d 45 Tahun \r\nMemiliki aplikasi Microsoft Excel\r\nMemiliki koneksi internet yang stabil\r\nMemiliki Laptop / PC', 'Kognitif\r\nLangkah membuka halaman awal Microsoft Excel\r\nFungsi matematika dan pemeriksaan formula pada Microsoft Excel\r\nManajeman dan struktur data pada Microsoft Excel\r\nPivotTable pada Microsoft Excel\r\nJenis-jenis grafik pada Microsoft Excel', NULL),
(2, 'Scrum Mastery: Integrasi Scrum Efektif untuk Manajer Proyek TI', 'Berdasarkan Future Jobs Report 2023 peran Manajer Proyek TI menuntut adaptasi terhadap metodologi yang lebih fleksibel dan responsif terhadap perubahan, hal ini membuat pemahaman mendalam tentang kerangka kerja Scrum menjadi sangat penting. Kelas Mengintegrasikan Scrum bagi Manajer Proyek TI memberikan peserta wawasan komprehensif dan praktis tentang penerapan Scrum dalam manajemen proyek. ', '1735986720-AS.png', 1000000, 'Peserta mampu membuat kerangkan kerja Scrum menggunakan Trello saat simulasi pembuatan kerangka kerja Scrum serta mendapatkan nilai presentase minimal 80% saat unjuk keterampilan.        ', 'C2 Memahami kerangka berpikir VUCA dan Agile value\r\nC2 Memahami kerangka kerja scrum dalam manajemen produk\r\nC3 Menerapkan acara dan perangkat scrum menggunakan Tools Task Manager\r\nC3 Mengelola dinamika dalam scrum tim\r\nC3 Menerapkan strategi kepemimpinan bagi manajer IT', 'Syarat dan Ketentuan: \r\nLulusan SMK/SMA \r\nBerusia 18 s/d 45 Tahun \r\nMenginstall aplikasi Trello\r\nSenang terlibat di kerjasama tim\r\nKemampuan adaptasi yang baik', 'Kognitif\r\nKerangka berpikir VUCA dan Agile Value\r\nScrum Value dan Scrum Team\r\nAcara dalam scrum, perangkat dalam scrum\r\nDinamika tim dalam scrum\r\nScrum bagi Manajer IT, evaluasi scrum', NULL),
(3, 'CorelDRAW Essentials: Keterampilan Wajib untuk Desainer Grafis', 'Menurut Indonesia Occupational Task and SKills (IndoTaSK) 2020, profesi desainer grafis diprediksi akan terus mengalami pertumbuhan, dengan kebutuhan yang meningkat untuk kemampuan adaptasi dan penguasaan alat desain terkini. Kelas Mengoperasikan CorelDRAW untuk Desainer Grafis dirancang untuk memberikan landasan yang kuat dalam menggunakan CorelDRAW.', '1735986945-AS 3.png', 500000, 'Peserta pelatihan berhasil membuat gambar sederhana di CorelDRAW yakni gambar bunga sederhana sesuai dengan instruksi Pelatih dengan mencapai nilai presentasi 80% dari 100% saat Unjuk Keterampilan ', 'C3. Menerapkan design brief sesuai dengan kebutuhan\r\nC3. Mengoperasikan tools dasar pada CorelDRAW\r\nC3. Mengoperasikan tools tambahan pada CorelDRAW\r\nC3. Membuat objek sederhana pada CorelDRAW\r\nC3. Membuat desain logo, poster, dan kemasan di CorelDRAW\r\n', 'Syarat dan Ketentuan :\r\nLulusan SMP\r\nBerusia 18 s/d 45 Tahun \r\nMemiliki aplikasi CorelDRAW\r\nMemiliki minat di bidang desain grafis\r\nMemiliki koneksi internet yang stabil', 'Kognitif\r\nDesign Brief dan Konsep Design\r\nTools Flyout dan Artistic Media pada perangkat lunak desain\r\nCorelDRAW Shortcut dan tools flyout pada CorelDRAW\r\nObjek dan teks pada desain grafis\r\nJenis Poster, Logo dan Desain Kemasan', NULL),
(4, 'Teknik Pemilahan dan Pengolahan Sampah', 'Merujuk pada IndoTaSK 2020, seorang Profesional Kesehatan dan Kebersihan Lingkungan harus mulai serius melihat masalah lingkungan berupa sampah. Mereka harus mempunyai kompetensi dalam melakukan penanganan sampah, terutama untuk sampah rumah tangga yang memang lekat dengan masyarakat. ', '1736533924-AS 2.png', 12000000, 'Peserta mampu melakukan langkah-langkah pemilahan sampah rumah tangga yang dibuktikan melalui video singkat dengan menjelaskan jenis sampah rumah tangga  dan mendapatkan nilai persentase minimal 100% saat unjuk keterampilan.', 'C2. Mengidentifikasi sampah berdasarkan jenis dan sumbernya.\r\nC3. Menerapkan sistem manajemen keselamatan, kesehatan kerja dan lingkungan\r\nC2. Menguasai dasar ilmu pemilahan sampah rumah tangga\r\nC3. Melakukan pengolahan sampah rumah tangga \r\nC2. Memahami  peran komunitas pengelola sampah', '- Lulusan SD/SMP\r\n- Berusia 18 s/d 45 Tahun\r\n- Kondisi internet yang stabil\r\n- Memiliki minat di bidang kesehatan  dan kebersihan lingkungan\r\n- Memiliki minat dalam pemilahan dan pengelolaan sampah', 'Klasifikasi sampah berdasarkan jenis dan sumber\r\nK3 dalam kesehatan dan kebersihan lingkungan \r\nLangkah pemilahan sampah rumah tangga\r\nUrgensi Pengelolaan Sampah\r\nTeknik pengelolaan sampah rumah tangga organik dan anorganik ', NULL),
(5, 'Tilapia Farming: Belajar Budi Daya Ikan Nila', 'Dalam kelas ini, Sobat LS semua akan mempelajari hal apa yang harus diperhatikan dalam melakukan budidaya Nila dimulai dari penggunaan filter air, instalasi air, pemilihan lokasi budidaya hingga menyesuaikan kolam sesuai dengan kebutuhan budidaya Nila.', '1736534279-AS 1.png', 50000, 'Peserta Pelatihan dapat mengoperasikan rumus dasar di Microsoft Excel melalui studi kasus yang diberikan di Unjuk Keterampilan serta mencapai nilai indikator minimal 80%', 'C2 Mengenal Microsoft Excel\r\nC3 Menggunakan formula dalam Microsoft Excel\r\nC3 Melakukan managemen data pada Microsoft Excel\r\nC3 Menggunakan PivotTable pada Microsoft Excel\r\nC3 Membuat grafik pada Microsoft Excel untuk visualisasi data', '- Lulusan SMP\r\n- Berusia 18 s/d 45 Tahun\r\n- Memiliki aplikasi Microsoft Excel\r\n- Memiliki koneksi internet yang stabil\r\n- Memiliki Laptop / PC', 'Kognitif\r\nDesign Brief dan Konsep Design\r\nTools Flyout dan Artistic Media pada perangkat lunak desain\r\nCorelDRAW Shortcut dan tools flyout pada CorelDRAW\r\nObjek dan teks pada desain grafis\r\nJenis Poster, Logo dan Desain Kemasan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_registrations`
--

CREATE TABLE `course_registrations` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `course_id` int NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_registrations`
--

INSERT INTO `course_registrations` (`id`, `user_id`, `course_id`, `registered_at`) VALUES
(5, 4, 2, '2025-01-13 09:24:38'),
(6, 4, 3, '2025-01-13 09:24:45'),
(8, 4, 4, '2025-01-14 11:17:24'),
(13, 5, 1, '2025-01-15 04:31:25'),
(16, 4, 5, '2025-02-08 06:50:57'),
(18, 4, 1, '2025-02-27 04:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `facilitator_applications`
--

CREATE TABLE `facilitator_applications` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `course_id` int NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `applied_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `approved_at` datetime DEFAULT NULL,
  `action_taken` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `facilitator_applications`
--

INSERT INTO `facilitator_applications` (`id`, `user_id`, `course_id`, `status`, `applied_at`, `approved_at`, `action_taken`) VALUES
(1, 2, 2, 'approved', '2025-01-12 17:20:46', '2025-03-03 13:51:19', 'approve'),
(2, 3, 1, 'approved', '2025-01-12 18:29:05', '2025-01-14 18:04:28', NULL),
(3, 3, 5, 'approved', '2025-01-12 19:10:05', '2025-01-12 22:29:06', NULL),
(4, 3, 3, 'approved', '2025-01-12 22:58:05', '2025-01-12 22:58:26', NULL),
(5, 2, 4, 'approved', '2025-01-14 18:04:09', '2025-01-14 18:04:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portofolio`
--

CREATE TABLE `portofolio` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `project_name` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `project_link` varchar(255) NOT NULL,
  `username` char(50) NOT NULL,
  `program_name` enum('Prakerja','Indonesia Skills Week') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `portofolio`
--

INSERT INTO `portofolio` (`id`, `image`, `project_name`, `project_link`, `username`, `program_name`) VALUES
(1, '1736165146_PF 1.png', 'Social Media Marketing', 'https://www.google.com/', 'Firman Maulana', 'Indonesia Skills Week'),
(2, '1736167081_PF 2.png', 'UI / UX Design', 'https://www.google.com/', 'Gede Bagus', 'Indonesia Skills Week'),
(3, '1736167127_PF 3.png', 'Content Writer', 'https://www.google.com/', 'Leo DIonis', 'Prakerja'),
(4, '1736167166_PF 4.png', 'Saku-Saku App', 'https://www.google.com/', 'Firman Maulana', 'Indonesia Skills Week'),
(5, '1736167212_PF.png', 'Merhandise T-Shirt', 'https://www.google.com/', 'Rizki Maulana', 'Indonesia Skills Week');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `course_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `review` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `program_name` enum('Prakerja','Indonesia Skills Week') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `linkedin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `image`, `name`, `course_name`, `review`, `program_name`, `linkedin`) VALUES
(1, '1736223443_User 2.png', 'Inggrie Anti Mulya', 'Web Development', 'Selama mengikuti program PBI, saya mendapatkan banyak wawasan dan pengalaman berharga dalam bekerja sama dengan tim untuk mengembangkan proyek web yang kompleks. ', 'Prakerja', 'https://id.linkedin.com/'),
(2, '1735987571_User 4.png', 'Juliana Oktaviani Enok', 'Excel 101: Kuasai Microsoft Excel', 'Selama mengikuti program PBI sebagai Web Developer, saya mendapatkan banyak pengalaman berharga. Program ini membantu saya meningkatkan keterampilan bidang web development', 'Indonesia Skills Week', 'https://id.linkedin.com/'),
(3, '1735987729_User 1.png', 'Rifqi Sirojul Muzhoffar', 'UI / UX Designer', 'Saya sangat senang bisa mengikuti program magang+ UI/UX Designer selama 1 bulan di Luarsekolah. Program ini sangat bermanfaat untuk saya dalam mempelajari dasar-dasar UI/UX Design', 'Prakerja', 'https://id.linkedin.com/'),
(4, '1735987840_User.png', 'Muhamad Rafa Maulana', 'UI / UX Designer', 'Aku jadi lebih paham tentang alur kerja sebagai UI/UX Design selain itu, kak ikhsan sebagai mentor UI/UX Design sangat friendly dan banyak memberikan ilmu tentang UI/UX Design ', 'Indonesia Skills Week', 'https://id.linkedin.com/'),
(5, '1735987992_User 5.png', 'Muhammad Rayhan Siddiq', 'UI / UX Designer', 'Selama aku mengikuti program ini aku banyak mendapatkan pengalaman dan juga relasi. Program PBI ini sangat membantu aku dalam meningkatkan keterampilan aku dalam dunia profesional.', 'Indonesia Skills Week', 'https://id.linkedin.com/'),
(6, '1736164739_User 6.png', 'Taufik Abdul Hamid Lestaluhu', 'Web Development', 'Magang+ oleh Luarsekolah ini bagus bagi yang mau mendapatkan pemgalaman baru dalam magang, karena disini kita juga bisa sambil belajar bagi yang sudah punya pengalaman', 'Indonesia Skills Week', 'https://id.linkedin.com/');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','facilitator') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Wananda Prima Sena', 'admin@test.com', '$2y$10$A5FAH8icShHNLx4ov7pjF.qTpRtIU5wSTodW6aWG9VytX5suKF996', 'admin'),
(2, 'Firman Maulana, S.Pd', 'tester@test.com', '$2y$10$UZqQT84r8zMTQH0.Nq22xuSluK2CBW9M5w/.omfeq72xyEvPLVYIy', 'facilitator'),
(3, 'Yayan Ariyanto, S.Kom, M.kom', 'tester1@test.com', '$2y$10$lhtKrNhbCnHh1/fb9fl6leFSggpzNjtI2xkurTkbDi9GA322dOd5K', 'facilitator'),
(4, 'Reza Setiawan', 'reza@gmail.com', '$2y$10$OvIMhvi8.AfTaW8gwvvwDOxS95k7zh85tHPU4VAdVojekgN5MKXIu', 'user'),
(5, 'Nizar Muhammad', 'nizar@gmail.com', '$2y$10$yOCRgTCAOYEmJR91H5g/zucSX6XyVG2AKmyHR2N8kJ1aZZDPmBtrS', 'user'),
(6, 'Rizki Ramadhan', 'rizki1@gmail.com', '$2y$10$fJPBQ52GWgJ8HjdEGOxKVeDHiPFDpYvoycbSW/CILZR9HkjPw9Hci', 'user'),
(7, 'Stalin', 'admin@gmail.com', '$2y$10$9O09D8l7UwCWBFjfWqtnAOSfi8PW1lav0OLRsg3NlnKZzg8RjcpkS', 'facilitator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facilitator` (`facilitator_id`);

--
-- Indexes for table `course_registrations`
--
ALTER TABLE `course_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `facilitator_applications`
--
ALTER TABLE `facilitator_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trainer_user` (`user_id`),
  ADD KEY `fk_trainer_course` (`course_id`);

--
-- Indexes for table `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_registrations`
--
ALTER TABLE `course_registrations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `facilitator_applications`
--
ALTER TABLE `facilitator_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_facilitator` FOREIGN KEY (`facilitator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `course_registrations`
--
ALTER TABLE `course_registrations`
  ADD CONSTRAINT `course_registrations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_registrations_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `facilitator_applications`
--
ALTER TABLE `facilitator_applications`
  ADD CONSTRAINT `fk_trainer_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_trainer_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
