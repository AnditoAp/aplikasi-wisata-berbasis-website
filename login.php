<?php
session_start();
include 'config.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query untuk mendapatkan data user berdasarkan username
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password (gunakan password_hash di database)
        if ($password === $user['password']) { 
            // Set session login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect sesuai role
            if ($user['role'] == 'admin') {
                header("Location: adminhome.php"); // Halaman Admin
            } else {
                header("Location: Home.php"); // Halaman User
            }
            
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Username tidak terdaftar!'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html");
    exit();
}
?>
