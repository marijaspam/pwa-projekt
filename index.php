<?php
include 'connect.php';

$query = "SELECT * FROM articles";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Le Monde</title>
</head>
<body>
    <header>
        <h1>Lemonde</h1>
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
        <section>
            <h2>Sve Vijesti</h2>
            <div class="articles-container">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="article">
                        <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                        <h3><?php echo $row['title']; ?></h3>
                        <p><?php echo $row['about']; ?></p>
                        <a href="skripta.php?id=<?php echo $row['id']; ?>">Pročitaj više</a>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Lemonde Marija Božić</p>
    </footer>
</body>
</html>
