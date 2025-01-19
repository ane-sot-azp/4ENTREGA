<?php

ob_start();
session_cache_limiter('private');

$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml_4entrega";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}

// URL-an jasotako 'id' parametroa jasotzen da, eta balio bat ez badago, 0 izango da

$produktuid = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<?php
// Produktu ID-a hutsik badago (0), script-a gelditu egingo da

if ($produktuid == '') {
    die;
} else {
        // SQL kontsulta prestatzen da, ProduktuID-aren arabera produktua ezabatzeko
    
    
+
    $sql = "DELETE FROM produktuak WHERE ProduktuID=" . $produktuid . "";
    if ($conn->query($sql) === TRUE) {
                // Bideraketa egin orri berri batera, Ariketa7.php-ra

        header("Location: ../Ariketa7.php");
        die();
    } else {
        echo "Zerbaitek ez du funtzionatu: " . $conn->error;
    }
        // Datu-basearekin konexioa itxi

    $conn->close();
}

echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "    <title>Ezabatu</title>";
echo "</head>";
echo "<body>";
echo "</body></html>";

?>