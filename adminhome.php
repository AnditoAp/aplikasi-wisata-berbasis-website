<?php
include 'configdata.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $idwisata = $_POST["idwisata"];
    $namawisata = $_POST["namawisata"];
    $kategori = $_POST["kategori"];
    $informasi = $_POST["informasi"];
    $harga = $_POST["harga"];
    $waktu = $_POST["waktu"];
    $lpeta = $_POST["lpeta"];

    // Ambil nama gambar dan peta lama dari database
    $sql = "SELECT gambar, peta FROM wisata WHERE idwisata=$idwisata";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $gambarLama = $row['gambar'];
    $petaLama = $row['peta'];

    // Proses gambar baru jika ada
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambarTmpName = $_FILES['gambar']['tmp_name'];
        $gambarName = time() . "_" . basename($_FILES['gambar']['name']);
        $gambarPath = "uploads/" . $gambarName;

        // Hapus gambar lama jika ada
        if ($gambarLama && file_exists("uploads/" . $gambarLama)) {
            unlink("uploads/" . $gambarLama);
        }

        // Upload gambar baru
        move_uploaded_file($gambarTmpName, $gambarPath);
        $sql = "UPDATE wisata SET namawisata='$namawisata', kategori='$kategori', informasi='$informasi', gambar='$gambarName', harga='$harga', waktu='$waktu', lpeta='$lpeta' WHERE idwisata=$idwisata";
    } else {
        // Jika tidak ada gambar baru, update hanya informasi lainnya
        $sql = "UPDATE wisata SET namawisata='$namawisata', kategori='$kategori', informasi='$informasi', harga='$harga', waktu='$waktu', lpeta='$lpeta' WHERE idwisata=$idwisata";
    }

    // Proses peta baru jika ada
    if (isset($_FILES['peta']) && $_FILES['peta']['error'] == 0) {
        $petaTmpName = $_FILES['peta']['tmp_name'];
        $petaName = time() . "_peta_" . basename($_FILES['peta']['name']);
        $petaPath = "uploads/" . $petaName;

        // Hapus peta lama jika ada
        if ($petaLama && file_exists("uploads/" . $petaLama)) {
            unlink("uploads/" . $petaLama);
        }

        // Upload peta baru
        move_uploaded_file($petaTmpName, $petaPath);
        $sql = "UPDATE wisata SET namawisata='$namawisata', kategori='$kategori', informasi='$informasi', peta='$petaName', harga='$harga', waktu='$waktu', lpeta='$lpeta' WHERE idwisata=$idwisata";
    }

    if ($conn->query($sql)) {
        header("Location: adminhome.php"); // Refresh halaman setelah update
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $idwisata = $_POST["idwisata"];
    // Ambil nama gambar dan peta yang akan dihapus
    $sql = "SELECT gambar, peta FROM wisata WHERE idwisata=$idwisata";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $gambar = $row['gambar'];
    $peta = $row['peta'];

    // Hapus gambar dan peta dari folder uploads
    if ($gambar && file_exists("uploads/" . $gambar)) {
        unlink("uploads/" . $gambar);
    }
    if ($peta && file_exists("uploads/" . $peta)) {
        unlink("uploads/" . $peta);
    }

    // Hapus data wisata dari database
    $sql = "DELETE FROM wisata WHERE idwisata=$idwisata";
    if ($conn->query($sql)) {
        header("Location: adminhome.php"); // Refresh halaman setelah hapus
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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .table-bordered {
            border: 3px solid #000 !important;
        }
        .table-bordered th, .table-bordered td {
            border: 2px solid #000 !important;
            text-align: center;
            vertical-align: middle;
        }
        .form-control {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        .img-thumbnail {
            width: 100px;
            height: auto;
        }
    </style>
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
            <h2>Daftar Wisata</h2>

            <?php
            $sql = "SELECT * FROM wisata"; 
            $result = $conn->query($sql);

            if (!$result) {
                die("<div class='alert alert-danger'>Query Error: " . $conn->error . "</div>");
            }

            if ($result->num_rows > 0) {
            ?>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Wisata</th>
                            <th>Kategori</th>
                            <th>Informasi</th>
                            <th>Gambar</th>
                            <th>Peta</th>
                            <th>Harga</th>
                            <th>Jam Operasional</th>
                            <th>Link Peta</th>
                            <th>Opsi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <input type="hidden" name="idwisata" value="<?= $row['idwisata'] ?>">
                                <td><input type="text" name="namawisata" class="form-control" value="<?= htmlspecialchars($row['namawisata']) ?>"></td>
                                <td><input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($row['kategori']) ?>"></td>
                                <td><input type="text" name="informasi" class="form-control" rows='3' value="<?= htmlspecialchars($row['informasi']) ?>"></td>
                                <td>
                                    <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>" class="img-thumbnail"><br>
                                    <input type="file" name="gambar" class="form-control mt-2">
                                </td>
                                <td>
                                    <img src="uploads/<?= htmlspecialchars($row['peta']) ?>" class="img-thumbnail"><br>
                                    <input type="file" name="peta" class="form-control mt-2">
                                </td>
                                <td><input type="text" name="harga" class="form-control" value="<?= htmlspecialchars($row['harga']) ?>"></td>
                                <td><input type="text" name="waktu" class="form-control" value="<?= htmlspecialchars($row['waktu']) ?>"></td>
                                <td><input type="text" name="lpeta" class="form-control" value="<?= htmlspecialchars($row['lpeta']) ?>"></td>
                                <td>
                                    <button type="submit" name="update" class="btn btn-success btn-sm">Simpan</button>
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </td>
                            </form>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php 
            } else { 
                echo "<div class='alert alert-warning'>Tidak ada data wisata.</div>";
            }
            ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
