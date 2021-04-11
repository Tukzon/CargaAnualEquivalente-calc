<?php
include_once('./conexion.php');

$form_pass = $_POST['clave1'];
$form_email = $_POST['email'];
$ver_pass = $_POST['clave2'];

$fail = Array();
$pass = Array();

$fail[0] = 1;
$fail[1] = "Las contrasenas no coinciden";
$fail[2] = "El email ya se encuentra registrado";
$fail[3] = "Error al crear cuenta";

$pass[0] = 0;
$pass[1] = "Registrado satisfactoriamente";

if($form_pass != $ver_pass){
    $arr = array("valor"=>$fail[0],"mensaje"=>$fail[1]);
    echo json_encode($arr);
}else{
    $buscarUsuario = "SELECT * FROM usuarios WHERE email = '$form_email' ";

    $result = $conexion->query($buscarUsuario);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $arr = array("valor"=>1,"mensaje"=>$fail[2]);
        echo json_encode($arr);
    }else{
        $hash = password_hash($form_pass, PASSWORD_BCRYPT);

        $query = "INSERT INTO usuarios (email, contrasena) VALUES ('$form_email', '$hash')";

        if ($conexion->query($query) === TRUE) {
            $arr = array("valor"=>0,"mensaje"=>$pass[1]);
            echo json_encode($arr);   
        }else{
            $arr = array("valor"=>0,"mensaje"=>$fail[3]);
            echo json_encode($arr); 
        }
    }
}
mysqli_close($conexion);
?>