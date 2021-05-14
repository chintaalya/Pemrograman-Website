<?php
// memulai session agar dapat memanfaatkan $_SESSION
session_start();

// menghalangi user untuk masuk ke dashboard sebelum login
if(!ISSET($_SESSION["login"])){
    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="title">Dashboard on Process</div>
            <a href="logout.php"><button>Logout</button></a>
        </div>
    </div>
</body>
</html>

