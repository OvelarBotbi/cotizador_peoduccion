<?php
  session_start();
#Conexion a base de datos
  header('Content-Type: text/html; charset=UTF-8');
  $servername = 'localhost';
  $username = 'Daniel_Fuentes';
  $password = 'b3x73c.2019@';
  $dbname = 'sdc_madero';
  $port='3306';
  $conn = new mysqli($servername, $username, $password, $dbname);
  //$conn->query("SET NAMES 'utf8'");

$user= $_SESSION['usuario'];
					$ressulll=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
					while($vat=mysqli_fetch_row($ressulll)){
						$iduss=$vat[0];
						
					}

           

  $idUsuario = $iduss;
  $idUnidad = 0;
  $idSesion = $_SESSION['num'];


  if($conn->connect_error){
    die("Falló la conexión -> ". $conn->connect_error);
  }

$idunidad=0;
  $unidadn=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$idUsuario' and idsession='$idSesion'");
  if($verr=mysqli_fetch_row($unidadn)){
      $idunidad=$verr[4];
      $nomrotatorio=$verr[14];
      $subtotal = $verr[8];
      $descuento = $verr[6];
      $iva = $verr[7];
      $totalSis = $verr[5];
      $gastos = $verr[9];
      $total90 = $verr[10];
      
  }    
  $result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$idUsuario' and idsession='$idSesion'");
                while($var = $result->fetch_array(MYSQLI_ASSOC)) {
                    $sistema=$var['sistema'];
                    $plataforma=$var['plataforma'];
                    $capacidad=$var['capacidad'];
                    $unidad=$var['unidad'];
                    $precio=$var['precio'];
                    $decuento=$var['descuento'];
                    $iva=$var['IVA'];
                    $subtotal=$var['sub'];
                    $gastos=$var['ginstalacion'];
                    $total=$var['total'];
                    $nomcliente=$var['cliente'];
                    $notaa = $var['observaciones'];
                }
                $notaa=utf8_encode($notaa);
$resultt=$conn->query("SELECT * FROM productos");
        while($ver = $resultt->fetch_array(MYSQLI_ASSOC)) {
            if($sistema==$ver['id']){
                $sistema=$ver['nombre'];
            }else if($plataforma==$ver['id']){
                 $plataforma=$ver['nombre'];
            }else if($capacidad==$ver['id']){
                 $capacidad=$ver['nombre'];
            }else if($unidad==$ver['id']){
                 $unidad=$ver['nombre'];
            }
        }

  $nombrerotatorio=$unidad." ".$sistema." ".$plataforma;
  #Solo se pueden imprimir 25 renglones por hoja del reporte...
  ob_start();
  $sysType = "Sistema de rotatorio";
  $mainTitle = utf8_encode($nombrerotatorio);
  $secondTitle = $capacidad;
  $date = "Fecha: ".date("d-m-Y");
  $cliente = "Ciente:".$nomcliente;   
  $url = "Madero Premium Super Inox 32 Puestos";
  $componentes = 3;
  $comp = array("Rotatorio", "Inox", "Premium");
  $nombres = array("Glandula 1", "Glandula 2", "Glandula 3", "Glandula 4", "Glandula 5", "Glandula 6", "Glandula 7"
              ,"Glandula 8" ,"Glandula 9" ,"Glandula 10" ,"Glandula 11" ,"Glandula 12" ,"Glandula 13" ,"Glandula 14"
              ,"Glandula 15" ,"Glandula 16" ,"Glandula 17" ,"Glandula 18" ,"Glandula 19" ,"Glandula 20" ,"Glandula 21"
              ,"Glandula 22" ,"Glandula 23" ,"Glandula 24" ,"Glandula 25");
  $contador = 0;
  $noPag = ($componentes*2+count($nombres))/25+1;
