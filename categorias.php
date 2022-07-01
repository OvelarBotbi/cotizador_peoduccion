<?php 
include ("arreglos.php");
session_start();
$active=2;
?>
<!DOCTYPE html>
<html>
<head>

<?php 
include ("js/direcciones.php");
?>

<style>
body {
  margin: 0;
  font-family: arial;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}
	.card {
	 max-height: auto;
	}
	 /*tbody {
      display:block;
      max-height:350px;
      overflow-y:auto;
		 
  }
  thead, tbody tr {
      display:table;
      width:100%;
      table-layout:fixed;
  }
  thead {
      width: calc( 100% - 1em )
  }
	tbody {
  display:block;
  max-height:350px;
  overflow-y:auto;
}
thead, tbody tr {
  display:table;
  width: var(--table-width);
  table-layout:fixed;
}*/
	
	.tamu {
		font-size: 20px;
	}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
    font-size: 15px;
}
 
.sidebar a.madero {
  background-color: #262121;
  color: white;
}
.sidebar a.active{
	 background-color: #474747;
  color: white;
}
.sidebar a:hover:not(.active) {
  background-color: #A7A7A7;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 50px;
  height: auto;
  width: auto;
    font-size: 13px;
}
.sidebar .icon {
  display: none;
}
@media screen and (max-width:1000px){
.sidebar{
  margin: 0;
  padding: 0;
  /*width: 100px;*/
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}
	.sidebar c{
		/*display: none;*/
	}
	div.content {
 /* margin-left: 100px;
  padding: 1px 50px;*/
  height: auto;
  width: auto;
}
	

} 
@media screen and (max-width:900px){
	.row {
		align-content: space-around;
	}

}
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
	.sidebar a{
		font-size: 10px;
		
	}
	.sidebar .icon{
		font-size: 20px;
		
	}
	.sidebar c{
		display: block;
		
	}
}
	
	
@media screen and (max-width: 700px) {
	.sidebar a:not(:first-child) {display: none;}
	.sidebar  a.icon {
    float: right;
    display: block;
		font-size: 15PX;
  }
	.sidebar.responsive .icon {
    position: absolute;
    background-color: #514F4F;
    color: white;
    right: 0;
    top: 0;
		
  }
	.sidebar a{
		font-size: 15PX;
		
	}
	.sidebar.responsive a{
    float: none;
    display: block;
    text-align: left;
    font-size: 15px;
 
  } 

	
	
}
	
	
	
  
	
	
/*@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}*/
	
	
</style>
</head>
<body>
<div>
<?php if(isset($_SESSION['usuario'])){
	include("plantillas/barralateral.php"); 
?>


<div class="content pt-5" style="display: block;">

  
  <!--<form id="tippla" action="validar.php" method="post" enctype="multipart/form-data" >-->
  	<div class="card">
		<div class="card-header tamu">CATEGORIAS</div>
		<div class="card-body">
		   <div id="moscat"></div> 
	  </div>
	  <!--</form>-->
  
 
  </div>



</div>


<script>
function myFunction() {
  var x = document.getElementById("mySidebar");
  if (x.className === "sidebar") {
    x.className += " responsive";
  } else {
    x.className = "sidebar";
  }
}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		recargarLista();
	})
	
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"categorias=" + 15,
			success:function(r){
				$('#moscat').html(r);
			}
		});
	}
</script>





<?php }?>
</body>
</html>
