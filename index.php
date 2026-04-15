<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>body { margin:15px; }</style>
</head>
<body>
    <h3>Latest Posts</h3>
<hr />
<?php
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<div>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<small>Published on: " . $row['created_at'] . "</small>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div><hr />";
    }
} else {
    echo "No posts yet!";
}
    ?>
</body>
</html>