<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
    body{
/*
        background-image: url(img/fondopdf.jpg);
        background-size: 1010px auto;
*/
    }
</style>
<?php 
session_start();
include("php_conexiones.php");


$user=$_SESSION['usuario'];
					$ressulll=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
					while($vat=mysqli_fetch_row($ressulll)){
						$iduss=$vat[0];
						
					}


$session=$_SESSION['num'];
$usuario=$iduss;


$idunidad=0;
$nomrotatorio;
$result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$usuario' and idsession='$session'");
if($ver=mysqli_fetch_row($result)){
    $idunidad=$ver[4];
    $nomrotatorio=$ver[14];
    $subtotal = $ver[8];
      $descuento = $ver[6];
      $iva = $ver[7];
      $totalSis = $ver[5];
      $gastos = $ver[9];
      $total90 = $ver[10];
}
//echo $idunidad."<br>";
//echo $nomrotatorio."<br>";




$result=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$usuario' and idsession='$session' and id_component='$idunidad'");
$reg= $result->num_rows;
//echo $reg."<br>";
$i=0;

echo "
<body>
<table> 
            <tr>
                <td rowspan='2'><img style='width:80px;' src='img/madero_redondo.png'></td>
                <th>COTIZACION DE ROTATORIO $nomrotatorio</th>
               
            </tr>
            <tr>
                <td>SISTEMA DE ORDEÑO</td>
                
            </tr>
           
        </table>

";

echo "<a style='font-size:30px;'>COMPONENTES</a>";
while($var=mysqli_fetch_row($result)){
   $idcomponente=$var[1];
    
    $cadena="<table class=''  border='1px'  style='width:1010px'>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan='4'>$var[2]</th>
                    </tr>
                    <tr>
                        <th style='width:10%;'>ID</th>
                        <th style='width:50%;'>DESCRIPCION</th>
                        <th style='width:10%;'>CANTIDAD</th>
                        <th style='width:15%;'>PRECIO</th>
                        <th style='width:15%;'>TOTAL</th>
                    <tr>
                </thead>
                <tbody>
             ";
            $resul=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponente' and id_usuario='$usuario' and idsession='$session'");
            while($ver=mysqli_fetch_row($resul)){
                $a=$ver[3];
                $b=$ver[4];
                $c=$ver[3]*$ver[4];    
                //echo $c;
                $b=number_format($b,2);
                $c=number_format($c,2);
                $cadena=$cadena." <tr>
                                <td style='width:10%;'>$ver[1]</td>
                                <td style='width:50%;'>$ver[2]</td>
                                <td style='width:10%; text-align: right;'>$ver[3]</td>
                                <td style='width:15%; text-align: right;'>$$b</td>
                                <td style='width:15%; text-align: right;'>$$c</td>
                                </tr>";
            }
$cadena=$cadena."
                </body>
            </table>";
  echo $cadena."<br>";  
}

$opc=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$usuario' and idsession='$session' and id_component=id_producto");
$reg= $opc->num_rows;
echo "<a style='font-size:30px;'>OPCIONALES</a>";

while($vir=mysqli_fetch_row($opc)){
    $idcomponent=$vir[1];
    $cade="<table class='' border='1px' style='width:1010px'>
                <thead>
                     <tr>
                        <th></th>
                        <th colspan='4'>$vir[2]</th>
                    </tr>
                    <tr>
                        <th style='width:10%;'>ID</th>
                        <th style='width:50%;'>DESCRIPCION</th>
                        <th style='width:10%;'>CANTIDAD</th>
                        <th style='width:15%;'>PRECIO</th>
                        <th style='width:15%;'>TOTAL</th>
                    <tr>
                </thead>
                <tbody>
             ";
            $partopc=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponent' and id_usuario='$usuario' and idsession='$session'");
            while($vur=mysqli_fetch_row($partopc)){
                $a=$vur[3];
                $b=$vur[4];
                $c=$vur[3]*$vur[4];    
                //echo $c;
                $b=number_format($b,2);
                $c=number_format($c,2);
                if($vur[0]!=$vur[1]){
                $cade=$cade." <tr>
                                <td style='width:10%;'>$vur[1]</td>
                                <td style='width:50%;'>$vur[2]</td>
                                <td style='width:10%; text-align: right;'>$vur[3]</td>
                                <td style='width:15%; text-align: right;'>$$b</td>
                                <td style='width:15%; text-align: right;'>$$c</td>
                                </tr>";
            }}
$cade=$cade."
                </body>
            </table>";
 
    
    
  echo $cade."<br>";   
}
$descuento=($descuento/100)*$totalSis;

 $subtotal=number_format($subtotal,2);
 $descuento=number_format($descuento,2);
 $iva=number_format($iva,2);
 $totalSis=number_format($totalSis,2);
 $gastos=number_format($gastos,2);
 $total90=number_format($total90,2);





