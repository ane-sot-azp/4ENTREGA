<?php
$servername = "localhost"; // Datu-basearen zerbitzariaren izena
$username = "root"; // Datu-basearen erabiltzailearen izena
$password = "1MG2024"; // Datu-basearen erabiltzailearen pasahitza
$dbname = "ml_4entrega"; // Datu-basearen izena

// Datu-basearekin konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioan errorea dagoen egiaztatu, egon balego mezua inprimatu
if ($conn->connect_error) {
    die("Ezin izan da konexioa egin: " . $conn->connect_error);
}

// GET metodo bidez bidalitako parametroak
$bilatu = isset($_GET["izenaBilatu"]) ? $_GET["izenaBilatu"] : ''; // GET metodoaren bidez "izenaBilatu" balioa hartzen du edo ez du ezer gordetzen
$mota = isset($_GET["mota"]) ? $_GET["mota"] : ''; // GET metodoaren bidez "mota" balioa hartzen du edo ez du ezer gordetzen
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7.Ariketa</title> <!-- Orrialdearen izenburua -->
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script> <!-- Ikonoen liburutegia kargatzeko script-a -->
    <link rel="stylesheet" href="css.css"> <!-- CSS artxiboaren esteka -->
    <style>
        /* Orrialderako estilo orokorrak */
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        a {
            color: rgb(29, 153, 175);
            text-decoration: none;
        }

        a:hover {
            color: rgb(16, 104, 119);
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!--Produktuen bilaketa egiteko formularioa GET-aren bidez -->
    <form action="Ariketa7.php" method="GET">
        <a href="txertatu.php"><i class="fa fa-plus" aria-hidden="true"></i></a> <!-- Produktuak gehitzeko ikonoa -->
        <input type="text" name="izenaBilatu" placeholder="Produktuaren izena bilatu..." /> <!-- Produktuaren izena sartzeko input-a -->
        <select name="mota"> <!-- Produktuaren mota hautatzeko zerrenda -->
            <option value="">Mota</option>
            <option value="Telefonoa">Telefonoa</option>
            <option value="Tableta">Tableta</option>
            <option value="Ordenagailua">Ordenagailua</option>
            <option value="Telebista">Telebista</option>
            <option value="Aurikularrak">Aurikularrak</option>
            <option value="Bozgorailua">Bozgorailua</option>
            <option value="Kamera">Kamera</option>
            <option value="Smart Device">Smart Device</option>
            <option value="Smart Watch">Smart Watch</option>
            <option value="Gamepad">Gamepad</option>
        </select>
        <button>Bilatu</button> <!-- Produktuak bilatzeko botoia -->
    </form>

    <?php
    // Emaitzen taula erakusteko taula sortu
    echo "<table>";
    echo "<tr>";
    echo "  <th>Produktua ID</th>"; 
    echo "  <th>Izena</th>";
    echo "  <th>Mota</th>"; 
    echo "  <th>Prezioa (€)</th>"; 
    echo "  <th>Ekintzak</th>"; 
    echo "</tr>";

    // Datu-basetik produktuak ateratzeko kontsulta
    $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak";
    $result = $conn->query($sql);
    $lerroak = 0; // Lerroen kontagailua sortu

    // Emaitzarik badagoen egiaztatu
    if ($result->num_rows > 0) {
        // Lortutako errenkada bakoitza egiaztatu
        while ($row = $result->fetch_assoc()) {
            // Motaren araberako filtroa definitu
            if (str_contains(strtolower($row["Mota"]), strtolower($mota))) {
                echo "<tr>";
                echo "<td>" . $row["ProduktuID"] . "</td>"; // Produktuaren ID-a begistaratzeko kodea
                echo "<td>" . $row["Izena"] . "</td>"; // Produktuaren izena begistaratzeko kodea
                echo "<td>" . $row["Mota"] . "</td>"; // Produktuaren mota begistaratzeko kodea
                echo "<td>" . $row["Prezioa"] . "</td>"; // Produktuaren prezioa begistaratzeko kodea
                echo "<td>
                        <a href='editatu.php/?id=" . $row["ProduktuID"] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                        <a href='ezabatu.php/?id=" . $row["ProduktuID"] . "'><i class='fa fa-trash' aria-hidden='true'></i></a>
                      </td>"; // Editatzeko eta ezabatzeko ikonoak begistaratzeko kodea
                echo "</tr>";
                $lerroak++; // Lerroen kontagailua handitu
            }
        }
    } else {
        echo "Emaitzarik ez"; // Emaitzarik ez badago, mezu hau inprimatu
    }

    echo "</table>"; // Taula itxi

    // Ez badago bat datorren emaitzarik, mezu bat inprimatu
    if ($lerroak === 0) {
        echo "<h5>Emaitzarik ez dago sartutako datuekin</h5>";
    }

    // Datu-basearekin konexioa itxi
    $conn->close();
    ?>
</body>

</html>
