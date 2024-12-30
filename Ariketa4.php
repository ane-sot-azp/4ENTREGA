<?php
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
$bilatu = isset($_GET["izenaBilatu"]) ? $_GET["izenaBilatu"] : '';
$mota = isset($_GET["mota"]) ? $_GET["mota"] : '';

?>
<html>

<head>
    <title>4.Ariketa</title>
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.css" />
    <style>
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
        <form action="Ariketa4.php" method="GET">
            <a href=""><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a>
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
            <button>Bilatu</button>
        </form>
        <?php
        echo "<table>";
        echo "<tr>";
        echo "  <th>ProduktuId</th>";
        echo "  <th>Izena</th>";
        echo "  <th>Mota</th>";
        echo "  <th>Prezioa (€)</th>";
        echo "  <th>Editatu</th>";
        echo "</tr>";

        $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak";
        $result = $conn->query($sql);
        $lerroak = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (str_contains(strtolower($row["Izena"]), strtolower($bilatu)) && str_contains(strtolower($row["Mota"]), strtolower($mota))) {
                    echo "<tr>";
                    echo "<td>" . $row["ProduktuID"] . "</td>";
                    echo "<td>" . $row["Izena"] . "</td>";
                    echo "<td>" . $row["Mota"] . "</td>";
                    echo "<td>" . $row["Prezioa"] . "</td>";
                    echo "<td><a href=''><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>";
                    echo "</tr>";
                    $lerroak++;
                }
            }
        } else {
            echo "0 results";
        }
        echo "</table>";
        if ($lerroak === 0) {
            echo "<h5>Ez dago emaitzarik datu horiekin</h5>";
        }
        $conn->close();

        ?>
    </div>
</body>

</html>