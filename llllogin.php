<!DOCTYPE html>
<html lang="en">
<head>

  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
<body >
<div 	  ng-app="myApp" 
	   	  ng-controller="controlador" 
        ng-cloak 
        ng-ini="correcto=1">
       
<center>
	    <!--login-->
   	   	<div class="container">
            <div class="modal" id='myLogin' role="dialog"  data-backdrop="static" data-keyboard="false" style="display: block">	
                           <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                   
                                    <div class="modal-body" style="padding:40px 30px;">
                                    <img src="img/logo.png">
                                    
                                    <div class="form-group" align="left">
                                        <!--<span class="glyphicon glyphicon-user"></span> Usuario-->
                                        <input type="text"  style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control" placeholder="USUARIO" ng-model="usuario" name="usuario"> 
                                    </div>
                                    <div class="form-group" align="left">
                                        <!-- <span class="glyphicon glyphicon-eye-open"></span> Clave-->
                                        <input type="password" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control"  placeholder="CONTRASEÑA" ng-model="clave">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" ng-click="accesar()" style="background:#3333cc"><span class="glyphicon glyphicon-off"></span> Accesar</button>
                            </div>
                                </div>
                            </div>
                       </div>
               </div>        
        <!--Error-->          
        <div class="modal fade" id="error" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content modal-sm">
                                <div class="modal-header" align="left">
                                  
                                  <h2 class="modal-title">Error...</h2>
                                </div>
                                <div class="modal-body">
                                  <h3><b>Usuario y/o clave<br>Son incorrectos<br><br>Favor de verificarlos</b></h3>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                              
                            </div>
                          </div>  
        <!--Sin datos-->      
        <div class="modal fade" id="sinDatos" role="dialog">
                            <div class="modal-dialog">
                            
             
                              <div class="modal-content modal-sm" align="left">
                                <div class="modal-header">
                                 
                                  <h2 class="modal-title">Error...</h2>
                                </div>
                                <div class="modal-body">
                                  <h3><b>Debes ingresar<br>usuarios y clave</b></h3>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                              
                            </div>
                          </div>      
 </div>  
 </center> 
</div>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link real="stylesheet" href="css/estilos.css">
    

	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
    
    
    <link rel="stylesheet" type="text/css" href="tcal.css" />
	<script type="text/javascript" src="tcal.js"></script> 
    
    <script src="js/funciones.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script> 
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
     <script src="js/app.js"></script>
    
    <script>$('#myLogin .modal-header').css({'background-color' : '#fffff','color' : '#00000','border-radius' : '5px 5px 0 0'});</script>
    <script>$('#error .modal-header').css({'background-color' : '#FF0000','color' : '#fff','border-radius' : '5px 5px 0 0'});</script> 
    <script>$('#sinDatos .modal-header').css({'background-color' : '#FF0000','color' : '#fff','border-radius' : '5px 5px 0 0'});</script>
</body>
<style>
	body {
			background-image: url(img/fondo_login.jpg);
		   /* background-size:contain;*/
		    background-position: top center;
			background-attachment: fixed;
			background-size:cover;
		    background-position: center center;
			background-color: #464646;
            
      
		
	}
 </style>
</html>