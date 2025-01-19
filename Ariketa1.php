<?php
$servername = "localhost"; // Zerbitzariaren izena definitzen da
$username = "root"; // Erabiltzailearen izena definitzen da
$password = "1MG2024"; //  My SQL-ren pasahitza definitzen da
$dbname = "ml_4entrega"; // Datu-basearen izena definitzen da

// Konexioa sortzen da datu-basearekin
$conn = new mysqli($servername, $username, $password, $dbname); 

// Konexioa huts egiten badu, errorea erakusten da
if ($conn->connect_error) {
    die("Ezin da konexioa egin. " . $conn->connect_error);
}

?>
<html>

<head>
    <title>1.Ariketa</title> <!-- Orriaren izenburua definitzen da -->
    <script src="https://kit.fontawesome.com/83f15f6aab.js" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="css.css" /> 
    <style>
        
        *{
            font-family: Verdana, Geneva, Tahoma, sans-serif; /* Letra mota definitzen da */
        }
        a:link {
            color: rgb(29, 153, 175); /* Esteka kolore lehenetsia definitzen da */
            background-color: transparent;
            text-decoration: none; /* Azpimarra kentzen da */
        }

        a:visited {
            color: rgb(160, 205, 212); /* Bisitatutako estekaren kolorea definitzen da */
            background-color: transparent;
            text-decoration: none;
        }

        a:hover {
            color: rgb(16, 104, 119); /* Kurtsorea gainetik pasatzean estekaren kolorea aldatzen da */
            background-color: transparent;
            text-decoration: underline; /* Azpimarra gehitzen da */
        }

        a:active {
            color: rgb(1, 214, 252); /* Aktibatuta dagoen estekaren kolorea definitzen da */
            background-color: transparent;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container"> <!-- Edukia biltzen duen div elementua -->
        <form>
            <a href=""><i class="fa fa-plus" aria-hidden="true" id="plus"></i></a> //Produktu berri bate gehitzeko ikonoa jarri ikonoa
            <input type="text" name="izenaBilatu" value="" placeholder="Produktuaren izena bilatu..." /> <!-- Produktua bilatzeko input-a -->
            <select name="mota"> <!-- Moten hautatzeko menua definitu -->
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
            <button>Bilatu</button> <!-- Bilatzeko botoia sortu -->
        </form>
        <?php
        echo "<table>"; // Taula sortzen da -->
        echo "<tr>";
        echo "  <th>ProduktuId</th>"; 
        echo "  <th>Izena</th>"; 
        echo "  <th>Mota</th>"; 
        echo "  <th>Prezioa (€)</th>"; 
        echo "  <th>Editatu</th>"; 
        echo "</tr>";
        //<--
        $sql = "SELECT ProduktuID, Izena, Mota, Prezioa FROM produktuak"; // Datu-basearen kontsulta prestatu
        $result = $conn->query($sql); // Kontsulta exekutatu
        if ($result->num_rows > 0) { // Erregistroak badaude,hauek bueltatzen ditu
            
            while ($row = $result->fetch_assoc()) { // Erregistro bakoitza prozesatu
                echo "<tr>";
                echo "<td>" . $row["ProduktuID"] . "</td>"; // Produktuaren ID-a begistaratzeko kodea
                echo "<td>" . $row["Izena"] . "</td>"; // Produktuaren izena begistaratzeko kodea
                echo "<td>" . $row["Mota"] . "</td>"; // Produktuaren mota begistaratzeko kodea
                echo "<td>" . $row["Prezioa"] . "</td>"; // Produktuaren prezioa begistaratzeko kodea
                echo "<td><a href=''><i class='fa fa-pencil' aria-hidden='true'></i></a><a href=''><i class='fa fa-trash' aria-hidden='true'></i></a><br></td>"; // Produktuak editatu eta ezabatzeko ikonoak jartzeko kode zatia
                echo "</tr>";
            }
        }
        $conn->close(); // Datu-basearen konexioa ixten da
        ?>
    </div>
</body>

</html>