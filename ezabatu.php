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


$produktuid = isset($_GET['id']) ? $_GET['id'] : 0;
?>
<?php
if ($produktuid == '') {
    die;
} else {
    $sql = "DELETE FROM produktuak WHERE ProduktuID=" . $produktuid . "";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../Ariketa7.php");
        die();
    } else {
        echo "Zerbaitek ez du funtzionatu: " . $conn->error;
    }
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