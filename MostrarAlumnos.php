<?php
require 'vendor/autoload.php'; // incluir lo bueno de Composer

$cliente = new MongoDB\client;

$alumnos = $cliente->ADAT_UD3_A04->alumnos;
$result = $alumnos->find();


foreach ($result as $entry) {
    $nombre = "          ".$entry['nombre']." ".$entry['apellido'];
    
    echo "<p> $nombre </p>";
    echo "<p> Asignaturas: </p>";

    foreach($entry['notasAlumno'] as $asig){
        $nombreAsig = $asig['nombreAsignatura'];
        echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;".$nombreAsig."</p>";
        echo "<p> &nbsp;&nbsp;&nbsp;&nbsp notas en la asignatura:</p>";
        
        
    }
}

?>

