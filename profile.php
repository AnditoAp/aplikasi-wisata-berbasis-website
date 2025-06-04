<?php
// Periksa apakah sesi sudah dimulai sebelum memanggil session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';

// Ambil user_id dari sesi yang sedang aktif
$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Ambil username berdasarkan user_id dari sesi
    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
} else {
    $username = "Guest"; // Tampilkan Guest jika tidak ada sesi login
}

$conn->close();

// Tampilkan username
echo "<span>" . htmlspecialchars($username) . "</span>";
?>
