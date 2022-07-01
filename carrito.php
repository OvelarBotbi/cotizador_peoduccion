<?php 
include ("arreglos.php");
include ("app/Usuario.inc.php");
include ("php_conexiones.php");
$active=1;
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Carrito Final</title>
<?php 
include ("js/direcciones.php");
    
?>
<link rel="stylesheet" href="css/carrito.css">
<script src="js/carrito.js"></script>
<style>
.verde{
    background-color: ;
    color: black;
}
</style>
<link rel="icon" type="image/png" href="./img/logo.png" />
</head>
<body>
    <div id="contenedor_carga" style="position: absolute;">
       <div id="carga"></div>
    </div>
  
    <div>
        <?php if(isset($_SESSION['usuario'])){
	       include("plantillas/barralateral.php"); 
        ?>
        <div  id="contplat" class="content pt-5" style="display: block;">
            

               
                <div id="cardcarr" class="card card2" style="display:none" >
                    <div class="card-header verde"><i class="fa fa-cart-plus"></i>CARRITO
                    <button type="button"  style="float: right;" class="btn btn-info" onclick="guardarBorrador()">Guardar Borrador</button>
                    <div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left:35%; position:absolute; min-width:240px; font-size:1.8rem;margin-top:-50px">
  <div class="toast-header">
    
    <strong class="mr-auto">Borrador</strong>
    <small>Ahora</small>
  </div>
  <div class="toast-body" style="text-align: center;">
    Borrador Guardado
  </div>
</div>
                </div>
                    <div class="card-body">
                        <div id="carrito"></div>
                        
                    </div>
                </div>
                
                <div id="carddesc" class="card card2" style="display:none">
                    <div class="card-header verde"><i class="fa fa-cart-plus"></i>CARRITO</div>
                    <div class="card-body">
                        <button Onclick="regresar()" class="btn btn-warning">
                            <li class=" fas fa-reply"></li>
                        </button>
                        <div id="descuento"></div>
                        <input onclick="aplicarnota()" type="button"  id="btnsig" class="btn btn-success btn-lg btn-block" value="VER PDF" data-toggle="modal" data-target="#myModal">
                    </div>
                </div>
        </div> 
        
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <h1 class="modal-title">COTIZACIONES</h1>
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div style="width:100%;">
                       <table border="0"  style="width:100%">
                          <thead>
                               <tr>
                                  <th style="font-size:15px; width:150px">CLIENTE</th>
                                  <th style="font-size:15px; width:150px">PRECIO LISTA GENERAL</th>
                                  <th style="font-size:15px; width:150px">COSTO REAL NETO</th>
                               </tr>
                          </thead>
                           <tbody>
                                 <tr>
                                  <td style="width:150px"><img src="img/pdf.png" Onclick="siguientepdfcli()" width="50px" heigth="50px" ></td>
                                  <td style="width:150px"><img src="img/pdf.png" Onclick="siguientepdfint()" width="50px" heigth="50px" ></td>
                                  <td style="width:150px"><img src="img/pdf.png" Onclick="siguientepdfcos()" width="50px" heigth="50px" ></td>
                               </tr>
                           </tbody>
                       </table>
                        
                    </div></div>
                    <div class="modal-footer">
                        <input type="button" id="finalizar" Onclick="finalizar()" value="Finalizar" class="btn btn-success btn-lg" > 
                       
                        
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
    </div>
    <script type="text/javascript">
//        $(document).ready(function() {
//            $('#sis').val(0);
//            mostrarcarritofinal();
//            // document.getElementById("des").addEventListener("blur", myFunction);
//            
//
//        })
    </script>
    <script>
     
        window.onload=function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility='hidden';
        contenedor.style.opacity='0';
            mostrarcarritofinal(0);
           // igualarcero();
             
    }
    
   
    
    
    </script>
    
    <?php }?>
</body>
</html>