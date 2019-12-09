<?php
require 'vendor/autoload.php'; // incluir lo bueno de Composer
$cliente = new MongoDB\client;
$alumnos = $cliente->ADAT_UD3_A04->alumnos;

if (isset($_GET['matricula'])) {

    if (isset($_GET['tarea']) && isset($_GET['nota']) && isset($_GET['asignatura'])) {

        $matr = strval($_GET['matricula']);
        $tarea = intval($_GET['tarea']);
        $nota = intval($_GET['nota']);
        $asig = $_GET['asignatura'];

        pull($alumnos, $matr, $asig, $tarea);

        push($alumnos, $matr, $asig, $tarea, $nota);
    } else if (isset($_GET['tarea']) && isset($_GET['asignatura'])) {
        pull($alumnos, $_GET['matricula'], $_GET['asignatura'], intval($_GET['tarea']));
    }
    header("Location: ./DetalleAlumno.php?matricula=" . $_GET['matricula']);
} else {
    header("Location: ./Menu.php");
}

function pull($collection, $matricula, $asignatura, $numTarea)
{
    $updateResult = $collection->updateOne(
        [
            'nMatricula' => $matricula,
            'notasAlumno.codigoAsignatura' => $asignatura
        ],
        ['$pull' => ['notasAlumno.$.notasAsignatura' => ['numTarea' => $numTarea]]]

    );
}
function push($collection, $matricula, $asignatura, $numTarea, $notaTarea)
{
    $updateResult = $collection->updateOne(
        [
            'nMatricula' => $matricula,
            'notasAlumno.codigoAsignatura' => $asignatura
        ],
        ['$push' => ['notasAlumno.$.notasAsignatura' => ['numTarea' => $numTarea, 'notaTarea' => $notaTarea]]]

    );
}
