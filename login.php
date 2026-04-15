<?php
session_start();
include('db.php');

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
        if (password_verify($password, $row['password'])){
            $_SESSION['user'] = $row['username'];
            header("Location: admin.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>body { margin:15px; }</style>
</head>
<body>
    <h3>Login</h3>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required /><br />
        <input type="password" name="password" placeholder="Password" required /><br />
        <button type="submit" name="login">Login</button>
</form>
</body>
</html>