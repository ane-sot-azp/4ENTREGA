<?php
// Datu-basearen konexiorako beharrezko datuak

$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml_4entrega";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}// GET metodoaren bidez jasotako parametroak eskuratu; ez badaude, lehenetsi hutsa

$bilatu = isset($_GET["izenaBilatu"]) ? $_GET["izenaBilatu"] : '';
$mota = isset($_GET["mota"]) ? $_GET["mota"] : '';

?>
<html>

<head>
    <title>4.Ariketa</title>
            <!--  ikonoak erabiltzeko -->

    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script>
            <!-- Kanpoko CSS fitxategia lotzen du -->

    <link rel="stylesheet" href="css.css" />
    <style>
        *{                        /* Orri osoan erabiliko den letra-tipoa */

            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        a:link {
                                    /* Erabili behar diren estilo ezberdinak */

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
                                            <!-- Bilaketa formularioa -->

        <form action="Ariketa4.php" method="GET">
            <a href=""><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a>
                                                                <!-- produktuaren izena bilatzeko -->

            <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." />
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
                                    <!-- Bilatu botoia -->

            <button>Bilatu</button>
        </form>
        <?php
                        // Taula HTML sortzen du datuak erakusteko

        echo "<table>";
        echo "<tr>";
        echo "  <th>ProduktuId</th>";
        echo "  <th>Izena</th>";
        echo "  <th>Mota</th>";
        echo "  <th>Prezioa (€)</th>";
        echo "  <th>Editatu</th>";
        echo "</tr>";
        // SQL  produktuen datuak lortzeko

        $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak";
                    // SQL kontsulta exekutatu eta emaitza gordetzen du

        $result = $conn->query($sql);
                    // lerroaren zenbaketa asi

        $lerroak = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                                    //emaitzak agertzen dira

                if (str_contains(strtolower($row["Izena"]), strtolower($bilatu)) && str_contains(strtolower($row["Mota"]), strtolower($mota))) {
                    echo "<tr>";
                    echo "<td>" . $row["ProduktuID"] . "</td>"; //Produktu id
                    echo "<td>" . $row["Izena"] . "</td>";  //izena
                    echo "<td>" . $row["Mota"] . "</td>"; //mota
                    echo "<td>" . $row["Prezioa"] . "</td>";  //prezioa
                                                                            // Editatzeko eta ezabatzeko ikonoak

                    echo "<td><a href=''><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>";
                    echo "</tr>";
                    $lerroak++;  // Emaitza zenbatu
                }
            }
        } else {
            echo "0 results";
                                                    // Datu-baseak ez badu daturik itzuli

        }
        echo "</table>";
        if ($lerroak === 0) {
             // Emaitzarik aurkitu ez bada erabiltzaileari adierazten zaio
            echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
        }
        $conn->close();

        ?>
    </div>
</body>

</html>