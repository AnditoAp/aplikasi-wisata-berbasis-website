-- File SQL untuk menggabungkan tabel users dan wisata

-- Membuat tabel users
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Menambahkan data ke tabel users
INSERT INTO `users` (`id`, `username`, `password`, `role`)
VALUES (1, 'admin', 'admin123', 'admin');

-- Membuat tabel wisata
CREATE TABLE `wisata` (
  `idwisata` int(11) NOT NULL AUTO_INCREMENT,
  `namawisata` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `informasi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `peta` varchar(255) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `lpeta` varchar(255) NOT NULL,
  PRIMARY KEY (`idwisata`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Menambahkan data ke tabel wisata
INSERT INTO `wisata` (`idwisata`, `namawisata`, `kategori`, `informasi`, `gambar`, `peta`, `harga`, `waktu`, `lpeta`) VALUES
(6, 'Danau Emfote', 'Danau', 'Danau Emfote terkenal akan bentuknya menyerupai bentuk hati.', '1743151924_danaulove.jpg', '1743151924_peta_danaulove.JPG', 'Rp. 25.000', '08:00 - 17:00', 'https://www.google.co.id/maps/place/Danau+Emfote/@-2.6598814,140.4938157,12.75z/data=!4m6!3m5!1s0x686c8d16ab4bbdb5:0x82f9bba1f39708a6!8m2!3d-2.6608739!4d140.5396897!16s%2Fg%2F11bw7v5sgz?entry=ttu&g_ep=EgoyMDI1MDMyNC4wIKXMDSoASAFQAw%3D%3D'),
(7, 'Danau Sentani', 'Danau', 'Danau Sentani adalah danau yang terletak di Pulau Papua, Indonesia. ', '1743920915_gunungjayapura.jpg', '1743920915_peta_danausentani.JPG', '-', '08:00 - 20:00', 'https://maps.app.goo.gl/ZvyBjeYJJFKHWGuq9'),
(8, 'Kali Biru 1', 'Terkenal', 'Terletak di daerah yang lebih tinggi, Kalibiru 1 menawarkan pemandangan alam yang spektakuler, dengan latar belakang danau dan hutan tropis. Tempat ini terkenal dengan gardu pandang dan jalur trekking menantang bagi para petualang.', '1743921388_kalibiru1.jfif', '1743921388_peta_kalibiru1.JPG', 'Rp. 75.000', '08:00 - 18:00', 'https://maps.app.goo.gl/HzpDVRzJCrjDYvux8'),
(9, 'Kali Biru 2', 'Terkenal', 'Kalibiru 2 menawarkan fasilitas yang lebih lengkap dan nyaman, cocok untuk keluarga. Di sini, pengunjung dapat menikmati kegiatan luar ruang seperti camping dan bersepeda sambil menikmati keindahan alam sekitar.', '1743921602_kalibiru2.jfif', '1743921602_peta_kalibiru2.JPG', 'Rp. 100.000', '08:00 - 18:00', 'https://maps.app.goo.gl/KxJnd8V8xTmA75Sv8?g_st=aw'),
(10, 'Bukit Yotoro', 'Bukit', 'ukit Yotoro adalah salah satu tempat wisata yang berada di Kampung Kwadeware, Distrik Waibu, Kabupaten Jayapura. Tempat yang satu ini sangat cocok sekali untuk teman-teman yang ingin berfoto, camping atau sekedar ingin bersantai.', '1743921914_bukityotoro.JPG', '1743921914_peta_bukityotoropeta.JPG', 'Rp. 25.000', '08:00 - 16:00', 'https://maps.app.goo.gl/5s4ZZnLEqMjPWGgH8?g_st=aw'),
(11, 'Helle Yo Hill', 'Bukit', 'Helle Yo Hill di Kampung Sereh, Kabupaten Jayapura, menawarkan pemandangan pegunungan dan hutan tropis yang indah, cocok untuk foto, hiking, dan menikmati udara sejuk alam Papua.', '1743922622_Helle Yo Hill.jfif', '1743922622_peta_Helle Yo Hill.JPG', 'Rp. 10.000', '09:00 - 18:00', 'https://maps.app.goo.gl/1TwpXsmJkyPYNP7B6'),
(12, 'Bukit Banjabey', 'Bukit', 'Bukit Banjabey di Kabupaten Jayapura menawarkan pemandangan alam yang memukau, dengan latar belakang pegunungan dan hutan tropis. Tempat ini menjadi spot wisata yang populer untuk menikmati udara sejuk dan panorama indah dari ketinggian. Bukit Banjabey co', '1743923018_bukit banjabey.jfif', '1743923018_peta_banjabey.JPG', 'Rp. 10.000', '08:00 - 17:00', 'https://maps.app.goo.gl/4Vdwr55R9G2YRaAj9'),
(13, 'Kali Dansari', 'Terkenal', 'Kali Dansari di Kabupaten Jayapura adalah destinasi wisata alam yang menawarkan pemandangan sungai dan hutan tropis yang masih alami. Tempat ini populer di kalangan wisatawan yang ingin menikmati suasana tenang dan sejuk sambil menikmati keindahan alam se', '1743923449_kalidansari.jfif', '1743923449_peta_kalidansari.JPG', '-', '10:00 - 16:00', 'https://maps.app.goo.gl/9FsvnREfjdnpT7378'),
(14, 'Batu Susun', 'Terkenal', 'Batu Susun Yongsu Spari di Kabupaten Jayapura adalah sebuah lokasi wisata alam yang terkenal dengan formasi batuan unik yang tersusun rapi. Tempat ini menawarkan pemandangan alam yang memukau, dengan suasana yang tenang dan asri. Batu Susun Yongsu Spari m', '1743923774_batususun.jfif', '1743924747_peta_batususun.JPG', '-', '09:00 - 18:00', 'https://maps.app.goo.gl/TeBjMBmajsT2ABxh8?g_st=aw'),
(15, 'Kali Bak', 'Terkenal', 'Kali Bak di Kabupaten Jayapura adalah sebuah kali yang terletak di daerah yang masih alami, menawarkan pemandangan alam yang indah dan udara segar. Kali Bak sering menjadi tujuan bagi para pengunjung yang ingin menikmati keindahan alam Papua, dengan air s', '1743924369_kalibak.jfif', '1743924369_peta_kalibak.JPG', '-', '10:00 - 18:00', 'https://maps.app.goo.gl/gXv37Etxguw8QKFs5'),
(16, 'Kali Bambar', 'Terkenal', 'Kali Bambar di Kabupaten Jayapura adalah sebuah kali yang terletak di daerah Papua, dengan pemandangan alam yang memukau. kali ini dikenal dengan airnya yang jernih dan dikelilingi oleh hutan tropis yang masih alami. Kali Bambar menjadi salah satu tempat ', '1743924726_kalibambar.jfif', '1743924726_peta_kalibambar.JPG', 'Rp. 10.000 - Rp. 20.000', '09:00 - 18:00', 'https://maps.app.goo.gl/5GdoMfFrcW9GNVSW7'),
(17, 'Bukit Tungkuwiri', 'Bukit', 'Bukit Tungkuwiri di Kabupaten Jayapura adalah sebuah bukit yang menawarkan pemandangan alam yang luar biasa. Dengan latar belakang pegunungan dan hutan tropis, tempat ini menjadi spot wisata yang populer untuk menikmati udara sejuk dan panorama indah dari', '1743925034_bukittengkuwiri.jfif', '1743924979_peta_bukittengkuwiri.JPG', '-', '10:00 - 16:00', 'https://maps.app.goo.gl/BhMTzkdvKGXUTrSj7'),
(18, 'Pantai Tablanusu', 'Pantai', 'Tablanusu adalah sebuah kampung yang memiliki pantai dengan batu koral hitam di garis pantainya. Terdapat di wilayah Entiyebo dan Waiya di Distrik Depapre, Kabupaten Jayapura, Papua. Berjarak sekitar 60 km dari Kota Jayapura atau 2 jam perjalanan dengan m', '1743925473_Tablanusu.jfif', '1743925473_peta_tablanusu.JPG', 'Rp. 25.000 - Rp. 50.000', '08:00 - 18:00', 'https://maps.app.goo.gl/raV9SKkQJMLDqGWq6'),
(19, 'Pantai Harlen', 'Pantai', 'Keindahan Pantai Harlen seakan tidak ada habisnya. Diawali dengan sambutan air laut yang begitu jernih dan bergradasi sesuai kedalamannya, Pantai Harlen membawa alam yang indah hingga hamparan pasir putih yang lembut.', '1743925896_pantai harlen.jfif', '1743925896_peta_pantaiharlen.JPG', 'Rp. 500.000', '09:00 - 16:00', 'https://maps.app.goo.gl/DSJhEBCoK4Uv1jFm6'),
(20, 'Pantai Amai', 'Pantai', 'Pantai Amai, yang terletak di Kampung Tablasupa, Distrik Depapre, Kabupaten Jayapura, Papua, adalah destinasi wisata populer yang menawarkan pemandangan alam yang memukau dan suasana tenang, serta unik karena pertemuan air tawar dan air laut di ujung pant', '1743926155_pantaiamai.jfif', '1743926155_peta_pantaiamai.JPG', 'Rp. 25.000', '08:00 - 16:00', 'https://maps.app.goo.gl/g96BoRMv4JV9LuVN6'),
(21, 'Tobuso', 'Terkenal', 'Tobuso, yang juga dikenal sebagai \"rumput kuda\", adalah destinasi wisata tersembunyi di Kampung Dormena, Distrik Depapre, Kabupaten Jayapura, Papua, yang menawarkan pemandangan alam yang hijau dan asri, serta spot foto unik seperti perahu yang seolah-olah', '1743926355_tobuso.jfif', '1743926355_peta_tobuso.JPG', 'Rp. 10.000 - Rp. 20.000', '09:00 - 18:00', 'https://maps.app.goo.gl/u3qUTZK4quJHpFNRA'),
(22, 'Cycloop Water Park', 'Terkenal', 'Cycloop Waterpark menjadi salah satu objek dan icon wisata lokal di Sentani, sekaligus selalu diminati banyak pengunjung dari kota Jayapura dan sekitarnya.\r\nHal tersebut terbukti dari banyaknya pengunjung yang selalu memadati Cycloop Waterpark di Sentani,', '1743926786_cyclopwp.jfif', '1743926786_peta_cyclopwp.JPG', 'Rp. 30.000 - Rp.50.000', '09:00 - 17:00', 'https://maps.app.goo.gl/VDx7vmPYinLdEsUu6'),
(23, 'Bukit Bhulem Mokho', 'Bukit', 'Bukit Bhulem Mokho di Jayapura menawarkan pengalaman wisata alam yang memukau, dengan pemandangan alam yang menakjubkan dari puncak bukit. Tempat ini memberikan kesempatan untuk menikmati kedamaian alam Papua sambil beraktivitas luar ruang seperti fotogra', '1743927155_bukitbhulemmokho.jfif', '1743927155_peta_bukitbhulemmokho.JPG', 'Rp. 10.000', '09:00 - 18:00', 'https://maps.app.goo.gl/RxirDjfsear5zuxv7'),
(24, 'Tugu Mac Arthur', 'Terkenal', 'Tugu McArthur merupakan saksi sejarah besar Perang Dunia ke-2 yang terjadi di tanah Papua. Tugu ini menjadi peringatan datangnya pasukan sekutu di wilayah Pasifik pada tahun 1944. Hal ini terkait penyerangan sekutu terhadap Jepang yang saat itu menguasai ', '1743927502_tugumac.jfif', '1743927502_peta_tugumacarthur.JPG', 'Rp. 10.000 - Rp. 20.000', '08:00 - 18:00', 'https://maps.app.goo.gl/c1umrenxuQckkcbV8'),
(25, 'Pantai Howe', 'Pantai', 'Pantai Howe di Kabupaten Jayapura tidak hanya menawarkan keindahan pantai dengan pasir putih dan air laut yang jernih, tetapi juga dilengkapi dengan kafe yang nyaman. Pengunjung dapat menikmati suasana pantai yang tenang sambil bersantai di kafe, menikmat', '1743927772_pantaihowe.jfif', '1743927772_peta_pantaihowe.JPG', '-', '16:00 - 21:00', 'https://maps.app.goo.gl/etE2VQB8Y6bLxxT27'),
(26, 'Dermaga Apung Yohok Hulu', 'Terkenal', 'Dermaga Apung Yohok Hulu di Kabupaten Jayapura adalah dermaga unik yang mengapung di atas air, menawarkan pemandangan alam yang indah. Tempat ini cocok untuk bersantai, berfoto, dan menikmati suasana tenang di atas perairan.', '1743927995_dermagaapung.jfif', '1743927995_peta_dermagaapung.JPG', 'Rp. 10.000', '09:00 - 18:00', 'https://maps.app.goo.gl/VR1Gxypf5jTpB9Jr6'),
(27, 'Taman Pholeuw', 'Taman', 'Di taman ini, pengunjung bisa melihat juga bisa melihat perbukitan hijau yang mengelilingi danau. Taman kota ini dicat dengan dominasi warna putih dan biru dengan sejumlah lukisan yang menjadi hiasan. Ada undakan dengan lukisan matahari besar yang sering ', '1743928707_tamanpholeuw.jfif', '1743928808_peta_tamanpholeuw.JPG', '-', '09:00 - 20:00', 'https://maps.app.goo.gl/AWz3tntwxaRxRF5S6');

-- Menggabungkan kedua tabel tanpa relasi
-- Query ini akan menggabungkan semua data dari tabel `users` dan `wisata`
SELECT *
FROM users
JOIN wisata;

-- Menggabungkan tabel `users` dan `wisata` dengan relasi (misalnya berdasarkan ID pengguna)
-- Perlu dicatat bahwa di dalam struktur yang ada, tidak ada relasi yang jelas antara kedua tabel ini.
-- Anda harus membuat relasi terlebih dahulu atau menyesuaikan berdasarkan kebutuhan aplikasi.
SELECT users.id, users.username, users.role, wisata.namawisata, wisata.kategori, wisata.informasi
FROM users
JOIN wisata ON users.id = wisata.idwisata; -- Ini hanya contoh dan membutuhkan relasi antar tabel yang jelas
