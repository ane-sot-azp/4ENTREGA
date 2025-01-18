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

$produktuid = isset($_GET['id']) ? $_GET['id'] : 0; //id parametroa GET metodoan bidali bada, $produktuakid aldagaiean gordetzen da, eta ez bada ezer bidaltzen, 0 balorea emango zaio aldagaiari
$izena_berezi = $mota_berezi = $prezioa_berezi = ""; // lerroko aldagaiak hutsak uzten ditu

if ($produktuid) { //produktuak id aldagaia badago, if barnekoa exekutatuko da
    $sql1 = "SELECT Izena, Mota, Prezioa FROM produktuak WHERE ProduktuID =" . $produktuid . ""; //sql eskaera bat egiten da, editatu ikonoa zapaldu dugun lerroko produktuaren idarekin
    $result1 = $conn->query($sql1); //eskaera $result1 aldagaiean gordetzen da
    if ($result1->num_rows > 0) { //fila guztiak inprimatzeko kondizioa sortzen da
        while ($row = $result1->fetch_assoc()) {  //emaitzen lerroak inprimatzeaz zihurtatzen den kondizioa
            $izena_berezi = $row["Izena"]; //$izena_berezi aldagaiari aukeratutako produktuaren idaren datu basetako izena ezartzen zaio
            $mota_berezi = $row["Mota"]; //$mota_berezi aldagaiari aukeratutako produktuaren idaren datu baseetako mota ezartzen zaio
            $prezioa_berezi = $row["Prezioa"]; //$prezioa_berezi aldagaiari aukeratutako produktuaren idaren prezioa ezartzen zaio
        }
    }
}
?>
<html>

<head>
    <title>Editatu</title> <!-- web orriak izango duen titulua idazten da -->
    <style>
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
    <h1>Editatu</h1>
    <form method="GET" action="editatu.php"> <!-- produktuak editatzeko formularioa -->
        <input type="hidden" name="produktuida" value="<?php echo $produktuid ?>" /> <!-- produktuid aldagaiak gorde duen balorea erakusten duen input bat -->
        <label for="Izena">Izena:</label><br> <!-- izena inputaren label a -->
        <input type="text" name="izenaa" value="<?php echo $izena_berezi ?>" /><br><br> <!-- text motako input bat eta bertan $izen_berezia aldagaiak gorde duen balorea inprimatua -->
        <label for="Mota">Mota:</label><br> <!-- mota inputaren label a -->
        <select name="motaa"> <!-- selct bat mota aukera guztiekin -->
            <option value="<?php echo $mota_berezi ?>"><?php echo $mota_berezi ?></option> <!-- defektuz, mota_berezi aldagaiak gorde duen balorea erakutsiko du -->
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
        <label for="Prezioa">Prezioa (€):</label><br> <!-- prezioa inputaren label a -->
        <input type="number" name="prezioaa" step="any" min="0" value="<?php echo $prezioa_berezi ?>" /><br><br> <!-- defektuz prezioa_berezi aldagaiaren balorea erakusten duen input bat -->
        <button type="submit">Aldatu</button>
    </form>
    <?php
    $izenaa = isset($_GET["izenaa"]) ? $_GET["izenaa"] : ''; //$izenaa aldagaiari get metodoan bidali den balorea ezartzen zaio eta hutsa bada ' ' hutsunea ezartzen zaio
    $motaa = isset($_GET["motaa"]) ? $_GET["motaa"] : ''; //$motaa aldagaiari get metodoan bidali den balorea ezartzen zaio eta hutsa bada ' ' hutsunea ezartzen zaio
    $prezioaa = isset($_GET["prezioaa"]) ? $_GET["prezioaa"] : ''; //$prezioaa aldagaiari get metodoan bidali den balorea ezartzen zaio eta hutsa bada ' ' hutsunea ezartzen zaio
    $produktuida = isset($_GET['produktuida']) ? $_GET['produktuida'] : 0; //$produktuida aldagaiari get metodoan bidali den balorea ezartzen zaio eta hutsa bada ' ' hutsunea ezartzen zaio
    if ($produktuida && ($izenaa || $motaa || $prezioaa)) { //idatzitako lau aldagaiek balorea badute, if barnekoa exekutatuko da
        $sql = "UPDATE produktuak SET Izena='" . $izenaa . "', Mota='" . $motaa . "', Prezioa=" . $prezioaa . " WHERE ProduktuID=" . $produktuida . ""; //sql kontsulta bat egiten da, sartutako balore berriekin datu baseetan aukeratutako lerroko idaren lerroan update bat egiteko
        if ($conn->query($sql) === TRUE) {// ariketa gauzatzen bada Ariketa7.php ra bidaltzen dizu
            header("Location: ../Ariketa7.php");
            die();
        } else { //errore bat badago, errorea inprimatuko du eta Ariketa7.php ra bidalduko dizu
            echo "Zerbaitek ez du funtzionatu: " . $conn->error;
            echo "<a href='/ML/4ENTREGA/Ariketa7.php'>Datu basera bueltatu</a>";
        }
    }
    $conn->close(); //datu baseekin konexioa itxiko da 
    echo "</body></html>"; //body eta htmla itxiko dira
    ?>