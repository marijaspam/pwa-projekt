<?php
session_start();
include 'connect.php';

// Provjera je li korisnik prijavljen i je li administrator
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
    header("Location: login.php");
    exit();
}

// Povezivanje s bazom podataka
include 'connect.php';

// Putanja do direktorija sa slikama 
define('UPLPATH', 'img/'); 

// Dohvaćanje svih vijesti iz baze
$query = "SELECT * FROM vijesti";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'OBS - Administracija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>L'OBS</h1>
        <nav class="navbar main_nav" role="navigation"> 
            <ul class="main nav navbar-nav"> 
                <li><a href="index.php">Početna</a></li> 
                <li><a href="kategorija.php?id=sport">Sport</a></li> 
                <li><a href="kategorija.php?id=kultura">Kultura</a></li> 
                <li><a href="administracija.php">Administracija</a></li> 
                <li><a href="registracija.php">Registracija</a></li> 
            </ul> 
        </nav>
    </header>
    <main>
        <h2>Administracija vijesti</h2>
        <a href="unos.html" class="button">Novi unos</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th>Sažetak</th>
                    <th>Tekst</th>
                    <th>Slika</th>
                    <th>Kategorija</th>
                    <th>Arhiva</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['naslov']; ?></td>
                        <td><?php echo $row['sazetak']; ?></td>
                        <td><?php echo $row['tekst']; ?></td>
                        <td><img src="<?php echo UPLPATH . $row['slika']; ?>" width="100px"></td>
                        <td><?php echo $row['kategorija']; ?></td>
                        <td><?php echo $row['arhiva'] ? 'Da' : 'Ne'; ?></td>
                        <td>
                            <a href="uredi.php?id=<?php echo $row['id']; ?>" class="button">Uredi</a>
                            <a href="obrisi.php?id=<?php echo $row['id']; ?>" class="button">Obriši</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        © L'Obs - Les marques ou contenus du site nouvelobs.com sont soumis à la protection de la propriété intellectuelle
    </footer>
</body>
</html>
