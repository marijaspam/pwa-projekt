<?php
session_start();
include 'connect.php';

if (isset($_POST['prijava'])) {
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];

    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnici WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt);

    if (password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
        $_SESSION['username'] = $imeKorisnika;
        $_SESSION['level'] = $levelKorisnika;
        header("Location: administracija.php");
        exit();
    } else {
        $msg = 'Neispravno korisničko ime ili lozinka';
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Lemonde - Prijava</h1>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Početna</a></li>
                <li><a href="login.php">Prijava</a></li>
                <li><a href="registracija.php">Registracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section role="prijava">
            <form action="login.php" method="POST">
                <div class="form-item">
                    <span id="porukaUsername" class="bojaPoruke"></span>
                    <label for="username">Korisničko ime:</label>
                    <div class="form-field">
                        <input type="text" name="username" id="username" class="form-field-textual">
                    </div>
                </div>
                <div class="form-item">
                    <span id="porukaPassword" class="bojaPoruke"></span>
                    <label for="lozinka">Lozinka:</label>
                    <div class="form-field">
                        <input type="password" name="lozinka" id="lozinka" class="form-field-textual">
                    </div>
                </div>
                <div class="form-item">
                    <button type="submit" value="Prijava" name="prijava">Prijava</button>
                </div>
            </form>
            <?php
            if (isset($msg)) {
                echo '<p>' . $msg . '</p>';
            }
            ?>
        </section>
    </main>
    <footer>
        © Lemonde - Marija Božić
    </footer>
</body>
</html>
