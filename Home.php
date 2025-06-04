<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAYAPURA STREETS</title>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script> 
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            display: flex;
            flex: 1;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .overlay-content {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
        }
        .close-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color:rgb(0, 0, 0);
            color: white;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            width: 100px;
            cursor: pointer;
        }
        .close-btn:hover {
            transform: scale(1.05);
            background: linear-gradient(45deg, rgb(165, 165, 165), rgb(48, 48, 48));
        }
        #social-overlay:target {
            display: flex;
        }
        .view-gallery-btn {
        display: inline-block;
        padding: 10px 30px;
        background: black;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 18px;
        font-weight: bold;
        transition: transform 0.3s ease, background 0.3s ease;
    }
    .view-gallery-btn:hover {
        transform: scale(1.05);
        background: linear-gradient(45deg, rgb(165, 165, 165), rgb(48, 48, 48));
    }

        /* Sidebar */
        aside {
            width: 250px;
            background: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            flex-shrink: 0;
        }

        /* Profil */
        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile span {
            font-size: 14px;
            font-weight: 600;
        }

        /* Sidebar Navigation */
        .sidebar-menu ul {
            list-style: none;
            font-size: 15px;
            padding: 0;
        }
        .sidebar-menu ul li {
            margin-bottom: 10px;
        }
        .sidebar-menu ul li a {
            text-decoration: none;
            color: black;
            display: block;
        }

        /* Social Media Icons */
        .social-icons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            justify-content: center;
        }
        .social-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .social-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #000;
            font-size: 18px;
            font-weight: bold;
        }
        .social-icon {
            width: 50px;
            height: 50px;
            margin-bottom: 5px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Main Content */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }
        .slideshow {
            position: absolute;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: -1;
            animation: slideShow 15s infinite;
            background-size: cover;
            background-position: center;
        }
        @keyframes slideShow {
            0% { background-image: url('images/bgjembatanmerah.jpg'); }
            33% { background-image: url('images/gunungjayapura.jpg'); }
            66% { background-image: url('images/bukitjayapura.jpg'); }
            100% { background-image: url('images/bgjembatanmerah.jpg'); }
        }

        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
            height: 100%;
            padding: 20px;
        }
        .content-container h1 {
            font-size: 50px;
            color: white;
            margin-bottom: 10px;
        }
        .content-container p {
            font-size: 15px;
            color: white;
            margin-bottom: 20px;
        }
        .content-container a {
            background: black;
            color: white;
            padding: 10px 30px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside>
            <!-- Profil -->
            <div class="profile">
                <img src="images/profile.png" alt="User Profile">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>

            <h1 style="font-size: 35px; margin-bottom: 0px; color: rgb(0, 0, 0);">JAYAPURA STREETS</h1>

            <!-- Menu -->
            <div class="sidebar-menu">
                <ul>
                    <!-- <li><a href="Home.php">Beranda</a></li> -->
                    <!-- <li><a href="#social-overlay">Sosial Media</a></li> --> <!-- Link Sosial Media -->
                    <li><a href="login.html">Log Out</a></li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main>
            <div class="slideshow"></div>
            <div class="content-container">
                <h1>FIND MORE HERE!</h1>
                <p>Jelajahi pesona Jayapura. Temukan keindahan di setiap langkah.</p>
                <a href="ViewGallery.php" class="view-gallery-btn">View Gallery</a>
            </div>
        </main>
    </div>

    <!-- Overlay for Social Media -->
    <div id="social-overlay" class="overlay">
    <div class="overlay-content">
        <h2>Sosial Media : </h2>
        <br></br>
        <div class="social-icons">
            <div class="social-item">
                <a href="https://instagram.com/_.aaand" target="_blank" class="social-link">
                    <img src="images/iconinstagram.png" class="social-icon">
                    <span>Instagram</span>
                </a>
            </div>
            <div class="social-item">
                <a href="https://facebook.com/andreasrandang" target="_blank" class="social-link">
                    <img src="images/iconfacebook.png" class="social-icon">
                    <span>Facebook</span>
                </a>
            </div>
            <div class="social-item">
                <a href="https://x.com/andreasrandang" target="_blank" class="social-link">
                    <img src="images/iconx.jpg" class="social-icon">
                    <span>X</span>
                </a>
        </div>
    </div>

    <a href="#" class="close-btn">Close</a>
</body>
</html>
