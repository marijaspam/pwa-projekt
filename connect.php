<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lemonde"; // Ime tvoje baze podataka

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
