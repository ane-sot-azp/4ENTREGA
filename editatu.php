<?php
$servername = "localhost"; // Datu-basearen zerbitzariaren izena
$username = "root"; // Datu-basearen erabiltzailearen izena
$password = "1MG2024"; // Datu-basearen pasahitza
$dbname = "ml_4entrega"; // Datu-basearen izena

// Datu-basearekin konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioan errorea dagoen egiaztatu
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}

// Produktuaren ID-a lortu GET metodoaren bidez
$produktuid = isset($_GET['id']) ? $_GET['id'] : 0; // IDa ez badago, balio lehenetsia 0 izango da
$izena_berezi = $mota_berezi = $prezioa_berezi = ""; // Erabiltzailea editatzen ari den produktua gordetzeko aldagaiak

// Produktu bat aukeratuta badago (IDarekin), haren datuak datu-basetik lortu
if ($produktuid) {
    $sql1 = "SELECT Izena, Mota, Prezioa FROM produktuak WHERE ProduktuID =" . $produktuid . ""; // Produktua bilatzeko SQL kontsulta
    $result1 = $conn->query($sql1); // Kontsulta exekutatu
    if ($result1->num_rows > 0) { // Produktua aurkitzen bada
        while ($row = $result1->fetch_assoc()) { // Produktuaren datuak lortu eta aldagaietan gorde
            $izena_berezi = $row["Izena"];
            $mota_berezi = $row["Mota"];
            $prezioa_berezi = $row["Prezioa"];
        }
    }
}
?>
<html>

<head>
    <title>Editatu</title> <!-- Orrialdearen izenburua -->
    <style>
        /* Estiloak definitzen dira */
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
            width: 100%; /* Testu-eremuen zabalera */
        }

        input[type="number"] {
            width: 100%; /* Zenbakien zabalera */
        }

        select {
            width: 100%; /* Aukera-eremuen zabalera */
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
    <h1>Editatu</h1> <!-- Orrialdearen goiburua -->
    <!-- Produktuaren datuak editatzeko formularioa -->
    <form method="GET" action="editatu.php">
        <input type="hidden" name="produktuida" value="<?php echo $produktuid ?>" /> <!-- Produktuaren ID-a gordetzeko ezkutuko eremua -->
        <label for="Izena">Izena:</label><br> <!-- Izena etiketa -->
        <input type="text" name="izenaa" value="<?php echo $izena_berezi ?>" /><br><br> <!-- Produktuaren izena -->
        <label for="Mota">Mota:</label><br> <!-- Mota etiketa -->
        <select name="motaa"> <!-- Produktuaren mota aukeratzeko eremua -->
            <option value="<?php echo $mota_berezi ?>"><?php echo $mota_berezi ?></option> <!-- Hautatutako produktuaren mota lehenetsita agertu -->
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
        <label for="Prezioa">Prezioa (€):</label><br> <!-- Prezioa etiketa -->
        <input type="number" name="prezioaa" step="any" min="0" value="<?php echo $prezioa_berezi ?>" /><br><br> <!-- Produktuaren prezioa -->
        <button type="submit">Aldatu</button> <!-- Produktuaren datuak aldatu botoia -->
    </form>

    <?php
    // Formularioaren bidez bidalitako datuak lortu
    $izenaa = isset($_GET["izenaa"]) ? $_GET["izenaa"] : ''; // Izena lortu
    $motaa = isset($_GET["motaa"]) ? $_GET["motaa"] : ''; // Mota lortu
    $prezioaa = isset($_GET["prezioaa"]) ? $_GET["prezioaa"] : ''; // Prezioa lortu
    $produktuida = isset($_GET['produktuida']) ? $_GET['produktuida'] : 0; // Produktuaren ID-a lortu

    // Produktuaren datuak aldatzeko egiaztatu eta kontsulta sortu
    if ($produktuida && ($izenaa || $motaa || $prezioaa)) { 
        $sql = "UPDATE produktuak SET Izena='" . $izenaa . "', Mota='" . $motaa . "', Prezioa=" . $prezioaa . " WHERE ProduktuID=" . $produktuida . ""; // SQL eguneratze kontsulta
        if ($conn->query($sql) === TRUE) { // Kontsulta arrakastatsua bada
            header("Location: ../Ariketa7.php"); // Produktuen orrira itzuli
            die(); // Exekuzioa gelditu
        } else { // Kontsultan errorea badago
            echo "Zerbaitek ez du funtzionatu: " . $conn->error; // Errore-mezua erakutsi
            echo "<a href='/ML/4ENTREGA/Ariketa7.php'>Datu basera bueltatu</a>"; // Orri nagusira itzultzeko esteka
        }
    }

    $conn->close(); // Datu-basearekiko konexioa itxi
    echo "</body></html>"; // HTML itxi
?>
