<?php
session_start();
include_once('./conexion.php');
if(isset($_SESSION['conectado'])){
    $correo = $_SESSION['conectado'];
    echo json_encode($correo);
} else{
    echo json_encode(0);
}
?>