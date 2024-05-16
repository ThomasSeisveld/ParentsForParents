<?php
// error reporting from server
error_reporting(E_ALL);

// Connect to db
$conn = new SQLite3('../ASSETS/DB.db');

// form submit
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $Title = $_POST['Title'];
    $question = $_POST['question'];

    $insert_query = "INSERT INTO probleem (naam,vraag,title,geslacht) VALUES ('$name','$question','$Title','$gender')";
    $conn->query($insert_query);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactformulier</title>
    <link rel="stylesheet" href="../CSS/addstyle.css">
</head>
<body>

    <header>
        <h1>Common questions for parents</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li class="SELECTED"><a href="add.php">add</a></li>
        </ul>
    </nav>

    <div class="main">
        <h2>Your problem input:</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="gender">Geslacht</label>
                <select id="gender" name="gender" required>
                    <option value="">Selecteer geslacht</option>
                    <option value="Vader">Vader</option>
                    <option value="Moeder">Moeder</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" id="Title" name="Title" required>
            </div>
            <div class="form-group">
                <label for="question">Vraag</label>
                <textarea id="question" name="question" required></textarea>
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