?>
<page backtop="4mm" backbottom="4mm" backleft="4mm" backright="4mm">
  <div style="height: 85%; width: 100%; background-color: #00528A;">
    <!-- Contendor 1 -->
    <div style="height: 50%; width: 100%; display: inline-block; position: relative;">
      <!-- espacio de imagen -->
      <div
        style="background-color: white; height: 90%; margin-left: 4%; margin-right; 4%; margin-top: 10%; width: 92%;">
        <!--Cuadro blanco -->
        <!-- Cuadrito azul -->
        <img src="../public/static/mad_prem.jpg" style="width: 100%; height: 100%; object-fit: contain;" />
        <div
          style="display: block; position: absolute; top: 15%; right: 0; background-color: #00528A;width: 25%; height: 5%; padding: 10px; padding-top: 0px;">
          <p style="background-color: #00528A; color: white; font: Times; font-weigth: lighter;
              font-size: 14px; text-align: center;"><?php echo $sysType; ?></p>
        </div>
      </div>
    </div>
    <!-- contenedor 2 -->
    <div style="height: 40%; width: 100%; display: inline-block; position: relative;">
      <!-- cuadro informativo 1 -->
      <div
        style="background-color: white; display: block; width: 30%; height: 40%; position: absolute; left: 4%; top: 10%;">
        <hr style="background-color:#00528A; border: none; width: 50%; margin: 0 auto;" />
        <h3 style="font-size: 16px; color: #06528D; padding: 15px; text-align: Center;">
          Soluciones Óptimas e Integrales para los productores lecheros
        </h3>
        <h2 style="color: #929295; padding: 15px; font-size: 14px; text-align: center;"><img
            src="../public/static/here_icon.png" style="height: 15px; width: 15px;" />
          J.F. Brittingham 110 nte.<br /> Int. 1, Cd. Industrial Trc.<br />Torreón, Coah. México.<br />
        </h2>
        <h2 style="color: #929295; padding: 15px; font-size: 14px; font-weigth: 200; text-align: center;"><img
            src="../public/static/telefono_icon.png" style="height: 15px; width: 15px;">
          (871) 747 1300 / 05
        </h2>
        <br />
        <br />
        <hr size="30px" style="border: none; background-color: #929295" />
      </div>
      <!-- cuadro informativo 2 -->
      <div
        style="background-color: white; display: block; width: 60%; text-align: center;position: absolute; right: 4%; top: 10%; padding: 10px;">
        <img style="display: block; margin: auto;" src="../public/static/madero-logo-ft2.png" />
        <h3 style="text-align: left; font-size: 32px; color: #00AEEF; margin: 10;"><?php echo $mainTitle; ?></h3>
        <h2 style="text-align: left; font-size: 24px; color: #F7931D; margin: 0 10 10 10;"><?php echo $secondTitle; ?>
        </h2>
        
        <br />
        <h4 style="margin: 0 auto; 12px; color: #06528D;"><?php echo $date; ?>&nbsp;&nbsp;<?php echo $cliente; ?> </h4>
        <hr size="30px" style="border: none; background-color: #06528D;" />
      </div>
    </div>
  </div>
  <!-- contenedor 3 -->
  <div style="width: 100%; background-color: white; height: 14%; display: inline-block; position: relative;">
    <div style="display: block;">
      <img style="height: 100px; width: 200px; " src="../public/static/keep_milking.png" />
    </div>
    <div style="display: block; position: absolute; right: 5%; top: 20%;">
      <p style="color: #06528D; font-weight: bold;">www.maderoequipos.com.mx</p>
    </div>
  </div>

</page>

