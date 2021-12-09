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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Formulario de Búsqueda - Práctica 2 DWS</title>
</head>
<body>
    <style>body{background-image: url("./img/boy-beside-christmas-tree-asus.jpg");}</style>
    <div class="container">
        <div class="mx-auto" style="width: 450px;">
            <div class="col">  
                <h1 class="text-primary">Seleccione niño/a</h1>
            </div>
        </div>
        <form action="#" method="post">
            <div class="input-group mb-4" class="mx-auto" style="width: 100%;">
                <div class="col">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Opciones</label>
                        <select class="custom-select" name="ninos[]">
                            <option disabled selected>Escoja niño/a...</option>
                            <?php
                                if ($proyectos->num_rows>0){
                                    $opciones = ['No','Sí'];
                                    while($fila = mysqli_fetch_array($proyectos)) {
                                        $idNino = $fila['idNino'];
                                        // Guardar la fecha en formato Español
                                        $fecha = new DateTime($fila['fechaNacimientoNino']);
                                        echo "<option value='$idNino'>".$fila['nombreNino']. " " .$fila['apellidosNino']. " - " 
                                        .$fecha->format('d/m/Y'). " - " .$opciones[(int)$fila['buenoNino']]."</option>";
                                        echo "";
                                    }
                                } else {
                                    echo "No hay ningún resultado";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary" name="seleccionar_nino" value="Seleccionar">
                </div>
            </div>
        </form>
        <?php
            $comprobacion = 0;
            if (isset($_POST["seleccionar_nino"])){
                // Guardamos en una variable el niño que se ha escogido
                $resultado = $_POST["ninos"];
                $nino_escodigo = implode("", $_POST["ninos"]);
                // Guardamos la sentencia select en la variable sql_select
                $sql_select = "SELECT idNino, nombreNino, nombreRegalo FROM ninos, regalos, piden
                WHERE ninos.idNino = piden.idNinoFK
                AND piden.idRegaloFK = regalos.idRegalo
                AND idNino = $nino_escodigo";
                // Ejecutar el SELECT
                $proyectos = $connection->query($sql_select);

                if ($proyectos->num_rows>0){
                    // Creamos una tabla para pasar los resultados
                    echo "<table class='table table-borderless table-dark'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th scope='col'>Nombre del Niño/a</th>";
                    echo "<th scope='col'>Juguete que ha pedido</th>";
                    echo "</tr>";
                    echo "</thead>";
                        
                    // Mientras haya resultados los agregamos a la tabla
                    while($fila = mysqli_fetch_array($proyectos)) {
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td>".$fila['nombreNino']."</td>";
                        echo "<td>".$fila['nombreRegalo']."</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                        
                    // fin de la tabla
                    echo "</table>";
                } else {
                    // Si no hay ningún registro que aparezca un mensaje
                    echo "No hay ningún resultado";
                }
                $comprobacion++;
            }
            
            if ($comprobacion!=0){
                echo "
                    <form action='' method='post'>
                        <div class='input-group mb-4' class='mx-auto' style='width: 100%;'>
                            <div class='col'>
                                <div class='input-group-prepend'>
                                    <label class='input-group-text' for='inputGroupSelect01'>Opciones</label>
                                    <select class='custom-select' name='regalos'>
                                        <option disabled selected>Seleccione otro regalo para el niño/a...</option>"; 
                                        $sql_select2 = "SELECT * FROM regalos;";
                                        $proyectos2 = $connection->query($sql_select2);                   
                                        if ($proyectos2->num_rows>0){
                                            while($fila = mysqli_fetch_array($proyectos2)) {
                                                echo "<option value='$fila[idRegalo]'>$fila[nombreRegalo]</option>"; 
                                            }
                                        } else {
                                            echo 'No hay ningún resultado';
                                        }
                                    echo "
                                        </select>
                                </div>
                            </div>
                                <div class='col-auto'>
                                    <input type='submit' class='btn btn-primary' name='seleccionar_regalo' value='Seleccionar'>
                                    <input type='hidden' name='idNino' value='$nino_escodigo'>
                                </div>
                            </div>
                    </form>";
            }
        ?>
        <?php           
            if (isset($_POST["seleccionar_regalo"])){
                // Guardamos en las variables idNino y regalos los valores seleccionados
                $idNino = $_REQUEST['idNino'];
                $idRegalo = $_REQUEST['regalos'];
                // Escribir el INSERT 
                $sql_insert = "INSERT INTO piden VALUES(NULL, $idNino, $idRegalo)";
                // Ejecutarlo
                $connection->query($sql_insert);
                // Mostrar mensaje de registro correcto
                echo "<div class='alert alert-success' role='alert'>Se ha registrado correctamente el nuevo registro.</div>";
            }
        ?>
        <div class="mx-auto" style="width: 190px;">
            <div class="col-4">
                <a href="inicio.html" class="btn btn-outline-primary">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>