<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Detalle Asignatura</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-row">
            <div class="col-6">

                <?php

                if (isset($_GET['asignatura'])) {

                    $findQuery = array('codigoAsignatura' => $_GET['asignatura']);
                    require 'vendor/autoload.php'; // incluir lo bueno de Composer
                    $cliente = new MongoDB\client;

                    $asignaturas = $cliente->ADAT_UD3_A04->asignaturas;
                    $result = $asignaturas->find($findQuery);

                    foreach ($result as $entry) {
                        $nombre = $entry['nombreAsignatura'];
                        $asignatura = $entry['codigoAsignatura'];

                        echo "<h1> $nombre </h1>";
                        echo "<h2> Tareas: </h2>";

                        foreach ($entry['tareas'] as $tarea) {
                            $codTarea = $tarea['codigoTarea'];
                            echo "<h3> &nbsp;&nbsp;&nbsp;&nbsp;" . $codTarea . "</h3>";
                            echo "<h4> &nbsp;&nbsp;&nbsp;&nbspNotas en la tarea:</h4>";

                            $alumnos = $tarea['alumnos'];
                            foreach ($alumnos as $alumno) {
                                $matricula = $alumno["matricula"];
                                $nota = $alumno["notaTarea"];
                                $onClickAction = "document.location.href='./ActualizaNotasAsignatura.php?asignatura=" . $asignatura . "&tarea=" . $codTarea . "&matricula=" . $matricula . "'";

                                echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Matricula de Alumno: " . $matricula . " nota en la tarea " . $nota . "</p>";
                                echo "<button type='button' onClick=" . $onClickAction . ">Borrar</button>";
                            }
                        }
                    }
                } else {
                    header("Location: ./MostrarAsignaturas.php");
                }

                ?>
            </div>

            <form class="col-6" method="GET" action="./ActualizaNotasAsignatura.php">
                Asignatura:<br>
                <input type="text" name="asignatura" value="<?php echo strval($_GET['asignatura']); ?>" readonly="readonly">
                <br>
                Tarea:<br>
                <input type="text" name="tarea" value="Mickey">
                <br>
                Codigo alumno:<br>
                <input type="text" name="matricula" value="mick">
                <br>
                Nota:<br>
                <input type="text" name="nota" value="mick">
                <br><br>
                <input type="submit" value="Submit">
            </form>


        </div>
    </div>
</body>

</html>