<!-- pagina dos-->
<style>
  .main-draw {
    margin: 0 auto;
    border: none;
    width: 100%;
    height: 20%;
}
  #left-polygon { 
    fill: #00528A; 
    stroke: #00528A;
  }

  #right-polygon {
    fill: #929295;
    stroke: #929295;
  }
  
  #title-desc {
    color: white;
    font-size: 28px;
    margin: 0;
    padding: 0;
  }

  .header-title {
    position: absolute;
    right: 3%;
    top: 30;
    width: 55%;
  }

  .header-icon{
    position: absolute;
    left: 7%;
    top: 60;
    width: 30%
  }

  #logo {
    height: 100px;
    width: 100px;
  }

  .container {
    margin-top: 20px;
    position: relative;
    height: 65%;
    width: 100%;
  }
  
  .main-table {
    width: 100%;
      margin-bottom: 10px;
  }

  .alternate {
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    table-layout: fixed;
    margin-left: 6%;
  }

  th{
    color: white;
    font-weight: bold;
  }

  .th-1{
    background-color: #002F53;
    width: 600px;
    height: 20px;
    text-align: center;
    border: none;
    margin: 0 auto;
  }

  .td-subtitle {
    background-color: #00528A;
    color: white;
    padding: 5px;
    font-weight: bold;
    text-align: center;
  }

  #name{
    text-align: left;
  }

  .td-data {
    padding: 5px;
    color: black;
    text-align: center;
    border-bottom: 1px solid lightgray;
  }

  .td-nombre{
    text-aling: left;
    padding: 5px;
    width: 50%;
    border-bottom: 1px solid lightgray;
  }

  .down-draw {
    margin: 0 auto;
    border: none;
    width: 100%;
    height: 8%;
  }

  #bright-polygon {
    fill: #929295;
    stroke: #929295;
    z-index: 1;
  }

  #bleft-polygon {
    fill: #00528A; 
    stroke: #00528A;
    z-index: -1;
  }

  .footer-title {
    position: relative;
    width: 60%;
    height: 100%;
    padding: 0;
  }

  .footer-title .footer-text {
    position: absolute;
    top: 46%;
    font-size: 14px;
    color: white;
    font-weight: lighter;
  }

  .totales {
    padding: 0;
    margin: 0;
    float: right;
    text-align: right;
  }

  .totales h4 {
    padding: 0;
    margin: 0;
    font-weight: bold;
    font-size: 14px;
  }
</style>

<?php
  //$idunidad=0;
  $unidad=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$idUsuario' and idsession='$idSesion'");
  if($ver=mysqli_fetch_row($unidad)){
      $idunidad=$ver[4];
      $nomrotatorio=$ver[14];
      $subtotal = $ver[8];
      $descuento = $ver[6];
      $iva = $ver[7];
      $totalSis = $ver[5];
      $gastos = $ver[9];
      $total90 = $ver[10];
  }
    $nomrotatorio =utf8_encode($nomrotatorio);
  $result=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$idUsuario' and idsession='$idSesion' and id_component='$idunidad'");
  //$reg= $result->num_rows;
