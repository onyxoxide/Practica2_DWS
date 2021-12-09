<?php 
    // Variables para la conexión de la BD
    $server = 'localhost:3307';
    $user = 'root';
    $password = '';
    $bd = 'bdpractica2php';

    // Conexión con la BD
    $connection = mysqli_connect($server, $user, $password, $bd);

    // Mostramos si ha habido algún error
    if (mysqli_connect_error()) {
        die('Error de Conexion (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    }

    // Sentencia SELECT para sacar los regalos que entrega Melchor
    $sql_select = "SELECT nombreRegalo, precioRegalo, nombreNino, apellidosNino
    FROM reymago, regalos, ninos, piden
    WHERE reymago.idReyMago = regalos.idReyMagoFK LIKE '1'
    AND regalos.idRegalo = piden.idRegaloFK
    AND ninos.idNino = piden.idNinoFK;";
    $proyectos = $connection->query($sql_select);

    // Sentencia SELECT para sacar los regalos que entrega Gaspar
    $sql_select2 = "SELECT nombreRegalo, precioRegalo, nombreNino, apellidosNino
    FROM reymago, regalos, ninos, piden
    WHERE reymago.idReyMago = regalos.idReyMagoFK LIKE '2'
    AND regalos.idRegalo = piden.idRegaloFK
    AND ninos.idNino = piden.idNinoFK;";
    $proyectos2 = $connection->query($sql_select2);
    
    // Sentencia SELECT para sacar los regalos que entrega Melchor
    $sql_select3 = "SELECT nombreRegalo, precioRegalo, nombreNino, apellidosNino
    FROM reymago, regalos, ninos, piden
    WHERE reymago.idReyMago = regalos.idReyMagoFK LIKE '3'
    AND regalos.idRegalo = piden.idRegaloFK
    AND ninos.idNino = piden.idNinoFK;";
    $proyectos3 = $connection->query($sql_select3);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Datos de los Reyes Magos - Práctica 2 DWS</title>
</head>
<body>
    <style>body{background-image: url("./img/lighted-christmas-tree-asus.jpg");}</style>
    <div class="container">
        <div class="mx-auto" style="width: 550px;">
            <div class="col">  
                <h1 class="text-danger">Datos de los Reyes Magos</h1>
            </div>
        </div>
        <?php
            $totalGastadoMelchor = 0;
            if ($proyectos->num_rows>0){
                echo "<table class='table table-borderless table-dark'>";
                echo "<thead>";
                echo "<tr class='bg-danger'>";
                echo "<th colspan='4'>Rey Mago: Melchor</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th scope='col'>Nombre Niño/a</th>";
                echo "<th scope='col'>Apellidos Niño/a</th>";
                echo "<th scope='col'>Regalo</th>";
                echo "<th scope='col'>Precio Regalo (€)</th>";
                echo "</tr>";
                echo "</thead>";
                    
                while($fila = mysqli_fetch_array($proyectos)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>".$fila['nombreNino']."</td>";
                    echo "<td>".$fila['apellidosNino']."</td>";
                    echo "<td>".$fila['nombreRegalo']."</td>";
                    echo "<td>".$fila['precioRegalo']."</td>";
                    $totalGastadoMelchor = $fila['precioRegalo'] + $totalGastadoMelchor;
                    echo "</tr>";
                    echo "</tbody>";
                }
                echo "<tr>";
                echo "<td class='bg-danger' colspan='4'>Total de dinero que se ha gastado Melchor: $totalGastadoMelchor"."€</td>";
                echo "</tr>";
                echo "</table>";
            }else {
                echo "<div class='alert alert-danger' role='alert'>No hay ningún resultado</div>";
            }
        ?>
        <?php
            $totalGastadoGaspar = 0;
            if ($proyectos2->num_rows>0){
                echo "<table class='table table-borderless table-dark'>";
                echo "<thead>";
                echo "<tr class='bg-danger'>";
                echo "<th colspan='4'>Rey Mago: Gaspar</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th scope='col'>Nombre Niño/a</th>";
                echo "<th scope='col'>Apellidos Niño/a</th>";
                echo "<th scope='col'>Regalo</th>";
                echo "<th scope='col'>Precio Regalo (€)</th>";
                echo "</tr>";
                echo "</thead>";
                    
                while($fila = mysqli_fetch_array($proyectos2)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>".$fila['nombreNino']."</td>";
                    echo "<td>".$fila['apellidosNino']."</td>";
                    echo "<td>".$fila['nombreRegalo']."</td>";
                    echo "<td>".$fila['precioRegalo']."</td>";
                    $totalGastadoGaspar = $fila['precioRegalo'] + $totalGastadoGaspar;
                    echo "</tr>";
                    echo "</tbody>";
                }
                echo "<tr>";
                echo "<td class='bg-danger' colspan='4'>Total de dinero que se ha gastado Gaspar: $totalGastadoGaspar"."€</td>";
                echo "</tr>";
                echo "</table>";
            }else {
                echo "<div class='alert alert-danger' role='alert'>No hay ningún resultado</div>";
            }
        ?>
        <?php
            $totalGastadoBaltasar = 0;
            if ($proyectos3->num_rows>0){
                echo "<table class='table table-borderless table-dark'>";
                echo "<thead>";
                echo "<tr class='bg-danger'>";
                echo "<th colspan='4'>Rey Mago: Baltasar</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th scope='col'>Nombre Niño/a</th>";
                echo "<th scope='col'>Apellidos Niño/a</th>";
                echo "<th scope='col'>Regalo</th>";
                echo "<th scope='col'>Precio Regalo (€)</th>";
                echo "</tr>";
                echo "</thead>";
                    
                while($fila = mysqli_fetch_array($proyectos3)) {
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<td>".$fila['nombreNino']."</td>";
                    echo "<td>".$fila['apellidosNino']."</td>";
                    echo "<td>".$fila['nombreRegalo']."</td>";
                    echo "<td>".$fila['precioRegalo']."</td>";
                    echo "</tr>";
                    $totalGastadoBaltasar = $fila['precioRegalo'] + $totalGastadoBaltasar;
                    echo "</tbody>";
                }
                echo "<tr>";
                echo "<td class='bg-danger' colspan='4'>Total de dinero que se ha gastado Baltasar: $totalGastadoBaltasar"."€</td>";
                echo "</tr>";
                echo "</table>";
            }else {
                echo "<div class='alert alert-danger' role='alert'>No hay ningún resultado</div>";
            }
        ?>
        <div class="mx-auto" style="width: 200px;">
            <div class="col-4">
                <a href="inicio.html" class="btn btn-outline-danger">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>