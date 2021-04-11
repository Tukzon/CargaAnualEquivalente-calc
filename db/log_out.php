<?php 
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
session_start();
$_SESSION['conectado'] = NULL;
session_destroy();

$arr = array("valor"=> 1,"mensaje"=>"Su sesion se ha cerrado");
echo json_encode($arr);

 ?>