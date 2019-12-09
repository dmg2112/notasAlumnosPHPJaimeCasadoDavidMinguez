<?php
require 'vendor/autoload.php'; // incluir lo bueno de Composer
$cliente = new MongoDB\client;
$asignaturas = $cliente->ADAT_UD3_A04->asignaturas;

if (isset($_GET['asignatura'])) {

    if (isset($_GET['tarea']) && isset($_GET['nota']) && isset($_GET['asignatura'])) {

        $matricula = strval($_GET['matricula']);
        $tarea = intval($_GET['tarea']);
        $nota = intval($_GET['nota']);
        $asig = $_GET['asignatura'];

        pull($asignaturas, $asig, $matricula, $tarea);

        push($asignaturas, $asig, $matricula, $tarea, $nota);
    } else if (isset($_GET['tarea']) && isset($_GET['matricula'])) {
        echo "muajajaj";
        pull($asignaturas, $_GET['asignatura'], strval($_GET['matricula']), intval($_GET['tarea']));
    }
    header("Location: ./DetalleAsignatura.php?asignatura=" . $_GET['asignatura']);
} else {
    header("Location: ./Menu.php");
}

function pull($collection, $asignatura, $alumno, $numTarea)
{
    $updateResult = $collection->updateOne(
        [
            'codigoAsignatura' => $asignatura,
            'tareas.codigoTarea' => $numTarea
        ],
        ['$pull' => ['tareas.$.alumnos' => ['matricula' => $alumno]]]

    );
}
function push($collection, $asignatura, $alumno, $numTarea, $notaTarea)
{
    $updateResult = $collection->updateOne(
        [
            'codigoAsignatura' => $asignatura,
            'tareas.codigoTarea' => $numTarea
        ],
        ['$push' => ['tareas.$.alumnos' => ['matricula' => $alumno, 'notaTarea' => $notaTarea]]]

    );
}
