<?php
require 'vendor/autoload.php'; // incluir lo bueno de Composer

$cliente = new MongoDB\client;

$asignaturas = $cliente->ADAT_UD3_A04->asignaturas;
$result = $asignaturas->find();


foreach ($result as $entry) {
    $nombre = $entry{'nombreAsignatura'};
    $codAsignatura = $entry['codigoAsignatura'];
    
    echo "<a href='./DetalleAsignatura.php?asignatura=$codAsignatura'> $nombre </a>";
    echo "<p> Tareas: </p>";

    foreach($entry['tareas'] as $tarea){
        $codTarea = $tarea['codigoTarea'];
        echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;Tarea ".$codTarea."</p>";
        echo "<p> &nbsp;&nbsp;&nbsp;&nbspNotas en la asignatura:</p>";

        $alumnos = $tarea['alumnos'];
        foreach($alumnos as $alumno){
            $matricula = $alumno["matricula"];
            $nota = $alumno["notaTarea"];

            echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Matricula de Alumno: ".$matricula." nota en la tarea ".$nota."</p>";
        }
        
        
    }
}
