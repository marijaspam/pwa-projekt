<?php
session_start();
include 'connect.php';

// Provjera je li korisnik prijavljen i je li administrator
if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// Brisanje vijesti iz baze
$query = "DELETE FROM vijesti WHERE id = $id";
if (mysqli_query($conn, $query)) {
    header("Location: administracija.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
