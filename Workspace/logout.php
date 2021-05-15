<?php
// memulai session agar dapat memanfaatkan $_SESSION
session_start();

// menghapus session yang sudah dibuat
session_unset();
session_destroy();

// menghapus cookie yang sudah dibuat
setcookie('id', '', time()-3600);
setcookie('key', '', time()-3600);

// kembali ke halaman index
header("location:index.php");
?>