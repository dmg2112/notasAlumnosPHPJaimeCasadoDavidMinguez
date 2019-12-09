<?php

    if(isset($_GET['matricula'])){
        if(isset($_GET['tarea']) && isset($_GET['nota']) && isset($_GET['asignatura'])){
		
		
            require 'vendor/autoload.php'; // incluir lo bueno de Composer
            $cliente = new MongoDB\client;
            $matr = strval($_GET['matricula']);
            $tarea = intval($_GET['tarea']);
            $nota = intval($_GET['nota']);
            $asig = $_GET['asignatura'];
    
            $alumnos = $cliente->ADAT_UD3_A04->alumnos;

            
            
            $updateResult = $alumnos->updateOne(
                [ 'nMatricula' => $matr,
            'notasAlumno.codigoAsignatura'=> $asig ],
                [ '$pull' => [ 'notasAlumno.$.notasAsignatura' => ['numTarea'=> $tarea] ]]
    
            );
            $updateResult = $alumnos->updateOne(
                [ 'nMatricula' => $matr,
            'notasAlumno.codigoAsignatura'=> $asig ],
                [ '$push' => [ 'notasAlumno.$.notasAsignatura' => ['numTarea'=> $tarea , 'notaTarea'=> $nota] ]]
    
            );



            header("Location: ./DetalleAlumno.php?matricula=".$_GET['matricula']);
            
        }else{
            header("Location: ./DetalleAlumno.php?matricula=".$_GET['matricula']);
        }

    }else{
        header("Location: ./Menu.php");
    }
     

?>