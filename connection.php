<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "quiz";

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $dbname);

// membuat fungsi untuk pengecekan saat register
function register($data){
    global $conn;
    $username = strtolower($data["username"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $conf_password = mysqli_real_escape_string($conn, $data["conf_password"]);

    // cek keberadaan username, username bernilai unique, maka tidak boleh ada username yang sama
    $query = "SELECT username FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if(mysqli_fetch_array($result)) {
        echo "<script>alert('Username Sudah Terdaftar')</script>";
        return false;
    }
    
    // mengecek kesesuaian passwor dengan password konfirmasi
    if($password !== $conf_password) {
        echo "<script>alert('Konfirmasi Password Tidak Sesuai')</script>";
        return false;
    }

    // mengenkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // menambahkan data registrasi ke database
    $query = "INSERT INTO user VALUES('','$username','$password')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>
