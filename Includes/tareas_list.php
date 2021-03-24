<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
include "../Model/conexion.php";


$idclase = mysqli_real_escape_string($con, $_REQUEST['clase']);
$idusuario = $_SESSION['iduser'];

$permiso = 0;

$validacion1 = mysqli_query($con, "SELECT id FROM clases WHERE id = '$idclase' and id_profesor = '$idusuario'");
if (mysqli_num_rows($validacion1) > 0) {
    $permiso = 1;
} else {
    $validacion2 = mysqli_query($con, "SELECT id_clase FROM alumnosdeclase WHERE id_clase = '$idclase' and id_usuario = '$idusuario'");
    if (mysqli_num_rows($validacion2) > 0) {
        $permiso = 2;
    } else {
        $permiso = 0;
    }
}


if ($permiso== 1 || $permiso == 2) {
    $sql2 = mysqli_query($con, "SELECT * FROM tareas WHERE id_clase = '$idclase'");

    while ($tarea = mysqli_fetch_array($sql2)) { ?>
        <a href="detalletarea.php?tarea=<?php echo $tarea['id'] ?>&clase=<?php echo $_POST['clase'] ?>" class="tarealink">
            <div class="alert alert-light" role="alert">
                <img src="resources/img/homework2.png" alt="icon" class="homework2_icon">
                <?php echo $tarea['titulo'] ?>
            </div>
        </a><?php
        }
    } else {
        echo "Esta clase no existe o no tienes permiso para acceder";
    }
/**
 * Este archivo (clases_list.php) unicamente devolvera la lista completa de clases
 */
?>