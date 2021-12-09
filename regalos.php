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

    // Guardamos la sentencia select en la variable sql_select
    $sql_select = "SELECT * FROM regalos";
    // Ejecutar el SELECT
    $proyectos = $connection->query($sql_select);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Datos de los regalos - Práctica 2 DWS</title>
</head>
<body>
    <style>body{background-image: url("./img/presents.jpg");}</style>
    <div class="container">
        <div class="mx-auto" style="width: 471px;">
            <div class="col">  
                <h1 class="text-primary">Datos de los regalos</h1>
            </div>
        </div>
        <?php
            // Comprobar si hay más de un registro
            if ($proyectos->num_rows>0){
                // Creamos una tabla para pasar los resultados
                echo "<table class='table table-borderless table-dark'>";
                echo "<thead>";
                echo "<tr>";
                //echo "<th scope='col'>ID</th>";
                echo "<th scope='col'>Nombre del juguete</th>";
                echo "<th scope='col'>Precio (€)</th>";
                echo "<th scope='col'>Rey Mago</th>";
                echo "</tr>";
                echo "</thead>";
                
                // Mientras haya resultados los agregamos a la tabla
                while($fila = mysqli_fetch_array($proyectos)) {
                    // Agregamos una fila y recuperamos los valores utilizando la matriz asociativa que guardamos en $fila en cada iteración
                    echo "<tbody>";
                    echo "<tr>";
                    //echo "<th scope='row'>".$fila['idRegalo']."</th>";
                    echo "<td>".$fila['nombreRegalo']."</td>";

                    $precioRegalo = $fila['precioRegalo'];
                    $precioRegaloformat = number_format($precioRegalo, 2, ',', '.');
                    echo "<td>".$precioRegaloformat."</td>";
                    
                    // Crear array con las opciones de la actitud de los niños
                    $reyesMagos = ['', 'Melchor','Gaspar','Baltasar'];
                    echo "<td>".$reyesMagos[(int)$fila['idReyMagoFK']]."</td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
                
                // fin de la tabla
                echo "</table>";
                } else {
                    // Si no hay ningún registro que aparezca un mensaje
                    echo "No hay ningún resultado";
                }
        ?>
        <div class="mx-auto" style="width: 200px;">
            <div class="col-2">
                <a href="inicio.html" class="btn btn-outline-primary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>