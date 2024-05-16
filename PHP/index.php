<?php
// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to db
$conn = new SQLite3('../ASSETS/DB.db');

// Get 5 most recent posts
$recent_query = "SELECT * FROM probleem ORDER BY ID DESC LIMIT 5";
$recent_result = $conn->query($recent_query);

// Search
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT * FROM probleem WHERE title LIKE '%$search%' OR vraag LIKE '%$search%'";
    $search_result = $conn->query($search_query);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents For Parents</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<header>
    <h1>Parents For Parents</h1>
</header>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="add.php">Add</a></li>
    </ul>
</nav>

<div class="main">
    <h2>Zoek naar vragen:</h2>
    <form method="POST">
        <div class="form-group">
            <input type="text" id="search" name="search" placeholder="Zoek vragen..." required>
            <button type="submit">Zoek</button>
        </div>
    </form>
    <?php
    if (isset($search)) {
        echo "<h2>Zoekresultaten voor: $search</h2>";
        echo "<ul>";
        while ($row = $search_result->fetchArray()) {
            $short_vraag = substr($row['vraag'], 0, 40) . '...';
            echo "<li><a href='probleem.php?id=" . $row['ID'] . "'>" . $row['title'] . "</a> - " . $short_vraag . "</li>";
        }
        echo "</ul>";
    }
    ?>
    <h2>Recente problemen</h2>
    <ul>
        <?php
        while ($row = $recent_result->fetchArray()) {
            $short_vraag = substr($row['vraag'], 0, 40) . '...';
            echo "<li><a href='probleem.php?id=" . $row['ID'] . "'>" . $row['title'] . "</a>- " . $short_vraag . "</li>";
        }
        ?>
    </ul>
</div>

<footer>
    <p>&copy; 2024 Mijn Website. Alle rechten voorbehouden.</p>
</footer>

</body>
</html>
