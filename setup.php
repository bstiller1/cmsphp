<?php
include('db.php');
$hashed_password = password_hash('SwordFish!123', PASSWORD_DEFAULT);
$sql = "UPDATE users SET password = '$hashed_password' WHERE username = 'admin'";
mysqli_query($conn, $sql);
echo "Admin user created!";
?>