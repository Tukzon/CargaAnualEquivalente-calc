<?php
include_once('./conexion.php');
session_start();
if(!isset($_SESSION['conectado'])){
    echo json_encode("Inicie sesion");
}elseif(!isset($_SESSION['calculo'])){
    echo json_encode("Realice el calculo");
}else{

    $usuario = $_SESSION['conectado'];
    $calculo = $_SESSION['calculo'];
    $VC = $calculo['valor_cuota'];
    $NC = $calculo['num_cuota'];
    $PC = $calculo['precio_contado'];
    $OC = $calculo['otros_costos'];
    $resultado = $calculo['resultado'];

    $fail = Array();
    $pass = Array();

    $fail[0] = "XD";
    $fail[1] = "Me da flojera limpiar esto";
    $fail[2] = "Error al guardar";
    $pass[0] = "Guardado satisfactoriamente";


    if(!isset($_POST['tienda']) || !isset($_POST['marca']) || !isset($_POST['producto'])){
        json_encode($fail[2]);
    }else{

        $tienda = $_POST['tienda'];
        $marca = $_POST['marca'];
        $producto = $_POST['producto'];
    
        if($OC >= 0){
        $query = "INSERT INTO registros (usuario,tienda,producto,marca,precio_contado,valor_cuota,num_cuota,resultado,otros_costos) VALUES ('$usuario', '$tienda', '$producto', '$marca', '$PC', '$VC', '$NC', '$resultado','$OC')";
        }else{
            $query = "INSERT INTO registros (usuario,tienda,producto,marca,precio_contado,valor_cuota,num_cuota,resultado,otros_costos) VALUES ('$usuario', '$tienda', '$producto', '$marca', '$PC', '$VC', '$NC', '$resultado','0')";
        }

        if ($conexion->query($query) === TRUE){
            echo json_encode($pass[0]);   
        }else{
            echo json_encode($fail[2]);
            echo json_encode($query);
        }
    }
}  
?>