<?php
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
