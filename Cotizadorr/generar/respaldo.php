<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<?php 

include("php_conexiones.php");

$idunidad=0;
$nomrotatorio;
$result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='1' and idsession='$2y$05$1EUOFBN1XFQWcElxKwVUPe5a0zAK3cYGINDenbYJDqnA5G1KWAqye'");
if($ver=mysqli_fetch_row($result)){
    $idunidad=$ver[4];
    $nomrotatorio=$ver[14];
}
//echo $idunidad."<br>";
//echo $nomrotatorio."<br>";




$result=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='1' and idsession='$2y$05$1EUOFBN1XFQWcElxKwVUPe5a0zAK3cYGINDenbYJDqnA5G1KWAqye' and id_component='$idunidad'");
$reg= $result->num_rows;
//echo $reg."<br>";
$i=0;


while($var=mysqli_fetch_row($result)){
   $idcomponente=$var[1];
    
    $cadena="<table border='1px' style='width:600px'>
                <thead>
                    <tr>
                        <th>$var[1]</th>
                        <th>$var[2]</th>
                    <tr>
                </thead>
                <tbody>
             ";
            $resul=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$idcomponente' and id_usuario='1' and idsession='$2y$05$1EUOFBN1XFQWcElxKwVUPe5a0zAK3cYGINDenbYJDqnA5G1KWAqye'");
            while($ver=mysqli_fetch_row($resul)){
                $cadena=$cadena." <tr>
                                <td>$ver[1]</td>
                                <td>$ver[2]</td>
                                </tr>";
            }
$cadena=$cadena."
                </body>
            </table>";
  echo $cadena."<br>";  
}












?>

<page backtop="4mm" backbottom="4mm" backleft="4mm" backright="4mm">
  <draw class="main-draw">
      <polygon id="left-polygon"  points="0 230,269 230,327 0,0 0">
      <polygon id="right-polygon" points="900 180,216 180,242 0,900 0">
  </draw><br>
  <div class="header-title">
    <h3 id="title-desc"><?php echo $url; ?></h3>
  </div>
  <div id="table container" class="header-icon">
    <img id="logo" src="../public/static/madero-logo-ft2.png"/>
  </div>
  <div class="container">
    <div class="main-table">
      <?php
      <table class="alternate" cellspacing="0" cellpadding="0">
        <tr>
          <th class="th-1" colspan="4"></th>
        </tr>
        <tr>
          <td class="td-subtitle" id="name">NOMBRE</td>
          <td class="td-subtitle">CANTIDAD</td>
          <td class="td-subtitle">PRECIO/UNI</td>
          <td class="td-subtitle">TOTAL</td>
        </tr>
        <?php
          for($contador;$contador < count($nombres); $contador++){
        ?>
        <tr>
          <td class="td-nombre"><?php echo $nombres[$contador];?></td>
          <td class="td-data"><?php echo rand(0, 10);?></td>
          <td class="td-data">$<?php echo rand();?></td>
          <td class="td-data">$<?php echo rand();?></td>
        </tr>
          <?php } ?>
      </table>
      ?>
    </div>
  </div>
  <draw class="down-draw">
    <polygon id="bleft-polygon" points="591 100,616 45,-3 45,-2 100">
    <polygon id="bright-polygon" points="550 95,853 95,852 0,605 0">
    <div class="footer-title">
    <h3 class="footer-text">&nbsp;&nbsp;&nbsp;&nbsp;Soluciones Óptimas e Integrales para los Productores Lecheros</h3>
  </div> 
  </draw>
</page>
<?php
  }
  ?>