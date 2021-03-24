<?php

/**
 * Este archivo (clases_list.php) unicamente devolvera la lista completa de clases
 */
session_start();
if (empty($_SESSION['active'])) {
    echo "Debe iniciar sesion";
} else {
    $id_usuario = $_SESSION['iduser']; //id profesor y id alumno a la vez

    include "../Model/conexion.php";
    $clasesdeprofesor = mysqli_query($con, "SELECT * FROM clases WHERE id_profesor = $id_usuario");

    while ($fila = mysqli_fetch_array($clasesdeprofesor)) {
        $idclase = $fila['id'] ?>
        <li>
            <div class="card">
                <div class="card-body header_card blue">
                    <a href="tareas.php?clase=<?php echo $idclase; ?>" class="card-title">
                        <h5 class="text-truncate"><?php echo $fila['nombre']; ?></h5>
                    </a>
                    <p class="card-text"><?php
                                            if (isset($fila['seccion']) && !empty($fila['seccion'])) {
                                                echo $fila['seccion'];
                                            } else {
                                                echo 1;
                                            }
                                            ?></p>
                </div>
                <div class="card-body body_card">
                    <?php $query2 = mysqli_query($con, "SELECT COUNT(id) as total FROM tareas WHERE id_clase = $idclase");
                    $cantidadtareas = mysqli_fetch_assoc($query2)['total'];
                    echo '<p class="card-text">' . $cantidadtareas . ' ';
                    if ($cantidadtareas == 1) {
                        echo 'Actividad';
                    } else {
                        echo 'Actividades';
                    }
                    echo '</p>';
                    ?>

                    <br>
                </div>
                <div class="card-footer-morado">
                    <a class="btn-blanco-desing btn-class-modal" data-toggle="modal" data-target="#formclasemodal" data-accion="editar" data-id="<?php echo $idclase; ?>">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                        Editar
                    </a>
                    <a class="btn-blanco-desing btn-class class_management_btn" data-id="<?php echo $idclase; ?>" data-accion="eliminar_clase">
                        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                            <title>Trash Bin</title>
                            <path fill='none' d='M337.46 240L312 214.54l-56 56-56-56L174.54 240l56 56-56 56L200 377.46l56-56 56 56L337.46 352l-56-56 56-56z' />
                            <path fill='none' d='M337.46 240L312 214.54l-56 56-56-56L174.54 240l56 56-56 56L200 377.46l56-56 56 56L337.46 352l-56-56 56-56z' />
                            <path d='M64 160l29.74 282.51A24 24 0 00117.61 464h276.78a24 24 0 0023.87-21.49L448 160zm248 217.46l-56-56-56 56L174.54 352l56-56-56-56L200 214.54l56 56 56-56L337.46 240l-56 56 56 56z' />
                            <rect x='32' y='48' width='448' height='80' rx='12' ry='12' />
                        </svg>

                        Eliminar
                    </a>
                </div>
            </div>
        </li>
<?php
    }

    $clasesdealumno = mysqli_query($con,   "SELECT ac.id_alumno as alumno, c.id, c.nombre, c.seccion
                                            FROM alumnosdeclase as ac
                                            INNER JOIN clases as c ON c.id = ac.id_clase
                                            WHERE ac.id_usuario = '$id_usuario'");

    while ($clase2 = mysqli_fetch_array($clasesdealumno)) {
        $id2 = $clase2['id'] ?>
        <li>
            <div class="card">
                <div class="card-body header_card cadetblue">
                    <a href="tareas.php?clase=<?php echo $id2; ?>" class="card-title">
                        <h5 class="text-truncate"><?php echo $clase2['nombre']; ?></h5>
                    </a>
                    <p class="card-text"><?php
                                            if (isset($clase2['seccion']) && !empty($clase2['seccion'])) {
                                                echo $clase2['seccion'];
                                            } else {
                                                echo 1;
                                            }
                                            ?></p>
                </div>

                <div class="card-body body_card">
                    <?php $query4 = mysqli_query($con, "SELECT COUNT(id) as total FROM tareas WHERE id_clase = $id2");
                    $cantidadtareas = mysqli_fetch_assoc($query4)['total'];
                    echo '<p class="card-text">' . $cantidadtareas . ' ';
                    if ($cantidadtareas == 1) {
                        echo 'Actividad';
                    } else {
                        echo 'Actividades';
                    }
                    echo '</p>';
                    ?>

                    <br>
                </div>
                <div class="card-footer-morado">
                    <a class="btn-blanco-desing btn-class abandonarclase"  data-alumnoid="<?php echo $clase2['alumno']; ?>">
                        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'>
                            <title>Trash Bin</title>
                            <path fill='none' d='M337.46 240L312 214.54l-56 56-56-56L174.54 240l56 56-56 56L200 377.46l56-56 56 56L337.46 352l-56-56 56-56z' />
                            <path fill='none' d='M337.46 240L312 214.54l-56 56-56-56L174.54 240l56 56-56 56L200 377.46l56-56 56 56L337.46 352l-56-56 56-56z' />
                            <path d='M64 160l29.74 282.51A24 24 0 00117.61 464h276.78a24 24 0 0023.87-21.49L448 160zm248 217.46l-56-56-56 56L174.54 352l56-56-56-56L200 214.54l56 56 56-56L337.46 240l-56 56 56 56z' />
                            <rect x='32' y='48' width='448' height='80' rx='12' ry='12' />
                        </svg>

                        Abandonar
                    </a>
                </div>
            </div>
        </li>
<?php
    }
}
?>