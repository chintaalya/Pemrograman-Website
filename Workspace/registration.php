<?php
// memulai session agar dapat memanfaatkan $_SESSION
session_start();

// mengarahkan user ke halaman dashboard bila button login ditekan / login bernilai true
// menghalangi user untuk pergi ke halaman registration sebelum logout
if(isset($_SESSION["login"])){
    header("location:dashboard.php");
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <?php
    require 'connection.php';
    if(isset($_POST["register"])){
        if(register($_POST) > 0){
            header("location:index.php?message=success");
        } else {
            echo mysqli_error($conn);
        }
    }
    ?>

    <div class="container">
        <div class="wrapper">
            <div class="title">Registration Form</div>
            <form method="POST" action="#">
            <?php 
            if(isset($_GET['error'])){
                $error = $_GET['error'];
                if($error == "password"){

                    // menampilkan pesan error bila password salah ?>
                    <p style="color: #995200; font-style: italic; padding-bottom: 25px;">Konfirmasi Password tidak sesuai!</p>
            <?php
                } else if($error == "username"){
                    
                    // menampilkan pesan error bila username salah ?>
                    <p style="color: #995200; font-style: italic; padding-bottom: 25px;">Username sudah terdaftar!</p>
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
                <div class="row">
                    <label for="conf_password"><i class="fas fa-lock"></i></label>
                    <input type="password" name="conf_password" id="conf_password" placeholder="Konfirmasi Password" required>
                </div>
                <div class="row button">
                    <input type="submit" name="register" value="Register">
                </div>
                <div class="signup">Already have an account? <a href="index.php">Login Now!</a></div>
            </form>
        </div>
    </div>
</body>
</html>