$numero=$total90;
function unidad($numuero){
switch ($numuero)
{
case 9:
{
$numu = "NUEVE";
break;
}
case 8:
{
$numu = "OCHO";
break;
}
case 7:
{
$numu = "SIETE";
break;
}
case 6:
{
$numu = "SEIS";
break;
}
case 5:
{
$numu = "CINCO";
break;
}
case 4:
{
$numu = "CUATRO";
break;
}
case 3:
{
$numu = "TRES";
break;
}
case 2:
{
$numu = "DOS";
break;
}
case 1:
{
$numu = "UNO";
break;
}
case 0:
{
$numu = "";
break;
}
}
return $numu;
}

function decena($numdero){

if ($numdero >= 90 && $numdero <= 99)
{
$numd = "NOVENTA ";
if ($numdero > 90)
$numd = $numd."Y ".(unidad($numdero - 90));
}
else if ($numdero >= 80 && $numdero <= 89)
{
$numd = "OCHENTA ";
if ($numdero > 80)
$numd = $numd."Y ".(unidad($numdero - 80));
}
else if ($numdero >= 70 && $numdero <= 79)
{
$numd = "SETENTA ";
if ($numdero > 70)
$numd = $numd."Y ".(unidad($numdero - 70));
}
else if ($numdero >= 60 && $numdero <= 69)
{
$numd = "SESENTA ";
if ($numdero > 60)
$numd = $numd."Y ".(unidad($numdero - 60));
}
else if ($numdero >= 50 && $numdero <= 59)
{
$numd = "CINCUENTA ";
if ($numdero > 50)
$numd = $numd."Y ".(unidad($numdero - 50));
}
else if ($numdero >= 40 && $numdero <= 49)
{
$numd = "CUARENTA ";
if ($numdero > 40)
$numd = $numd."Y ".(unidad($numdero - 40));
}
else if ($numdero >= 30 && $numdero <= 39)
{
$numd = "TREINTA ";
if ($numdero > 30)
$numd = $numd."Y ".(unidad($numdero - 30));
}
else if ($numdero >= 20 && $numdero <= 29)
{
if ($numdero == 20)
$numd = "VEINTE ";
else
$numd = "VEINTI".(unidad($numdero - 20));
}
else if ($numdero >= 10 && $numdero <= 19)
{
switch ($numdero){
case 10:
{
$numd = "DIEZ ";
break;
}
case 11:
{
$numd = "ONCE ";
break;
}
case 12:
{
$numd = "DOCE ";
break;
}
case 13:
{
$numd = "TRECE ";
break;
}
case 14:
{
$numd = "CATORCE ";
break;
}
case 15:
{
$numd = "QUINCE ";
break;
}
case 16:
{
$numd = "DIECISEIS ";
break;
}
case 17:
{
$numd = "DIECISIETE ";
break;
}
case 18:
{
$numd = "DIECIOCHO ";
break;
}
case 19:
{
$numd = "DIECINUEVE ";
break;
}
}
}
else
$numd = unidad($numdero);
return $numd;
}

function centena($numc){
if ($numc >= 100)
{
if ($numc >= 900 && $numc <= 999)
{
$numce = "NOVECIENTOS ";
if ($numc > 900)
$numce = $numce.(decena($numc - 900));
}
else if ($numc >= 800 && $numc <= 899)
{
$numce = "OCHOCIENTOS ";
if ($numc > 800)
$numce = $numce.(decena($numc - 800));
}
else if ($numc >= 700 && $numc <= 799)
{
$numce = "SETECIENTOS ";
if ($numc > 700)
$numce = $numce.(decena($numc - 700));
}
else if ($numc >= 600 && $numc <= 699)
{
$numce = "SEISCIENTOS ";
if ($numc > 600)
$numce = $numce.(decena($numc - 600));
}
else if ($numc >= 500 && $numc <= 599)
{
$numce = "QUINIENTOS ";
if ($numc > 500)
$numce = $numce.(decena($numc - 500));
}
else if ($numc >= 400 && $numc <= 499)
{
$numce = "CUATROCIENTOS ";
if ($numc > 400)
$numce = $numce.(decena($numc - 400));
}
else if ($numc >= 300 && $numc <= 399)
{
$numce = "TRESCIENTOS ";
if ($numc > 300)
$numce = $numce.(decena($numc - 300));
}
else if ($numc >= 200 && $numc <= 299)
{
$numce = "DOSCIENTOS ";
if ($numc > 200)
$numce = $numce.(decena($numc - 200));
}
else if ($numc >= 100 && $numc <= 199)
{
if ($numc == 100)
$numce = "CIEN ";
else
$numce = "CIENTO ".(decena($numc - 100));
}
}
else
$numce = decena($numc);

return $numce;
}

