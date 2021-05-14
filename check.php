<?php
// memulai session agar dapat memanfaatkan $_SESSION
session_start();
require 'connection.php';
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $sql);

// mengecek apakah username telah tercatat pada database atau belum
if (mysqli_num_rows($result) > 0){
    
    // mengecek kecocokan password
    $row = mysqli_fetch_array($result);
    if (password_verify($password, $row['password'])) {
        
        // jika password telah sesuai, maka session bernilai benar
        $_SESSION["login"] = true;

        // mengecek apakah user menekan remember me atau tidak
        if(isset($_POST['remember'])){
            
            // membuat cookie untuk menyimpan catatan login user
            setcookie('id', $row['user_id'], time()+3600);
            setcookie('key', hash('sha384', $row['username']), time()+3600);
        }
        
        // menuju ke dashboard bila password telah sesuai
        header("location:dashboard.php");
    } else {

        // kembali ke halaman index dengan pesan error password bila password tidak sesuai
        header("location:index.php?error=password");
    }
} else {
    
    // kembali ke halaman index dengan pesan error username jika username belum terdaftar
    header("location:index.php?error=username");
}
?>

