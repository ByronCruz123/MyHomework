<?php
$server = "localhost";
$user = "root";
$database = "myhomework_db";
$pass = "";

$con = mysqli_connect($server, $user, $pass, $database);

if(!$con){
    die("Conexion Fallida. Error: " .mysqli_connect_errno());
}else{
    //echo "Conectado";
}