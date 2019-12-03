<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Detalle Alumno</title>
  </head>
  <body>
	<div class="container-fluid">
		<div class="row flex-row">
<div class ="col-6">

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
				$codigoAsig = $asig['codigoAsignatura'];
        			echo "<h3> &nbsp;&nbsp;&nbsp;&nbsp;".$nombreAsig."  ".$codigoAsig."</h3>";
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
</div>

<form class = "col-6" action="./ActualizarNotas.php">
Matricula:<br>
  <input type="text" name="matricula" value="<?php echo strval($_GET['matricula']); ?>" readonly="readonly">
  <br>
Asignatura:<br>
  <input type="text" name="asignatura" value="Mickey">
  <br>
  Tarea:<br>
  <input type="text" name="tarea" value="mick">
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


