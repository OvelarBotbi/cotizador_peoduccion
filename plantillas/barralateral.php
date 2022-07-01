 <div class="sidebar" id="mySidebar">
     <a class="madero" href="/cotizador/cotizaciones.php"><img src="img/madero_redondo.PNG" style="width:50px;  justify-content: space-between; display:flex;margin:auto;"></a>
     <a>Bienvenido: <br> <?php $user=$_SESSION['usuario']; $result=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'"); while ($vari=mysqli_fetch_row($result)){
			$subt = $vari[1];
			
		} echo $subt; ?></a>
    <?php 
        if($_SESSION['rol']==1 || $_SESSION['rol']==2){     
     ?>
     <a class='<?php if($active==1){echo "active";} ?>' href="cotizaciones.php">
         <span class="menu form-inline">
            <i class="fa fa-money tamano"></i>
             <c>&nbsp;&nbsp;Cotizacion</c>
         </span>
     </a>
     <a class='<?php if($active==6){echo "active";} ?>' href="cotizaciones.php?bor=1">
         <span class="menu form-inline">
            <i class="fa fa-eraser tamano"></i>
             <c>&nbsp;&nbsp;Borradores</c>
         </span>
     </a>
     <?php 
        } 
     ?>
     <a class='<?php if($active==5){echo "active";} ?>' href="historial-cotizaciones.php">
         <span class="menu form-inline">
            <i class="fas fa-calendar-alt tamano"></i>
             <c>&nbsp;&nbsp;Historial cotizaciones</c>
         </span>
     </a>
     
     <?php 
        if($_SESSION['rol']==1){     
     ?>
     <!--  <a class='<?php if($active==2){echo "active";} ?>' href="categorias.php"><i class="fa fa-tags tamano"></i><span class="menu"><c> Categorias</c></span></a>-->
     <a class='<?php if($active==3){echo "active";} ?>' href="componentes.php">
        <span class="menu form-inline">
             <i class="fa fa-puzzle-piece"></i>
             <c>&nbsp;&nbsp;Componentes</c>
         </span>
     </a>
     <a class='<?php if($active==4){echo "active";} ?>' href="usuarios.php">
        <span class="menu form-inline">
            <i class="fa fa-users tamano"></i>
             <c>&nbsp;&nbsp;Usuarios</c>
         </span>
     </a>
     <?php 
        } 
     ?>
     <form id="cerrar" action="validar.php" method="post">
         <input name="cerrar" value="2" style="display:none;">
         <a href="#" type="submit" onclick="document.getElementById('cerrar').submit();">
            <span class="menu form-inline">
                <i class="fas fa-door-open ico tamano"></i>
                 <c>&nbsp;&nbsp;Salir</c>
             </span>
         </a>
     </form>
     <a href="javascript:void(0);" class="icon" onclick="myFunction()">
         <i class="fa fa-bars fa-4x" style="width:160; height:160; font-size: 200%; text-align: right; "></i>
     </a>
 </div>