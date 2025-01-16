<?php
$servername = "localhost"; //base datuen zerbitzariaren izena
$username = "root"; //datu baseetako erabiltzailearen izena 
$password = "1MG2024"; //datu baseetako pasahitza
$dbname = "ml_4entrega"; //datu basearen izena

// datu baseekin konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// konexioan errore bat dagoen begiratu
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}
$bilatu = isset($_GET["izenaBilatu"]) ? $_GET["izenaBilatu"] : ''; //izenaBilatu parametroa GET metodoan bidali den ala ez egiaztatzen du, bidali bada, $bilatu aldagaiean gordetzen da, eta bidali ez bada, ' ' hutsa gordetzen du $bilatu aldagaian
$mota = isset($_GET["mota"]) ? $_GET["mota"] : ''; //mota parametroa GET metodoan bidali den ala ez egiaztatzen du, bidali bada, $mota aldagaiean gordetzen da, eta bidali ez bada, ' ' hutsa gordetzen du $mota aldagaian
?>
<html>

<head>
    <title>6.Ariketa</title> <!-- web orrian agertuko den izenburua -->
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script>
    <!-- ikonoen liburutegiak kargatzen ditu -->
    <link rel="stylesheet" href="css.css" /> <!-- css-artxiborako esteka, estiloak aplikatzeko -->
    <style>
        /* horri honetarako css estiloa */
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
    <form action="Ariketa6.php" method="GET"> <!-- produktuak bilatzeko formularioa -->
        <a href="txertatu.php"><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a>
        <!-- produktuak gehitzeko ikonoa zapaltzean, txertatu.php-ra eramaten zaitu-->
        <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." />
        <!-- textu inputa produktuak bilatzeko -->
        <select name="mota"> <!-- hainbat aukera dituen inputa -->
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
        <button>Bilatu</button> <!-- bilaketa egiteko botoia -->
    </form>
    <?php
    echo "<table>"; //produktuak erakusteko taula sortzen da
    echo "<tr>";
    echo "  <th>ProduktuId</th>"; //produktuen id-en zutabeen izenburua
    echo "  <th>Izena</th>"; //produktuen izenen zutabearen izenburua
    echo "  <th>Mota</th>"; //produktuen motaren zutabearen izenburua
    echo "  <th>Prezioa (€)</th>"; //produktuen prezioaren zutabeen izenburua
    echo "  <th>Editatu</th>"; //produktuen edizioa edo ezabatzea egiteko zutabearen izenburua
    echo "</tr>";

    $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak"; //produktuak datu basetik erakusteko kontsulta
    $result = $conn->query($sql); //kontsulta ejekutatu eta emaitza gordetzen du $result aldagaiean
    $lerroak = 0; //lerroak zenbatzen dituen aldagaia sortzen da
    if ($result->num_rows > 0) { //emaitz guztiak inprimatzeaz zihurtatzen da
        while ($row = $result->fetch_assoc()) { //emaitzen lerroak inprimatzeaz zihurtatzen den buklea
            if (str_contains(strtolower($row["Mota"]), strtolower($bilatu))) { //datu baseetan dugun mota eta $bilatu parametroan gorde dugun mota berdinak badira, if barnekoa exekutatuko da mota horren lerroarekin
                echo "<tr>"; //lerro berria sortzen du taulan
                echo "<td>" . $row["ProduktuID"] . "</td>"; //lerroan bilatutako produktuaren id-a inprimatzen du
                echo "<td>" . $row["Izena"] . "</td>"; //lerroan bilatutako produktuaren izena inprimatzen du
                echo "<td>" . $row["Mota"] . "</td>"; //lerroan bilatutako produktuaren mota inprimatzen du
                echo "<td>" . $row["Prezioa"] . "</td>"; ////lerroan bilatutako produktuaren prezioa inprimatzen du
                echo "<td><a href='editatu.php/?id=" . $row["ProduktuID"] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>";
                //editatzeko eta ezabatzeko ikonoak inprimatzen ditu, editatzearen ikonoa zapalduz gero, editatu.php fitxategira bidalduko dizu eta aukeratutako lerroko PruktuIda ere bidalduko du
                echo "</tr>";
                $lerroak++; //lerroen kontadorean +1 egiten da
            }
        }
    } else {
        echo "0 results"; //bilatutakoarekin bat datorren emaitzarik ez badago, '0 results' inprimatzen du
    }
    echo "</table>"; //taula isten du 
    if ($lerroak === 0) { //lerroen kontagailua 0n geratzen bada, bilatutakoarekin bat datorren emaitzarik ez dagoela inprimatuko du
        echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
    }
    $conn->close(); //datu baseekin konexioa itxiko da
    

    ?>
    </div>
</body>

</html>