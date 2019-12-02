<?php

	if(isset($_GET['matricula'])){
		
		$findQuery = array('matricula' => $_GET['matricula']);
		require 'vendor/autoload.php'; // incluir lo bueno de Composer

		$cliente = new MongoDB\client;

		$alumnos = $cliente->ADAT_UD3_A04->alumnos;
		$result = $alumnos->find($findQuery);
		
		foreach ($result as $entry) {
    			$nombre = $entry['nombre']." ".$entry['apellido'];
    			$matricula = $entry['nMatricula'];
    
    			echo "<h1> $nombre </h1>";
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
	}else{
		header("Location: ./MostrarAlumnos.php");
	}

?>