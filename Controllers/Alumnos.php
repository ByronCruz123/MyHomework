<?php
    if($_REQUEST['accion'] == "eliminar"){
        if( isset($_POST['id']) && isset($_POST['para']) && isset($_POST['clase']) ){
            if( !empty($_POST['id']) && !empty($_POST['para']) && !empty($_POST['clase']) ){
    
                require '../Model/conexion.php';
                session_start();
                $id_de =  $_SESSION['iduser']; //de quien se crea la notificacion
                $id_alumno = mysqli_real_escape_string($con, $_POST['id']); //para eliminar
                $id_para = mysqli_real_escape_string($con, $_POST['para']); //
                $id_clase = mysqli_real_escape_string($con, $_POST['clase']);
    
            }else{
                echo 'Operacion invalida ';
            }
    
            $sql = mysqli_query($con, "DELETE FROM alumnosdeclase WHERE id_alumno = '$id_alumno'");
    
            if(mysqli_affected_rows($con) > 0){
                
                echo "eliminado";
                $sql_insert = mysqli_query($con,   "INSERT INTO notificaciones (de, para, tipo, clase_id) 
                                                    VALUES ('$id_de', '$id_para', '2', '$id_clase')");
            } 
    
        }

    }elseif($_REQUEST['accion'] == "agregar"){
        require '../Model/conexion.php';
        $id_clase = mysqli_real_escape_string($con, $_POST['clase']);
        $id_alumno = mysqli_real_escape_string($con, $_POST['id']);
        session_start();

        $profesor = $_SESSION["iduser"];

        //verificar que la variable idalumno sea un numero
        if(is_numeric($id_alumno)){

            //Verificar que el alumno a ingresar no sea el propio profesor
            if($id_alumno != $profesor){

                //verificar que el alumno a ingresar no exista en la clase
                $query = mysqli_query($con, "SELECT * FROM alumnosdeclase WHERE id_clase = '$id_clase' and id_usuario = '$id_alumno'"); 
                if(mysqli_num_rows($query) > 0){
                    echo "Este alumno ya forma parte de esta clase";
                }else{
                    //si está registrado en la clase entonces...

                    //verificar que el usuario a insertar como alumno de la clase exista en la base de datos
                    $queryexisteusuario = mysqli_query($con, "SELECT id FROM usuario WHERE id = $id_alumno");

                    if(mysqli_num_rows($queryexisteusuario) > 0){
                        //en caso de existir agregar dicho usuario como alumno a la clase  
                        $queryinsert = mysqli_query($con, "INSERT INTO alumnosdeclase(id_clase, id_usuario, acceso) VALUES ('$id_clase', '$id_alumno', '1')");
                        
                        //si esta operacion se completa guardar notificacion
                        if($queryinsert){
                            echo "agregado";
                            $querynuevanotificacion = mysqli_query($con,   "INSERT INTO notificaciones (de, para, tipo, clase_id) 
                                                                            VALUES ('$profesor', '$id_alumno', '1', '$id_clase')");
                        }
    
                    }else{//usuario no existe en la base de datos
                        echo "Usuario no encontrado";
                    }
                }//fin else, usuario no existe en la clase aún

            }else{//el usuario a insertar es el profesor de la clase
                echo "Ser tu propio alumno quizás no sea lo más apropiado";
            }
        }else{//la variable id_alumno no es numerica
            echo "Código no válido";
        }
    } else{
        //no se le especifico función al controlador 
        echo 'Operacion invalida';
    }
?>