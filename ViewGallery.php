<?php
include 'configdata.php';

// Ambil nilai pencarian dan kategori dari URL
$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';

// Query awal
$sql = "SELECT * FROM wisata";

// Tambahkan filter pencarian jika ada
if ($search) {
    $sql .= " WHERE LOWER(namawisata) LIKE '%$search%'";
}

// Tambahkan filter kategori jika ada dan bukan "Semua"
if ($kategori !== 'Semua') {
    $sql .= ($search ? " AND" : " WHERE") . " kategori='$kategori'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAYAPURA STREETS - Gallery</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background: black;
            color: white;
        }
        .card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
        }
        .card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: 0.3s ease-in-out;
        }
        .card:hover img {
            filter: blur(5px);
        }
        .info {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            width: 80%;
        }
        .card:hover .info {
            opacity: 1;
        }
        .btn-search {
            background: rgb(53, 53, 53);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgb(39, 39, 39);
        }
        .btn-search:hover {
            transform: scale(1.05);
            background: linear-gradient(45deg, rgb(165, 165, 165), rgb(48, 48, 48));
        }
        .btn-filter {
            background: #222;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-filter:hover {
            background: rgb(122, 122, 122);
            color: white;
        }
        .btn-back {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #333;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgb(39, 39, 39);
        }
        .btn-back:hover {
            transform: scale(1.05);
            background: linear-gradient(45deg, rgb(39, 34, 34), rgb(48, 48, 48));
        }
        .card-link {
            display: block;
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body class="p-6">
    <div class="max-w-6xl mx-auto text-center">
        <h1 class="text-5xl font-bold mb-6">JAYAPURA STREETS</h1>
        
        <!-- Form Pencarian -->
        <form method="GET" class="mb-6 flex justify-center">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari Tempat Wisata" 
                class="border p-2 rounded w-1/2 text-lg text-black">
            <button type="submit" class="ml-2 btn-search text-white">Cari</button>
            <!-- Tombol Kembali -->
            <a href="home.php" class="ml-2 btn-back">Kembali</a>
        </form>

        <!-- Filter Kategori -->
        <form method="GET" class="flex justify-center space-x-4 mb-8">
            <?php
            $kategoriList = ["Semua", "Pantai", "Bukit", "Danau", "Taman", "Terkenal"];
            foreach ($kategoriList as $kat) {
                $checked = ($kategori === $kat) ? "bg-gray-600 text-white" : "bg-gray-800 text-gray-300";
                echo "<button type='submit' name='kategori' value='$kat' class='btn-filter $checked'>$kat</button>";
            }
            ?>
        </form>

        <!-- Grid Wisata -->
        <div class="grid grid-cols-3 gap-6" data-aos="zoom-in-up" data-wow-delay="0.8s">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card shadow-lg rounded-lg overflow-hidden bg-white bg-opacity-90">';
                    // Link ke detailwisata.php dengan parameter id
                    echo '<a href="detailwisata.php?id=' . $row["idwisata"] . '&search=' . urlencode($search) . '&kategori=' . urlencode($kategori) . '" class="card-link">';
                    echo '<img src="uploads/' . $row["gambar"] . '" class="h-64 w-full object-cover" alt="' . $row["namawisata"] . '">';
                    echo '<div class="info">';
                    echo '<p class="text-lg font-semibold wisata-name">' . $row["namawisata"] . '</p>';
                    echo '<p class="text-sm wisata-kategori" style="display: none;">' . $row["kategori"] . '</p>';
                    echo '<p class="text-sm">' . $row["informasi"] . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="col-span-3 text-gray-300">Tidak ada data wisata.</p>';
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>
</html>