?>
<page backtop="4mm" backbottom='4mm' backleft='4mm' backright='4mm'>
<div class='container'>
<?php
    while($var=mysqli_fetch_row($result)){
    $nombreComp = utf8_encode($var[2]);
    $idcomponente=$var[1];
        print "
        <div class='main-table'>
        <table class='alternate' cellspacing='0' cellpadding='0'>
        <thead>
          <tr>
            <th class='th-1' colspan='4'>$nombreComp</th>
          </tr>
          <tr>
            <th class='td-subtitle' id='name'>NOMBRE</th>
            <th class='td-subtitle'>CANTIDAD</th>
            <th class='td-subtitle'>PRECIO/UNI</th>
            <th class='td-subtitle'>TOTAL</th>
          </tr>
        </thead>
        <tbody>
        ";
        $resul=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponente' and id_usuario='$idUsuario' and idsession='$idSesion'");
        while($ver=mysqli_fetch_row($resul)){
          $nombre = utf8_encode($ver[2]); 
          $cantidad = $ver[3];
          $precioUnit = $ver[4];
          $total = $cantidad*$precioUnit;
        $precioUnit=number_format($precioUnit,2);
            $total=number_format($total,2);
            print "
            <tr>
            <td class='td-nombre'>$nombre</td>
            <td class='td-data'>$cantidad</td>
            <td class='td-data' style='text-align: right;'>$$precioUnit</td>
            <td class='td-data' style='text-align: right;'>$$total</td>
          </tr>";
        }
        print "
        </tbody>
        </table>
        </div>";
 }

 $result=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$idUsuario' and idsession='$idSesion' and id_component=id_producto");
  //$reg= $result->num_rows;
  while($var=mysqli_fetch_row($result)){
    $nombreComp = utf8_encode($var[2]);
    $cantidadcomp=$var[3];
    $idcomponente=$var[1];
     
        print "
        <div class='main-table'>
        <table class='alternate' cellspacing='0' cellpadding='0'>
        <thead>
          <tr>
            <th class='th-1'  colspan='4'>$nombreComp ($cantidadcomp)</th>
          </tr>
          <tr>
            <th class='td-subtitle' id='name' >NOMBRE</th>
            <th class='td-subtitle' >CANTIDAD(UNIT)</th>
            <th class='td-subtitle' >PRECIO/UNI</th>
            <th class='td-subtitle'>TOTAL</th>
          </tr>
        </thead>
        <tbody>
        ";
        $resul=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponente' and id_usuario='$idUsuario' and idsession='$idSesion'");
        while($ver=mysqli_fetch_row($resul)){
          $nombre = utf8_encode($ver[2]); 
          
          $cantidad = $ver[3];
          $cantidaduni=$cantidad/$cantidadcomp;
          $precioUnit = $ver[4];
          $total = $cantidad*$precioUnit;
             $precioUnit=number_format($precioUnit,2);
            $total=number_format($total,2);
             if($ver[0]!=$ver[1]){
            print "
            <tr>
              <td class='td-nombre'>$nombre</td>
              <td class='td-data'>$cantidad ($cantidaduni)</td>
              <td class='td-data' style='aling:right;'>$$precioUnit</td>
              <td class='td-data' style='aling:right;'>$$total</td>
          </tr>";
             }
        }
        print "
        </tbody>
        </table>
        </div>";
 }
?>
    </div>
</page>
<?php
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
function multiexplode ($delimiters,$string) {   
  $ready = str_replace($delimiters, $delimiters[0], $string);
  $launch = explode($delimiters[0], $ready);
  return  $launch;
}
$notas= multiexplode(array("-","*"), $notaa);
 print"<page backtop='4mm' backbottom='4mm' backleft='4mm' backright='4mm'>
  <draw class='main-draw'>
      <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
      <polygon id='right-polygon' points='900 180,216 180,242 0,900 0'>
  </draw><br>
  <div class='header-title'>
    <h3 id='title-desc'>$nomrotatorio</h3>
  </div>
  <div id='table container' class='header-icon'>
    <img id='logo' src='../public/static/madero-logo-ft2.png'/>
  </div>
  <div class='container'>
    <p class='totales'>
      <h4>Total Sistema: $$totalSis</h4>
      <h4>Descuento: $$descuento</h4>
      <h4>Gastos de Instalación: $$gastos</h4>
      <h4>Subtotal: $$subtotal</h4>
      <h4>IVA: $$iva</h4>
      <h4>Total: $$total90</h4>
      <h4>Con letra: $rr</h4>
    </p>
    <h4 style='font-size:11px; top:-500px;'>Nota:</h4>
    ";
         for($i=1;$i<count($notas);$i++){
           if($i==1){
            print "<b style='font-size:9px'> -". $notas[$i]."</b><br>";
           }else{
            print "<b style='font-size:9px'>-". $notas[$i]."</b><br>";

           }      
          }
  print "
  </div>
  
  
  <draw class='down-draw'>
    <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
    <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
    <div class='footer-title'>
    <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
  </div> 
  </draw>  
  </page>";
?>
<?php
  use Spipu\Html2Pdf\Html2Pdf;
  use Spipu\Html2Pdf\Exception\Html2PdfException;
  use Spipu\Html2Pdf\Exception\ExceptionFormatter;

  $content = ob_get_clean();
  require_once(dirname(__FILE__).'/../vendor/autoload.php');
  try
  {
      $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
      $html2pdf->pdf->SetDisplayMode('fullpage');
      $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
      $html2pdf->Output('PDF-CF.pdf');
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }