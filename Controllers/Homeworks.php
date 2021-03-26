<?php
if ($_REQUEST['accion'] == "obtener") {

   if (empty($_POST['idalumno']) || empty($_POST['idtarea'])) {
      echo 'Error';
   } else {
      require '../Model/conexion.php';
      $id_tarea = $_POST['idtarea'];
      $id_alumno = $_POST['idalumno'];
      $sql = mysqli_query($con, "SELECT * FROM trabajos WHERE id_alumno = '$id_alumno' and id_tarea = '$id_tarea'");

      while ($trabajo = mysqli_fetch_array($sql)) { ?>
         <tr>
            <td><?php echo $trabajo['nombre']; ?></td>
            <td><?php echo $trabajo['descripcion']; ?></td>
            <td>
               <a class="btn btn-small btn-info" target="_blank" href="../myHomework/Resources/archivos_tareas/<?php echo $trabajo['nombre'];?>">
               <i class="fas fa-download"></i>
               </a>
            </td>
         </tr><?php
            }
         }

      } elseif ($_REQUEST['accion'] == "agregar") {
         if (empty($_FILES['file']['name']) || empty($_POST['id_tarea']) || empty($_POST['id_alumno'])) {
            echo "El archivo es requerido";
         } else {
            require '../Model/conexion.php';
            $id_tarea = mysqli_real_escape_string($con, $_POST['id_tarea']);
            $id_alumno = mysqli_real_escape_string($con, $_POST['id_alumno']);
            $comentario = mysqli_real_escape_string($con, $_POST['comentario']);


            $nombre_archivo = $_FILES['file']['name'];
            $nombre_archivo = trim($nombre_archivo);

            $nombre_archivo = str_replace(' ', '', $nombre_archivo);
            $archivo_temporal = $_FILES['file']['tmp_name'];
            $ruta = "../Resources/archivos_tareas/" . $nombre_archivo;

            move_uploaded_file($archivo_temporal, $ruta);

            $sql = "INSERT INTO trabajos (id_alumno, id_tarea, nombre, descripcion) 
                VALUES ('$id_alumno', '$id_tarea', '$nombre_archivo', '$comentario')";

            $sql_query = mysqli_query($con, $sql);

            if ($sql_query) {
               echo 'subido';
            } else {
               echo 'subirerror';
            }
         }
      } else {
         //no se le especifico función al controlador 
         echo 'Operacion invalida';
      }
