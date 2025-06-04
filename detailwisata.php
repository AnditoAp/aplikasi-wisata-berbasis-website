<?php
include 'configdata.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua';

// Query untuk mendapatkan data wisata
$sql = "SELECT * FROM wisata WHERE idwisata = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Bersihkan data peta
    $embed_peta = trim($row['peta']);
    $link_peta = trim($row['lpeta']);
    $is_iframe = preg_match('/<iframe/i', $embed_peta);
    
    // Ambil gambar peta di database
    $gambar_peta = isset($row['peta']) && !empty($row['peta']) ? 'uploads/' . $row['peta'] : '';
    
    // Ekstrak koordinat dari link Google Maps jika ada
    $coordinates = '';
    if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $link_peta, $matches)) {
        $coordinates = $matches[1] . ',' . $matches[2];
    }
} else {
    header("Location: viewgallery.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $row['namawisata'] ?> - JAYAPURA STREETS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('uploads/<?= $row['gambar'] ?>');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .info-card {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 30px;
            margin: -50px auto 0;
            max-width: 800px;
            position: relative;
            z-index: 10;
        }
        .map-container {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }
        .map-link {
            display: block;
            width: 100%;
            height: 100%;
        }
        .map-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.3);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .map-overlay:hover {
            opacity: 1;
        }
        .map-overlay-text {
            background: rgba(0,0,0,0.7);
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
            margin-top: 20px;
        }
        .btn-back:hover {
            background-color: #555;
            transform: translateY(-2px);
        }
        .detail-item {
            margin-bottom: 15px;
        }
        .detail-label {
            font-weight: bold;
            color: #ccc;
            display: block;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 18px;
        }
        .map-placeholder {
            width: 100%;
            height: 100%;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ccc;
        }
        .iframe-container {
            width: 100%;
            height: 100%;
        }
        .iframe-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .peta-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="p-6">
    <!-- Hero Section -->
    <div class="hero-section">
        <div>
            <h1 class="text-5xl font-bold mb-4"><?= strtoupper($row['namawisata']) ?></h1>
        </div>
    </div>

    <!-- Info Card -->
    <div class="info-card">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Kiri - Informasi -->
            <div>
                <h2 class="text-3xl font-bold mb-6">INFORMASI</h2>
                <p class="text-lg mb-8"><?= $row['informasi'] ?></p>
                
                <div class="detail-item">
                    <span class="detail-label">KATEGORI</span>
                    <span class="detail-value"><?= $row['kategori'] ?></span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">HARGA TIKET</span>
                    <span class="detail-value"><?= $row['harga'] ?></span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">WAKTU OPERASIONAL</span>
                    <span class="detail-value"><?= $row['waktu'] ?></span>
                </div>
            </div>

            <!-- Kolom Kanan - Peta -->
            <div>
                <h2 class="text-3xl font-bold mb-6">LOKASI</h2>
                <div class="map-container">
                    <?php if (!empty($gambar_peta) || !empty($embed_peta) || !empty($link_peta)): ?>
                        <?php if (!empty($gambar_peta)): ?>
                            <!-- Tampilkan gambar peta dari database -->
                            <a href="<?= !empty($link_peta) ? htmlspecialchars($link_peta) : '#' ?>" target="_blank" class="map-link">
                                <img src="<?= $gambar_peta ?>" alt="Peta <?= $row['namawisata'] ?>" class="peta-image">
                                <div class="map-overlay">
                                    <span class="map-overlay-text">Klik untuk membuka peta</span>
                                </div>
                            </a>
                        <?php elseif (!empty($embed_peta) && $is_iframe): ?>
                            <!-- Tampilkan embed iframe -->
                            <div class="iframe-container">
                                <?= $embed_peta ?>
                                <a href="<?= !empty($link_peta) ? htmlspecialchars($link_peta) : '#' ?>" target="_blank" class="map-link">
                                    <div class="map-overlay">
                                        <span class="map-overlay-text">Klik untuk membuka peta</span>
                                    </div>
                                </a>
                            </div>
                        <?php elseif (!empty($link_peta)): ?>
                            <!-- Tampilkan static map atau placeholder -->
                            <a href="<?= htmlspecialchars($link_peta) ?>" target="_blank" class="map-link">
                                <?php if (!empty($coordinates)): ?>
                                    <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?= $coordinates ?>&zoom=15&size=600x400&markers=color:red%7C<?= $coordinates ?>&key=YOUR_API_KEY" 
                                         alt="Peta <?= $row['namawisata'] ?>" class="peta-image">
                                <?php else: ?>
                                    <div class="map-placeholder">
                                        <span>Peta <?= $row['namawisata'] ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="map-overlay">
                                    <span class="map-overlay-text">Klik untuk membuka peta</span>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="map-placeholder">
                            <span>Peta tidak tersedia</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center py-8 mt-12">
        <a href="viewgallery.php?search=<?= urlencode($search) ?>&kategori=<?= urlencode($kategori) ?>" class="btn-back">KEMBALI KE GALLERY</a>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>