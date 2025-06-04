<?php
include 'configdata.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idwisata = $_POST['idwisata'];
    $namawisata = mysqli_real_escape_string($conn, $_POST['namawisata']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $informasi = mysqli_real_escape_string($conn, $_POST['informasi']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $waktu = mysqli_real_escape_string($conn, $_POST['waktu']);
    $lpeta = mysqli_real_escape_string($conn, $_POST['lpeta']);

    // Get current data
    $query = "SELECT gambar, peta FROM wisata WHERE idwisata = $idwisata";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $currentGambar = $row['gambar'];
    $currentPeta = isset($row['peta']) ? $row['peta'] : '';

    // Initialize SQL parts
    $updateFields = "namawisata='$namawisata', kategori='$kategori', informasi='$informasi', 
                    harga='$harga', waktu='$waktu', lpeta='$lpeta'";

    // Handle gambar (image) upload if provided
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambarName = time() . "_" . basename($_FILES['gambar']['name']);
        $gambarPath = "uploads/" . $gambarName;
        
        // Delete old file if exists
        if ($currentGambar && file_exists("uploads/" . $currentGambar)) {
            unlink("uploads/" . $currentGambar);
        }
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $gambarPath)) {
            $updateFields .= ", gambar='$gambarName'";
        }
    }

    // Handle peta (map) upload if provided
    if (isset($_FILES['peta']) && $_FILES['peta']['error'] == 0) {
        $petaName = time() . "_peta_" . basename($_FILES['peta']['name']);
        $petaPath = "uploads/" . $petaName;
        
        // Delete old file if exists
        if ($currentPeta && file_exists("uploads/" . $currentPeta)) {
            unlink("uploads/" . $currentPeta);
        }
        
        if (move_uploaded_file($_FILES['peta']['tmp_name'], $petaPath)) {
            $updateFields .= ", peta='$petaName'";
        }
    }

    // Update the database
    $sql = "UPDATE wisata SET $updateFields WHERE idwisata=$idwisata";

    if ($conn->query($sql)) {
        // Success message
        echo "<div class='alert alert-success'>Data berhasil diperbarui!</div>";
        
        // Redirect after a short delay
        echo "<script>
            setTimeout(function() {
                window.location.href = 'adminhome.php';
            }, 1500);
        </script>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>