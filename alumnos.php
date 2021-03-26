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
            header('Location: inicio.php');
        } else {
            header('Location: inicio.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <link rel="icon" href="Resources/img/homework.svg">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
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
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white border-bottom">
            <?php
            include 'Model/conexion.php';
            $nombreclase = '';
            if (isset($_GET['clase']) && !empty($_GET['clase'])) {

                $idclase = mysqli_real_escape_string($con, $_GET['clase']);

                $sql = mysqli_query($con, "SELECT * FROM clases WHERE id =  '$idclase'");

                $clase = mysqli_fetch_assoc($sql);

                if (mysqli_num_rows($sql) > 0) {
                    $nombreclase = $clase['nombre'];
            ?>
                    <a class="navbar-brand seccion2" href="tareas.php?clase=<?php echo $clase['id'] ?>">
                    <?php
                } else {
                    ?>
                        <a class="navbar-brand seccion2" href="inicio.php">
                        <?php
                    }
                } else {
                        ?>
                        <a class="navbar-brand seccion2" href="inicio.php">
                        <?php
                    }
                        ?>
                        <span> <?php echo isset($clase['nombre']) ? $clase['nombre'] : 'Esta clase no existe :('; ?></span>
                        <span>
                            <?php
                            if (isset($clase['seccion'])) {
                                if (!empty($clase['seccion'])) {
                                    echo $clase['seccion'];
                                } else {
                                    echo 1;
                                }
                            }
                            ?>
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
                            <li class="nav-item">

                                <a class="nav-link btn-blanco-desing" href="alumnos.php?clase=<?php echo $idclase ?>">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                    </svg>
                                    Alumnos
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
                        <div class="vacio pl-lg-3 pr-lg-4"></div>
                        <button class="navbar-toggler btn-menu" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        </nav>

    </header>


    <input class="idclase" type="hidden" value="<?php echo $idclase ?>">



    <main class="container tareas">
        <div class="botones d-block">
            <a class="nav-link btn-blanco-desing active d-inline-block" href="alumnos.php?clase=<?php echo $idclase ?>">Lista de alumnos</a>
            <a class="nav-link btn-blanco-desing d-inline-block" data-toggle="modal" data-target="#añadiralumnos">

                Agregar
            </a>
        </div>

        <br>
        <div>
            <h1 class="titulotarea grayclaro">Alumnos de <?php echo $nombreclase; ?></h1>
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody class="listaalumnos">


                </tbody>
            </table>

        </div>

    </main>



    <!-- Modal -->
    <div class="modal fade" id="añadiralumnos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar alumno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="bd-example">
                        <ul class="list-group seleccionados">
                            <!-- Resultados de busqueda -->
                        </ul>
                    </div>
                    <div class="main">

                        <!-- Actual search box -->
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control" name="txtbuscaralumno" placeholder="Ingrese nombre o apellido">
                        </div>

                    </div>


                    <div class="bd-example">
                        <ul class="list-group listaalumnosencontrados">


                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info" id="agregaralumnos" disabled>Agregar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="navbar">
        <header>
            MyHomework
        </header>
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="inicio.php"><i class="ion-ios-home-outline"></i> <span>Clases</span></a>
                </li>
                <li>
                    <a href="alumnos.php?clase=<?php echo $idclase ?>"><i class="ion-android-people"></i> <span>Alumnos</span></a>
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
    cargaralumnos();
</script>

</html>