<?php
include("php_conexiones.php");
include_once 'app/categorias.inc.php';
include_once 'app/Relacion.inc.php';
$relaciones= array();
$result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and C.id_cat=1");
$reg= $result->num_rows; 
$outp="";
if ($reg>0){
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
		$relaciones[]= new relacion($rs['id'],$rs['id_cat'],$rs['nombre'],$rs['descripcion'],$rs['padre']);
	}
}
?>
   