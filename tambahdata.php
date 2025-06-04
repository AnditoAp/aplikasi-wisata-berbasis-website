<?php
include 'configdata.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namawisata = $_POST["namawisata"];
    $kategori = $_POST["kategori"];
    $informasi = $_POST["informasi"];
    $harga = $_POST["harga"];
    $waktu = $_POST["waktu"];
    $lpeta = $_POST["lpeta"];

    // Proses upload gambar utama
    $gambarName = '';
    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        $gambarName = time() . "_" . basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "uploads/" . $gambarName);
    }

    // Proses upload gambar peta
    $petaName = '';
    if (isset($_FILES["peta"]) && $_FILES["peta"]["error"] == 0) {
        $petaName = time() . "_peta_" . basename($_FILES["peta"]["name"]);
        move_uploaded_file($_FILES["peta"]["tmp_name"], "uploads/" . $petaName);
    }

    // Simpan data ke database
    $sql = "INSERT INTO wisata (namawisata, kategori, informasi, gambar, peta, harga, waktu, lpeta) 
            VALUES ('$namawisata', '$kategori', '$informasi', '$gambarName', '$petaName', '$harga', '$waktu', '$lpeta')";

    if ($conn->query($sql)) {
        header("Location: adminhome.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="bg-light p-3" style="width: 250px; height: 100vh;">
            <h4>Admin Panel</h4>
            <ul class="list-unstyled">
                <li><a href="adminhome.php" class="btn btn-success w-100 my-2">Data</a></li> 
                <li><a href="tambahdata.php" class="btn btn-primary w-100 my-2">Tambah Data</a></li>
                <li><a href="login.html" class="btn btn-secondary w-100 my-2">Log Out</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="p-4" style="flex: 1;">
            <h2>Tambah Data Wisata</h2>
            
            <form method="POST" action="" enctype="multipart/form-data" class="border p-4 rounded">
                <div class="mb-3">
                    <label class="form-label">Nama Wisata</label>
                    <input type="text" name="namawisata" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Pantai">Pantai</option>
                        <option value="Bukit">Bukit</option>
                        <option value="Danau">Danau</option>
                        <option value="Taman">Taman</option>
                        <option value="Terkenal">Terkenal</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Informasi</label>
                    <textarea name="informasi" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Gambar Utama</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Gambar Peta</label>
                    <input type="file" name="peta" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Harga Masuk</label>
                    <input type="text" name="harga" class="form-control" placeholder="Contoh: Rp 10.000" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Jam Operasional</label>
                    <input type="text" name="waktu" class="form-control" placeholder="Contoh: 08:00 - 17:00" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Link Peta (Google Maps)</label>
                    <input type="url" name="lpeta" class="form-control" placeholder="https://maps.google.com/..." required>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                <a href="adminhome.php" class="btn btn-secondary">Batal</a>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>