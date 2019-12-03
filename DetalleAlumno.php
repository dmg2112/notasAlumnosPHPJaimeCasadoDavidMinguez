<html>
<body>






<?php

	if(isset($_GET['matricula'])){
		
		$findQuery = array('nMatricula' => $_GET['matricula']);
		require 'vendor/autoload.php'; // incluir lo bueno de Composer
		$cliente = new MongoDB\client;

		$alumnos = $cliente->ADAT_UD3_A04->alumnos;
		$result = $alumnos->find($findQuery);
		
		foreach ($result as $entry) {
    			$nombre = $entry['nombre']." ".$entry['apellido'];
    			$matricula = $entry['nMatricula'];
    
    			echo "<h1> $nombre </h1>";
    			echo "<h2> Asignaturas: </h2>";

    			foreach($entry['notasAlumno'] as $asig){
        			$nombreAsig = $asig['nombreAsignatura'];
        			echo "<h3> &nbsp;&nbsp;&nbsp;&nbsp;".$nombreAsig."</h3>";
        			echo "<h4> &nbsp;&nbsp;&nbsp;&nbspNotas en la asignatura:</h4>";

        			$notasAsig = $asig['notasAsignatura'];
        			foreach($notasAsig as $asig){
            				$num = $asig["numTarea"];
            				$nota = $asig["notaTarea"];

            				echo "<p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Numero de Tarea: ".$num." nota en la tarea ".$nota."</p>";
       				}
        
        
    			}
		}
	}else{
		header("Location: ./MostrarAlumnos.php");
	}

?>

<form action="/action_page.php">
  Tarea:<br>
  <input type="text" name="firstname" value="Mickey">
  <br>
  Nota:<br>
  <input type="text" name="lastname" value="Mouse">
  <br><br>
  <input type="submit" value="Submit">
</form> 



</body>
</html>


