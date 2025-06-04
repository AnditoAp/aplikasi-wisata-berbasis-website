<?php
$servername = "localhost"; // Sesuaikan dengan pengaturan XAMPP Anda
$username_db = "root"; // Default username XAMPP
$password_db = ""; // Kosong jika belum diubah
$database = "jayapura_streets"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
