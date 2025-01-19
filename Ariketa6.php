<?php
$servername = "localhost"; // Datu base zerbitzariaren izena gordetzen du
$username = "root"; // Datu basearen erabiltzailearen izena gordetzen du
$password = "1MG2024"; // Datu basearen pasahitza gordetzen du
$dbname = "ml_4entrega"; // Datu basearen izena gordetzen du

$conn = new mysqli($servername, $username, $password, $dbname); // Datu basearekin konexioa sortzen du

if ($conn->connect_error) { // Konexioan errore bat dagoen ala ez egiaztatzen du, eta balego mezua erakusten du
    die("Ezin da konexioa egin. " . $conn->connect_error); 
}
$bilatu = isset($_GET["izenaBilatu"]) ? $_GET["izenaBilatu"] : ''; // GET metodoaren bidez "izenaBilatu" balioa hartzen du edo ez du ezer gordetzen
$mota = isset($_GET["mota"]) ? $_GET["mota"] : ''; // GET metodoaren bidez "mota" balioa hartzen du edo ez du ezer gordetzen
?>
<html>

<head>
    <title>6.Ariketa</title> <!-- Webgunearen izenburua -->
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script>
    <!-- Ikonoak kargatzen dituen script -->
    <link rel="stylesheet" href="css.css" /> 
    <style>
        /* Orrialderako estilo orokorrak */
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        a:link {
            color: rgb(29, 153, 175);
            background-color: transparent;
            text-decoration: none;
        }

        a:visited {
            color: rgb(160, 205, 212);
            background-color: transparent;
            text-decoration: none;
        }

        a:hover {
            color: rgb(16, 104, 119);
            background-color: transparent;
            text-decoration: underline;
        }

        a:active {
            color: rgb(1, 214, 252);
            background-color: transparent;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form action="Ariketa6.php" method="GET"> <!-- Produktuen bilaketa egiteko formularioa GET-aren bidez -->
        <a href="txertatu.php"><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a>
        <!-- Produktu berriak gehitzeko ikonoa -->
        <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." />
        <!-- Bilaketarako testu-kutxa -->
        <select name="mota"> <!-- Produktu mota hautatzeko menua  -->
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
    echo "<table>"; // Taula bat sortzen du datuak erakusteko
    echo "<tr>";
    echo "  <th>ProduktuId</th>";
    echo "  <th>Izena</th>";
    echo "  <th>Mota</th>";
    echo "  <th>Prezioa (€)</th>";
    echo "  <th>Editatu</th>";
    echo "</tr>";

    $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak"; // Produktuak begistaratzeko kontsulta
    $result = $conn->query($sql); // Kontsulta exekutatzen du eta emaitza gordetzen du
    $lerroak = 0; // Emaitza lerroen zenbaketa gordetzen duen aldagaia
    if ($result->num_rows > 0) { // Emaitzak badaude, exekutatzen da, bestela ez
        while ($row = $result->fetch_assoc()) { // Lerro bakoitza lortzen du
            if (str_contains(strtolower($row["Mota"]), strtolower($bilatu))) { // Mota bilatutakoarekin bat datorren konprobatzen du
                echo "<tr>"; // Lerro berri bat gehitzen du taulan
                echo "<td>" . $row["ProduktuID"] . "</td>"; // Produktuaren IDa begistaratzeko kodea
                echo "<td>" . $row["Izena"] . "</td>"; // Produktuaren izena begistaratzeko kodea
                echo "<td>" . $row["Mota"] . "</td>"; // Produktuaren mota begistaratzeko kodea
                echo "<td>" . $row["Prezioa"] . "</td>"; // Produktuaren prezioa begistaratzeko kodea
                echo "<td><a href='editatu.php/?id=" . $row["ProduktuID"] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>"; // Editatu eta ezabatu botoiak erakusten ditu
                echo "</tr>";
                $lerroak++; // Lerroen zenbaketa handitzen du
            }
        }
    } else {
        echo "0 results"; // Emaitzarik ez badago mezua erakusten du
    }
    echo "</table>"; // Taula itxi egiten du
    if ($lerroak === 0) { // Lerroak 0 badira, mezu bat inprimatzen du
        echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
    }
    $conn->close(); // Konexioa datu basearekin itxi
    ?>
    </div>
</body>

</html>