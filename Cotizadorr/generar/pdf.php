<?php
  session_start();


#Conexion a base de datos
header('Content-Type: text/html; charset=UTF-8');
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'cotiz';
  $port='3306';
  $conn = new mysqli($servername, $username, $password, $dbname);
 $conn->query("SET NAMES 'utf8'");

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
  #Solo se pueden imprimir 25 renglones por hoja del reporte...
  ob_start();
  $sysType = "Sistema de ordeño";
  $mainTitle = "Cotización Sistema Rotatorio Madero Premium";
  $secondTitle = "32 puestos";
  $date = "Fecha";
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
        <h4 style="text-align: left; font-size: 12px; color: #06528D; margin: 0 10 10 10; font-weight: lighter;">Fecha:
        </h4>
        <br />
        <h4 style="margin: 0 auto; 12px; color: #06528D;"><?php echo $date; ?> </h4>
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
  $idunidad=0;
  
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
    $nomrotatorio = utf8_encode($nomrotatorio);
  $result=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$idUsuario' and idsession='$idSesion' and id_component='$idunidad'");

$idcomp=array();
$idprod=array();
$descomp=array();
$cantidad=array();
$precio=array();
$i=0;
while($com=mysqli_fetch_row($result)){
    
    $idcomp[$i]=$com[0];
    $idprod[$i]=$com[1];
    $descomp[$i]=$com[2];
    $cantidad[$i]=$com[3];
    $precio[$i]=$com[4];
    $i++;
    
}
$pidcomp=array();
$pidprod=array();
$pdescomp=array();
$pcantidad=array();
$pprecio=array();
$j=0;

for($i=0;$i<count($idprod);$i++){
    $idcomponente=$idprod[$i];
    $resul=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponente' and id_usuario='$idUsuario' and idsession='$idSesion'");
    
    while($part=mysqli_fetch_row($resul)){
        $pidcomp[$j]=$part[0];
        $pidprod[$j]=$part[1];
        $pdescomp[$j]=$part[2];
        $pcantidad[$j]=$part[3];
        $pprecio[$j]=$part[4];
        $j++;
    }
 
    
}





  //$reg= $result->num_rows;
  for($i=0;$i<count($idprod);$i++){
    $nombreComp = utf8_encode($descomp[$i]);
    $idcomponente=$idprod[$i];
        print "
        <page backtop='4mm' backbottom='4mm' backleft='4mm' backright='4mm'>
        <draw class='main-draw'>
            <polygon id='left-polygon'  points='0 230,269 230,327 0,0 0'>
            <polygon id='right-polygon' points='900 180,216 180,242 0,900 0'>
        </draw><br>
        <div class='header-title'>
          <h3 id='title-desc' >Plataforma $nomrotatorio</h3>
        </div>
        <div id='table container' class='header-icon'>
          <img id='logo' src='../public/static/madero-logo-ft2.png'/>
        </div>
        <div class='container'>
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
      
      
       for($j=0;$j<count($pidprod);$j++){
          $nombre = utf8_encode($pdescomp[$j]); 
          if($pidcomp[$j]==$idprod[$i]){
                    $a=$pcantidad[$j];
                    $b=$pprecio[$j];
                    $c=$pcantidad[$j]*$pprecio[$j];    
                    //echo $c;
                    $b=number_format($b,2);
                    $c=number_format($c,2);
            print "
            <tr>
            <td class='td-nombre'>$nombre</td>
            <td class='td-data'>$pcantidad[$j]</td>
            <td class='td-data'>$b</td>
            <td class='td-data'>$$c</td>
          </tr>";
        }}
        print "
        </tbody>
        </table>
        </div></div>
      <draw class='down-draw'>
        <polygon id='bleft-polygon' points='591 100,616 45,-3 45,-2 100'>
        <polygon id='bright-polygon' points='550 95,853 95,852 0,605 0'>
        <div class='footer-title'>
        <h3 class='footer-text'>&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
      </div> 
      </draw>
    </page>";
 }

      
      
      
      
  
 $descuento=($descuento/100)*$totalSis;

 $subtotal=number_format($subtotal,2);
 $descuento=number_format($descuento,2);
 $iva=number_format($iva,2);
 $totalSis=number_format($totalSis,2);
 $gastos=number_format($gastos,2);
 $total90=number_format($total90,2);
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
      <h4>IVA: $$iva</h4>
      <h4>Subtotal: $$subtotal</h4>
      <h4>Gastos de Instalación: $$gastos</h4>
      <h4>Total: $$total90</h4>
    </p>
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