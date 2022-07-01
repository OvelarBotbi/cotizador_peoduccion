<?php
session_start();


#Conexion a base de datos
header('Content-Type: text/html; charset=UTF-8');
$servername = 'cotizaciones.maderoequipos.com.mx';
$username = 'cotizaciones';
$password = 'D514jq&i';
$dbname = 'merkanet_cotizaciones';
$port = '3306';
$conn = new mysqli($servername, $username, $password, $dbname);
//$conn->query("SET NAMES 'utf8'");

$user = $_SESSION['usuario'];
$ressulll = $conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
while ($vat = mysqli_fetch_row($ressulll)) {
  $iduss = $vat[0];
}


$imagen = '../public/static/mad_prem.jpg';
$idUsuario = $iduss;
$idUnidad = 0;
$idSesion = $_SESSION['num'];


if ($conn->connect_error) {
  die("Falló la conexión -> " . $conn->connect_error);
}

$idunidad = 0;
$unidadn = $conn->query("SELECT * FROM rotatorio WHERE id_usuario='$idUsuario' and idsession='$idSesion'");
if ($verr = mysqli_fetch_row($unidadn)) {
  $idunidad = $verr[4];
  $nomrotatorio = $verr[14];
  $subtotal = $verr[8];
  $descuento = $verr[6];
  $iva = $verr[7];
  $totalSis = $verr[5];
  $gastos = $verr[9];
  $total90 = $verr[10];
  $nota = $verr[19];
}
$nota = utf8_encode($nota);
$s_descripcion = 0;
$s_descuento = 0;
$result = $conn->query("SELECT * FROM rotatorio AS rota LEFT JOIN imagenes as img ON img.id_comp=rota.plataforma WHERE rota.id_usuario='$idUsuario' and rota.idsession='$idSesion'");
while ($var = $result->fetch_array(MYSQLI_ASSOC)) {
  $sistema = $var['sistema'];
  $plataforma = $var['plataforma'];
  $capacidad = $var['capacidad'];
  $unidad = $var['unidad'];
  $precio = $var['precio'];
  $decuento = $var['descuento'];
  $iva = $var['IVA'];
  $subtotal = $var['sub'];
  $gastos = $var['ginstalacion'];
  $total = $var['total'];
  $nomcliente = $var['cliente'];
  $notaa = $var['observaciones'];
  $s_descripcion = $var['show_descripcion'];
  $s_descuento = $var['show_descuentos'];
  if ($var['dir_img'] != "" && $var['dir_img'] != null) {
    $imagen = $var['dir_img'];
    $imagen = '../../' . $imagen;
  }
}
$notaa = utf8_encode($notaa);
$resultt = $conn->query("SELECT * FROM productos");
while ($ver = $resultt->fetch_array(MYSQLI_ASSOC)) {
  if ($sistema == $ver['id']) {
    $sistema = $ver['nombre'];
  } else if ($plataforma == $ver['id']) {
    $plataforma = $ver['nombre'];
  } else if ($capacidad == $ver['id']) {
    $capacidad = $ver['nombre'];
  } else if ($unidad == $ver['id']) {
    $unidad = $ver['nombre'];
  }
}
$nombrerotatorio = $plataforma;
#Solo se pueden imprimir 25 renglones por hoja del reporte...
ob_start();
$sysType = "Sistema de rotatorio";
$mainTitle = utf8_encode($nombrerotatorio);
$secondTitle = $capacidad;
$date = "Fecha: " . date("d-m-Y");
$cliente = "Ciente:" . $nomcliente;
$url = "Madero Premium Super Inox 32 Puestos";
$componentes = 3;
$comp = array("Rotatorio", "Inox", "Premium");
$nombres = array(
  "Glandula 1", "Glandula 2", "Glandula 3", "Glandula 4", "Glandula 5", "Glandula 6", "Glandula 7", "Glandula 8", "Glandula 9", "Glandula 10", "Glandula 11", "Glandula 12", "Glandula 13", "Glandula 14", "Glandula 15", "Glandula 16", "Glandula 17", "Glandula 18", "Glandula 19", "Glandula 20", "Glandula 21", "Glandula 22", "Glandula 23", "Glandula 24", "Glandula 25"
);
$contador = 0;
$noPag = ($componentes * 2 + count($nombres)) / 25 + 1;
?>

<page backtop="-3.000mm" backbottom="-3.000mm" backleft="-3.000mm" backright="-3.000mm">
  <div style="height: 85%; width: 100%; background-color: #00528A;">
    <!-- Contendor 1 -->
    <div style="height: 50%; width: 100%; display: inline-block; position: absolute; top:0px; left:0px;">
      <!-- espacio de imagen -->
      <div
        style="background-color: white; height: 90%; margin-left: 4%; margin-right; 4%; margin-top: 4%; width: 92%;">
        <!--Cuadro blanco -->
        <!-- Cuadrito azul -->
        <img src="<?php echo $imagen; ?>" style="width: 100%; height: 100%; object-fit: contain; margin-bottom: 4%;" />
        <div
          style="display: block; position: absolute; top: 15%; right: 0; background-color: #00528A;width: 25%; height: 5%; padding: 10px; padding-top: 0px;">
          <p style="background-color: #00528A; color: white; font: Times; font-weigth: lighter;
              font-size: 14px; text-align: center;"><?php echo $sysType; ?></p>
        </div>
      </div>
    <!-- contenedor 2 -->
    <div style="height: 45%; width: 100%; display: inline-block; position: relative;">
      <div style="position: absolute; background-color: white; width: 100%; height: 100%; margin-left: 4%;" ></div>
    <!-- cuadro informativo 1 -->
      <div
        style="background-color: white; display: block; width: 30%; height: 40%; position: absolute; left: 4%; top: -10%; padding-left: 4mm;">
        
        <h3 style="font-size: 16px; color: #06528D; padding: 15px; text-align: left;">
          Soluciones Óptimas e Integrales Para Los Productores Lecheros
        </h3>
        <h2 style="color: #929295; padding: 15px; font-size: 14px; text-align: left;"><img
            src="../public/static/here_icon.png" style="height: 15px; width: 15px;" />
          J.F. Brittingham 110 nte.<br /> Int. 1, Cd. Industrial Trc.<br />Torreón, Coah. México.<br />
        </h2>
        <h2 style="color: #929295; padding: 15px; font-size: 14px; font-weigth: 200; text-align: left;"><img
            src="../public/static/telefono_icon.png" style="height: 15px; width: 15px;">
          (871) 747 1300 / 05
        </h2>
        <br />
        <br />
        
      </div>
      <!-- cuadro informativo 2 -->
      <div
        style="background-color: white; display: block; width: 56%; text-align: left;position: absolute; right: 4%; top: -30%; padding: 10px;">
        <div style="width: 100px;">
        <img class="imagen-left" src="../../img/logo.png" style="width: 100%;" />
        </div>
        <div>
        <h3 style="text-align: left; font-size: 20px; color: #00528A; margin: 10;"><?php echo "COTIZACION ".$mainTitle; ?></h3>
        <h2 style="text-align: left; font-size: 14px; color: #F7931D; margin: 0 10 10 10;"><?php echo $secondTitle; ?>
        </h2>
        <h4 style="text-align: left; font-size: 12px; color: #06528D; margin: 0 10 10 10; font-weight: lighter;">
        </h4>
        <br />
        <hr size="30px" style="border: none; background-color: #06528D;" />
        <h4 style="margin: 0 auto; 12px; color: #06528D;"><?php echo $date; ?><br><?php echo $cliente; ?> </h4>
        
        </div>
      
      </div>

    </div>
  </div>
  </div>
  <!-- contenedor 3 -->
  <div style="width: 100%; background-color: white; height: 14%; display: inline-block; position: relative;">
    <div style="display: block;">
      <img style="height: 100px; width: 200px; " src="../public/static/keep_milking.png" />
    </div>
    <div style="display: block; position: absolute; right: 5%; top: 20%;">
      <p style="color: #06528D; font-weight: bold; font-size: 14px">www.maderoequipos.com.mx</p>
    </div>
  </div>

