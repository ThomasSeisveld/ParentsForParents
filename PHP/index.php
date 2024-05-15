<?php
//error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connect to db
$conn = new SQLite3('../ASSETS/DB.db');

//get 5 most recent posts
$query = "SELECT * FROM probleem ORDER BY ID DESC LIMIT 5";
$result = $conn->query($query);

//search
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM probleem WHERE title LIKE '%$search%' OR vraag LIKE '%$search%'";
    $result = $conn->query($query);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parents For Parents</title>
</head>
<body>
<h1>Parents For Parents</h1>
<p>Welcome to Parents For Parents, a place where parents can share their problems and help each other out.</p>
<!-- search bar to search per word -->
<form method="POST">
    <label for="search">Search:</label>
    <input type="text" name="search" id="search">
    <input type="submit" value="Search">
</form>
<!-- search results-->
<?php
if (isset($search)) {
    echo "<h2>Search results for: $search</h2>";
    echo "<ul>";
    while ($row = $result->fetchArray()) {
        echo "<li><a href='probleem.php?id=" . $row['ID'] . "'>" . $row['title'] . "</a></li>";
    }
    echo "</ul>";
}
?>
<h2>Recent Problems</h2>
<ul>
    <?php
    while ($row = $result->fetchArray()) {
        echo "<li><a href='probleem.php?id=" . $row['ID'] . "'>" . $row['title'] . "</a></li>";
    }
    ?>
</body>
</html>
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoofdpagina</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<header>
    <h1>Homepage for parents</h1>
</header>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="add.php">Add</a></li>
    </ul>
</nav>

<div class="main">
    <h2>Search for Questions:</h2>
    <form method="GET" action="#">
        <div class="form-group">
            <input type="text" id="search" name="search" placeholder="Zoek vragen..." required>
            <button type="submit">Zoek</button>
        </div>
    </form>
</div>

<footer>
    <p>&copy; 2024 Mijn Website. Alle rechten voorbehouden.</p>
</footer>

</body>
</html>
