<?php
$servername = "localhost"; // Zerbitzariaren izena definitzen da datu-basearekin konektatzeko
$username = "root"; // Datu-basearen erabiltzailearen izena
$password = "1MG2024"; // Datu-basearen pasahitza
$dbname = "ml_4entrega"; // Erabiliko den datu-basearen izena

$conn = new mysqli($servername, $username, $password, $dbname); // MySQL konexioa sortzen da

if ($conn->connect_error) { // Konexio erroreak egiaztatzen dira
    die("Ezin da konexioa egin. " . $conn->connect_error); // Errorea gertatuz gero, mezua erakusten da eta exekuzioa gelditzen da
}
$bilatu = isset($_GET["izenaBilatu"]) ? $_GET["izenaBilatu"] : ''; // GET metodoaren bidez bidalitako bilaketa-balioa gordetzen da

?>
<html>

<head>
    <title>2.Ariketa</title> 
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script> <!-- Ikonoak agertzeko script-a -->
    <link rel="stylesheet" href="css.css" /> 
    <style>
        *{
            font-family: Verdana, Geneva, Tahoma, sans-serif; /* Testuaren letra-mota definitzen da */
        }
        a:link {
            color: rgb(29, 153, 175); /* Esteken lehenetsitako kolorea */
            background-color: transparent;
            text-decoration: none; /* Azpimarra kenduta */
        }

        a:visited {
            color: rgb(160, 205, 212); /* Bisitatutako esteken kolorea */
            background-color: transparent;
            text-decoration: none; 
        }

        a:hover {
            color: rgb(16, 104, 119); /* Kurtsorea estekaren gainean dagoenean kolorea */
            background-color: transparent;
            text-decoration: underline; /* Azpimarra gehitzen da */
        }

        a:active {
            color: rgb(1, 214, 252); /* Esteka aktiboaren kolorea */
            background-color: transparent;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container"> <!-- Edukia biltzen duen container-a -->
        <form action="Ariketa2.php" method="GET"> <!-- Formularioa GET metodoarekin bidaltzeko -->
            <a href=""><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a> <!-- Produktu berriak gehitzeko ikonoa -->
            <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." /> <!-- Produktuaren izena bilatzeko input-a -->
            <select name="mota"> <!-- Produktuaren motaren zerrenda -->
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
        echo "<table>"; // Produktuen datuak bistaratuko diren taula srtu
        echo "<tr>";
        echo "  <th>ProduktuId</th>"; 
        echo "  <th>Izena</th>"; 
        echo "  <th>Mota</th>"; 
        echo "  <th>Prezioa (€)</th>"; 
        echo "  <th>Editatu</th>"; 
        echo "</tr>";

        $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak"; // Produktuak datu-basetik lortzeko eta hauek inprimatzko kontsulta
        $result = $conn->query($sql); // Kontsulta exekutatzen da eta emaitza gordetzen da
        $lerroak = 0; // Emaitzen lerroen kopurua zenbatzeko aldagaia
        if ($result->num_rows > 0) { // Emaitzak badaude, lerroak egiten dira
            while ($row = $result->fetch_assoc()) { // Emaitza bakoitza ateratzeko kode zatia
                if (str_contains(strtolower($row["Izena"]), strtolower($bilatu))) { // Izena bilatutakoarekin bat datorren egiaztapena
                    echo "<tr>"; // Lerro berria sortzeko taulan
                    echo "<td>" . $row["ProduktuID"] . "</td>"; // Produktuaren IDa begistaratzeko kode zatia
                    echo "<td>" . $row["Izena"] . "</td>"; // Produktuaren izena begistaratzeko kode zatia
                    echo "<td>" . $row["Mota"] . "</td>"; // Produktuaren mota begistaratzeko kode zatia
                    echo "<td>" . $row["Prezioa"] . "</td>"; // Produktuaren prezioa begistaratzeko kode zatia
                    echo "<td><a href=''><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>"; // Editatzeko eta ezabatzeko estekak eta ikonoak
                    echo "</tr>";
                    $lerroak++; // Lerroen kopurua handitzeko
                }
            }
        } else {
            echo "0 results"; // Emaitzarik ez badago, mezu hura inprimatzen du
        }
        echo "</table>"; // Taula amaitzeko kodea
        if($lerroak===0){ // Lerroen kopurua 0 bada, mezu hura begistaratzeko kodea
        echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
        }
        $conn->close(); // Konexioa itxi

        ?>
    </div>
</body>

</html>
