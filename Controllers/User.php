<?php
session_start();
if (!empty($_POST)) {
    //validar si los campos no estan vacios

    if ($_POST['action'] == 'login') {
        if (empty($_POST['user']) || empty($_POST['pass'])) {
            echo "faltan_datos";
        } else {
            require_once "../Model/conexion.php";
            //uso de la funcion mysqli_real_escape_string para filtrar caracteres extraños obtenidos mediante POST

            $user = mysqli_real_escape_string($con, $_POST['user']);
            $pass = md5(mysqli_real_escape_string($con, $_POST['pass']));


            /*se verifica si el usuario y contraseña
        * enviados coinciden con los registrados en la BD
        */
            $query = mysqli_query($con, "SELECT * FROM usuario where user = '$user' and pass = '$pass'");
            mysqli_close($con);
            $result = mysqli_num_rows($query);
            //se recorren los datos del usuario que se esta logueando
            if ($result > 0) {

                $data = mysqli_fetch_array($query);

                $_SESSION['active'] = true;
                $_SESSION['iduser'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['user'] = $data['user'];

                echo "correcto";
            } else {
                echo "datos_incorrectos";
            }
        }
    } elseif ($_REQUEST['action'] == 'signup') {

        if (empty($_POST['nombre']) || empty($_POST['user']) || empty($_POST['pass'])) {
            echo "faltan_datos";
        } else {
            require_once "../Model/conexion.php";
            //uso de la funcion mysqli_real_escape_string para filtrar caracteres extraños obtenidos mediante POST

            $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
            $apellido = mysqli_real_escape_string($con, $_POST['apellido']);
            $user = mysqli_real_escape_string($con, $_POST['user']);
            $pass = md5(mysqli_real_escape_string($con, $_POST['pass']));


            /*se verifica que el usuario 
        * no exista en la base de datos
        */
            $query = mysqli_query($con, "SELECT * FROM usuario where user = '$user'");
            $result = mysqli_num_rows($query);
            //se recorren los datos del usuario que se esta logueando
            if ($result > 0) {
                echo "ya_existe";
                mysqli_close($con);
            } else {
                $query_insert = mysqli_query($con,   "INSERT INTO usuario(nombre,apellido,user,pass)
                                                            VALUES('$nombre','$apellido','$user','$pass')");
                mysqli_close($con);
                if ($query_insert) {
                    echo 'creado';
                } else {
                    echo 'nocreado';
                }
            }
        }
    }
}
