<?php
$servername = "localhost"; // Zerbitzariaren izena
$username = "root"; // Erabiltzaile izena
$password = "1MG2024"; // Pasahitza
$dbname = "ml_4entrega"; // Datu-basearen izena

// Konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioan errorea dagoen egiaztatu
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error); // Errore-mezua erakutsi eta exekuzioa gelditu
}

// Formularioaren balioak jasotzea (GET metodoaren bidez)
$izena = isset($_GET["izena"]) ? $_GET["izena"] : ''; // "Izena" parametroa, hutsik badago, lehenetsitako balioa hutsune bat da
$mota = isset($_GET["mota"]) ? $_GET["mota"] : ''; // "Mota" parametroa
$prezioa = isset($_GET["prezioa"]) ? $_GET["prezioa"] : ''; // "Prezioa" parametroa
?>

<html>

<head>
    <title>Txertatu</title> <!-- Orrialdearen izenburua -->
    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif; /* Letra-tipoa definitzen du */
        }

        form {
            text-align: center; /* Formularioaren testua erdigunean kokatu */
            background-color: rgb(240, 239, 239); /* Atzeko kolorea */
            border-radius: 5px; /* Bukaera biribilduak */
            width: 30%; /* Zabalera definitu */
            margin: auto; /* Erdian kokatu */
            padding: 15px; /* Barruko tartea */
            box-shadow: 0px 0px 10px 4px lightblue; /* Itzala gehitu */
        }

        form>input,
        select,
        button {
            padding: 5px; /* Kanpoaldeko tartea */
            vertical-align: super; /* Bertikalki lerrokatu */
            text-align: center; /* Testua erdigunean */
        }

        input[type="text"] {
            width: 100%; /* Zabalera osoa */
        }

        input[type="number"] {
            width: 100%; /* Zabalera osoa */
        }

        select {
            width: 100%; /* Zabalera osoa */
        }

        h1 {
            text-align: center; /* Izenburua erdigunean */
        }

        button {
            width: 40%; /* Botoiaren zabalera */
            height: 40px; /* Botoiaren altuera */
            background-color: rgb(29, 153, 175); /* Atzeko kolorea */
            color: white; /* Testuaren kolorea */
            border-radius: 5px; /* Bukaera biribilduak */
            border: none; /* Mugak kendu */
        }
    </style>
</head>

<body>
    <h1>Txertatu</h1> <!-- Orrialdearen izenburua -->
    <form method="GET" action="txertatu.php"> <!-- Formularioa, GET metodoarekin -->
        <label for="Izena">Izena:</label><br> <!-- Izena eremua -->
        <input type="text" name="izena" value="" /><br><br> <!-- Testu-sarrerako eremua -->
        <label for="Mota">Mota:</label><br> <!-- Mota aukeraketa -->
        <select name="mota"> <!-- Hautaketa zerrenda -->
            <option value="">Mota</option> <!-- Aukera lehenetsia -->
            <option value="Telefonoa">Telefonoa</option> <!-- Telefono aukera -->
            <option value="Tableta">Tableta</option> <!-- Tableta aukera -->
            <option value="Ordenagailua">Ordenagailua</option> <!-- Ordenagailua aukera -->
            <option value="Telebista">Telebista</option> <!-- Telebista aukera -->
            <option value="Aurikularrak">Aurikularrak</option> <!-- Aurikularrak aukera -->
            <option value="Bozgorailua">Bozgorailua</option> <!-- Bozgorailua aukera -->
            <option value="Kamera">Kamera</option> <!-- Kamera aukera -->
            <option value="Smart Device">Smart Device</option> <!-- Gailu adimentsua -->
            <option value="Smart Watch">Smart Watch</option> <!-- Erloju adimentsua -->
            <option value="Gamepad">Gamepad</option> <!-- Gamepad aukera -->
        </select><br><br>
        <label for="Prezioa">Prezioa (€):</label><br> <!-- Prezioa eremua -->
        <input input type="number" name="prezioa" step="any" min="0" /><br><br> <!-- Zenbakizko sarrera -->
        <button>Txertatu</button> <!-- Botoia -->
    </form>

    <?php
    // Balio guztiak hutsik badaude, exekuzioa gelditu
    if ($izena == '' & $mota == '' & $prezioa == '') {
        die; // Exekuzioa gelditu
    } else { 
        // Produktua gehitzeko SQL kontsulta
        $sql = "INSERT INTO produktuak (Izena, Mota, Prezioa) VALUES ('" . $izena . "','" . $mota . "','" . $prezioa . "')";
        if ($conn->query($sql) === TRUE) { // Kontsulta arrakastatsua bada
            echo "Erregistro berria sartu da!"; // Mezu positiboa erakutsi
        } else { // Errorea gertatu bada
            echo "Zerbaitek ez du funtzionatu: " . $sql . "<br>" . $conn->error; // Errore-mezua erakutsi
        }
        $conn->close(); // Konexioa itxi
    }
    echo "</body></html>"; // HTML orriaren bukaera
    header("Location: ./Ariketa7.php"); // Orrialde nagusira birbideratu
    die(); // Exekuzioa amaitu
    ?>
