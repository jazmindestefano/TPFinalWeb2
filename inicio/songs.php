<?php
$servername = "localhost";
$username = "root";
$dbname = "labanda";
$password = "";

// Create connection
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM canciones";
$result = mysqli_query($conn, $sql);

$canciones = Array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $cancion = Array();
        $cancion['idCancion'] =  $row["idCancion"];
        $cancion['nombre'] =  $row["nombre"];
        $cancion['duracion'] =  $row["duracion"];
        $canciones[] = $cancion;
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="index.php" class="w3-bar-item w3-button w3-padding-large">La banda</a>
        <a href="songs.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Canciones</a>
        <a href="tours.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Presentaciones</a>
    </div>
</div>


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- The Band Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
        <h2 class="w3-wide">Canciones</h2>
        <table class="w3-table">
            <tr>
                <th>Cancion</th>
                <th>duracion</th>
                <th>reproducir</th>
            </tr>

            <?php
                foreach ( $canciones as $cancion){
                    echo   "<tr>
                                <td>" . $cancion['nombre'] . "</td>
                                <td>" . $cancion['duracion'] . "</td>
                                <td> Reproducir </td>
                            </tr>";
                }
            ?>
        </table>
    </div>

    <!-- End Page Content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
</footer>

</body>
</html>
