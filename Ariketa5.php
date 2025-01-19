<?php
$servername = "localhost"; // Datu-basearen zerbitzariaren izena
$username = "root"; // Datu-basearen erabiltzaile izena
$password = "1MG2024"; // Datu-basearen pasahitza
$dbname = "ml_4entrega"; // Datu-basearen izena

// Datu-basearekin konexioa sortzen du
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioan errorea dagoen egiaztatzen du, eta errorea ematen badu mezua inprimatu
if ($conn->connect_error) {
    die("Ezin izan da konexioa ezarri: " . $conn->connect_error);
}

// 'izenaBilatu' parametroa jaso eta aldagai batean gordetzen du
$bilatu = isset($_GET["izenaBilatu"]) ? $_GET["izenaBilatu"] : '';

// 'mota' parametroa jaso eta aldagai batean gordetzen du
$mota = isset($_GET["mota"]) ? $_GET["mota"] : '';
?>
<html>

<head>
    <title>5.Ariketa</title> 
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script>
    <!-- Ikonoen liburutegia gehitzen du -->
    <link rel="stylesheet" href="css.css" /> <!-- Estiloak gehitzeko CSS fitxategia lotzen du -->
    <style>
        /* Orrialdearen estiloak definitzen ditu */
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
        <!-- Produktuen bilaketa egiteko formularioa GET-aren bidez -->
        <form action="Ariketa5.php" method="GET">
            <!-- Produktuak gehitzeko ikonoa gehitu -->
            <a href="txertatu.php"><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a>
            <!-- Bilatzeko input-a definitu -->
            <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." />
            <!-- Mota aukeratzeko zerrenda -->
            <select name="mota">
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
            <!-- Produktuak bilatzekon botoia -->
            <button>Bilatu</button>
        </form>
        <?php

        // Produktuak erakusteko taula sortu
        echo "<table>";
        echo "<tr>";
        echo "  <th>ProduktuId</th>"; 
        echo "  <th>Izena</th>"; /
        echo "  <th>Mota</th>"; 
        echo "  <th>Prezioa (€)</th>"; 
        echo "  <th>Editatu</th>"; 
        echo "</tr>";

        // Datu-basean bilaketa egiteko kontsulta prestatu
        $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak";
        // Kontsulta exekutatu eta emaitzak gordetzen ditu
        $result = $conn->query($sql);
        // Lerro kopurua zenbatzeko aldagai bat sortzen da
        $lerroak = 0;
        if ($result->num_rows > 0) {
            // Emaitzen lerro bakoitza irakurri eta inprimatzen du
            while ($row = $result->fetch_assoc()) {
                // Mota eta bilatutako balioa konparatzen ditu
                if (
                    str_contains(strtolower($row["Mota"]), strtolower($mota)) &&
                    str_contains(strtolower($row["Izena"]), strtolower($bilatu))
                ) {
                    // Lerro berria gehitzen du taulan
                    echo "<tr>";
                    echo "<td>" . $row["ProduktuID"] . "</td>"; // Produktuaren IDa begistaratzeko kodea
                    echo "<td>" . $row["Izena"] . "</td>"; // Produktuaren izena begistaratzeko kodea
                    echo "<td>" . $row["Mota"] . "</td>"; // Produktuaren mota begistaratzeko kodea
                    echo "<td>" . $row["Prezioa"] . "</td>"; // Produktuaren prezioa begistaratzeko kodea
                    echo "<td><a href=''><i class='fa fa-pencil' aria-hidden='true'></i></a>
                          <a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>";
                    // Editatu eta ezabatzeko aukerak
                    echo "</tr>";
                    $lerroak++; // Lerro kopurua handitzen du
                }
            }
        } else {
            // Ez bada emaitzarik aurkitzen, mezua inprimatzen du
            echo "0 results";
        }
        // Taula amaitzen du
        echo "</table>";
        // Lerro kopurua 0 bada, mezua inprimatzen du
        if ($lerroak === 0) {
            echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
        }
        // Datu-basearekin konexioa itxi
        $conn->close();

        ?>
    </div>
</body>

</html>