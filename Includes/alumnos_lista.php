<?php
if ($_REQUEST['tipo'] == "completa") {
    if (isset($_REQUEST['clase']) && !empty($_REQUEST['clase'])) {
        include "../Model/conexion.php";
        $idclase = mysqli_real_escape_string($con, $_REQUEST['clase']);

        $sql2 = mysqli_query($con, "SELECT ac.id_alumno, us.nombre, us.apellido, ac.id_usuario
                                                    FROM alumnosdeclase AS ac 
                                                    INNER JOIN usuario AS us ON ac.id_usuario = us.id 
                                                    WHERE ac.id_clase = $idclase AND ac.acceso = true");
        $contador = 1;

        while ($alumno = mysqli_fetch_array($sql2)) { ?>
            <tr id="fila">
                <th scope="row"><?php echo $contador++; ?></th>
                <td class="text-capitalize"><?php echo $alumno['nombre'] . " " . $alumno["apellido"]; ?></td>
                <td>
                    <button class="btn btn-danger btn_eliminar_alumno" role="button" data-id="<?php echo $alumno['id_alumno']; ?>" data-para="<?php echo $alumno['id_usuario']; ?>">
                        Eliminar
                    </button>
                </td>
            </tr>
        <?php

        }
    }
} elseif ($_REQUEST["tipo"] == "filtro") {
    if (isset($_REQUEST['filtro']) && !empty($_REQUEST['filtro'])) {
        session_start();
        $idprofesor = $_SESSION['iduser'];

        include "../Model/conexion.php";
        $filtro = mysqli_real_escape_string($con, $_REQUEST['filtro']);

        $sqlfiltro = mysqli_query($con,    "SELECT id, CONCAT(nombre , ' ', apellido) as nombre, user 
                                            FROM usuario
                                            WHERE nombre LIKE '%$filtro%' OR
                                                  apellido LIKE '%$filtro%' OR
                                                  user LIKE '%$filtro%'");

        if(mysqli_num_rows($sqlfiltro) > 0){
            while ($alumno = mysqli_fetch_array($sqlfiltro)) { ?>
                <li class="list-group-item" data-id="<?php echo $alumno['id']?>">
                    <span class="nombrealumno"><?php echo $alumno['nombre']?></span>
                    <span class="badge badge-secondary badge-pill"><?php echo $alumno['user']?></span>
                </li>
            <?php 
            }
        }else{?>
            <p class="sinresultado">Tu busqueda no devolvió ningún resultado</p>
        <?php
        }

    }
}

?>