function miles($nummero){
if ($nummero >= 1000 && $nummero < 2000){
$numm = "MIL ".(centena($nummero%1000));
}
if ($nummero >= 2000 && $nummero <10000){
$numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
}
if ($nummero < 1000)
$numm = centena($nummero);

return $numm;
}

function decmiles($numdmero){
if ($numdmero == 10000)
$numde = "DIEZ MIL";
if ($numdmero > 10000 && $numdmero <20000){
$numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
}
if ($numdmero >= 20000 && $numdmero <100000){
$numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
}
if ($numdmero < 10000)
$numde = miles($numdmero);

return $numde;
}

function cienmiles($numcmero){
if ($numcmero == 100000)
$num_letracm = "CIEN MIL";
if ($numcmero >= 100000 && $numcmero <1000000){
$num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
}
if ($numcmero < 100000)
$num_letracm = decmiles($numcmero);
return $num_letracm;
}

function millon($nummiero){
if ($nummiero >= 1000000 && $nummiero <2000000){
$num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
}
if ($nummiero >= 2000000 && $nummiero <10000000){
$num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
}
if ($nummiero < 1000000)
$num_letramm = cienmiles($nummiero);

return $num_letramm;
}

function decmillon($numerodm){
if ($numerodm == 10000000)
$num_letradmm = "DIEZ MILLONES";
if ($numerodm > 10000000 && $numerodm <20000000){
$num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
}
if ($numerodm >= 20000000 && $numerodm <100000000){
$num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
}
if ($numerodm < 10000000)
$num_letradmm = millon($numerodm);

return $num_letradmm;
}

function cienmillon($numcmeros){
if ($numcmeros == 100000000)
$num_letracms = "CIEN MILLONES";
if ($numcmeros >= 100000000 && $numcmeros <1000000000){
$num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
}
if ($numcmeros < 100000000)
$num_letracms = decmillon($numcmeros);
return $num_letracms;
}

function milmillon($nummierod){
if ($nummierod >= 1000000000 && $nummierod <2000000000){
$num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod >= 2000000000 && $nummierod <10000000000){
$num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
}
if ($nummierod < 1000000000)
$num_letrammd = cienmillon($nummierod);

return $num_letrammd;
}




function convertir($numero){
$num = str_replace(",","",$numero);
$num = number_format($num,2,'.','');
$cents = substr($num,strlen($num)-2,strlen($num)-1);
$num = (int)$num;

$numf = milmillon($num);

return $numf." PESOS CON ".$cents."/100";
}

//echo convertir($numero);

$rr=convertir($numero);










echo "
  <div class='container' >
    <p class='totales' >
      <h4>Total Sistema: $$totalSis</h4>
      <h4>Descuento: $$descuento</h4>
      <h4>IVA: $$iva</h4>
      <h4>Subtotal: $$subtotal</h4>
      <h4>Gastos de Instalación: $$gastos</h4>
      <h4>Total: $$total90</h4>
      <h4>Con letra: $rr</h4>
    </p>
  </div>
  </body>
  ";

?>
<script>
function doPrint(theForm) {
var i;
for(i=0; i<theForm.elements.length ; i++) {
// Agregar en esta lista de condiciones
// todos aquellos tipos de Input que se quieren ocultar
if( (theForm.elements[i].type == "submit") ||
(theForm.elements[i].type == "reset") ||
(theForm.elements[i].type == "button") )
theForm.elements[i].style.visibility = 'hidden';
}
window.print();

for(i=0; i<theForm.elements.length ; i++) {
if( (theForm.elements[i].type == "submit") ||
(theForm.elements[i].type == "reset") ||
(theForm.elements[i].type == "button") )
theForm.elements[i].style.visibility = 'visible';
}
} 
    
</script>
</body>