<?php
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml_4entrega";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}

$produktuid = isset($_GET['id']) ? $_GET['id'] : 0;
$izena_berezi = $mota_berezi = $prezioa_berezi = "";

if ($produktuid) {
    $sql1 = "SELECT Izena, Mota, Prezioa FROM produktuak WHERE ProduktuID =" . $produktuid . "";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $izena_berezi = $row["Izena"];
            $mota_berezi = $row["Mota"];
            $prezioa_berezi = $row["Prezioa"];
        }
    }
}
?>
<html>

<head>
    <title>Editatu</title>
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
    <form method="GET" action="editatu.php">
        <input type="hidden" name="produktuida" value="<?php echo $produktuid ?>" />
        <label for="Izena">Izena:</label><br>
        <input type="text" name="izenaa" value="<?php echo $izena_berezi ?>" /><br><br>
        <label for="Mota">Mota:</label><br>
        <select name="motaa">
            <option value="<?php echo $mota_berezi ?>"><?php echo $mota_berezi ?></option>
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
        <input type="number" name="prezioaa" step="any" min="0" value="<?php echo $prezioa_berezi ?>" /><br><br>
        <button type="submit">Aldatu</button>
    </form>
    <?php
    $izenaa = isset($_GET["izenaa"]) ? $_GET["izenaa"] : '';
    $motaa = isset($_GET["motaa"]) ? $_GET["motaa"] : '';
    $prezioaa = isset($_GET["prezioaa"]) ? $_GET["prezioaa"] : '';
    $produktuida = isset($_GET['produktuida']) ? $_GET['produktuida'] : 0;
    if ($produktuida && ($izenaa || $motaa || $prezioaa)) {
        $sql = "UPDATE produktuak SET Izena='" . $izenaa . "', Mota='" . $motaa . "', Prezioa=" . $prezioaa . " WHERE ProduktuID=" . $produktuida . "";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../Ariketa7.php");
            die();
        } else {
            echo "Zerbaitek ez du funtzionatu: " . $conn->error;
            echo "<a href='/ML/4ENTREGA/Ariketa7.php'>Datu basera bueltatu</a>";
        }
    }
    $conn->close();
    echo "</body></html>";
    ?>