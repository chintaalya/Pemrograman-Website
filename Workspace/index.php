<?php
// memulai session agar dapat memanfaatkan $_SESSION
session_start();

// mengecek keberadaan cookie, jika cookie masih ada, user dapat langsung masuk tanpa login
if(isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $num = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // mengambil data user berdasarkan idnya
    require_once 'connection.php';
    $sql = "SELECT username FROM user WHERE user_id='$num'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // mengecek kesamaan username yang sudah dienkripsi pada cookie dengan username pada database
    if ($key === hash('sha384', $row['username'])){

        // jika cookie dan username sama, login akan bernilai true, dan website akan menampilkan halaman dashboar 
        $_SESSION['login'] = true;
    }
}

// mengarahkan user ke halaman dashboard bila button login ditekan / login bernilai true
// menghalangi user untuk kembali ke halaman login sebelum logout
if(isset($_SESSION["login"])) {
    header("location:dashboard.php");
}

if(isset($_GET['message'])){
    $message = $_GET['message'];
    if($message == "success"){
        echo "<script>alert('Data User Berhasil Ditambahkan')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="title">Login Form</div>
            <form method="POST" action="check.php">
            <?php 
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                if($error == "password"){

                    // menampilkan pesan error bila password salah ?>
                    <p style="color: #995200; font-style: italic; padding-bottom: 25px;">Password salah!</p>
            <?php
                } else if($error == "username"){
                    
                    // menampilkan pesan error bila username salah ?>
                    <p style="color: #995200; font-style: italic; padding-bottom: 25px;">Username tidak terdaftar!</p>
            <?php
                }
            }
            ?>
                <div class="row">
                    <label for="username"><i class="fas fa-user"></i></label>
                    <input type="text" name="username" id="username" placeholder="Username" required>
                </div>
                <div class="row">
                    <label for="password"><i class="fas fa-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <div class="row button">
                    <input type="submit" name="login" value="Login">
                </div>
                <div class="signup">Doesn't have any account? <a href="registration.php">Sign-up Now!</a></div>
            </form>
        </div>
    </div>
</body>
</html>

