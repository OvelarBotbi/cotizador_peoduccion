<?php 
header('Content-Type: text/html; charset=UTF-8');
        $user='Daniel_Fuentes';
        $password='b3x73c.2019@';
        $db='sdc_madero';
        $host='localhost';
        $port='3306';
        $conn = new mysqli($host, $user,$password, $db);
        $conn->query("SET NAMES 'utf8'");

    
if ($conn->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    echo "<br>";
}

if (!$result=$conn->query("CALL proc0000()")) {
    echo "Falló CALL: (" . $conn->errno . ") " . $conn->error;
}
$result->bindParam(1, $valor_devuleto, PDO::PARAM_STR, 4000); 

$sentencia->execute();

print "El procedimiento devolvió $valor_devuleto\n";







//else{
//    echo "Si jalo";
//    $sel="SELECCIONAR";
//			$val=0;
//			$click="recargarTamanos()";
//		$cadena="<a class='letche'>PLATAFORMA</a>
//			<select id='pla' name='idplataforma' class='form-control'>
//			<option value'$val' disabled  selected>$sel</option>";
//            
//            while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
//                $cadena=$cadena.'<option value='.$ver['id'].' Onclick='.$click.'>'.($ver['descripcion']).'</option>';
//            }
////			while ($ver=mysqli_fetch_row($result)) {
////				
////				$cadena=$cadena.'<option value='.$ver[0].' Onclick='.$click.'>'.utf8_encode($ver[2]).'</option>';
////			}
//
//			echo  $cadena."</select>";
//			
//}


?>