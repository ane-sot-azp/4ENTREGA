<?php

ob_start(); // Irteera bufferra aktibatu
session_cache_limiter('private'); // Saio cache-motaren mugatzailea ezarri

$servername = "localhost"; // Zerbitzariaren izena
$username = "root"; // Erabiltzaile izena
$password = "1MG2024"; // Pasahitza
$dbname = "ml_4entrega"; // Datu-basearen izena

// Konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioan errorea dagoen egiaztatu
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error); // Errore-mezua erakutsi
}

// Produktuaren ID-a lortu GET parametroen bidez
$produktuid = isset($_GET['id']) ? $_GET['id'] : 0; // ID-a ez badago, lehenetsitako balioa 0 izango da
?>

<?php
// Produktuaren ID-a hutsik badago
if ($produktuid == '') {
    die; // Exekuzioa gelditu
} else { 
    // Produktua ezabatzeko SQL kontsulta sortu
    $sql = "DELETE FROM produktuak WHERE ProduktuID=" . $produktuid . "";
    if ($conn->query($sql) === TRUE) { // Kontsulta arrakastatsua bada
        header("Location: ../Ariketa7.php"); // Produktu zerrendaren orrira birbideratu
        die(); // Exekuzioa amaitu
    } else { // Kontsultak errorea izan badu
        echo "Zerbaitek ez du funtzionatu: " . $conn->error; // Errore-mezua erakutsi
    }
    $conn->close(); // Konexioa itxi
}

// HTML orriaren hasiera idatzi
echo "<!DOCTYPE html>";
echo "<html lang='es'>"; // HTML hizkuntza kodea
echo "<head>";
echo "    <title>Ezabatu</title>"; // Orrialdearen izenburua
echo "</head>";
echo "<body>";
echo "</body></html>"; // HTML orriaren bukaera
?>
