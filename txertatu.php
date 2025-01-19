<?php
// Datu-basea konektatzeko parametroak definitzen dira

$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml_4entrega";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}

// Formularioan sartutako balioak jasotzen dira, 'izena', 'mota' eta 'prezioa'

$izena = isset($_GET["izena"]) ? $_GET["izena"] : '';
$mota = isset($_GET["mota"]) ? $_GET["mota"] : '';
$prezioa = isset($_GET["prezioa"]) ? $_GET["prezioa"] : '';

?>
<html>

<head>
    <title>Txertatu</title>
    <style>
        * {
            font-family: Verdana,  Geneva, Tahoma;
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
    <h1>Txertatu</h1>
    <form method="GET" action="txertatu.php">
        <label for="Izena">Izena:</label><br>
        <input type="text" name="izena" value="" /><br><br>
        <label for="Mota">Mota:</label><br>
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
        </select><br><br>
        <label for="Prezioa">Prezioa (€):</label><br>
        <input input type="number" name="prezioa" step="any" min="0" /><br><br>
        <button>Txertatu</button>
    </form>

    <?php
        // Formularioan ez badira balioak sartu, script-a gelditzen da

    if ($izena == '' & $mota == '' & $prezioa == '') {
        die;
    } else {
        // SQL kontsulta prestatu, produktua txertatzeko
        // "Izena", "Mota" eta "Prezioa" balioak sartzen dira
        $sql = "INSERT INTO produktuak (Izena, Mota, Prezioa) VALUES ('" . $izena . "','" . $mota . "','" . $prezioa . "')";
        if ($conn->query($sql) === TRUE) {
            echo "Erregistro berria sartu da!";
        } else {
            echo "Zerbaitek ez du funtzionatu: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    echo "</body></html>";
        // Erregistroa sartu ondoren, erabiltzailea "Ariketa7.php" orrira bideratuko da

    header("Location: ./Ariketa7.php");
    die();
    ?>