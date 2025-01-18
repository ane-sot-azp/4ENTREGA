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


$izena = isset($_GET["izena"]) ? $_GET["izena"] : ''; //$izena aldagaian gordetzen da get metodoan bidalitako balioa eta hutsik badago ' ' hutsunean gordetzen da
$mota = isset($_GET["mota"]) ? $_GET["mota"] : ''; //$mota aldagaian gordetzen da get metodoan bidalitako balioa eta hutsik badago ' ' hutsunean gordetzen da
$prezioa = isset($_GET["prezioa"]) ? $_GET["prezioa"] : ''; //$prezioa aldagaian gordetzen da get metodoan bidalitako balioa eta hutsik badago ' ' hutsunean gordetzen da

?>
<html>

<head>
    <title>Txertatu</title> <!-- web orriaren izenburua -->
    <style> /* css estiloa aplikatzen da */
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        form {
            text-align: center;
            background-color: rgb(240, 239, 239);
            border-radius: 5px;
            width: 30%;
            margin: auto;
            padding: 15px;
            box-shadow: 0px 0px 10px 4px lightblue;
        }

        form>input,
        select,
        button {
            padding: 5px;
            vertical-align: super;
            text-align: center;
        }

        input[type="text"] {
            width: 100%;
        }

        input[type="number"] {
            width: 100%;
        }

        select {
            width: 100%;
        }

        h1 {
            text-align: center;
        }

        button {
            width: 40%;
            height: 40px;
            background-color: rgb(29, 153, 175);
            color: white;
            border-radius: 5px;
            border: none;
        }
    </style>
</head>

<body>
    <h1>Txertatu</h1> <!-- txertatu izenburua idazten da -->
    <form method="GET" action="txertatu.php">  <!-- formularioa sortzen da get metodoarekin eta txertatu.php dokumentuan eragingo du -->
        <label for="Izena">Izena:</label><br> <!-- izena inputarentzako label a -->
        <input type="text" name="izena" value="" /><br><br> <!-- text motako inputa izena idazteko -->
        <label for="Mota">Mota:</label><br> <!-- label a mota inpurarentzako -->
        <select name="mota"> <!-- select bat hainbat aukerarekin -->
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
        </select><br><br>
        <label for="Prezioa">Prezioa (€):</label><br> <!-- prezioaren inputarentzako label a -->
        <input input type="number" name="prezioa" step="any" min="0" /><br><br> <!-- zenbaki input bat prezioak gordetzeko -->
        <button>Txertatu</button> <!-- botoia datuak bidaltzeko -->
    </form>

    <?php
    if ($izena == '' & $mota == '' & $prezioa == '') { // barneko hiru parametroak hutsak badira eragiketa bukatuko da
        die;
    } else { //hiru parametroak zerbait badute else barnekoa exekutatuko da
        $sql = "INSERT INTO produktuak (Izena, Mota, Prezioa) VALUES ('" . $izena . "','" . $mota . "','" . $prezioa . "')"; //sql eragiketa bat egingo da formularioan sartutako baloreak datu baseetan exekutazeko
        if ($conn->query($sql) === TRUE) { //konexioa zuzena bada eta eragiketa gauzatzen bada echo barnekoa inprimatuko da
            echo "Erregistro berria sartu da!";
        } else { //eragiketan errore bat badago errorea inprimatuko da
            echo "Zerbaitek ez du funtzionatu: " . $sql . "<br>" . $conn->error;
        }
        $conn->close(); //datu baseekin konexioa itxiko da

    echo "</body></html>"; //html eta body a itxiko dira
    header("Location: ./Ariketa7.php"); //Ariketa7.phpra bueltatuko da
    die(); //eragiketa itxiko da
    ?>