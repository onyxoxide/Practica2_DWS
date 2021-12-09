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
    $sql_select = "SELECT * FROM ninos ORDER BY 2";
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
    <title>Datos de los niños - Práctica 2 DWS</title>
</head>
<body>
    <style>body{background-image: url("./img/boy-beside-christmas-tree-asus.jpg");}</style>
    <div class="container">
        <div class="mx-auto" style="width: 471px;">
            <div class="col">  
                <h1 class="text-primary">Datos de los niños</h1>
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
                echo "<th scope='col'>Nombre</th>";
                echo "<th scope='col'>Apellidos</th>";
                echo "<th scope='col'>Fecha de Nacimiento</th>";
                echo "<th scope='col'>Bueno (sí/no)</th>";
                echo "</tr>";
                echo "</thead>";
                
                // Mientras haya resultados los agregamos a la tabla
                while($fila = mysqli_fetch_array($proyectos)) {
                    // Agregamos una fila y recuperamos los valores utilizando la matriz asociativa que guardamos en $fila en cada iteración
                    echo "<tbody>";
                    echo "<tr>";
                    //echo "<th scope='row'>".$fila['idNino']."</th>";
                    echo "<td>".$fila['nombreNino']."</td>";
                    echo "<td>".$fila['apellidosNino']."</td>";

                    // Guardar en fecha la fecha de Nacimiento de los niños
                    $fecha = new DateTime($fila['fechaNacimientoNino']);
                    // Mostrar la fecha en formato Español
                    echo "<td>".$fecha->format('d/m/Y')."</td>";
                    
                    // Crear array con las opciones de la actitud de los niños
                    $opciones = ['No','Sí'];
                    echo "<td>".$opciones[(int)$fila['buenoNino']]."</td>";
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
            <div class="col-4">
                <a href="inicio.html" class="btn btn-outline-primary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>