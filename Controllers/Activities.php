<?php

    /**
     * Este archivo se encargara de ejecutar una u otra funcion, dependiendo 
     * del valor que traiga el paremetro "accion"
     */

     //filtrado de caracteres extraños en los parametros POST
    
    if($_REQUEST['accion'] == "crear"){
        include "../Model/conexion.php";

        $idclase = mysqli_real_escape_string($con, $_POST['idclase']);
        $nombre = mysqli_real_escape_string($con, $_POST['titulo']);
        $instrucciones = mysqli_real_escape_string($con, $_POST['instrucciones']);
        $f_entrega = mysqli_real_escape_string($con, $_POST['f_entrega']);
        $h_entrega = mysqli_real_escape_string($con, $_POST['h_entrega']);
        $puntos = mysqli_real_escape_string($con, $_POST['puntos']);
    
        /**
         * @Crear clase
         * Se ejecutara siempre y cuando el valor del parametro "accion" sea => "crear"
         * Esta funcion ejecutara una sentencia SQL de insercion con los valores POST obtenidos
         */

        $fecha_entrega = $f_entrega . " " . $h_entrega;
        $insert_tarea = mysqli_query($con, "INSERT INTO tareas (id_clase, titulo, instrucciones, fecha_entrega, puntos)
                                   VALUES ('$idclase', '$nombre', '$instrucciones', '$fecha_entrega', '$puntos')");
        
        if($insert_tarea){   
            echo "creado";
        }else{
            echo "errorcrear";
        }
    }elseif($_REQUEST['accion'] == "eliminar"){
        include "../Model/conexion.php";

        /**
         * @Actualizar Lector
         * Se ejecutara siempre y cuando el valor del parametro "accion" sea => "actualizar"
         * Esta funcion ejecutara una sentencia SQL update con los valores POST obtenidos
         */
        $idtarea = mysqli_real_escape_string($con, $_POST['tarea']);

        $sql = mysqli_query($con,  "DELETE FROM tareas WHERE id = '$idtarea'");
        
        
        if (mysqli_affected_rows($con) > 0) {
            echo "eliminado";
            mysqli_close($con);
        }else{
            echo "Tarea no eliminada";
            mysqli_close($con);
        }
    }else{
         /**
         * Parametro accion @Desconocido
         * Se ejecutara siempre y cuando el valor del parametro "accion" no sea => "nuevo" o "actualizar"
         * Unicamente devolvera un mensaje
         */
        echo "error_desconocido";
    }
