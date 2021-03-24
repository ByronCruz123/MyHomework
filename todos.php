<?php
    include "Model/conexion.php";

    $sql = mysqli_query($con, "SELECT * FROM Alumnos");
    
    while($alumnos = mysqli_fetch_array($sql)){
        echo $alumnos['id'].'<br>';
    }

?>