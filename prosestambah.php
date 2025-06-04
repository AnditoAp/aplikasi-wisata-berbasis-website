<?php
include 'configdata.php'; // Pastikan koneksi database disertakan

// Cek apakah form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namawisata = $_POST["namawisata"];
    $kategori = $_POST["kategori"];
    $informasi = $_POST["informasi"];
    // Tambahkan field baru
    $peta = $_POST["peta"];
    $harga = $_POST["harga"];
    $waktu = $_POST["waktu"];
    $lpeta = $_POST["lpeta"];

    // Cek apakah file diunggah
    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        $namaFile = $_FILES["gambar"]["name"];
        $tmpName = $_FILES["gambar"]["tmp_name"];
        $folderUpload = "uploads/";

        // Pastikan folder uploads ada
        if (!is_dir($folderUpload)) {
            mkdir($folderUpload, 0777, true);
        }

        // Buat nama unik untuk file agar tidak tertimpa
        $namaFileBaru = time() . "_" . basename($namaFile);
        $pathFile = $folderUpload . $namaFileBaru;

        // Pindahkan file yang diupload ke folder tujuan
        if (move_uploaded_file($tmpName, $pathFile)) {
            // Simpan data ke database dengan field baru
            $sql = "INSERT INTO wisata (namawisata, kategori, informasi, gambar, peta, harga, waktu, lpeta) 
                    VALUES ('$namawisata', '$kategori', '$informasi', '$namaFileBaru', '$peta', '$harga', '$waktu', '$lpeta')";

            if ($conn->query($sql) === TRUE) {
                echo "Data berhasil ditambahkan!";
                header("Location: adminhome.php"); // Redirect setelah berhasil
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengupload file!";
        }
    } else {
        echo "Tidak ada file yang diupload atau terjadi error!";
    }
} else {
    echo "Akses ditolak!";
}
?>