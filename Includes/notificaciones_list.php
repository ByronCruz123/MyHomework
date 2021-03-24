<?php
/* Este archivo devolvera la lista de notificaciones para el usuario que inicie sesions */
session_start();

$usuario = $_SESSION['iduser'];

include "../Model/conexion.php";

$query = mysqli_query($con,"SELECT envia.nombre as user, tiponoti.descripcion, clase.nombre as clase, noti.tipo as tipoid
                            FROM notificaciones as noti
                            INNER JOIN usuario as envia on envia.id = noti.de
                            INNER JOIN tipo_de_notificacion as tiponoti on tiponoti.codigo = noti.tipo
                            INNER JOIN clases as clase on clase.id = noti.clase_id
                            WHERE noti.para = '$usuario'
                            ORDER BY noti.id DESC");

while ($notificacion = mysqli_fetch_array($query)) {

    if($notificacion['tipoid'] == 1){
        $foto = 'new_user.svg';
    }elseif($notificacion['tipoid'] == 2){
        $foto = 'eliminado2.png';
    }else{
        $foto = 'alert-light'; 
    }
    
    
    ?>

    <div class="alert alert-light" role="alert">
        <img src="resources/img/<?php echo $foto;?>" alt="icon" class="homework2_icon">
        <?php echo $notificacion['user'] . " " . $notificacion['descripcion'] . " " . $notificacion['clase']?>
    </div>
<?php
}
?>