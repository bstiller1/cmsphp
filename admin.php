<?php 
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include('db.php'); 

if (isset($_POST['submit'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    if (mysqli_query($conn, $sql)){
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>body { margin: 15px; }</style>
</head>
<body>
    <h3>Add New Post</h3>
    <form method="POST" action="admin.php">
        <input type="text" name="title" placeholder="Post Title" required /><br />
        <textarea name="content" placeholder="Write content here..." required></textarea><br />
        <button type="submit" name="submit">Publish</button>
</form>
<h3>Manage Posts</h3>
<table>
    <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "<td>
        <a href='edit.php?id=" . $row['id'] . "'>Edit</a> | 
        <a href='delete.php?id=" . $row['id'] . "' onlcick='return confirm(\"Are you sure?\")'>Delete</a>
        </td>";
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>