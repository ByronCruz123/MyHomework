<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}

include "../Model/conexion.php";

/**
 * Este archivo se encargara de ejecutar una u otra funcion, dependiendo 
 * del valor que traiga el paremetro "accion"
 */

//filtrado de caracteres extraños en los parametros POST
if ($_REQUEST['accion'] == "guardar_clase") {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $seccion = mysqli_real_escape_string($con, $_POST['seccion']);
    $materia = mysqli_real_escape_string($con, $_POST['materia']);
    $salon = mysqli_real_escape_string($con, $_POST['salon']);
    $idprofesor = $_SESSION['iduser'];

    if ($nombre != "") {

        /**
         * @Crear clase
         * Se ejecutara siempre y cuando el valor del parametro "accion" sea => "guardar_clase"
         * Esta funcion ejecutara una sentencia SQL de insercion con los valores POST obtenidos
         */
        $sql = mysqli_query($con, "INSERT INTO clases (id_profesor, nombre, seccion, materia, salon)
        VALUES ('$idprofesor', '$nombre', '$seccion', '$materia', '$salon')");
        mysqli_close($con);

        if ($sql) {
            echo "creado";
        }
    } else {
        echo "errorcrear";
    }
} elseif ($_REQUEST['accion'] == "actualizar_clase") {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $seccion = mysqli_real_escape_string($con, $_POST['seccion']);
    $materia = mysqli_real_escape_string($con, $_POST['materia']);
    $salon = mysqli_real_escape_string($con, $_POST['salon']);

    /**
     * @Actualizar clase
     * Se ejecutara siempre y cuando el valor del parametro "accion" sea => "actualizar"
     * Esta funcion ejecutara una sentencia SQL update con los valores POST obtenidos
     */
    $idclase = $_REQUEST['id'];

    if ($nombre != "") {
        $sql = mysqli_query($con,  "UPDATE clases
                                    SET nombre = '$nombre', seccion = '$seccion', materia = '$materia', salon = '$salon'
                                    WHERE id = '$idclase'");


        if (mysqli_affected_rows($con) > 0) {
            echo "actualizado";
            mysqli_close($con);
        }
    } else {
        echo "erroractualizar";
        mysqli_close($con);
    }
} elseif ($_REQUEST['accion'] == "eliminar_clase") {
    $idclase = $_REQUEST['id'];

    $sqleliminar = mysqli_query($con, "DELETE FROM clases WHERE clases.id = '$idclase'");


    if (mysqli_affected_rows($con) > 0) {
        echo "eliminado";
        mysqli_close($con);
    } else {
        echo "erroreliminar";
    }
} elseif ($_REQUEST['accion'] == "abandonarclase") {
    $id = $_REQUEST['id']; //en este caso consiste en tomar el idalumnodeclase para abandonar la clase

    $sqleliminar = mysqli_query($con, "DELETE FROM alumnosdeclase WHERE id_alumno = '$id'");


    if (mysqli_affected_rows($con) > 0) {
        echo "claseabandonada";
        mysqli_close($con);
    } else {
        echo "errorabandonar";
        mysqli_close($con);
    }
}else {
    /**
     * Parametro accion @Desconocido
     * Se ejecutara siempre y cuando el valor del parametro "accion" no sea => "nuevo" o "actualizar"
     * Unicamente devolvera un mensaje
     */
    echo "error_desconocido";
}
