<?php
include_once "../Model/conexion.php";
$notas = json_decode($_POST["json"]);



foreach ($notas as $notas) {
    $idalumno = $notas->{"idalumno"};
    $idtarea = $notas->{"idtarea"};
    $puntos = $notas->{"puntos"};

    if ($notas->{"accion"} == "crear") {
        $sql = mysqli_query($con, "INSERT INTO notas (id_alumno, id_tarea, puntos)
                                    VALUES ('$idalumno', '$idtarea', '$puntos')");
        if ($sql) {
            echo "nota creada";
        } else {
            echo "error crear";
        }
    } elseif ($notas->{"accion"} == "actualizar") {
        $sql = mysqli_query($con, "UPDATE notas 
                                   SET puntos = '$puntos'
                                   WHERE id_alumno = '$idalumno' and id_tarea = '$idtarea'");
        if ($sql) {
            echo "nota actualizada";
        } else {
            echo "error actualizar";
        }
    }elseif($notas->{"accion"} == "eliminar"){
        $sql = mysqli_query($con, "DELETE FROM notas WHERE  id_alumno = '$idalumno' AND id_tarea = '$idtarea'");
        if ($sql) {
            echo "nota eliminada";
        } else {
            echo "error eliminar";
        }
    }
}
