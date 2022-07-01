<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>FORMULARIO DE REGISTRO</title>
        <link rel="stylesheet" href="css/editcomp.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
        <link rel="icon" type="image/png" href="./img/logo.png" />
          
                  
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>  
        <script src="js/functioncomp.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script> 
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    </head>
    <body>
    <?php
    session_start();
     if(isset($_SESSION['usuario'])){

	  //include("plantillas/barralateral.php"); 
    ?>  
            <form id="newcomp" action="validar.php"role="form" name="newcomp" class="form-register" >
                <h2 class="form-titulo letraa">NUEVO COMPONENTE</h2>
                <button Onclick="regcom()" class="btn btn-warning">
                        <li class=" fas fa-reply"></li>
                </button>
                <div class="contenedor-input">
                    <div id="icat" class="input-48 letr"></div>
                    <input class="input-48 letr" type="file" name="image" id='image'>	
                    <span class="input-100" id="estadoId"></span>
                    <!-- <input type="text" id="idcom" name="idcom"  placeholder="ID" maxlength="8" class="input-48 letr" style="text-transform:uppercase;" onkeyup="comprobarId()" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required> -->
                    <input type="text" id="nomcom" name="nomcom"  placeholder="NOMBRE" minlength="5" class="input-100 letr" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    <input type="text" id="descom" name="descom" placeholder="DESCRIPCION" class="input-100 letr" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"required>
                    <input id="accus" name="accus" value="18" style="display:none;">
                   
                   
                      
                      <input type="button"  id="cancelar" class="btn-cancelar input-48" value="CANCELAR" Onclick="regcom()">
                      
                    
                    <input type="button" style="display:block;" id="btnagrcom" class="btn-enviar input-48" value="REGISTRAR" Onclick="agregarcomponente()">
                    
                    
                </div>
            </form>
            <form  style="display:none;" id="selcom" action="validar.php"role="form" name="newcomp" class="form-registerr" >
                <h2 class="form-titulo letraa">ASIGNACION DE COMPONENTES</h2>
                <div class="contenedor-input">
                    
                    <!-- <input type="text" id="idcoma" name="idcom"  placeholder="ID MADERO" class="input-48 letr inputt" style="text-transform:uppercase;" onkeyup="comprobarId()" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                    <input type="text" id="nomcoma" name="nomcom"  placeholder="NOMBRE" class="input-48 letr inputt" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                     --><input id="opccion" type="text" value="16" style="display:none" > 
                   
                    
                    <div id="barrabus" class="input-100 letr" ></div>
                    <div id="datosarticulos" class="input-100"></div>
                     <input type="button"  id="aceptar" class="btn-enviar input-48" value="ACEPTAR" Onclick="regcom()">
                    
                </div>
            </form>
            
                    
            
<script type="text/javascript">
    
    $(document).ready(function(){
    recargarListacat();
        document.getElementById('registrar').style.display='none';
    })
    
    
</script>

<?php }else{
   header("Refresh:1; url=index.php");
}?>

    </body>        
</html>