<?php
session_start();
include_once('./conexion.php');

$fail = Array();
$pass = Array();

if (!empty($_POST['email']) || !empty($_POST['contrasena'])){

    $fail[0] = 1;
    $fail[1] = "Las credenciales ingresadas no coinciden";
    $fail[2] = "Ha ocurrido un error";

    $correo=$_POST['email'];
    $password=$_POST['contrasena'];

    $pass[0] = 0;
    $pass[1] = "Sesion iniciada";

    $result = mysqli_query($conexion, "SELECT email, contrasena FROM usuarios WHERE email = '$correo'");
    $fila = mysqli_fetch_assoc($result);
    $hash = $fila['contrasena'];

    if(password_verify($password, $hash)){
        $_SESSION['conectado'] = $correo;
        $arr = array("valor" => 0 ,"mensaje"=>$pass[1]);
        echo json_encode($arr);
    }else{
        $arr = array("valor" => 1 ,"mensaje"=>$fail[1]);
        echo json_encode($arr);
    }

}else{
    $arr = array("valor"=> 1 ,"mensaje"=>$fail[2]);
    echo json_encode($arr);
}
?>