</page>

<!-- pagina dos-->
<style>
  img.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  .main-draw {
    margin: 0 auto;
    border: none;
    width: 100%;
    height: 14%;

  }

  .main-draww {
    margin: 0 auto;
    border: none;
    width: 100%;
    height: 14%;
  }

  #left-polygon {
    fill: #00528A;
    stroke: #00528A;
  }

  #right-polygon {
    fill: #929295;
    stroke: #929295;
  }

  #left-column {
    width: 50%;
    float: left;
  }

  #right-column {
    margin-left: 50%;
    /* Change this to whatever the width of your left column is*/
  }

  .clear {
    clear: both;
  }

  #title-desc {
    color: white;
    font-size: 28px;
    margin: 0;
    padding: 0;
  }

  .imagen-left {
    left: 0;
    margin-left: 0;
    float: left;
    width: 100px;

  }

  .header-title {
    position: absolute;
    right: 3%;
    top: 30;
    width: 55%;
  }

  .header-icon {
    position: absolute;
    left: 7%;
    top: 20;
    width: 30%
  }

  #logo {
    width: 100px;
  }

  /* Create two unequal columns that floats next to each other */


  .row {
    display: flex;
  }

  /* Create two equal columns that sits next to each other */
  .column {
    flex: 50%;
    padding: 10px;
    height: 300px;
    /* Should be removed. Only for demonstration */
  }

  .container {
    margin-top: 20px;
    position: relative;
    height: 70%;
    width: 100%;
    font-size: 10px;
  }

  .main-table {
    width: 100%;
  }

  .alternate {
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    table-layout: fixed;
    margin-left: 6%;
  }

  th {
    color: white;
    font-weight: bold;
  }

  .th-1 {

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

  #name {
    text-align: left;
  }

  .td-data {
    padding: 5px;
    color: black;
    text-align: center;
    border-bottom: 1px solid lightgray;
  }

  .td-nombre {
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

  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
</style>

<?php
$idunidad = 0;
$unidad = $conn->query("SELECT * FROM rotatorio WHERE id_usuario='$idUsuario' and idsession='$idSesion'");
if ($ver = mysqli_fetch_row($unidad)) {
  $idunidad = $ver[4];
  $nomrotatorio = $ver[14];
  $subtotal = $ver[8];
  $descuento = $ver[6];
  $iva = $ver[7];
  $totalSis = $ver[5];
  $gastos = $ver[9];
  $total90 = $ver[10];
}
$nomrotatorio = utf8_encode($nomrotatorio);
$result = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$idUsuario' and idsession='$idSesion' and id_component='$idunidad' and ischeck=1 ORDER BY orden ");
//$reg= $result->num_rows;
if ($s_descripcion == 1) {
  while ($var = mysqli_fetch_row($result)) {
    $nombreComp = utf8_encode($var[2]);
    $idcomponente = $var[1];
    $hijos = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_component=$idcomponente AND id_usuario='$idUsuario' and idsession='$idSesion' and ischeck=1");
    $resltado = $hijos->num_rows;
    print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
        <draw class='main-draw'>
            <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
            <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
        </draw>
        <br>
        <div class='header-title'>
          <h3 id='title-desc' >$nombreComp</h3>
        </div>
        <div id='table container' class='header-icon'>
          <img id='logo' src='../../img/logo.png'/>
        </div>
        <div class='container' style='padding-left:10px'>
        <div class='main-table'>
        <table class='alternate' cellspacing='0' cellpadding='0'>
        <thead>
          <tr>
            <th class='th-1' colspan='4'></th>
          </tr>
          <tr>
            <th class='td-subtitle' id='name' colspan='3'>NOMBRE</th>
            <th class='td-subtitle'>CANTIDAD</th>
          </tr>
        </thead>
        <tbody>
        ";
    $resul = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponente' and id_usuario='$idUsuario' and idsession='$idSesion' and ischeck=1 ORDER BY descripcion ");
    $numreg = $resul->num_rows;
    $i = 1;
    $j = 0;
    $cadena = "";
    while ($ver = mysqli_fetch_row($resul)) {
      $nombre = utf8_encode($ver[2]);
      $cantidad = $ver[3];
      $precioUnit = $ver[5];
      $total = $cantidad * $precioUnit;
      $precioUnit = number_format($precioUnit, 2);
      $total = number_format($total, 2);
      if ($i <= 30) {
        print "
              <tr>
              <td class='td-nombre' colspan='3'>$nombre</td>
              <td class='td-data' style='text-align: right;'>$cantidad</td>
              </tr>
              ";
      } else {
        $j = 1;
        $cadena .= "<tr>
              <td class='td-nombre' colspan='3'>$nombre</td>
              <td class='td-data' style='text-align: right;'>$cantidad</td>
              </tr>";
      }
      $i++;
    }
    print " 
        </tbody>
        </table>
        </div>";

    $iiigggmmm = $conn->query("SELECT * FROM imagenes WHERE id_comp='$idcomponente'");
    $regg = $iiigggmmm->num_rows;
    $dirrr = "";
    while ($imgggg = $iiigggmmm->fetch_array(MYSQLI_ASSOC)) {
      $dirrr = $imgggg['dir_img'];
    }
    if ($numreg < 18) {
      if ($regg > 0) {
        print '
         <br><img src="../../' . $dirrr . '"  align="center" style="width:400px; height: 300; margin-left: 170px;  margin-right: auto;" class="center"  >';
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
    if ($numreg > 17 && ($regg > 0 || $j == 1)) {
      print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
      <draw class='main-draw'>
          <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
          <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
      </draw><br>
      <div class='header-title'>
        <h3 id='title-desc' >$nombreComp</h3>
      </div>
      <div id='table container' class='header-icon'>
        <img id='logo' src='../../img/logo.png'/>
      </div>
      <div class='container' style='padding-left:10px'>
      <div class='main-table'>
      <table class='alternate' cellspacing='0' cellpadding='0'>
      <thead>
        <tr>
          <th class='th-1' colspan='4'></th>
        </tr>
        <tr>
          <th class='td-subtitle' id='name' colspan='3'>NOMBRE</th>
          <th class='td-subtitle'>CANTIDAD</th>
        </tr>
      </thead>
      <tbody>
      $cadena
      </tbody>
      </table>
      
      ";
      if ($regg > 0) {
        print '
    <br><img src="../../' . $dirrr . '"  align="center" style="width:400px; height: 300; margin-left: 170px;  margin-right: auto;" class="center"  >
     ';
      }

      print "
    </div>
    </div>
    <draw class='down-draw'>
    <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
    <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
    <div class='footer-title'>
    <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
    </div> 
    </draw>
  </page>";
    }
  }

  $result = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$idUsuario' and idsession='$idSesion' and id_component=id_producto and ischeck=1 ORDER BY descripcion ");
  //$reg= $result->num_rows;
  while ($var = mysqli_fetch_row($result)) {
    $nombreComp = utf8_encode($var[2]);
    $cantidadcomp = $var[3];
    $idcomponente = $var[1];

    print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
        <draw class='main-draw'>
            <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
            <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
        </draw><br>
        
        <div class='header-title'>
          <h3 id='title-desc'>$nombreComp ($cantidadcomp) </h3>
        </div>
        <div id='table container' class='header-icon'>
          <img id='logo' src='../../img/logo.png'/>
        </div>
        <div class='container' style='padding-left:10px'>
        <div class='main-table'>
        
        <table class='alternate' cellspacing='0' cellpadding='0'>
        <thead>
          <tr>
            <th class='th-1' colspan='5'></th>
          </tr>
          <tr>
            <th class='td-subtitle' id='name' colspan='3'>NOMBRE</th>
            <th class='td-subtitle'  colspan='1'>CAN UNIT</th>
            <th class='td-subtitle'  colspan='1'>CANTIDAD</th>
          </tr>
        </thead>
        <tbody>
        ";
    $resul = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponente' and id_usuario='$idUsuario' and ischeck=1 and idsession='$idSesion' ORDER BY descripcion ");
    $numreg = $resul->num_rows;
    $i = 1;
    $j = 0;
    $cadena = "";
    while ($ver = mysqli_fetch_row($resul)) {
      $nombre = utf8_encode($ver[2]);
      $cantidad = $ver[3];
      $cantidaduni = $cantidad / $cantidadcomp;
      $precioUnit = $ver[5];
      $total = $cantidad * $precioUnit;
      $precioUnit = number_format($precioUnit, 2);
      $total = number_format($total, 2);
      if ($i <= 30) {
        if ($ver[0] != $ver[1]) {
          print "
                 <tr>
                 <td class='td-nombre' colspan='3'>$nombre</td>
                 <td class='td-data'>$cantidaduni</td>
                 <td class='td-data'>$cantidad</td>
                  </tr>";
        }
      } else {
        if ($ver[0] != $ver[1]) {
          $j = 1;
          $cadena .= "
                 <tr>
                 <td class='td-nombre' colspan='3'>$nombre</td>
                 <td class='td-data'>$cantidaduni</td>
                 <td class='td-data'>$cantidad</td>
                  </tr>";
        }
      }
      $i++;
    }
    print " 
          </tbody>
          </table>
          </div>";
    $iiigggmmmop = $conn->query("SELECT * FROM imagenes WHERE id_comp='$idcomponente'");
    $reggop = $iiigggmmmop->num_rows;
    $dirrrop = "";
    while ($imggggop = $iiigggmmmop->fetch_array(MYSQLI_ASSOC)) {
      $dirrrop = $imggggop['dir_img'];
    }
    if ($numreg < 18) {
      if ($reggop > 0) {
        print '
         <br><img src="../../' . $dirrrop . '"  style="width:400px; height: 300; margin-left: 170px;  margin-right: auto;" class="center" >';
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
    if ($numreg > 17 && ($reggop > 0 || $j == 1)) {
      print "
      <page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
      <draw class='main-draw'>
          <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
          <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
      </draw><br>
      <div class='header-title'>
        <h3 id='title-desc'>$nombreComp ($cantidadcomp) </h3>
      </div>
      <div id='table container' class='header-icon'>
        <img id='logo' src='../../img/logo.png'/>
      </div>
      <div class='container' style='padding-left:10px'>
      <div class='main-table'>
      
      <table class='alternate' cellspacing='0' cellpadding='0'>
      <thead>
        <tr>
          <th class='th-1' colspan='5'></th>
        </tr>
        <tr>
          <th class='td-subtitle' id='name' colspan='3'>NOMBRE</th>
          <th class='td-subtitle'  colspan='1'>CAN UNIT</th>
          <th class='td-subtitle'  colspan='1'>CANTIDAD</th>
        </tr>
      </thead>
      <tbody>
      $cadena
        </tbody>
        </table>
      ";
      if ($reggop > 0) {
        print '
        <br><img src="../../' . $dirrrop . '"  align="center" style="width:400px; height: 300; margin-left: 170px;  margin-right: auto;" class="center"  >
         ';
      }

      print "
        </div>
        </div>
        <draw class='down-draw'>
        <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
        <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
        <div class='footer-title'>
        <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
      </div> 
      </draw>
    </page>";
    }
  }
}
//-------------------------------   PDF SECUNDARIO  ----------------------------------------------------
else {
  while ($var = mysqli_fetch_row($result)) {
    $nombreComp = utf8_encode($var[2]);
    $idcomponente = $var[1];
    $idcomponentepadre = $var[0];
  }
  //------------------Plataforma-----------------------------
  $hijos = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_component=$idcomponente and ischeck=1");
  $busca_plataforma =  $conn->query("SELECT * FROM cotizacion_detallada as cot left JOIN imagenes as img ON img.id_comp=cot.id_producto where cot.id_usuario='$idUsuario' and cot.idsession='$idSesion' and cot.id_component='$idcomponentepadre'  and cot.descripcion LIKE '%PLATAFORMA%' and ischeck=1");
  $numreg = $busca_plataforma->num_rows;
  if ($numreg > 0) {
    print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
          <draw class='main-draw'>
              <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
              <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
          </draw>
          <br>
          <div class='header-title'>
            <h3 id='title-desc' >PLATAFORMAS</h3>
          </div>
          <div id='table container' class='header-icon'>
            <img id='logo' src='../../img/logo.png'/>
          </div>
          <div class='container' style='padding-left:10px'>
          
          ";
    $i = 1;
    $j = 0;
    $cadena = "";

    while ($ver = mysqli_fetch_row($busca_plataforma)) {
      if ($ver[14] != "" && $ver[14] != null) {
        $imagenComp = $ver[14];
        $imagenComp = '../../' . $imagenComp;
      }
    }
    $pag = 0;
    $busca_plataforma2 =  $conn->query("SELECT * FROM cotizacion_detallada as cot left JOIN imagenes as img ON img.id_comp=cot.id_producto where cot.id_usuario='$idUsuario' and cot.idsession='$idSesion' and cot.id_component='$idcomponentepadre'  and cot.descripcion LIKE '%PLATAFORMA%' and ischeck=1");
    $numreg = $busca_plataforma2->num_rows;
    $lista = array();
    while ($vers = mysqli_fetch_row($busca_plataforma2)) {
      $nombre = utf8_encode($vers[2]);
      $cantidad = $vers[3];
      $precioUnit = $vers[5];
      $total =   $precioUnit;
      $precioUnit = number_format($precioUnit, 2);
      $total = number_format($total, 2);
      
      if ($vers[14]!=null && $vers[14]!='') {
        $imagenComp = $vers[14];
        $imagenComp = '../../' . $imagenComp;
      }else{
        $imagenComp = '../../img/logo.png';
      }
      if ($i <= 3) {
        print "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%;'>
              <img  src='$imagenComp' style='width:350px; height:230px;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
                
                ";
      } else {
        $j = 1;
        $cadena = $cadena . "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%;'>
              <img  src='$imagenComp' style='width:350px; height:230px;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
          
        ";

        $lista[$pag] = $cadena;
      }
      if ($i % 3 == 0 && $i != 0) {
        $pag++;
        $cadena = "";
      }
      $i++;
    }
    print "
          </div>";


    print " 
        <draw class='down-draw'>
          <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
          <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
          <div class='footer-title'>
          <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
        </div> 
        </draw>
      </page>";
    if ($numreg > 3 && $j == 1) {
      $paginasNuevas = intval($numreg / 3);


      $f = 0;
      while ($f < $paginasNuevas) {
        print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
        <draw class='main-draw'>
            <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
            <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
        </draw><br>
        <div class='header-title'>
          <h3 id='title-desc' >PLATAFORMAS</h3>
        </div>
        <div id='table container' class='header-icon'>
          <img id='logo' src='../../img/logo.png'/>
        </div>
        <div class='container' style='padding-left:10px'>
        $lista[$f]
        
        
        ";

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
        $f++;
      }
    }
  }
  //------------------Equipos de ordeño-----------------------------
  
  $busca_ordeno =  $conn->query("SELECT * FROM cotizacion_detallada as cot left JOIN imagenes as img ON img.id_comp=cot.id_producto where cot.id_usuario='$idUsuario' and cot.idsession='$idSesion' and cot.id_component='$idcomponentepadre' and (cot.descripcion LIKE '%UNIDADES%' or cot.descripcion LIKE '%GLANDULA%' or cot.descripcion LIKE '%BOMBAS DE LECHE%' or cot.descripcion LIKE '%GRUPOS DE RECIBO%' or cot.descripcion LIKE '%GRUPO DE RECIBO%' or cot.descripcion LIKE '%LINEAS DE LECHE%' or cot.descripcion LIKE '%SISTEMA DE PULSACION%' or cot.descripcion LIKE '%TUBERIA DE PVC PULSACION%' or cot.descripcion LIKE '%SOPORTERIA%' or cot.descripcion LIKE '%FILTROS DE LECHE%' or cot.descripcion LIKE '%SISTEMA DE VACIO%' or cot.descripcion LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' or cot.descripcion LIKE '%SISTEMA DE LAVADO%' or cot.descripcion LIKE '%ARREADOR%' or cot.descripcion LIKE '%ARRASTRE DE LECHE%' or cot.descripcion LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' or cot.descripcion LIKE '%FILTROS A TANQUE%' or cot.descripcion LIKE '%SUCCION DE LAVADO%' OR cot.descripcion LIKE '%CONTROL DE VACIO%' OR cot.descripcion LIKE '%TRAMPA SANITARIA%' OR cot.descripcion  LIKE '%LINEA DE LECHE%' OR cot.descripcion  LIKE '%CONTROLADOR DE VACIO%') and ischeck=1 ORDER BY orden; ");
  $numreg = $busca_ordeno->num_rows;
  if ($numreg > 0) {
    print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
          <draw class='main-draw'>
              <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
              <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
          </draw>
          <br>
          <div class='header-title'>
            <h3 id='title-desc' >EQUIPOS DE ORDEÑO</h3>
          </div>
          <div id='table container' class='header-icon'>
            <img id='logo' src='../../img/logo.png'/>
          </div>
          <div class='container' style='padding-left:10px'>
          
          ";
    $i = 1;
    $j = 0;
    $cadena = "";

    while ($ver = mysqli_fetch_row($busca_ordeno)) {
      if ($ver[14] != "" && $ver[14] != null) {
        $imagenComp = $ver[14];
        $imagenComp = '../../' . $imagenComp;
      }
    }

    $busca_ordeno2 =  $conn->query("SELECT * FROM cotizacion_detallada as cot left JOIN imagenes as img ON img.id_comp=cot.id_producto where cot.id_usuario='$idUsuario' and cot.idsession='$idSesion' and cot.id_component='$idcomponentepadre' and (cot.descripcion LIKE '%UNIDADES%' or cot.descripcion LIKE '%GLANDULA%' or cot.descripcion LIKE '%BOMBAS DE LECHE%' or cot.descripcion LIKE '%GRUPOS DE RECIBO%' or cot.descripcion LIKE '%GRUPO DE RECIBO%' or cot.descripcion LIKE '%LINEAS DE LECHE%' or cot.descripcion LIKE '%SISTEMA DE PULSACION%' or cot.descripcion LIKE '%TUBERIA DE PVC PULSACION%' or cot.descripcion LIKE '%SOPORTERIA%' or cot.descripcion LIKE '%FILTROS DE LECHE%' or cot.descripcion LIKE '%SISTEMA DE VACIO%' or cot.descripcion LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' or cot.descripcion LIKE '%SISTEMA DE LAVADO%' or cot.descripcion LIKE '%ARREADOR%' or cot.descripcion LIKE '%ARRASTRE DE LECHE%' or cot.descripcion LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' or cot.descripcion LIKE '%FILTROS A TANQUE%' or cot.descripcion LIKE '%SUCCION DE LAVADO%' OR cot.descripcion LIKE '%CONTROL DE VACIO%' OR cot.descripcion LIKE '%TRAMPA SANITARIA%' OR cot.descripcion  LIKE '%LINEA DE LECHE%' OR cot.descripcion  LIKE '%CONTROLADOR DE VACIO%') and ischeck=1  ORDER BY cot.orden; ");
    $numreg = $busca_ordeno2->num_rows;
    $lista = array();
    $pag = 0;
    while ($vers = mysqli_fetch_row($busca_ordeno2)) {
      $nombre = utf8_encode($vers[2]);
      $cantidad = $vers[3];
      $precioUnit = $vers[5];
      $total =   $precioUnit;
      $precioUnit = number_format($precioUnit, 2);
      $total = number_format($total, 2);
      
      if ($vers[14]!=null && $vers[14]!='') {
        $imagenComp = $vers[14];
        $imagenComp = '../../' . $imagenComp;
      }else{
        $imagenComp = '../../img/logo.png';
      }
      if ($i <= 3) {
        print "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%;'>
              <img  src='$imagenComp' style='width:350px; height:230px;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
                
                ";
      } else {
        $j = 1;
        $cadena = $cadena . "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%;'>
              <img  src='$imagenComp' style='width:350px; height:230px;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
          
        ";

        $lista[$pag] = $cadena;
      }
      if ($i % 3 == 0 && $i != 3) {
        $pag++;
        $cadena = "";
      }
      $i++;
      
    }
    print "
          </div>";


    print " 
        <draw class='down-draw'>
          <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
          <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
          <div class='footer-title'>
          <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
        </div> 
        </draw>
      </page>";
    if ($numreg > 3 && $j == 1) {
      $paginasNuevas = intval($numreg / 3);


      $f = 0;
      while ($f < $paginasNuevas) {
        print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
        <draw class='main-draw'>
            <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
            <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
        </draw><br>
        <div class='header-title'>
          <h3 id='title-desc' >EQUIPOS DE ORDEÑO</h3>
        </div>
        <div id='table container' class='header-icon'>
          <img id='logo' src='../../img/logo.png'/>
        </div>
        <div class='container' style='padding-left:10px'>
        
        $lista[$f]
        
        
        ";

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
        $f++;
      }
    }
  }
  //-----------------complementarios--------------------------------
  
  $busca_complementarios =  $conn->query("SELECT * FROM cotizacion_detallada as cot left JOIN imagenes as img ON img.id_comp=cot.id_producto where cot.id_usuario='$idUsuario' and cot.idsession='$idSesion'  and cot.id_component='$idcomponentepadre'  and descripcion NOT LIKE '%UNIDADES DE ORDE%' and descripcion NOT LIKE '%PLATAFORMA%' and descripcion NOT LIKE '%GLANDULA%' AND descripcion NOT LIKE '%BOMBAS DE LECHE%' AND descripcion NOT LIKE '%GRUPOS DE RECIBO%' AND descripcion NOT LIKE '%GRUPO DE RECIBO%' AND descripcion NOT LIKE '%LINEAS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE PULSACION%' AND descripcion NOT LIKE '%TUBERIA DE PVC PULSACION%' AND descripcion NOT LIKE '%SOPORTERIA%' AND descripcion NOT LIKE '%FILTROS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE VACIO%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' AND descripcion NOT LIKE '%SISTEMA DE LAVADO%' AND descripcion NOT LIKE '%ARREADOR%' AND descripcion NOT LIKE '%ARRASTRE DE LECHE%' AND descripcion NOT LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' AND descripcion not LIKE '%FILTROS A TANQUE%' AND descripcion not LIKE '%SUCCION DE LAVADO%' AND descripcion not LIKE '%CONTROL DE VACIO%' AND descripcion not LIKE '%TRAMPA SANITARIA%' AND descripcion not LIKE '%LINEA DE LECHE%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO%' and cot.ischeck=1 ORDER BY orden;");
  $numreg = $busca_complementarios->num_rows;
  if ($numreg > 0) {
    print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
          <draw class='main-draw'>
              <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
              <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
          </draw>
          <br>
          <div class='header-title'>
            <h3 id='title-desc' >COMPLEMENTARIOS</h3>
          </div>
          <div id='table container' class='header-icon'>
            <img id='logo' src='../../img/logo.png'/>
          </div>
          <div class='container' style='padding-left:10px'>
          
          ";
    $i = 1;
    $j = 0;
    $cadena = "";

    while ($ver = mysqli_fetch_row($busca_complementarios)) {
      if ($ver[14] != "" && $ver[14] != null) {
        $imagenComp = $ver[14];
        $imagenComp = '../../' . $imagenComp;
      }
    }
    $pag = 0;
    $busca_complementarios2 =  $conn->query("SELECT * FROM cotizacion_detallada as cot left JOIN imagenes as img ON img.id_comp=cot.id_producto where cot.id_usuario='$idUsuario' and cot.idsession='$idSesion'  and cot.id_component='$idcomponentepadre'  and descripcion NOT LIKE '%UNIDADES DE ORDE%' and descripcion NOT LIKE '%PLATAFORMA%' and descripcion NOT LIKE '%GLANDULA%' AND descripcion NOT LIKE '%BOMBAS DE LECHE%' AND descripcion NOT LIKE '%GRUPOS DE RECIBO%' AND descripcion NOT LIKE '%GRUPO DE RECIBO%' AND descripcion NOT LIKE '%LINEAS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE PULSACION%' AND descripcion NOT LIKE '%TUBERIA DE PVC PULSACION%' AND descripcion NOT LIKE '%SOPORTERIA%' AND descripcion NOT LIKE '%FILTROS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE VACIO%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' AND descripcion NOT LIKE '%SISTEMA DE LAVADO%' AND descripcion NOT LIKE '%ARREADOR%' AND descripcion NOT LIKE '%ARRASTRE DE LECHE%' AND descripcion NOT LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' AND descripcion not LIKE '%FILTROS A TANQUE%' AND descripcion not LIKE '%SUCCION DE LAVADO%' AND descripcion not LIKE '%CONTROL DE VACIO%' AND descripcion not LIKE '%TRAMPA SANITARIA%' AND descripcion not LIKE '%LINEA DE LECHE%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO%' and cot.ischeck=1 ORDER BY orden;");
    $numreg = $busca_complementarios2->num_rows;
    $lista = array();
    while ($vers = mysqli_fetch_row($busca_complementarios2)) {
      $nombre = utf8_encode($vers[2]);
      $cantidad = $vers[3];
      $precioUnit = $vers[5];
      $total =   $precioUnit;
      $precioUnit = number_format($precioUnit, 2);
      $total = number_format($total, 2);
      
      if ($vers[14]!=null && $vers[14]!='') {
        $imagenComp = $vers[14];
        $imagenComp = '../../' . $imagenComp;
      }else{
        $imagenComp = '../../img/logo.png';
      }
      if ($i <= 3) {
        print "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%;'>
              <img  src='$imagenComp' style='width:350px; height:230px;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
                
                ";
      } else {
        $j = 1;
        $cadena = $cadena . "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%;'>
              <img  src='$imagenComp' style='width:350px; height:230px;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
          
        ";

        $lista[$pag] = $cadena;
      }
      if ($i % 3 == 0 && $i != 3) {
        $pag++;
        $cadena = "";
      }
      $i++;
    }
    print "
          </div>";


    print " 
        <draw class='down-draw'>
          <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
          <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
          <div class='footer-title'>
          <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
        </div> 
        </draw>
      </page>";
    if ($numreg > 3 && $j == 1) {
      $paginasNuevas = intval($numreg / 3);


      $f = 0;
      while ($f < $paginasNuevas) {
        print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
        <draw class='main-draw'>
            <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
            <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
        </draw><br>
        <div class='header-title'>
          <h3 id='title-desc' >COMPLEMENTARIOS</h3>
        </div>
        <div id='table container' class='header-icon'>
          <img id='logo' src='../../img/logo.png'/>
        </div>
        <div class='container' style='padding-left:10px'>
        $lista[$f]
        
        
        ";

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
        $f++;
      }
    }
  }
  //------------------------------------------opcionales------------------------------------
  $busca_opcionales = $conn->query("SELECT * FROM cotizacion_detallada as cot LEFT JOIN imagenes as img ON img.id_comp=cot.id_producto WHERE cot.id_usuario='$idUsuario' and cot.idsession='$idSesion' and cot.id_component=cot.id_producto and cot.ischeck=1 ORDER BY cot.descripcion ");
  $numreg = $busca_opcionales->num_rows;
  //$reg= $result->num_rows;
  if ($numreg > 0) {
    print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
          <draw class='main-draw'>
              <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
              <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
          </draw>
          <br>
          <div class='header-title'>
            <h3 id='title-desc' >OPCIONALES</h3>
          </div>
          <div id='table container' class='header-icon'>
            <img id='logo' src='../../img/logo.png'/>
          </div>
          <div class='container' style='padding-left:10px'>
          
          ";
    $i = 1;
    $j = 0;
    $cadena = "";

    while ($ver = mysqli_fetch_row($busca_opcionales)) {
      if ($ver[14] != "" && $ver[14] != null) {
        $imagenComp = $ver[14];
        $imagenComp = '../../' . $imagenComp;
      }
    }
    $pag = 0;
    $busca_opcionales2 =  $conn->query("SELECT * FROM cotizacion_detallada as cot LEFT JOIN imagenes as img ON img.id_comp=cot.id_producto WHERE cot.id_usuario='$idUsuario' and cot.idsession='$idSesion' and cot.id_component=cot.id_producto ORDER BY cot.descripcion ");
    $numreg = $busca_opcionales2->num_rows;
    $lista = array();
    while ($vers = mysqli_fetch_row($busca_opcionales2)) {
      $nombre = utf8_encode($vers[2]);
      $cantidad = $vers[3];
      $precioUnit = $vers[5];
      $total =   $precioUnit;
      $precioUnit = number_format($precioUnit, 2);
      $total = number_format($total, 2);
      
      if ($vers[14]!=null && $vers[14]!='') {
        $imagenComp = $vers[14];
        $imagenComp = '../../' . $imagenComp;
      }else{
        $imagenComp = '../../img/logo.png';
      }
      if ($i <= 3) {
        print "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%; height:230px;'>
              <img  src='$imagenComp' style='width:100%; height:100%;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
                
                ";
      } else {
        $j = 1;
        $cadena = $cadena . "
          <table style='width:100%;padding:0'>
            <tr>
              <td style='width:50%;'>
              <img  src='$imagenComp' style='width:350px; height:230px;' >
              </td>
              <td style='width:47%;'>
                <h3 style='text-align:center;'>$nombre</h3>
                <h4 style='text-align:center;'>Precio: $$total</h4>
              </td>
            </tr>
          </table>
          
        ";

        $lista[$pag] = $cadena;
      }
      if ($i % 3 == 0 && $i != 3) {
        $pag++;
        $cadena = "";
      }
      $i++;
    }
    print "
          </div>";


    print " 
        <draw class='down-draw'>
          <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
          <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
          <div class='footer-title'>
          <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
        </div> 
        </draw>
      </page>";
    if ($numreg > 3 && $j == 1) {
      $paginasNuevas = intval($numreg / 3);


      $f = 0;
      while ($f < $paginasNuevas) {
        print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
        <draw class='main-draw'>
            <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
            <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
        </draw><br>
        <div class='header-title'>
          <h3 id='title-desc' >OPCIONALES</h3>
        </div>
        <div id='table container' class='header-icon'>
          <img id='logo' src='../../img/logo.png'/>
        </div>
        <div class='container' style='padding-left:10px'>
        $lista[$f]
        
        
        ";

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
        $f++;
      }
    }
  }
}
$descuento = ($descuento / 100) * $totalSis;

$subtotal = number_format($subtotal, 2);
$descuento = number_format($descuento, 2);
$iva = number_format($iva, 2);
$totalSis = number_format($totalSis, 2);
$gastos = number_format($gastos, 2);
$total90 = number_format($total90, 2);


$numero = $total90;
function unidad($numuero)
{
  switch ($numuero) {
    case 9: {
        $numu = "NUEVE";
        break;
      }
    case 8: {
        $numu = "OCHO";
        break;
      }
    case 7: {
        $numu = "SIETE";
        break;
      }
    case 6: {
        $numu = "SEIS";
        break;
      }
    case 5: {
        $numu = "CINCO";
        break;
      }
    case 4: {
        $numu = "CUATRO";
        break;
      }
    case 3: {
        $numu = "TRES";
        break;
      }
    case 2: {
        $numu = "DOS";
        break;
      }
    case 1: {
        $numu = "UNO";
        break;
      }
    case 0: {
        $numu = "";
        break;
      }
  }
  return $numu;
}

function decena($numdero)
{

  if ($numdero >= 90 && $numdero <= 99) {
    $numd = "NOVENTA ";
    if ($numdero > 90)
      $numd = $numd . "Y " . (unidad($numdero - 90));
  } else if ($numdero >= 80 && $numdero <= 89) {
    $numd = "OCHENTA ";
    if ($numdero > 80)
      $numd = $numd . "Y " . (unidad($numdero - 80));
  } else if ($numdero >= 70 && $numdero <= 79) {
    $numd = "SETENTA ";
    if ($numdero > 70)
      $numd = $numd . "Y " . (unidad($numdero - 70));
  } else if ($numdero >= 60 && $numdero <= 69) {
    $numd = "SESENTA ";
    if ($numdero > 60)
      $numd = $numd . "Y " . (unidad($numdero - 60));
  } else if ($numdero >= 50 && $numdero <= 59) {
    $numd = "CINCUENTA ";
    if ($numdero > 50)
      $numd = $numd . "Y " . (unidad($numdero - 50));
  } else if ($numdero >= 40 && $numdero <= 49) {
    $numd = "CUARENTA ";
    if ($numdero > 40)
      $numd = $numd . "Y " . (unidad($numdero - 40));
  } else if ($numdero >= 30 && $numdero <= 39) {
    $numd = "TREINTA ";
    if ($numdero > 30)
      $numd = $numd . "Y " . (unidad($numdero - 30));
  } else if ($numdero >= 20 && $numdero <= 29) {
    if ($numdero == 20)
      $numd = "VEINTE ";
    else
      $numd = "VEINTI" . (unidad($numdero - 20));
  } else if ($numdero >= 10 && $numdero <= 19) {
    switch ($numdero) {
      case 10: {
          $numd = "DIEZ ";
          break;
        }
      case 11: {
          $numd = "ONCE ";
          break;
        }
      case 12: {
          $numd = "DOCE ";
          break;
        }
      case 13: {
          $numd = "TRECE ";
          break;
        }
      case 14: {
          $numd = "CATORCE ";
          break;
        }
      case 15: {
          $numd = "QUINCE ";
          break;
        }
      case 16: {
          $numd = "DIECISEIS ";
          break;
        }
      case 17: {
          $numd = "DIECISIETE ";
          break;
        }
      case 18: {
          $numd = "DIECIOCHO ";
          break;
        }
      case 19: {
          $numd = "DIECINUEVE ";
          break;
        }
    }
  } else
    $numd = unidad($numdero);
  return $numd;
}

function centena($numc)
{
  if ($numc >= 100) {
    if ($numc >= 900 && $numc <= 999) {
      $numce = "NOVECIENTOS ";
      if ($numc > 900)
        $numce = $numce . (decena($numc - 900));
    } else if ($numc >= 800 && $numc <= 899) {
      $numce = "OCHOCIENTOS ";
      if ($numc > 800)
        $numce = $numce . (decena($numc - 800));
    } else if ($numc >= 700 && $numc <= 799) {
      $numce = "SETECIENTOS ";
      if ($numc > 700)
        $numce = $numce . (decena($numc - 700));
    } else if ($numc >= 600 && $numc <= 699) {
      $numce = "SEISCIENTOS ";
      if ($numc > 600)
        $numce = $numce . (decena($numc - 600));
    } else if ($numc >= 500 && $numc <= 599) {
      $numce = "QUINIENTOS ";
      if ($numc > 500)
        $numce = $numce . (decena($numc - 500));
    } else if ($numc >= 400 && $numc <= 499) {
      $numce = "CUATROCIENTOS ";
      if ($numc > 400)
        $numce = $numce . (decena($numc - 400));
    } else if ($numc >= 300 && $numc <= 399) {
      $numce = "TRESCIENTOS ";
      if ($numc > 300)
        $numce = $numce . (decena($numc - 300));
    } else if ($numc >= 200 && $numc <= 299) {
      $numce = "DOSCIENTOS ";
      if ($numc > 200)
        $numce = $numce . (decena($numc - 200));
    } else if ($numc >= 100 && $numc <= 199) {
      if ($numc == 100)
        $numce = "CIEN ";
      else
        $numce = "CIENTO " . (decena($numc - 100));
    }
  } else
    $numce = decena($numc);

  return $numce;
}

function miles($nummero)
{
  if ($nummero >= 1000 && $nummero < 2000) {
    $numm = "MIL " . (centena($nummero % 1000));
  }
  if ($nummero >= 2000 && $nummero < 10000) {
    $numm = unidad(Floor($nummero / 1000)) . " MIL " . (centena($nummero % 1000));
  }
  if ($nummero < 1000)
    $numm = centena($nummero);

  return $numm;
}

function decmiles($numdmero)
{
  if ($numdmero == 10000)
    $numde = "DIEZ MIL";
  if ($numdmero > 10000 && $numdmero < 20000) {
    $numde = decena(Floor($numdmero / 1000)) . "MIL " . (centena($numdmero % 1000));
  }
  if ($numdmero >= 20000 && $numdmero < 100000) {
    $numde = decena(Floor($numdmero / 1000)) . " MIL " . (miles($numdmero % 1000));
  }
  if ($numdmero < 10000)
    $numde = miles($numdmero);

  return $numde;
}

function cienmiles($numcmero)
{
  if ($numcmero == 100000)
    $num_letracm = "CIEN MIL";
  if ($numcmero >= 100000 && $numcmero < 1000000) {
    $num_letracm = centena(Floor($numcmero / 1000)) . " MIL " . (centena($numcmero % 1000));
  }
  if ($numcmero < 100000)
    $num_letracm = decmiles($numcmero);
  return $num_letracm;
}

function millon($nummiero)
{
  if ($nummiero >= 1000000 && $nummiero < 2000000) {
    $num_letramm = "UN MILLON " . (cienmiles($nummiero % 1000000));
  }
  if ($nummiero >= 2000000 && $nummiero < 10000000) {
    $num_letramm = unidad(Floor($nummiero / 1000000)) . " MILLONES " . (cienmiles($nummiero % 1000000));
  }
  if ($nummiero < 1000000)
    $num_letramm = cienmiles($nummiero);

  return $num_letramm;
}

function decmillon($numerodm)
{
  if ($numerodm == 10000000)
    $num_letradmm = "DIEZ MILLONES";
  if ($numerodm > 10000000 && $numerodm < 20000000) {
    $num_letradmm = decena(Floor($numerodm / 1000000)) . "MILLONES " . (cienmiles($numerodm % 1000000));
  }
  if ($numerodm >= 20000000 && $numerodm < 100000000) {
    $num_letradmm = decena(Floor($numerodm / 1000000)) . " MILLONES " . (millon($numerodm % 1000000));
  }
  if ($numerodm < 10000000)
    $num_letradmm = millon($numerodm);

  return $num_letradmm;
}

function cienmillon($numcmeros)
{
  if ($numcmeros == 100000000)
    $num_letracms = "CIEN MILLONES";
  if ($numcmeros >= 100000000 && $numcmeros < 1000000000) {
    $num_letracms = centena(Floor($numcmeros / 1000000)) . " MILLONES " . (millon($numcmeros % 1000000));
  }
  if ($numcmeros < 100000000)
    $num_letracms = decmillon($numcmeros);
  return $num_letracms;
}

function milmillon($nummierod)
{
  if ($nummierod >= 1000000000 && $nummierod < 2000000000) {
    $num_letrammd = "MIL " . (cienmillon($nummierod % 1000000000));
  }
  if ($nummierod >= 2000000000 && $nummierod < 10000000000) {
    $num_letrammd = unidad(Floor($nummierod / 1000000000)) . " MIL " . (cienmillon($nummierod % 1000000000));
  }
  if ($nummierod < 1000000000)
    $num_letrammd = cienmillon($nummierod);

  return $num_letrammd;
}




function convertir($numero)
{
  $num = str_replace(",", "", $numero);
  $num = number_format($num, 2, '.', '');
  $cents = substr($num, strlen($num) - 2, strlen($num) - 1);
  $num = (int) $num;

  $numf = milmillon($num);

  return $numf . " DOLARES CON " . $cents . "/100 USD";
}

//echo convertir($numero);

$rr = convertir($numero);

function multiexplode($delimiters, $string)
{
  $ready = str_replace($delimiters, $delimiters[0], $string);
  $launch = explode($delimiters[0], $ready);
  return  $launch;
}
$notas = multiexplode(array("-", "*"), $notaa);
//print_r($notas);


print "<page backtop='-3mm' backbottom='-19mm' backleft='-3mm' backright='-3mm'>
  <draw class='main-draw'>
      <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
      <polygon id='right-polygon' points='900 130,216 130,242 0,900 0'>
  </draw><br>
  <div class='header-title'>
    <h3 id='title-desc'>$nomrotatorio</h3>
  </div>
  <div id='table container' class='header-icon'>
    <img id='logo' src='../../img/logo.png'/>
  </div>
  <div class='container' style='padding-left:10px; padding-right:10px;'>
    <p class='totales'>
      <h4>Subtotal: $$subtotal</h4>
      <h4>IVA: $$iva</h4>
      <h4>Total: $$total90</h4>
      <h4>Con letra: $rr</h4>
    </p>
    <h4 style='font-size:14px; top:-500px;'>Nota:</h4>
    <b style='font-size:12px'>
    <pre>$notaa</pre>
    </b><br>
    </div>
    
    ";

print "
  
  
  
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
require_once(dirname(__FILE__) . '/../vendor/autoload.php');
try {
  $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
  $html2pdf->pdf->SetDisplayMode('fullpage');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output('Cot ' . $nomcliente . Date("d-m-Y", time()) . '.pdf');
} catch (HTML2PDF_exception $e) {
  echo $e;
  exit;
}
