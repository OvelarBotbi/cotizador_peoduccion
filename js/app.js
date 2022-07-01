// JavaScript Document

var app = angular.module('myApp', ['ngMaterial']);
app.controller('controlador', function($scope,$http,$window,$mdDialog,$sce,$httpParamSerializer){
	    
	    var prodpadre=0;
		$("#myLogin").modal("show");
		// funcion para accesar al sistema
		$scope.accesar=function(){
			if (($scope.usuario)&&($scope.clave)){
				$http.post("log.php", {usuario:$scope.usuario, clave:$scope.clave})
				.then(function (response) {
					if (response.data==0){
						$("#error").modal("show");
						$scope.correcto=0;
					}
					else{
						window.location.href = "cotizaciones";
						
						
						
						
					}
				}); //cierre del then
			}
			else{
				$("#sinDatos").modal("show");
				$scope.correcto=0;
			}
			//$("#myLogin").modal("show");
		}
		// Fin de funcion para accesar al sistema
		$scope.salir=function(){
			$scope.correcto=0;
			$window.location.reload();
		}
		
		$scope.refrescar=function(){
			$scope.accesar();
		}
		
		$scope.sistema=function(){
			$acc=1;
			//alert($acc);
			$http.post("validar.php", {accion:$acc})
				.then(function (response){
				
				$scope.sistemas=response.data.sistemas;
				
			})
			
			
		}
		$scope.plataforma=function(padre){
			$acc=2;
			alert(padre);
			$http.post("validar.php", {accion:$acc,pad:padre})
				.then(function (response){
				$scope.plataforma=response.data.plataforma;
				
			})
			
		}
		$scope.agrusu=function(){
			$http.post("validar.php", {accion:18,rolusu:$scope.rolusu,nomusu:$scope.nomusu,nickusu:$scope.nickusu,conusu:$scope.conusu,corusu:$scope.corusu})
			.then(function (response){
				 	alert("usuario agregado");
				window.location.href = "usuarios.php";
				
			});
			
		}
		
		$scope.regusu=function(){
			window.location.href = "usuarios.php";
		}
		
});


	
	