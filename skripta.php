<?php
include 'connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM articles WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $row['title']; ?> - Lemonde</title>
</head>
<body>
    <header>
        <h1>Le Monde</h1>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="kategorija.php?id=sport">Sport</a></li>
                <li><a href="kategorija.php?id=kultura">Kultura</a></li>
                <li><a href="unos.html">Unos</a></li>
                <li><a href="administracija.php">Administracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <article>
            <h2><?php echo $row['title']; ?></h2>
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
            <p><?php echo $row['content']; ?></p>
        </article>
    </main>
    <footer>
        <p>&copy; 2023 Lemonde</p>
    </footer>
</body>
</html>
