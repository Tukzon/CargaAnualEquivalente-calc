<?php 
session_start();

	$VC = $_POST['ValC'];
    $NC = $_POST['NumC'];
    $PC = $_POST['ValP'];
    $OC = $_POST['OtrC'];

	if($NC*$VC <= $PC){
		echo json_encode("Cae negativo, no soportado");
	}else{

		if($PC/$NC == $VC){
			echo json_encode($OC*0.012);
		}else{	
			if($VC <= 0 || $NC < 2 || $PC <= 0){
				die("Ingrese valores validos");
			}else{
				$counter=0;
				$x=10000;
				$im=0;
				$iM=100;
				while (($x>10 or $x<-10) and $counter<10000){
					$x=-$PC-$OC;
					$i=($im+$iM)/2;
					for ($j = 1; $j <= $NC; $j++){
						$x+=($VC)/((1+$i)**$j);
					}
					if ($x>10){
						$im=$i;
					}
					else if ($x<-10){
						$iM=$i;
					}
					$counter+=1;
				}
				$Im= $i;
				$Ia=((1+$Im)**12-1)*100;
				$It=((1+$Im)**$NC-1)*100;
				if($OC > 0){
					$data = array('valor_cuota' => $VC, 'num_cuota' => $NC, 'precio_contado' => $PC, 'otros_costos' => $OC, 'resultado' => $Ia);
				}else{
					$data = array('valor_cuota' => $VC, 'num_cuota' => $NC, 'precio_contado' => $PC, 'otros_costos' => 0, 'resultado' => $Ia);
				}
				$_SESSION['calculo'] = $data;
				echo json_encode($Ia);
			}
		}
	}
?>