<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
} else {
    include 'Model/conexion.php';
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
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <link rel="icon" href="Resources/img/homework.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Resources/css/bootstrap.css">
    <link rel="stylesheet" href="Resources/css/buscador.css">
    <link rel="stylesheet" href="Resources/css/styles.css">
    <link rel="stylesheet" href="Resources/css/navbar.css">
    <link rel="stylesheet" href="Resources/css/alertify.css">
    <link rel="stylesheet" href="Resources/css/default.css">

    <!-- SIDEBAR ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body style="background-color: white;">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white border-bottom">
        <?php

        if (isset($_GET['clase']) && !empty($_GET['clase']) && $permiso != 0) {

            $idclase = mysqli_real_escape_string($con, $_GET['clase']);

            $sql = mysqli_query($con, "SELECT * FROM clases WHERE id =  '$idclase'");

            $clase = mysqli_fetch_assoc($sql);

            if (mysqli_num_rows($sql) > 0) { ?>
                <a class="navbar-brand seccion2" href="tareas.php?clase=<?php echo $clase['id'] ?>">
                <?php
            } else { ?>
                    <a class="navbar-brand seccion2" href="inicio.php"><?php
                                                                    }
                                                                } else { ?>
                    <a class="navbar-brand seccion2" href="inicio.php"> <?php
                                                                    } ?>
                    <span> <?php echo isset($clase['nombre']) ? $clase['nombre'] : 'Esta clase no existe :('; ?></span>
                    <span> <?php
                            if (isset($clase['seccion'])) {
                                if (!empty($clase['seccion'])) {
                                    echo $clase['seccion'];
                                } else {
                                    echo 1;
                                }
                            } ?>
                    </span>
                    </a>

                    <ul class="navbar-nav navbar-links">
                        <li class="nav-item">
                            <a class="nav-link btn-blanco-desing" href="inicio.php">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z" />
                                    <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                </svg>
                                Clases
                            </a>
                        </li>

                        <?php
                        if ($permiso == 1) {
                        ?>
                            <li class="nav-item">

                                <a class="nav-link btn-blanco-desing" href="alumnos.php?clase=<?php echo $idclase ?>">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                    </svg>
                                    Alumnos
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link btn-blanco-desing" href="solicitudes.php">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                Solicitudes
                            </a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link btn-blanco-desing" href="notificaciones.php">
                                <svg width="0.7em" height="1em" viewBox="0 0 16 16" class="bi bi-bell-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                                </svg>
                                Notificaciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="btn-group">
                                <a class="nav-link btn-blanco-desing dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                    Cuenta
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="configurarcuenta.php">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                            <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                                        </svg> Configurar
                                    </a>
                                    <a class="dropdown-item" href="salir.php">
                                        <svg width="0.7em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                                        </svg>
                                        Salir
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="btnextrayburger">
                        <div class="boton btnlabel">
                            <!-- <input type="checkbox" id="toggle" class="toggle-btn"> -->
                            <label id="btn-search" for="search-tag">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" class="svg-icon iconlupa">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3347 17.7381C14.6099 19.1517 12.404 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10C20 12.3985 19.1556 14.5998 17.7478 16.3228L25.6796 24.2546C26.0702 24.6451 26.0702 25.2783 25.6796 25.6688C25.2891 26.0593 24.6559 26.0593 24.2654 25.6688L16.3347 17.7381ZM18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10Z"></path>
                                </svg>
                            </label>
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 408 408" class="search-tag__come-back svg-icon s-mr-05"><path d="M408,178.5H96.9L239.7,35.7L204,0L0,204l204,204l35.7-35.7L96.9,229.5H408V178.5z"></path></svg> -->
                            <input id="search-tag" placeholder="¿Qué buscaremos hoy?" type="search" class="search-tag__input s-bg-white z-normal" autocomplete="off">
                        </div>
                        <button class="navbar-toggler btn-menu" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
    </nav>


    <!--CONTENIDO-->
    <main class="container tareas">
        <?php
        if ($permiso == 1) {
        ?>
            <a href="" class="btn btn-info mb-3" data-toggle="modal" data-target="#creartareamodal">Nueva tarea</a>
        <?php
        }else{
        ?>
        <div class="pt-4"></div>
        <?php
        }
        ?>
        <div class="tarea">
            <!-- Contenido Dinamico -->






        </div>

    </main>

    <!-- MODAL 1 -->
    <div class="modal fade px-2" id="creartareamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="nuevatareaform">
                    <div class="modal-body">
                        <h6 class="modal-title" id="exampleModalLabel">Nueva tarea</h6>
                        <input type="hidden" name="accion" value="crear">
                        <input type="hidden" name="idclase" value="<?php echo $_GET['clase'] ?>">
                        <div class="form-group pt-3">
                            <input type="text" class="form-control" name="titulo" placeholder="Titulo" required>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="instrucciones" placeholder="Instrucciones"></textarea>
                        </div>
                        <span class="fecha_entrega">Fecha de entrega</span>
                        <div class="form-inline">
                            <input type="date" id="fecha" class="form-control mb-2 mr-sm-2" value="<?php echo date("Y-m-d"); ?>" name="f_entrega" required>
                            <input type="time" id="hora" class="form-control mb-2 mr-sm-2" value="23:59" name="h_entrega" required>
                        </div>
                        <span class="fecha_entrega">Puntos</span>
                        <div class="form-inline">
                            <input type="number" class="form-control" name="puntos" value="100">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear tarea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="navbar">
        <header>
            Profesores
        </header>
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="inicio.php"><i class="ion-ios-home-outline"></i> <span>Clases</span></a>
                </li>
                <?php
                if ($permiso == 1) { ?>
                    <li>
                        <a href="alumnos.php?clase=<?php echo $idclase ?>"><i class="ion-android-people"></i> <span>Alumnos</span></a>
                    </li>
                <?php } ?>
                <li>
                    <a href="solicitudes.php"><i class="ion-android-person-add"></i> <span>Solicitudes</span></a>
                </li>
                <li>
                    <a href="notificaciones.php"><i class="ion-ios-bell-outline"></i> <span class="">Notificaciones</span></a>
                </li>
                <li>
                    <a href="#"><i class="ion-android-person"></i> <span class="">Cuenta</span></a>
                    <ul class="nav-flyout">
                        <li>
                            <a href="configurarcuenta.php"><i class="ion-gear-a"></i>Configurar cuenta</a>
                        </li>
                        <li>
                            <a href="salir.php"><i class="ion-ios-close-outline"></i>Cerrar sesion</a>
                        </li>
                        <li>
                            <a href="register.php"><i class="ion-ios-plus-outline"></i> Nueva Cuenta</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="salir.php"><i class="ion-ios-unlocked-outline"></i> <span class="">Salir</span></a>
                </li>
            </ul>
        </nav>
    </aside>

</body>

<script src="resources/js/jquery.js"></script>
<script src="resources/js/popper.min.js"></script>
<script src="resources/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="resources/js/alertify.js"></script>
<script src="resources/js/functions.js"></script>
<script>
    cargartareas(<?php echo $_GET['clase'] ?>);
</script>

</html>