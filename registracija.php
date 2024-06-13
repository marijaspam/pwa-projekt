<?php
include 'connect.php';

if (isset($_POST['registracija'])) {
    $ime = $conn->real_escape_string($_POST['ime']);
    $prezime = $conn->real_escape_string($_POST['prezime']);
    $korisnicko_ime = $conn->real_escape_string($_POST['korisnicko_ime']);
    $lozinka = $conn->real_escape_string($_POST['lozinka']);
    $hashed_lozinka = password_hash($lozinka, PASSWORD_DEFAULT);
    $razina = 0; // Default user level

    $sql = "SELECT korisnicko_ime FROM korisnici WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $msg = "Korisničko ime već postoji!";
    } else {
        $stmt = $conn->prepare("INSERT INTO korisnici (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $ime, $prezime, $korisnicko_ime, $hashed_lozinka, $razina);

        if ($stmt->execute()) {
            $msg = "Registracija uspješna!";
            header("Location: login.php");
        } else {
            $msg = "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Lemonde - Registracija</h1>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Početna</a></li>
                <li><a href="login.php">Prijava</a></li>
                <li><a href="registracija.php">Registracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="registracija.php" method="POST">
            <div class="form-item">
                <label for="ime">Ime:</label>
                <input type="text" name="ime" id="ime" required>
            </div>
            <div class="form-item">
                <label for="prezime">Prezime:</label>
                <input type="text" name="prezime" id="prezime" required>
            </div>
            <div class="form-item">
                <label for="korisnicko_ime">Korisničko ime:</label>
                <input type="text" name="korisnicko_ime" id="korisnicko_ime" required>
            </div>
            <div class="form-item">
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka" id="lozinka" required>
            </div>
            <div class="form-item">
                <label for="lozinka2">Ponovite lozinku:</label>
                <input type="password" name="lozinka2" id="lozinka2" required>
            </div>
            <div class="form-item">
                <button type="submit" name="registracija">Registracija</button>
            </div>
        </form>
        <?php
        if (isset($msg)) {
            echo '<p>' . $msg . '</p>';
        }
        ?>
    </main>
    <footer>
        © Lemonde - Marija Božić
    </footer>
</body>
</html>
