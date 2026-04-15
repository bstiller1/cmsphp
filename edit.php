<?php
session_start();
if (!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
include('db.php');

$id = (int)$_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id");
$post = mysqli_fetch_assoc($result);

if (isset($_POST['update'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    if (mysqli_query($conn, $sql)){
        header("Location: admin.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>body { margin: 15px; }</style>
</head>
<body>
    <h3>Update Post</h3>
<form method="POST">
    <input type="text" name="title" value="<?php echo $post['title']; ?>" required /><br />
    <textarea name="content" required><?php echo $post['content']; ?></textarea><br />
    <button type="submit" name="update">Update Post</button>
</form>
</body>
</html>