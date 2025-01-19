<?php
$servername = "localhost"; // Datu basearen zerbitzariaren izena definitzen da
$username = "root"; // Datu basearen erabiltzaile izena definitzen da
$password = "1MG2024"; // Datu basearen pasahitza definitzen da
$dbname = "ml_4entrega"; // Erabiliko den datu basearen izena

// Zerbitzariarekin eta datu basearekin konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioan erroreak badaude, mezu bat inprimatzen da eta prozesua gelditzen da
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}
$bilatu = isset($_GET["mota"]) ? $_GET["mota"] : ''; // GET parametroan "mota" dagoen egiaztatzen da, eta ez badago, ez da ezer gordetzen

?>
<html>

<head>
    <title>3.Ariketa</title> 
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script> <!-- Ikonoen liburutegia kargatzeko script-a -->
    <link rel="stylesheet" href="css.css" /> <!-- CSS estiloen artxiboa gehitzen da -->
    <style>
        /* Orriaren estilo orokorrak */
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
    <div class="container">
        <form action="Ariketa3.php" method="GET"> <!-- Produktuak bilatzeko formularioa GET-en bidez lortzeko -->
            <a href=""><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a> <!-- Produktu berriak gehitzeko ikonoa -->
            <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." /> <!-- Testua izenaren arabera bilatzeko input-a -->
            <select name="mota"> <!-- Produktu mota aukeratzeko zerrenda -->
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
        echo "<table>"; // Taula berri bat sortzen da produktu datuak erakusteko
        echo "<tr>"; // Taularen goiburuko errenkada
        echo "  <th>ProduktuId</th>"; 
        echo "  <th>Izena</th>"; 
        echo "  <th>Mota</th>"; 
        echo "  <th>Prezioa (€)</th>"; 
        echo "  <th>Editatu</th>"; 
        echo "</tr>";

        $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak"; // Produktuak lortzeko kontsulta
        $result = $conn->query($sql); // Kontsulta exekutatu eta emaitzak lortzen dira
        $lerroak = 0; // Lerroen zenbaketa hasteko hasierako balioañllllllllllllllllllllllll.-
        if ($result->num_rows > 0) { // Emaitzarik badagoen egiaztatzeko kode zatia
            while ($row = $result->fetch_assoc()) { // Emaitza bakoitza lerroka prozesatzen da
                if (str_contains(strtolower($row["Mota"]), strtolower($bilatu))) { // "Mota" datua bilaketarekin bat datorren kode zatia
                    echo "<tr>"; // Errenkada berri bat gehitzen da
                    echo "<td>" . $row["ProduktuID"] . "</td>"; // Produktuaren IDa begistaratzen da
                    echo "<td>" . $row["Izena"] . "</td>"; // Produktuaren izena begistaratzen da
                    echo "<td>" . $row["Mota"] . "</td>"; // Produktuaren mota begistaratzen da
                    echo "<td>" . $row["Prezioa"] . "</td>"; // Produktuaren prezioa begistaratzen da
                    echo "<td><a href=''><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>"; // Editatzeko eta ezabatzeko ikonoak gehitzen dira
                    echo "</tr>"; // Errenkada itxi
                    $lerroak++; // Lerroak gehitzen dira
                }
            }
        } else {
            echo "0 results"; // Emaitzarik ez badago, mezua erakusten da
        }
        echo "</table>"; // Taula ixtea
        if ($lerroak === 0) { // Errenkada kopurua 0 bada, mezua inprimatzen da
            echo "<h5>Ez dago emaitzarik datu horiekin</h5>"; 
        }
        $conn->close(); // Datu basearen konexioa itxi

        ?>
    </div>
</body>

</html>
