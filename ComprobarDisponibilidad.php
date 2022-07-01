<?php

if(isset($_POST['accion'])){
$acc=$_POST['accion'];

if($acc==18){
if(isset($_POST['usuario'])){
    require_once("DBController.php");
$db_handle = new DBController();
    if(!empty($_POST["usuario"])) {
  $query = "SELECT * FROM usuarios WHERE usuario='" . $_POST["usuario"] . "'";
  $user_count = $db_handle->numRows($query);
  if($user_count>0) {
      //echo "<span class='estado-no-disponible-usuario'> Usuario no Disponible.</span>";
       echo '<div class="alert alert-danger"> Usuario no disponible.</div>';
  }else{
      //echo "<span class='estado-disponible-usuario'> Usuario Disponible.</span>";
      echo '<div class="alert alert-success"> Usuario  disponible.</div>';
  }
}


    
}}}else if(isset($_POST['idcommp'])){
    require_once("DBController.php");
$db_handle = new DBController();
    if(!empty($_POST["idcommp"])) {
    $query = "SELECT * FROM productos WHERE id='".$_POST["idcommp"]."'";
    $user_count = $db_handle->numRows($query);
    if($user_count>0) {
    //echo "<span class='estado-no-disponible-usuario'> Usuario no Disponible.</span>";
    echo '<div class="alert alert-danger"> Id no disponible.</div>';
    }else{
    //echo "<span class='estado-disponible-usuario'> Usuario Disponible.</span>";
    echo '<div class="alert alert-success"> Id disponible.</div>';
    }
    }

 
}else if(isset($_POST['accion'])){
    include("php_conexiones.php");
    $usu=$_POST['usuario'];
    $nom="";
    $acc=$_POST['accion'];
    $result=$conn->query("SELECT * FROM usuarios WHERE usuario='$usu'");
    while ($ver=mysqli_fetch_row($result)) {
        $nom=$ver[2];
    }
    //echo "<script type=\"text/javascript\">alert(\"$usu entro al $nom\");</script>"; 
    
    $resultt=$conn->query("SELECT * FROM usuarios WHERE usuario='$usu'");
    $reg= $resultt->num_rows;
    if($reg>0) {
      //echo "<span class='estado-no-disponible-usuario'> Usuario no Disponible.</span>";
        if($usu==$nom and $acc==20){
            echo '<div class="alert alert-success"> Usuario  disponible.</div>';
        }else{
            echo '<div class="alert alert-danger"> Usuario no disponible.</div>';
        }
       
    }else{
      //echo "<span class='estado-disponible-usuario'> Usuario Disponible.</span>";
      echo '<div class="alert alert-success"> Usuario  disponible.</div>';
    }
    
}

?>