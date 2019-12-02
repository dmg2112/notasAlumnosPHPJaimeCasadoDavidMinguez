<?php
require 'vendor/autoload.php'; // incluir lo bueno de Composer

$cliente = new MongoDB\client;

$alumnos = $cliente->ADAT_UD3_A04->alumnos;
$result = $alumnos->find();


foreach ($result as $entry) {
    $nombre = "          ".$entry['nombre']." ".$entry['apellido'];
    $matricula = $entry['nMatricula'];
    
    echo "<a href='./DetalleAlumno.php?matricula=$matricula'> $nombre </a>";
    echo "<p> Asignaturas: </p>";

    foreach($entry['notasAlumno'] as $asig){
        $nombreAsig = $asig['nombreAsignatura'];
        echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;".$nombreAsig."</p>";
        echo "<p> &nbsp;&nbsp;&nbsp;&nbspNotas en la asignatura:</p>";

        $notasAsig = $asig['notasAsignatura'];
        foreach($notasAsig as $asig){
            $num = $asig["numTarea"];
            $nota = $asig["notaTarea"];

            echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Numero de Tarea: ".$num."</p>";
            echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nota en la tarea ".$nota."</p>";
        }
        
        
    }
}

?>

