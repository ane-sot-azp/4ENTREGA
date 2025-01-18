<?php

$servername = "localhost"; //base datuen zerbitzariaren izena
$username = "root"; //datu baseetako erabiltzailearen izena 
$password = "1MG2024"; //datu baseetako pasahitza
$dbname = "ml_4entrega"; //datu basearen izena

// datu baseekin konexioa sortu eta $conn aldagaian gorde
$conn = new mysqli($servername, $username, $password, $dbname);

// konexioan errore bat dagoen begiratu
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}


$produktuid = isset($_GET['id']) ? $_GET['id'] : 0; //$produktuaid aldagaian gordetzen da get metodoan bidalitako ida eta hutsik badago ' ' hutsunea ezartzen zaio
?>
<?php
if ($produktuid == '') { //$produktuid aldagaia hutsa badago ariketa bukatuko da
    die;
} else { //$produktuid aldagia hutsik ez badago, else barnekoa exekutatuko da
    $sql = "DELETE FROM produktuak WHERE ProduktuID=" . $produktuid . ""; //sql eskaera exekutatuko da eta aukeratutako lerroko id aren lerroa ezabatuko da datu baseetan
    if ($conn->query($sql) === TRUE) { //konexioa egiten bada Ariketa7.php era bidalduko dizu
        header("Location: ../Ariketa7.php");
        die();
    } else { //errore bat badago, gertatu den errorea erakutsiko du
        echo "Zerbaitek ez du funtzionatu: " . $conn->error;
    }
    $conn->close(); //datu baseekin konexioa itxiko da
}

echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "    <title>Ezabatu</title>"; //Ezabatu izena jarriko dio web orriari
echo "</head>";
echo "<body>";
echo "</body></html>";

?>