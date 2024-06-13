<?php
session_start();
include 'connect.php';

// Provjera je li korisnik prijavljen i je li administrator
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// Dohvaćanje postojećih podataka vijesti
$query = "SELECT * FROM vijesti WHERE id = $id";
$result = mysqli_query($conn, $query);
$article = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $about = $conn->real_escape_string($_POST['about']);
    $content = $conn->real_escape_string($_POST['content']);
    $category = $conn->real_escape_string($_POST['category']);
    $archive = isset($_POST['archive']) ? 1 : 0;

    if (!empty($_FILES['pphoto']['name'])) {
        $picture = $_FILES['pphoto']['name'];
        $target_dir = 'img/' . $picture;
        move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    } else {
        $picture = $article['slika'];
    }

    $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: administracija.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uredi vijest</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>L'OBS - Uredi vijest</h1>
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
        <form enctype="multipart/form-data" action="" method="POST">
            <div class="form-item">
                <label for="title">Naslov vijesti:</label>
                <input type="text" name="title" value="<?php echo $article['naslov']; ?>">
            </div>
            <div class="form-item">
                <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
                <textarea name="about" cols="30" rows="10"><?php echo $article['sazetak']; ?></textarea>
            </div>
            <div class="form-item">
                <label for="content">Sadržaj vijesti:</label>
                <textarea name="content" cols="30" rows="10"><?php echo $article['tekst']; ?></textarea>
            </div>
            <div class="form-item">
                <label for="pphoto">Slika:</label>
                <input type="file" name="pphoto">
                <img src="<?php echo UPLPATH . $article['slika']; ?>" width="100px">
            </div>
            <div class="form-item">
                <label for="category">Kategorija vijesti:</label>
                <select name="category">
                    <option value="sport" <?php if ($article['kategorija'] == 'sport') echo 'selected'; ?>>Sport</option>
                    <option value="kultura" <?php if ($article['kategorija'] == 'kultura') echo 'selected'; ?>>Kultura</option>
                </select>
            </div>
            <div class="form-item">
                <label>Spremiti u arhivu:</label>
                <input type="checkbox" name="archive" <?php if ($article['arhiva']) echo 'checked'; ?>>
            </div>
            <div class="form-item">
                <button type="submit">Ažuriraj</button>
            </div>
        </form>
    </main>
    <footer>
        © L'Obs - Les marques ou contenus du site nouvelobs.com sont soumis à la protection de la propriété intellectuelle
    </footer>
</body>
</html>
