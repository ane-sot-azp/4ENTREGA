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

?>
<html>

<head>
    <title>1.Ariketa</title> <!-- web orrian agertuko den izenburua -->
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script> <!-- ikonoen liburutegiak kargatzen ditu -->
    <link rel="stylesheet" href="css.css" /> <!-- css-artxiborako esteka, estiloak aplikatzeko -->
    <style>
        /* horri honetarako css estiloa */
        *{
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
        <form> <!-- produktuak bilatzeko formularioa -->
            <a href=""><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a> <!-- plus ikonoa -->
            <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." /> <!-- textu inputa produktuak bilatzeko -->
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
        if ($result->num_rows > 0) { //emaitz guztiak inprimatzeaz zihurtatzen da
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ProduktuID"] . "</td>"; //produktuen id-a inprimatzen du
                echo "<td>" . $row["Izena"] . "</td>"; //produktuen izena inprimatzen du
                echo "<td>" . $row["Mota"] . "</td>"; //produktuen mota inprimatzen du
                echo "<td>" . $row["Prezioa"] . "</td>"; //produktuen prezioa inprimatzen du
                echo "<td><a href=''><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>"; //produktuak editatu eta ezabatzeko ikonoak inprimatzen ditu
                echo "</tr>";
            }
        }
        $conn->close(); //datu baseekin egindako konexioa isten du
        ?>
    </div>
</body>

</html>