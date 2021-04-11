<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST');

header("Access-Control-Allow-Headers: X-Requested-With");
session_start();
include_once('./conexion.php');
$fail = Array();
$fail[0] = "Ha ocurrido un problema"; 
if(isset($_SESSION['conectado'])){
    $correo = $_SESSION['conectado'];
    $query = "SELECT tienda,producto,marca,precio_contado,valor_cuota,num_cuota,otros_costos,resultado, fecha FROM registros WHERE usuario = '$correo'";
    $result = $conexion->query($query);
    $n = 1;
    $historial = Array();
    while($row = mysqli_fetch_assoc($result)){
        $hist = array('numero' => $n,"tienda"=>$row["tienda"],"producto"=>$row["producto"],"marca"=>$row["marca"],"precio_contado"=>$row["precio_contado"],"valor_cuota"=>$row["valor_cuota"],
        "num_cuota"=>$row["num_cuota"],"otros_costos"=>$row["otros_costos"],"resultado"=>$row["resultado"],"fecha"=>$row["fecha"]);
        $n = $n + 1;
        array_push($historial, $hist);
    }
    $arr = array("valor"=>1,"tabla"=>$historial);
    echo json_encode($arr);
}else{
    echo json_encode($fail[0]);
}
?>