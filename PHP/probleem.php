<?php
// error reporting
error_reporting(E_ALL);

// Connect to db
$conn = new SQLite3('../ASSETS/DB.db');

//check if id is in url if not redirect to index
if (!isset($_GET['id'])) {
    header('Location: index.php');
}

// Get problem by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $probleem_query = "SELECT * FROM probleem WHERE ID = $id";
    $probleem_result = $conn->query($probleem_query);
    $probleem = $probleem_result->fetchArray();

    // put the problem in variables
    $naam = $probleem['naam'];
    $vraag = $probleem['vraag'];
    $title = $probleem['title'];
    $geslacht = $probleem['geslacht'];
}

// get comments by problem ID
$comments_query = "SELECT * FROM comments WHERE post_id = $id";
$comments_result = $conn->query($comments_query);

// form submit
if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $reactie = $_POST['reactie'];
    $post_id = $_POST['post_id'];

    $insert_query = "INSERT INTO comments (naam,antwoord,post_id) VALUES ('$naam','$reactie','$post_id')";
    $conn->query($insert_query);

    header('Location: probleem.php?id=' . $post_id);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Probleem van: <?php echo $naam; ?></title>
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
    <h2><?php echo $title; ?></h2>
    <p><?php echo $vraag; ?></p>
    <p><strong>Door: <?php echo $naam; ?></strong></p>
    <p><strong>Geslacht: <?php echo $geslacht; ?></strong></p>
    <h3>Reacties:</h3>
    <ul>
        <?php
        while ($row = $comments_result->fetchArray()) {
            echo "<li><strong>" . $row['naam'] . "</strong> - " . $row['antwoord'] . "</li>";
        }
        ?>
    </ul>

    <h3>Reageer:</h3>
    <form method="POST">
        <input type="hidden" name="post_id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="naam">Naam</label>
            <input type="text" id="naam" name="naam" required>
        </div>
        <div class="form-group">
            <label for="reactie">Reactie</label>
            <textarea id="reactie" name="reactie" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Verzenden</button>
        </div>
    </form>
</div>
<footer>
    <p>&copy; 2024 Mijn Website. Alle rechten voorbehouden.</p>
</footer>
</body>
</html>