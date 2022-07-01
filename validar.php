<?php 
set_time_limit(600);
session_start();
include_once 'app/Usuario.inc.php';
include("php_conexiones.php");
include("arreglos.php");
//include("js/direcciones.php");
	$data = file_get_contents("php://input");
	$objData = json_decode($data);
    
    $plataformas=0;

if(isset($_POST["sistemas"])){
	$sistemas=$_POST['sistemas'];
    $accion =3;
}else if(isset($_POST["plataformas"])){
    $plataformas=$_POST['plataformas'];
	$accion =4;
}else if(isset($_POST["tamanos"])){
	$tamanos=$_POST['tamanos'];
	$accion =5;
}else if(isset($_POST["unidades"])){
	$unidades=$_POST['unidades'];
	$accion=6;
}else if(isset($_POST['eliminartodo'])){
	$accion=7;
}else if(isset($_POST['carrito'])){
	$carritos=$_POST['carrito'];
	$accion=8;
   // echo "<script type=\"text/javascript\">alert(\"entro al $carritos\");</script>"; 
}else if(isset($_POST['cerrar'])){
	$accion=$_POST['cerrar'];
}else if(isset($_POST['eliminar'])){
   // $carritos=$_POST['carritos'];
	$elim=$_POST['eliminar'];
	$accion=9;
}else if(isset($_POST['carritoel'])){
    $carritos=$_POST['carritoel'];
	$accion=10;
}else if(isset($_POST['componentes'])){
    
	$accion=11; 
}else if(isset($_POST['moscat'])){
	$accion=12;
}else if(isset($_POST['catcom'])){
	$accion=13;
}else if(isset($_POST['compo'])){
	$accion=14;
}else if(isset($_POST['categorias'])){
    $accion=15;
}else if(isset($_POST['usuarios'])){
    $accion=16;
}else if(isset($_POST['accus'])){
    $accion=$_POST['accus'];
}else if(isset($_POST['eliusuario'])){
	$eliusuario=$_POST['eliusuario'];
    $accion=19;
}else if(isset($_POST['elicat'])){
	$elicat=$_POST['elicat'];
    $accion=21;
}else if(isset($_POST['unidad'])){
       $accion=22;
}else if(isset($_POST['opcionalesc'])){
       $accion=23;
}else if(isset($_POST['opcionalesp'])){
       $pcionalesp=$_POST['opcionalesp'];   
       $accion=24;
}else if(isset($_POST['mosbtncar'])){
       $mosbtncar=$_POST['mosbtncar'];   
       $accion=25;
}else if(isset($_POST['comnom'])){
       $accion=26;
}else if(isset($_POST['btnagrusu'])){
         
       $accion=27;
}else if(isset($_POST['nbtnagrusu'])){
         
       $accion=28;
}else if(isset($_POST['texto'])){
         
       $accion=33;
    //echo "<script type=\"text/javascript\">alert(\"entro al $accion\");</script>"; 
}else if(isset($_POST['idnvo'])){
         
       $accion=34;
}else if(isset($_POST['idsuma'])){
         
       $accion=35;
}else if(isset($_POST['idresta'])){
       $accion=36;
}else if(isset($_POST['elicomponente'])){
       $accion=37;
}
else if(isset($_POST['idquitar'])){
       $accion=38;
}else if(isset($_POST['actcomp'])){
       $accion=39;
}else if(isset($_POST['carritofinal'])){
       $accion=40;
}else if(isset($_POST['elimcompfinal'])){
   
       $accion=41;
     //echo "<script type=\"text/javascript\">alert(\"entro al $accion\");</script>"; 
}else if(isset($_POST['elimpartfinal'])){
       $accion=42;
}else if(isset($_POST['descuento'])){
       $accion=43;
}else if(isset($_POST['cantdescuento'])){
       $accion=44;
}else if(isset($_POST['cantgasto'])){
       $accion=45;
}else if(isset($_POST['histcot'])){ 
       $accion=46;
}else if(isset($_POST['guarot'])){ 
       $accion=47;
}else if(isset($_POST['nota'])){ 
       $accion=48;
}else if(isset($_POST['igualar'])){ //Igualar a cero los datos del precio, iva y subtotal de rotatorio
    $accion=49;
}else if(isset($_POST['updatecheck'])){
    $checkup=$_POST['updatecheck'];
    $padreprod=$_POST['padreprod'];
	$accion=50;
}
else if(isset($_POST['updatecheckfinal'])){
    $checkup=$_POST['updatecheckfinal'];
    $padreprod=$_POST['padreprod'];
	$accion=51;
}else if(isset($_POST['nuevacantidad_id'])){
    $padreprod=$_POST['padreprod'];
	$accion=52;
}else if(isset($_POST['showinfopdf'])){
	$accion=53;
}
else if(isset($_POST['insertborra'])){
	$accion=54;
}
else if(isset($_POST['showBorradores'])){
	$accion=55;
}
else if(isset($_POST['abrirBorra'])){
    $id_borra=$_POST['abrirBorra'];
	$accion=56;
}
else if(isset($_POST['deleteborra'])){
    $id_borra=$_POST['deleteborra'];
	$accion=57;
}
else{
	$accion = 100;
}
  //echo "<script type=\"text/javascript\">alert(\"entro al $accion\");</script>";  

////Variables de SESSION
  $idsession=$_SESSION['num'];
  $iduss=$_SESSION['num_usu'];

switch($accion){
	case 1:
		$result = $conn->query("SELECT * FROM productos where id_cat=3");
        $reg= $result->num_rows;
        
        $outp="";

		if ($reg>0){
			while($rs = $result->fetch_array(MYSQLI_ASSOC)) {

				if ($outp != "") {
					$outp .= ",";
				}
					$outp .= '{"id":"'  . $rs['id'] . '",';
					$outp .= '"nombre":"'  . $rs['nombre'] . '"}';
				}
			$outp ='{"sistemas":['.$outp.']}';
			$conn->close();
			echo($outp); //regresa el JSON
		}
	break;
	case 2:
		print "<img style='display:block;position:absolute;left:42.5%;width:15%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/loadi.gif' />";
        session_destroy();
        header("Refresh:1; url=index.php");
	break;
	
	case 3:
		$result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre = '$sistemas' ORDER BY CONVERT(SUBSTRING_INDEX(C.nombre,'VACAS',1),UNSIGNED INTEGER)");
        
		if($sistemas>0){
			$sel="SELECCIONAR";
			$val=0;
			$click="recargarTamanos()";
		$cadena="<a class='letche'>CAPACIDAD</a>
			<select id='pla' name='idplataforma' class='form-control'>proc0301
			<option value'$val' disabled  selected>$sel</option>";
            
            while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
                $cadena=$cadena.'<option value='.$ver['id'].' Onclick='.$click.'>'.($ver['nombre']).'</option>';
            }
//			while ($ver=mysqli_fetch_row($result)) {
//				
//				$cadena=$cadena.'<option value='.$ver[0].' Onclick='.$click.'>'.utf8_encode($ver[2]).'</option>';
//			}

			echo  $cadena."</select>";
			}else{
				//$sel="SELCCIONAR";
				//$val=0;
				//$click="recargarTamanos()";
				//$cadena="<label>PLATAFORMA</label> 
				//<select id='pla' name='idplataforma' class='form-control'>";
			    //$cadena=$cadena.'<option value'.$val.' Onclick='.$click.'>'.$sel.'</option>';
				//echo  $cadena."</select>";
		    }
		
	break;
        case 4:
            if($plataformas!=0)
                {setcookie("tamanos", $plataformas, time()+3600,'./');
                   // echo "<script type=\"text/javascript\">console.log(\"$plataformas\");</script>";
                }
		$result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre = '$plataformas' and C.id_cat=4 ORDER BY C.descripcion");
		if($plataformas!=0){
			$sel="SELECCIONAR";
			$val=0;
			$click="recargarUnidadesssss()";///no quitar las ssss miesntras jale
		    $cadena="<a class='letche'>PLATAFORMA</a>
			<select id='cap' name='idcapacidad' class='form-control'>
			<option value'$val' disabled  selected>$sel</option>";

			while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
                $cadena=$cadena.'<option value='.$ver['id'].'>'.($ver['nombre']).'</option>';
            }

			echo  $cadena."</select>";
			}else{
				//$sel="SELCCIONAR";
				//$cadena="<label>CAPACIDAD</label> 
				//<select id='cap' name='idcapacidad' class='form-control'>";
			    //$cadena=$cadena.'<option >'.$sel.'</option>';
				//echo  $cadena."</select>";
		    }
		
	break;
		case 5:
		$result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre = '$tamanos' ORDER BY C.descripcion");
		if($tamanos!=0){
			$sel="SELECCIONAR";
			$val=0;
			$click="recargarBotton()";
		    $cadena="<a class='letche'>UNIDADES</a>
			<select id='uni' name='idunidades' class='form-control'>
			<option value'$val' disabled selected>$sel</option>";

			while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
                $cadena=$cadena.'<option value='.$ver['id'].' Onclick='.$click.'>'.($ver['nombre']).'</option>';
            }
           
			//echo $cadena."</select>";
			}else{
				//$sel="SELCCIONAR";
				//$cadena="<label>UNIDADES</label> 
				//<select id='uni' name='idunidades' class='form-control'>";
			    //$cadena=$cadena.'<option >'.$sel.'</option>';
				//echo  $cadena."</select>";
		    }
		
	break;
        
////////////////////APERTURA-MOSTRAR BOTON CUANDO SELECCIONA EL TIPO DE PLATAFORMA////////////////////////         
	case 6:
		if($unidades!=0){
            $cadena= "
            <input class='d-none' name='uniord' value='$unidades'>

            <button id='btnmoscar' type='submit' name='submit' value='$unidades' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarrito()'>SELECCIONAR</button>";
            echo $cadena;
		}else{
			$cadena="";
			echo $cadena;
		}
	break;
////////////////////CIERRE-MOSTRAR BOTON CUANDO SELECCIONA EL TIPO DE PLATAFORMA////////////////////////  
        
	case 17:
		$cadena="<center class='tablealing'>
				<div class='table-responsive'>
				<table border='0px'>
					<thead>
						<tr>
						
							<th >DESCRIPCION</th>
							<th >PRECIO</th>
							<th >1</th>
						</tr>
					</thead>
					<tbody>
					<tr>
						";
		$result = $conn->query("SELECT * FROM cotizacion_detallada");
		$cadena2="";
		while ($ver=mysqli_fetch_row($result)) {
			$prec=$ver[3]*$ver[4];	 
			
			$cadena=$cadena."
								
					
									<td>$ver[2]</td>
									<td>$prec</td>
									<td>	
									<button type='submit' name='submit'  value='8' class='btn btn-danger btn-sm tam'><o class='fa fa-times'></o></button>
									</td>
							
								
							
							
									";
			
		}
		echo $cadena."</tr></tbody></table></div></center>";
    break;
    case 7:
		$resulta= $conn->query("CALL proc0701($iduss,'$idsession')");
        $result= $conn->query("CALL proc0702($iduss,'$idsession')");
		$cadena="";	
	break;
        
////////////////////APERTURA-MOSTRAR CARRITO CUANDO SELECCIONA EL TIPO DE PLATAFORMA////////////////////////    
        case 8:
            try{
                $ordenmagico= $conn->query("CALL ordenamiento()");
                $clear= $conn->query("CALL proc0701($iduss,'$idsession')");
            $cadena="
                <script language='JavaScript'>
                function bunload(event){
                    event.returnValue = '¿Estas seguro que quieres salir?';
                }
                function unload(e){
                    $.ajax({
                        type:'POST',
                        url:'validar.php',
                        data:'eliminartodo=' + 7,
                        success:function(r){
                            
                        }
                    });
                }
            window.addEventListener('beforeunload', bunload);
            
            window.addEventListener('unload', unload);
            
            </script>
                <div class='row'>
                    <div class='col-12 pt-2'>
                        <div class='letra'><b>DESCRIPCION
                                <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
                            </b></div>
                    </div>
                </div>
                ";
            
            $numcot=$conn->query("SELECT numcotizacion FROM histrotatorio ORDER BY numcotizacion DESC limit 1");
            $reghis= $numcot->num_rows;
            if($reghis==0){
                $numecotizacion=1;
            }else{
                
                while($numcott=$numcot->fetch_assoc()){
                    $numecotizacion=$numcott['numcotizacion']+1;
                    
                }
            }
           // echo "<script type=\"text/javascript\">alert(\"el num $reghis cot es $numecotizacion\");</script>";

                $resultt = $conn->query("SELECT id FROM productos WHERE id=$carritos");
                while($vers = $resultt->fetch_array(MYSQLI_ASSOC)){
                        $resultta = $conn->query("SELECT padre,id,nombre,cantidad,orden FROM productos AS C JOIN relacion_producto AS O ON O.hijo = C.id WHERE O.padre = '$carritos' ORDER BY id");
                        //$reg= $resultta->num_rows;
                        $resulttaaaaa = $conn->query("SELECT id FROM productos AS C JOIN relacion_producto AS O ON O.hijo = C.id WHERE O.padre = '$carritos' ORDER BY id");
                        $id_componentes= array();
                        $i=0;
                        $precioscompo=array();
                        while($ids = $resulttaaaaa->fetch_array(MYSQLI_ASSOC)){
                                $id_componentes[$i]=$ids['id'];
                                $id_componentes2=$ids['id'];
                                $resulttaaaaat = $conn->query("SELECT id_producto_madero,precio_producto_sap FROM productos_sap AS C JOIN relacion_producto AS O ON O.hijo = C.id_producto_madero WHERE O.padre = '$id_componentes2' ORDER BY id_producto_madero");
                                $id_partes= array();
                                $totalcomponente=0;
                                $totalcomponentee=array();
                                $j=0;
                                while($idss = $resulttaaaaat->fetch_array(MYSQLI_ASSOC)) {
                                        $id_partes[$j]=$idss['id_producto_madero'];
                                        $totalcomponente=$idss['precio_producto_sap'];
                                        $totalcomponentee[$j]=$totalcomponente;
                                        $j++;
                                }
                                $n=0;
                                $total=array();
                                $ccc=0;
                                for($m=0;$m<count($id_partes);$m++){ 
                                    $idsap=$id_partes[$m];
                                    $cantidadporprecio=$conn->query("SELECT precio_producto_sap,cantidad FROM productos_sap as C JOIN relacion_producto AS O ON O.hijo = C.id_producto_madero WHERE O.padre ='$id_componentes2' and  C.id_producto_madero='$idsap'");    
                                    while($mulpre = $cantidadporprecio->fetch_array(MYSQLI_ASSOC)) {
                                            $b=$mulpre['precio_producto_sap'];
                                            $b=number_format($b,8,'.','');
                                            $a=$mulpre['precio_producto_sap']*$mulpre['cantidad'];
                                    }
                                    $total[$m]=$a;
                                    $ccc=$ccc+$total[$m]; $n++;
                                    $precioscompo[$i]=$ccc;
                                }
                                $i++;
                        }
                            $z=0;
                            $precom=0;
                            while($vart = $resultta->fetch_array(MYSQLI_ASSOC)) {
                                    $idsession=$_SESSION['num'];
                                    //$precom=$precioscompo[$z];
                                    //$precom=number_format($precom,8,'.','');
                                    $id_comp=$vart['padre'];
                                    $id_prod=$vart['id'];
                                    $desc=$vart['nombre'];
                                    $canticomp=$vart['cantidad'];
                                    $orden=$vart['orden']; 
                                    $desc=str_replace("'","",$desc); 
                                    $resulttaaa = $conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,cantidad,uc,precio,id_usuario,idsession,numcotizacion,ischeck,orden) values('$id_comp','$id_prod','$desc',0,1,'0','$iduss','$idsession','$numecotizacion',1,$orden)");
                                    $z++;
                            }
                }
                $sistema=$_POST['sistema'];
                $plataforma=$_POST['plataforma'];
                $capacidad=$_POST['capacidad'];
                $unidad=$_POST['unidad'];
                $idclient=$_POST['nomclient'];
                $getName = $conn->query("SELECT nombre from productos where id=$plataforma");
                $nombreplat="";
                while($vart = $getName->fetch_array(MYSQLI_ASSOC)) {
                    $nombreplat=$vart['nombre'];
                } 
                $nomclient=$_POST['nomclient'];
                //$getNameCliente = $conn->query("SELECT card_name from clientes where card_code='$idclient'");
                
                //while($res = $getNameCliente->fetch_array(MYSQLI_ASSOC)) {
                  //  $nomclient=$res['card_name'];
                //}                
                $date = date("d-m-Y");
       // echo "<script type=\"text/javascript\">alert(\"nombre $nomclient\");</script>"; 
                $rotatorio=$conn->query("INSERT INTO rotatorio(sistema,plataforma,capacidad,unidad,id_usuario,idsession,numcotizacion,fecha,cliente,nombre) VALUES('$sistema','$plataforma','$capacidad','$unidad',$iduss,'$idsession',$numecotizacion,'$date','$nomclient','$nombreplat')");
                $contcompid=array();
                $contcomprelaid=array();
                $contcomp=$conn->query("SELECT id_producto FROM cotizacion_detallada WHERE idsession='$idsession'");
                $regcocom= $contcomp->num_rows;
                if($regcocom>0){
                        $u=0;
                        while($var = $contcomp->fetch_array(MYSQLI_ASSOC)) {
                                $contcompid[$u]=$var['id_producto'];
                                $padre=$var['id_producto'];
                                $u++;
                                $contcomprela=$conn->query("SELECT hijo FROM relacion_producto WHERE padre='$padre'");
                                $v=0;
                                while($verz = $contcomprela->fetch_array(MYSQLI_ASSOC)) {
                                        $contcomprelaid[$v]=$verz['hijo'];
                                        $hijo=$verz['hijo'];
                                        $contcompsap=$conn->query("SELECT * FROM productos_sap AS C JOIN relacion_producto AS O ON O.hijo = C.id_producto_madero WHERE O.padre ='$padre' and C.id_producto_madero='$hijo'");
                                        while($vor = $contcompsap->fetch_array(MYSQLI_ASSOC)) {
                                                $idprod=$vor['id_producto_madero'];
                                                $descr=$vor['nombre_producto_sap'];
                                                $preci=$vor['precio_producto_sap'];
                                                $costos=$vor['costos'];
                                                $cant=$vor['cantidad'];
                                                $moneda=$vor['moneda_articulo'];
                                                $descr=str_replace("'","",$descr); 
                                               /* if($moneda=="MXN"){
                                                    $predlr=$conn->query("SELECT * FROM precio_dolar");
                                                    while($dlr = $predlr->fetch_array(MYSQLI_ASSOC)){
                                                        $pre=$dlr['valor_usd'];
                                                    }
                                                    $preci=$preci/$pre;
                                                    $costos=$costos/$pre;
                                                }*/
                                                $contcompsapinst=$conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,costos,id_usuario,idsession,cantidad,numcotizacion,moneda,ischeck) values('$padre','$idprod','$descr','$preci','$costos','$iduss','$idsession','$cant','$numecotizacion','$moneda',1)");
                                        }
                                        $v++;
                                }
                        }

                        for($i=0;$i<count($contcompid);$i++){ 
                                $sub=0; $s=0; $subtotal=$conn->query("SELECT cantidad, precio FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$contcompid[$i]'");
                                while($mon = $subtotal->fetch_array(MYSQLI_ASSOC)) {
                                        $s=$mon['cantidad']*$mon['precio'];
                                        $sub=$sub+$s;
                                }
                                $total=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession'and id_producto='$contcompid[$i]'");
                        }
                }
                
                $busca_plataforma =  $conn->query("SELECT precio,id_producto,descripcion,ischeck FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' and descripcion LIKE '%PLATAFORMA%'");
                $existe= $busca_plataforma->num_rows;
                if($existe>0)
                $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>PLATAFORMA</div></b>";
                while($ver_plat = $busca_plataforma->fetch_array(MYSQLI_ASSOC)) {
                    $prec=1*$ver_plat['precio'];
                    $decimales_plat = number_format($prec,2);
                    $id_plat=$ver_plat['id_producto'];
                    $desc_plat=$ver_plat['descripcion'];
                    $checado=$ver_plat['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    
                    $cadena=$cadena."
                    <div class='row'>
                        <div class='col-12'>
                            <div class='letra'>
                                <div class='panel-group'>
                                    <div class='panel panel-default'>
                                        <div style='width:100%;'>
                                            <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' >
                                                <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                                <div class='chalinoDer'>
                                                    <span style='float:right;' class='letchicacoll'>
                                                    
                                                        
                                                    </span>
                                                    
                                                    <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                                    
                                                </div>
                                            </a>
                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                        </div>
                                        <div id='c$id_plat' class='panel-collapse collapse >
                                            <ul class='list-group'>";
                                                $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                                $numcomp= $partcomp->num_rows;
                                                $num=1;       
                                                  
                                                $imagen=$conn->query("SELECT dir_img FROM imagenes WHERE id_comp='$id_plat'");
                                                $regg= $imagen->num_rows;
                                                $dirrr="";
                                                while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                    $dirrr=$imgggg['dir_img'];
                                                } 
                                                $cadena=$cadena." 
                                                <div class='contenedor-input'>
                                                    <span class='input-29'>";
                                                    if($num==1){
                                                        $cadena=$cadena."
                                                         <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                    }
                                                    $cadena=$cadena."   
                                                    </span>
                                                    <span class='input-69'>";
                                                while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                                $p=0;
                                                $p=$vi['cantidad']*$vi['precio'];
                                                $deci = number_format($p,2);
                                                $id_sub=$vi['id_producto'];
                                                $vi1=$vi['id_producto'];
                                                $vi2=$vi['descripcion'];
                                                $checadosub=$vi['ischeck'];
                                                $checkbool="";
                                                $cantidadsub=$vi['cantidad'];
                                                if($checadosub=="1")
                                                {
                                                    $checkbool="checked";
                                                }
                                                 $cadena=$cadena." 
                                                        <li class='list-group-item' style='margin-left:20px;'>
                                                            <div style='width:100%;'>
                                                                <div class='chalinoIzq'>
                                                                <b>
                                                                <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                                </b><span > $vi2 </span> 
                                                                    
                                                                </div>
                                                                <div class='chalinoDer' style='vertical-align:middle;'>
                                                                    
                                                                <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                            </div>
                                                        </li>
                                                    
                                                
                                                ";
                                                $num++;
                                                }
                                                $cadena=$cadena."</span></div> </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            }

            $busca_ordeno=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' and (descripcion LIKE '%ORDEÑO%' or descripcion LIKE '%GLANDULA%' or descripcion LIKE '%BOMBAS DE LECHE%' or descripcion LIKE '%GRUPOS DE RECIBO%' or descripcion LIKE '%GRUPO DE RECIBO%' or descripcion LIKE '%LINEAS DE LECHE%' or descripcion LIKE '%SISTEMA DE PULSACION%' or descripcion LIKE '%TUBERIA DE PVC PULSACION%' or descripcion LIKE '%SOPORTERIA%' or descripcion LIKE '%FILTROS DE LECHE%' or descripcion LIKE '%SISTEMA DE VACIO%' or descripcion LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' or descripcion LIKE '%SISTEMA DE LAVADO%' or descripcion LIKE '%ARREADOR%' or descripcion LIKE '%ARRASTRE DE LECHE%' or descripcion LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' or descripcion LIKE '%FILTROS A TANQUE%' or descripcion LIKE '%SUCCION DE LAVADO%' OR descripcion LIKE '%CONTROL DE VACIO%' OR descripcion LIKE '%TRAMPA SANITARIA%' OR descripcion  LIKE '%LINEA DE LECHE%' OR descripcion  LIKE '%CONTROLADOR DE VACIO%') ORDER BY orden");
            $existe= $busca_ordeno->num_rows;
                if($existe>0)
            $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>EQUIPOS DE ORDEÑO</div></b>";
            while($ver_ordeno = $busca_ordeno->fetch_array(MYSQLI_ASSOC)) {
                $prec=1*$ver_ordeno['precio'];
                $decimales_plat = number_format($prec,2);
                $id_plat=$ver_ordeno['id_producto'];
                $desc_plat=$ver_ordeno['descripcion'];
                $checado=$ver_ordeno['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                $cadena=$cadena."
                <div class='row'>
                    <div class='col-12'>
                        <div class='letra'>
                            <div class='panel-group'>
                                <div class='panel panel-default'>
                                    <div style='width:100%;'>
                                        <a class='btn-coti' href='#c$id_plat' data-toggle='collapse'>
                                            <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                            <div class='chalinoDer'>
                                                <span style='float:right;' class='letchicacoll'>
                                                    <input name='elim' value='$id_plat' style='display:none;'>
                                                    <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                        <i class='fa fa-times'></i>
                                                    </button-->
                                                </span>
                                                <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                            </div>
                                        </a>
                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                    </div>
                                    <div id='c$id_plat' class='panel-collapse collapse'>
                                        <ul class='list-group'>";
                                            $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                            $numcomp= $partcomp->num_rows;
                                            $num=1;       
                                              
                                            $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp='$id_plat'");
                                            $regg= $imagen->num_rows;
                                            $dirrr="";
                                            while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                $dirrr=$imgggg['dir_img'];
                                            } 
                                            $cadena=$cadena." 
                                            <div class='contenedor-input'>
                                                <span class='input-29'>";
                                                if($num==1){
                                                    $cadena=$cadena."
                                                     <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                }
                                                $cadena=$cadena."   
                                                </span>
                                                <span class='input-69'>";
                                            while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                            $p=0;
                                            $p=$vi['cantidad']*$vi['precio'];
                                            $deci = number_format($p,2);
                                            $vi1=$vi['id_producto'];
                                            $vi2=$vi['descripcion'];
                                            $id_sub=$vi['id_producto'];
                                            $checadosub=$vi['ischeck'];
                                            $cantidadsub=$vi['cantidad'];
                                            $checkbool="";
                                            if($checadosub=="1")
                                            {
                                                $checkbool="checked";
                                            }
                                             $cadena=$cadena." 
                                                    <li class='list-group-item' style='margin-left:20px;'>
                                                        <div style='width:100%;'>
                                                            <div class='chalinoIzq'>
                                                            <b>
                                                            <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                               </b> <span > $vi2 </span> 
                                                                
                                                            </div>
                                                            <div class='chalinoDer' style='vertical-align:middle;'>
                                                                <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                                <o class='fa fa-times'></o>
                                                            </button-->
                                                            <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                        </div>
                                                    </li>
                                                
                                            
                                            ";
                                            $num++;
                                            }
                                            $cadena=$cadena."</span></div> </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        }
        $busca_complementarios=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' and descripcion NOT LIKE '%ORDEÑO%' and descripcion NOT LIKE '%PLATAFORMA%' and descripcion NOT LIKE '%GLANDULA%' AND descripcion NOT LIKE '%BOMBAS DE LECHE%' AND descripcion NOT LIKE '%GRUPOS DE RECIBO%' AND descripcion NOT LIKE '%GRUPO DE RECIBO%' AND descripcion NOT LIKE '%LINEAS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE PULSACION%' AND descripcion NOT LIKE '%TUBERIA DE PVC PULSACION%' AND descripcion NOT LIKE '%SOPORTERIA%' AND descripcion NOT LIKE '%FILTROS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE VACIO%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' AND descripcion NOT LIKE '%SISTEMA DE LAVADO%' AND descripcion NOT LIKE '%ARREADOR%' AND descripcion NOT LIKE '%ARRASTRE DE LECHE%' AND descripcion NOT LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' AND descripcion not LIKE '%FILTROS A TANQUE%' AND descripcion not LIKE '%SUCCION DE LAVADO%' AND descripcion not LIKE '%CONTROL DE VACIO%' AND descripcion not LIKE '%TRAMPA SANITARIA%' AND descripcion not LIKE '%LINEA DE LECHE%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO%' ORDER BY orden;");
        $existe= $busca_complementarios->num_rows;
        if($existe>0)
        $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>COMPLEMENTARIOS</div></b>";
        while($ver_com = $busca_complementarios->fetch_array(MYSQLI_ASSOC)) {
            $prec=1*$ver_com['precio'];
            $decimales_plat = number_format($prec,2);
            $id_plat=$ver_com['id_producto'];
            $desc_plat=$ver_com['descripcion'];
            $checado=$ver_com['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
            $cadena=$cadena."
            <div class='row'>
                <div class='col-12'>
                
                    <div class='letra'>
                        <div class='panel-group'>
                            <div class='panel panel-default'>
                                <div style='width:100%;'>
                                    <a class='btn-coti' href='#c$id_plat' data-toggle='collapse'>
                                        <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                        <div class='chalinoDer'>
                                            <span style='float:right;' class='letchicacoll'>
                                                <input name='elim' value='$id_plat' style='display:none;'>
                                                <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                    <i class='fa fa-times'></i>
                                                </button-->
                                            </span>
                                            <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                        </div>
                                    </a>
                                    <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                </div>
                                <div id='c$id_plat' class='panel-collapse collapse'>
                                    <ul class='list-group'>";
                                        $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                        $numcomp= $partcomp->num_rows;
                                        $num=1;       
                                          
                                        $imagen=$conn->query("SELECT dir_img FROM imagenes WHERE id_comp='$id_plat'");
                                        $regg= $imagen->num_rows;
                                        $dirrr="";
                                        while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                            $dirrr=$imgggg['dir_img'];
                                        } 
                                        $cadena=$cadena." 
                                        <div class='contenedor-input'>
                                            <span class='input-29'>";
                                            if($num==1){
                                                $cadena=$cadena."
                                                 <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                            }
                                            $cadena=$cadena."   
                                            </span>
                                            <span class='input-69'>";
                                        while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                        $p=0;
                                        $p=$vi['cantidad']*$vi['precio'];
                                        $deci = number_format($p,2);
                                        $vi1=$vi['id_producto'];
                                        $vi2=$vi['descripcion'];
                                        $id_sub=$vi['id_producto'];
                                        $checadosub=$vi['ischeck'];
                                        $cantidadsub=$vi['cantidad'];
                                        $checkbool="";
                                        if($checadosub=="1")
                                        {
                                            $checkbool="checked";
                                        }
                                         $cadena=$cadena." 
                                                <li class='list-group-item' style='margin-left:20px;'>
                                                    <div style='width:100%;'>
                                                        <div class='chalinoIzq'>
                                                        <b>
                                                        <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                        </b> <span > $vi2 </span> 
                                                            
                                                        </div>
                                                        <div class='chalinoDer' style='vertical-align:middle;'>
                                                            <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                            <o class='fa fa-times'></o>
                                                        </button-->
                                                        <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                        </div>
                                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                    </div>
                                                </li>
                                            
                                        
                                        ";
                                        $num++;
                                        }
                                        $cadena=$cadena."</span></div> </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
    }
                
                $subt=0;
                $resulti = $conn->query("SELECT precio FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos'");
                $reg= $resulti->num_rows;
                if($reg==0){
                    echo 0;
                
                }else{




                while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                $subt = $subt+$vari['precio'];
                }
                $decimales_sub = number_format($subt,2);
                echo "<span style='float:right;'><b> <input value='SUBTOTAL $$decimales_sub' readonly style='border:none; outline:none; text-align:right' id='txtsubtotal'> </b> </span><br>";
                echo $cadena."</divv>";
                echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()' class='letche'>SIGUIENTE</button>";
                }
            }catch(Exception $error){
                echo "<p> Ocurrio un error inesperado recargue la pagina</p>";
            }
        break;
////////////////////CIERRE-MOSTRAR CARRITO CUANDO SELECCIONA EL TIPO DE PLATAFORMA////////////////////////    
	   case 9:
        $cadena="";
        $acci=$_POST['acci'];
        $idsession=$_SESSION['num'];
		$user=$_SESSION['usuario'];
        $a=$elim;
					$ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
					while($vat=mysqli_fetch_row($ressull)){
						$iduss=$vat[0];
						
					}
		if($acci==1){
            $resulta= $conn->query("DELETE FROM cotizacion_detallada WHERE id_producto='$elim' and id_usuario='$iduss' and idsession='$idsession'");
        
            $resuk=$conn->query("DELETE FROM cotizacion_detallada WHERE id_component='$elim' and id_usuario='$iduss' and idsession='$idsession'");
        }else if($acci==2){
            
            
            $padre="a";
            
            $resulet=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_producto='$elim'");
            $reg= $resulet->num_rows;
            
             //echo "<script type=\"text/javascript\">alert(\"los registros encontrados son $reg\");</script>"; 
            
             while($vtr=mysqli_fetch_row($resulet)){
                $padre=$vtr[0];
               // echo "<script type=\"text/javascript\">alert(\"entre al whilw\");</script>"; 
            }
            
           $resulta= $conn->query("DELETE FROM cotizacion_detallada WHERE id_producto='$elim' and id_usuario='$iduss' and idsession='$idsession'");
            
            //echo "<script type=\"text/javascript\">alert(\"el padre es $padre y la parte es $elim el yde de usuario $iduss la ide de session $idsession\");</script>"; 
            
            $resultr = $conn->query("SELECT * FROM cotizacion_detallada  WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$padre' ORDER BY id_producto");
            $rege= $resultr->num_rows;
            if($rege<1){
                $resultaer= $conn->query("DELETE FROM cotizacion_detallada WHERE id_producto='$padre' and id_usuario='$iduss' and idsession='$idsession'");
            }else{

            
            
            $prec=0;
            $s=0;
            $sub=0;
            while ($vur=mysqli_fetch_row($resultr)) {
                $s=$vur[3]*$vur[5];
                         $sub=$sub+$s;
                //echo "<script type=\"text/javascript\">alert(\"le sume $vur[4] y decimal vale $sub\");</script>"; 
                $resta=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession' and id_producto='$padre'");
            }	
        }
            
            
        }
		
		
			
		$cadena="<divv class='table-responsive table-xl'>
					<div class='row'>
					<div class='col-8 pt-2'>
						<div><b>DESCRIPCION</b></div>
					</div>
					<div class='col-2 pt-2'>
						<div><b>PRECIO</b></div>
					</div>
					<div class='col-2 pt-2'>
						<div></div>
					</div>
				   </div>
					";
		$result = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' ORDER BY id_producto");
		while ($ver_cot=mysqli_fetch_row($result)) {
			$prec=$ver_cot[3]*$ver_cot[4];			
				$cadena=$cadena."<div class='row'>
								<div class='col-8 pt-2'>
									<div>$ver_cot[2]</div>
								</div>
								<div class='col-2 pt-2'>
									<div>$prec</div>
								</div>
								<div class='col-2 pt-2'>
									
                                    <div><input name='elim' value='$ver_cot[1]' style='display:none;'><button id='elicar' type='submit' name='submit' value='$ver_cot[1]' class='btn btn-danger btn-sm '><o class='fa fa-times'></o></button></div>
								</div>
								</div>
								";
			}
           
		$subt=0;
		$resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss'");
		$reg= $resulti->num_rows;
		//echo $reg;
		while ($vari=mysqli_fetch_row($resulti)){
			$subt = $subt+$vari[4];
			
		}
		$decimales_sub = number_format($subt,2);
		echo "<b>SUBTOTAL $".$decimales_sub."</b><br><br>";
			echo $cadena."</divv>";
		
		break;
        case 10:
                $abrircolapse=$_POST['colapse'];
                $cadena="";
                $user=$_SESSION['usuario'];
                $idsession=$_SESSION['num'];
                $ressull=$conn->query("SELECT id_usuario FROM usuarios WHERE usuario='$user'");
                while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                      $iduss=$vat['id_usuario'];
                }
                
                $busca_plataforma =  $conn->query("SELECT precio,id_producto,descripcion,ischeck FROM cotizacion_detallada where id_usuario=$iduss and idsession='$idsession' and id_component=$carritos and descripcion LIKE '%PLATAFORMA%'");
                $existe= $busca_plataforma->num_rows;
                if($existe>0)
                $cadena="
                <button id='btnmoscar' name='btnmagico' value='$carritos' style='opacity:0; position:absolute;'>SELECCIONAR</button>
        <div class='letra' style='color: #00528b!important;'><b>PLATAFORMA</div></b>";
                while($ver_p = $busca_plataforma->fetch_array(MYSQLI_ASSOC)) {
                    
                    $prec=$ver_p['precio'];
                    $decimales_plat =   number_format($prec,2);
                    $id_plat=$ver_p['id_producto'];
                    $desc_plat=$ver_p['descripcion'];
                    $checado=$ver_p['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    $classcolapse="";
                    $classcolapseshow="";
                    if($abrircolapse==$id_plat)
                    {
                        $classcolapse="aria-expanded='true'";
                        $classcolapseshow="show in";
                    
                    }
                    $cadena=$cadena."
                    <div class='row'>
                        <div class='col-12'>
                            <div class='letra'>
                                <div class='panel-group'>
                                    <div class='panel panel-default'>
                                        <div style='width:100%;'>
                                            <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' $classcolapse>
                                                <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                                <div class='chalinoDer'>
                                                    <span style='float:right;' class='letchicacoll'>
                                                    
                                                        
                                                    </span>
                                                    
                                                    <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                                    
                                                </div>
                                            </a>
                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                        </div>
                                        <div id='c$id_plat' class='panel-collapse collapse $classcolapseshow' $classcolapse>
                                            <ul class='list-group'>";
                                                $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario=$iduss and cot.idsession='$idsession' and cot.id_component=$id_plat ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                                $numcomp= $partcomp->num_rows;
                                                $num=1;       
                                                  
                                                $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp=$id_plat");
                                                $regg= $imagen->num_rows;
                                                $dirrr="";
                                                while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                    $dirrr=$imgggg['dir_img'];
                                                } 
                                                $cadena=$cadena." 
                                                <div class='contenedor-input'>
                                                    <span class='input-29'>";
                                                    if($num==1){
                                                        $cadena=$cadena."
                                                         <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                    }
                                                    $cadena=$cadena."   
                                                    </span>
                                                    <span class='input-69'>";
                                                while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                                $p=0;
                                                $p=$vi['cantidad']*$vi['precio'];
                                                $deci = number_format($p,2);
                                                $id_sub=$vi['id_producto'];
                                                $vi1=$vi['id_producto'];
                                                $vi2=$vi['descripcion'];
                                                $checadosub=$vi['ischeck'];
                                                $cantidadsub=$vi['cantidad'];
                                                $checkbool="";
                                                if($checadosub=="1")
                                                {
                                                    $checkbool="checked";
                                                }
                                                 $cadena=$cadena." 
                                                        <li class='list-group-item' style='margin-left:20px;'>
                                                            <div style='width:100%;'>
                                                                <div class='chalinoIzq'>
                                                                <b>
                                                                <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                                </b> <span > $vi2 </span> 
                                                                    
                                                                </div>
                                                                <div class='chalinoDer' style='vertical-align:middle;'>
                                                                    
                                                                <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                            </div>
                                                        </li>
                                                    
                                                
                                                ";
                                                $num++;
                                                }
                                                $cadena=$cadena."</span></div> </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            }

            $busca_ordeno=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario=$iduss and idsession='$idsession' and id_component=$carritos and (descripcion LIKE '%ORDEÑO%' or descripcion LIKE '%GLANDULA%' or descripcion LIKE '%BOMBAS DE LECHE%' or descripcion LIKE '%GRUPOS DE RECIBO%' or descripcion LIKE '%GRUPO DE RECIBO%' or descripcion LIKE '%LINEAS DE LECHE%' or descripcion LIKE '%SISTEMA DE PULSACION%' or descripcion LIKE '%TUBERIA DE PVC PULSACION%' or descripcion LIKE '%SOPORTERIA%' or descripcion LIKE '%FILTROS DE LECHE%' or descripcion LIKE '%SISTEMA DE VACIO%' or descripcion LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' or descripcion LIKE '%SISTEMA DE LAVADO%' or descripcion LIKE '%ARREADOR%' or descripcion LIKE '%ARRASTRE DE LECHE%' or descripcion LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' or descripcion LIKE '%FILTROS A TANQUE%' or descripcion LIKE '%SUCCION DE LAVADO%' OR descripcion LIKE '%CONTROL DE VACIO%' OR descripcion LIKE '%TRAMPA SANITARIA%' OR descripcion  LIKE '%LINEA DE LECHE%' OR descripcion  LIKE '%CONTROLADOR DE VACIO%') ORDER BY orden");
            $existe= $busca_ordeno->num_rows;
            if($existe>0)
            $cadena=
            $cadena."
        <div class='letra' style='color: #00528b!important;'><b>EQUIPOS DE ORDEÑO</div></b>";
            while($ver_o = $busca_ordeno->fetch_array(MYSQLI_ASSOC)) {
                $prec=1*$ver_o['precio'];
                $decimales_plat = number_format($prec,2);
                $id_plat=$ver_o['id_producto'];
                $desc_plat=$ver_o['descripcion'];
                $checado=$ver_o['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    $classcolapse="";
                    $classcolapseshow="";
                    if($abrircolapse==$id_plat)
                    {
                        $classcolapse="aria-expanded='true'";
                        $classcolapseshow="show in";
                    
                    }
                $cadena=$cadena."
                <div class='row'>
                    <div class='col-12'>
                        <div class='letra'>
                            <div class='panel-group'>
                                <div class='panel panel-default'>
                                    <div style='width:100%;'>
                                        <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' $classcolapse>
                                            <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                            <div class='chalinoDer'>
                                                <span style='float:right;' class='letchicacoll'>
                                                    <input name='elim' value='$id_plat' style='display:none;'>
                                                    <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                        <i class='fa fa-times'></i>
                                                    </button-->
                                                </span>
                                                <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                            </div>
                                        </a>
                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                    </div>
                                    <div id='c$id_plat' class='panel-collapse collapse $classcolapseshow' $classcolapse>
                                        <ul class='list-group'>";
                                            $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario=$iduss and cot.idsession='$idsession' and cot.id_component=$id_plat ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                            $numcomp= $partcomp->num_rows;
                                            $num=1;       
                                              
                                            $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp=$id_plat");
                                            $regg= $imagen->num_rows;
                                            $dirrr="";
                                            while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                $dirrr=$imgggg['dir_img'];
                                            } 
                                            $cadena=$cadena." 
                                            <div class='contenedor-input'>
                                                <span class='input-29'>";
                                                if($num==1){
                                                    $cadena=$cadena."
                                                     <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                }
                                                $cadena=$cadena."   
                                                </span>
                                                <span class='input-69'>";
                                            while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                            $p=0;
                                            $p=$vi['cantidad']*$vi['precio'];
                                            $deci = number_format($p,2);
                                            $vi1=$vi['id_producto'];
                                            $vi2=$vi['descripcion'];
                                            $checadosub=$vi['ischeck'];
                                            $id_sub=$vi['id_producto'];
                                            $cantidadsub=$vi['cantidad'];
                                            $checkbool="";
                                            if($checadosub=="1")
                                            {
                                                $checkbool="checked";
                                            }
                                             $cadena=$cadena." 
                                                    <li class='list-group-item' style='margin-left:20px;'>
                                                        <div style='width:100%;'>
                                                            <div class='chalinoIzq'>
                                                            <b>
                                                            <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                            </b> <span > $vi2 </span> 
                                                                
                                                            </div>
                                                            <div class='chalinoDer' style='vertical-align:middle;'>
                                                                <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                                <o class='fa fa-times'></o>
                                                            </button-->
                                                            <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                        </div>
                                                    </li>
                                                
                                            
                                            ";
                                            $num++;
                                            }
                                            $cadena=$cadena."</span></div> </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        }
        $busca_complementarios=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario=$iduss and idsession='$idsession' and id_component=$carritos and descripcion NOT LIKE '%ORDEÑO%' and descripcion NOT LIKE '%PLATAFORMA%' and descripcion NOT LIKE '%GLANDULA%' AND descripcion NOT LIKE '%BOMBAS DE LECHE%' AND descripcion NOT LIKE '%GRUPOS DE RECIBO%' AND descripcion NOT LIKE '%GRUPO DE RECIBO%' AND descripcion NOT LIKE '%LINEAS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE PULSACION%' AND descripcion NOT LIKE '%TUBERIA DE PVC PULSACION%' AND descripcion NOT LIKE '%SOPORTERIA%' AND descripcion NOT LIKE '%FILTROS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE VACIO%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' AND descripcion NOT LIKE '%SISTEMA DE LAVADO%' AND descripcion NOT LIKE '%ARREADOR%' AND descripcion NOT LIKE '%ARRASTRE DE LECHE%' AND descripcion NOT LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' AND descripcion not LIKE '%FILTROS A TANQUE%' AND descripcion not LIKE '%SUCCION DE LAVADO%' AND descripcion not LIKE '%CONTROL DE VACIO%' AND descripcion not LIKE '%TRAMPA SANITARIA%' AND descripcion not LIKE '%LINEA DE LECHE%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO%' ORDER BY orden;");
    
        $existe= $busca_complementarios->num_rows;
        if($existe>0)
        $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>COMPLEMENTARIOS</div></b>";
        while($ver_c = $busca_complementarios->fetch_array(MYSQLI_ASSOC)) {
            $prec=1*$ver_c['precio'];
            $decimales_plat = number_format($prec,2);
            $id_plat=$ver_c['id_producto'];
            $desc_plat=$ver_c['descripcion'];
            $checado=$ver_c['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    $classcolapse="";
                    $classcolapseshow="";
                    if($abrircolapse==$id_plat)
                    {
                        $classcolapse="aria-expanded='true'";
                        $classcolapseshow="show in";
                    
                    }
            $cadena=$cadena."
            <div class='row'>
                <div class='col-12'>
                
                    <div class='letra'>
                        <div class='panel-group'>
                            <div class='panel panel-default'>
                                <div style='width:100%;'>
                                    <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' $classcolapse>
                                        <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                        <div class='chalinoDer'>
                                            <span style='float:right;' class='letchicacoll'>
                                                <input name='elim' value='$id_plat' style='display:none;'>
                                                <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                    <i class='fa fa-times'></i>
                                                </button-->
                                            </span>
                                            <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                        </div>
                                    </a>
                                    <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                </div>
                                <div id='c$id_plat' class='panel-collapse collapse $classcolapseshow' $classcolapse>
                                    <ul class='list-group'>";
                                        $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario=$iduss and cot.idsession='$idsession' and cot.id_component=$id_plat ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                        $numcomp= $partcomp->num_rows;
                                        $num=1;       
                                          
                                        $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp=$id_plat");
                                        $regg= $imagen->num_rows;
                                        $dirrr="";
                                        while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                            $dirrr=$imgggg['dir_img'];
                                        } 
                                        $cadena=$cadena." 
                                        <div class='contenedor-input'>
                                            <span class='input-29'>";
                                            if($num==1){
                                                $cadena=$cadena."
                                                 <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                            }
                                            $cadena=$cadena."   
                                            </span>
                                            <span class='input-69'>";
                                        while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                        $p=0;
                                        $p=$vi['cantidad']*$vi['precio'];
                                        $deci = number_format($p,2);
                                        $vi1=$vi['id_producto'];
                                        $vi2=$vi['descripcion'];
                                        $id_sub=$vi['id_producto'];
                                        $checadosub=$vi['ischeck'];
                                        $cantidadsub=$vi['cantidad'];
                                        $checkbool="";
                                        if($checadosub=="1")
                                        {
                                            $checkbool="checked";
                                        }
                                         $cadena=$cadena." 
                                                <li class='list-group-item' style='margin-left:20px;'>
                                                    <div style='width:100%;'>
                                                        <div class='chalinoIzq'>
                                                        <b>
                                                        <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                        </b>   <span > $vi2 </span> 
                                                            
                                                        </div>
                                                        <div class='chalinoDer' style='vertical-align:middle;'>
                                                            <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                            <o class='fa fa-times'></o>
                                                        </button-->
                                                        <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                        </div>
                                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                    </div>
                                                </li>
                                            
                                        
                                        ";
                                        $num++;
                                        }
                                        $cadena=$cadena."</span></div> </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
    }
                $subt=0;
                $resulti = $conn->query("SELECT ischeck,precio FROM cotizacion_detallada WHERE id_usuario=$iduss and idsession='$idsession' and id_component=$carritos");
                $reg= $resulti->num_rows;

                if($reg==0){
                    header("Refresh:1; url=cotizaciones.php");
                    echo 0;
                
                }else{
                    while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                        $ischecado=$vari['ischeck'];
                        if($ischecado==1)
                            $subt = $subt+$vari['precio'];
                    }
                    $decimales_sub = number_format($subt,2);
                    echo "<span style='float:right;'><b>SUBTOTAL $".$decimales_sub."</b> </span><br>";
                    echo $cadena."</divv>";
                    echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()'>SIGUIENTE</button>";
                   
                }
               
                
                
		break;
       case 11:
        $categorias = $conn->query("SELECT * FROM categoria WHERE id_cat!='3' ORDER BY id_cat ");
        $cadena="<div class='row' style='float:right;margin-right:0px'>
        <span style='margin-top:5px; margin-right:5px'>Categoria: </span>
        <select id='idcategoria' name='idcategoria' onchange='filtracat(this.value);' class='form-control' style='float:right;width:auto; margin-bottom:10px; font-size:12px'>
        <option value='0' onclick='filtracat(0)'>Todas las categorias</option>
        ";
        $categoria_seleccionada=$_POST["categoria"];
        while($ver = $categorias->fetch_array(MYSQLI_ASSOC)) {
            $id_cat=$ver['id_cat'];
            $nom_cat=$ver['nombre'];
            $clickc="filtracat($id_cat)";
            if($categoria_seleccionada!=$ver['id_cat'])
            {
               $cadena=$cadena.'<option value='.$id_cat.' Onclick='.$clickc.'>'.($ver['nombre']).'</option>';
            }
            else{
                $cadena=$cadena.'<option value='.$id_cat.' Onclick='.$clickc.' selected>'.($ver['nombre']).'</option>';
            }
        }
        $cadena=$cadena."</select></div>";
                $cadena=$cadena."                
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered' id='dataTable' style='margin-bottom: 0'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DESCRIPCION</th>
                                <th>CATEGORIA</th>
                                <th>ELIMINAR</th>
                                <th>EDITAR </th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
                            

                            if($categoria_seleccionada==0 || $categoria_seleccionada==null)
                                $resulti = $conn->query("SELECT * FROM productos ORDER BY id");
                            else{
                                $resulti = $conn->query("SELECT * FROM productos where id_cat=$categoria_seleccionada  ORDER BY id");
                            }
                            // if($_POST["texto"]!= ""){
                            //     $resulti=$conn->query("SELECT * FROM productos WHERE (nombre LIKE '%".$_POST["texto"]."%' OR id LIKE '%".$_POST["texto"]."%')  ORDER BY id ");

                            // }
                            while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                                    $vari0=$vari['id'];
                                    $vari1=$vari['id_cat'];
                                    $vari2=$vari['descripcion'];
                                    $ressss=$conn->query("SELECT * FROM categoria");
                                    $nomcategoria="";
                                    while($varo = $ressss->fetch_array(MYSQLI_ASSOC)) {
                                            if($vari1==$varo['id_cat']){
                                                    $nomcategoria=$varo['nombre'];
                                            }
                                    }
                                    $cadena=$cadena."
                                    <tr>
                                        <td>$vari0</td>
                                        <td>$vari2</td>
                                        <td>$nomcategoria</td>
                                        <td><button id='elicar' class='btn btn-danger btn-sm' Onclick='elimcompo($vari0)'>
                                                <o class='fa fa-times'></o>
                                            </button></td>
                                        <td>
                                            <form action='editarcomponente.php' method='post'><input class='d-none' name='indice' value='$vari0'><button name='editcomp' type='submit' value='2' id='editcomp$vari0' class='btn btn-warning btn-sm'>
                                                    <o class='fas fa-edit'></o>
                                                </button></form>
                                        </td>
                                    </tr>";
                            }
                            $cadena=$cadena."
                        </tbody>
                    </table>
                </div>";
                echo $cadena;
		break;
		case 12:
                $cadena="<select id='cat' name='cat' class='input-100 selectt' required>
                <option disabled selected value='0'>SELECCIONAR CATEGORIA</option>
                ";
                $result=$conn->query("SELECT * FROM categoria ORDER BY id_cat");
                while($var = $result->fetch_array(MYSQLI_ASSOC)) {
                    
                        $var0=$var['id_cat'];
                        $var1=$var['nombre'];
                        if($var0!=3){
                            $cadena=$cadena."<option value=$var0>$var1</option>";
                        }
                }
                echo $cadena."</select>";
		break;
		case 13:
		        $cadena="<select  name='catcom' class='form-control'>
					<option disabled selected>CATEGORIA</option>
				";
				$result=$conn->query("SELECT * FROM categoria");
				 while($var = $result->fetch_array(MYSQLI_ASSOC)) {
                        $var0=$var['id_cat'];
                        $var1=$var['nombre'];
                        $cadena=$cadena."<option value=$var0>$var1</option>";
                }
				echo $cadena."</select>";
		break;
		case 14:
                $cadena="";
                echo $cadena;
		break;
		case 15:
		$cadena="
				<div class='table-responsive'>
				    <table class='table table-striped'>
				        <thead>
				            <tr>
				                <th>ID</th>
				                <th>NOMBRE</th>
				            </tr>
				        </thead>
				        <tbody>
				            ";
				            $resulti = $conn->query("SELECT * FROM categoria ORDER BY id_cat");
                            while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                                    $vari0=$vari['id_cat'];
                                    $vari1=$vari['nombre'];
                                    $cadena=$cadena."
                                    <tr>
                                        <td>$vari0</td>
                                        <td>$vari1</td>
                                    </tr>";
				            }
				            $cadena=$cadena."
				        </tbody>
				    </table>
				</div>";
				echo $cadena;
		break;
/////////////////////////////////////////////////////////////// APERTURA- MOSTRAR USUARIOS////////////////////////////////////////////////////    
		case 16:
                $cadena="
                        <div class='table-responsive'>
                            <table class='table table-striped table-bordered' style='margin-bottom: 0'>
                                <thead>
                                    <tr>
                                       
                                        <th>NOMBRE</th>
                                        <th>USUARIO</th>
                                        <th>CORREO</th>
                                        <th>ROL</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
                                    $resulti = $conn->query("SELECT * FROM usuarios ORDER BY id_usuario ");
                                    while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                                        
                                            $vari0=$vari['id_usuario'];
                                            $vari1=$vari['nombre'];
                                            $vari2=$vari['usuario'];
                                            $vari4=$vari['correo'];
                                            $vari5=$vari['rol'];
                                            $rol="";
                                            if($vari5==1){
                                                    $rol="ADMINISTRADOR";
                                            }else{
                                                    $rol="VENDEDOR";
                                            }
                                            if($_SESSION['num_usu']!=1 && $vari0==1){

                                            }else{
                                                $cadena=$cadena."
                                            <tr>
                                                
                                                <td>$vari1</td>
                                                <td>$vari2</td>
                                                <td>$vari4</td>
                                                <td>$rol</td>
                                                <td> ";
                                            if($vari0!=1){ 
                                                $cadena=$cadena."<button value='$vari0' id='eliusua$vari0' class='btn btn-danger btn-sm' Onclick='eliminarUsuario($vari0)'>
                                                        <o class='fa fa-times'></o>
                                                    </button>";
                                            } 
                                            $cadena=$cadena."</td>";
                                            $cadena=$cadena."<td>
                                                    <form action='editarusuario.php' method='post'><input class='d-none' name='indice' value='$vari0'><button name='editusua' type='submit' value='2' id='editusua$vari0' class='btn btn-warning btn-sm'>
                                                            <o class='fas fa-edit'></o>
                                                        </button></form>
                                                    </td>
                                                    </tr>";
                                            }
                                            
                                    }
                                    $cadena=$cadena."
                                </tbody>
                            </table>
                        </div>";
                        echo $cadena;
		break;
/////////////////////////////////////////////////////////////// CIERRE- MOSTRAR USUARIOS////////////////////////////////////////////////////    
        
        
/////////////////////////////////////////////////////////////// APERTURA- AÑADIR USUARIOS////////////////////////////////////////////////////    
		case 18:
			$rol=$_POST['rolusu'];
			$nombre=$_POST['nomusu'];
			$usuario=$_POST['nickusu'];
			$contrasena=$_POST['conusu'];
			$correo=$_POST['corusu'];
            $passHash = password_hash($contrasena, PASSWORD_BCRYPT);
		    $resultt=$conn->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
			$reg= $resultt->num_rows;
			if($reg>0){
				echo "<script type=\"text/javascript\">alert(\"YA EXISTE UN USUARIO CON ESTE NICKNAME\"); window.location.href = './agregarusuario.php'; </script>";  
			}else{
				$result = $conn->query("INSERT INTO usuarios(nombre,usuario,pass,correo,rol) values('$nombre','$usuario','$passHash','$correo','$rol')");
				echo "<script type=\"text/javascript\">alert(\"USUARIO CREADO CORRECTAMENTE\"); window.location.href = './usuarios.php'; </script>";  
			}
		break;
/////////////////////////////////////////////////////////////// CIERRE- AÑADIR USUARIOS////////////////////////////////////////////////////   
        
/////////////////////////////////////////////////////////////// APERTURA- ELIMINAR USUARIOS////////////////////////////////////////////////////           
		case 19:
			$resulta= $conn->query("DELETE FROM usuarios WHERE id_usuario='$eliusuario'");
			$cadena="
			<div class='table-responsive'>
			    <table class='table table-striped table-bordered' style='margin-bottom: 0'>
			        <thead>
			            <tr>
			                <th>ID</th>
			                <th>NOMBRE</th>
			                <th>USUARIO</th>
			                <th>CORREO</th>
			                <th>ROL</th>
			                <th></th>
			                <th></th>
			            </tr>
			        </thead>
			        <tbody>
			            ";
			            $resulti = $conn->query("SELECT * FROM usuarios ORDER BY id_usuario ");
			             while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                                            $vari0=$vari['id_usuario'];
                                            $vari1=$vari['nombre'];
                                            $vari2=$vari['usuario'];
                                            $vari4=$vari['correo'];
                                            $vari5=$vari['rol'];
                                            $rol="";
                                            if($vari5==1){
                                                    $rol="ADMINISTRADOR";
                                            }else{
                                                    $rol="VENDEDOR";
                                            }
                                            $cadena=$cadena."
                                            <tr>
                                                <td>$vari0</td>
                                                <td>$vari1</td>
                                                <td>$vari2</td>
                                                <td>$vari4</td>
                                                <td>$rol</td>
                                                <td> ";
                                            if($vari0!=1){ 
                                                $cadena=$cadena."<button value='$vari0' id='eliusua$vari0' class='btn btn-danger btn-sm' Onclick='eliminarUsuario($vari0)'>
                                                        <o class='fa fa-times'></o>
                                                    </button>";
                                            } 
                                            $cadena=$cadena."</td>";
                                            $cadena=$cadena."<td>
                                                    <form action='editarusuario' method='post'><input class='d-none' name='indice' value='$vari0'><button name='editusua' type='submit' value='2' id='editusua$vari0' class='btn btn-warning btn-sm'>
                                                            <o class='fas fa-edit'></o>
                                                        </button></form>
                                                    </td>
                                                    </tr>";
                                    }
			            $cadena=$cadena."
			        </tbody>
			    </table>
			</div>";
			echo $cadena;
		break;
/////////////////////////////////////////////////////////////// CIERRE- ELIMINAR USUARIOS////////////////////////////////////////////////////  
        
/////////////////////////////////////////////////////////////// APERTURA- EDITAR USUARIOS////////////////////////////////////////////////////   
	case 20:
			$idusuu=$_POST['idusu'];
			$rol=$_POST['rolusu'];
			$nombre=$_POST['nomusu'];
			$usuario=$_POST['nickusu'];
			$contrasena=$_POST['conusu'];
			$passHash = password_hash($contrasena, PASSWORD_BCRYPT);
			$correo=$_POST['corusu'];
			$resultt=$conn->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
            $reg= $resultt->num_rows;
            if($reg>0){
                if(strlen($contrasena)>30){
			        $result = $conn->query("UPDATE usuarios SET nombre='$nombre', usuario='$usuario', correo='$correo', rol='$rol' WHERE id_usuario='$idusuu'");
                }else{
			        $result = $conn->query("UPDATE usuarios SET nombre='$nombre', usuario='$usuario', pass='$passHash', correo='$correo', rol='$rol' WHERE id_usuario='$idusuu'");
                }
            }
            echo "<script type=\"text/javascript\">alert(\"USUARIO EDITADO CORRECTAMENTE\"); </script>"; 
            $user=$_SESSION['usuario']; 
            $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
            $reg= $ressull->num_rows;
            if($usuario==$user){
                    echo "<script type=\"text/javascript\">alert(\"EDITASTE AL USUARIO ACTUAL, SE CERRARA LA SESION\"); </script>";
                    header("Refresh:1; url=index.php");
                    session_destroy();
			}else{
			         echo "<script type=\"text/javascript\"> window.location.href='./usuarios.php' ; </script>"; 
            }
		break;
        case 21:
            $result=$conn->query("DELETE FROM categoria WHERE id_cat='$elicat'");
       
		      $cadena="
                        <form id='agrcom' action='agregarcategoria.php' method='post' >
                        <button class='btn btn-success btn-sm' type='input'><o class='fa fa-plus'></o> AGREGAR</button>
                        </form><br><br>
                                <div class='table-responsive'>
                                <table class='table table-striped' >	
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>ELIMINAR</th>
                                            <th>EDITAR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ";
				$resulti = $conn->query("SELECT * FROM categoria");
                while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
				$cadena=$cadena."
								<tr>
									<td>".$vari['id_cat']."</td>
									<td>".$vari['nombre']."</td>
									<td><button id='elicat' Onclick='elimCat(".$vari['id_cat'].")' class='btn btn-danger btn-sm' ><o class='fa fa-times'></o></button></td>
									<td><button id='editcat' class='btn btn-warning btn-sm' ><o class='fas fa-edit'></o></button></td>
								</tr>";
                }
                $cadena=$cadena."
                            </tbody>
                        </table>
                        </div>";
                echo $cadena;
        break;
//////////////////////////////////////APERTURA CARRITO YA CON EL ROTATORIO///////////////////////// no se usa       
        case 22:
             $sistema=$_POST['sistema'];
             $plataforma=$_POST['plataforma'];
             $capacidad=$_POST['capacidad'];
             $unidad=$_POST['unidad'];
             $result=$conn->query("SELECT * FROM productos");
            $sistemaa="";
            $plataformaa="";
            $capacidada="";
            $unidada="";
             while($var = $result->fetch_array(MYSQLI_ASSOC)) {
                 if($var['id']==$sistema){
                    $sistemaa=$var['nombre']; 
                 }else if($var['id']==$plataforma){
                    $plataformaa=$var['nombre'];  
                 }else if($var['id']==$capacidad){
                    $capacidada=$var['nombre'];  
                 }else if($var['id']==$unidad){
                    $unidada=$var['nombre'];  
                 }
             }
        echo " <table>
                    <tbody>
                        <tr>
                            <td> ROTATORIO $sistemaa $plataformaa $capacidada $unidada</td>
                        </tr>
                    </tbody>
               </table        
               "; 
        break;
//////////////////////////////////////CIERRE CARRITO YA CON EL ROTATORIO/////////////////////////  
//////////////////////////////////////APERTURA CATEGORIAS OPCIONALES////////////////////////////       
    case 23:
            
        $tamanoSel=$_COOKIE['tamanos'];
        echo "<script type=\"text/javascript\">console.log(\"$tamanoSel\");</script>";
        setcookie("tamanos", $tamanoSel, time()+3600,'./');
            $result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre='$tamanoSel' and C.id_cat=6");
            $val=0;
            $cadenaa="";
            $cadena="
            <button type='button' id='regIni' Onclick='regresarCarritoInicial()' class='btn btn-warning' style='margin-bottom:10px;'>
                        <li class='fas fa-reply'></li>
                    </button>
            <button id='btnmosca' onclick='carga()' type='submit' name='submit' value='' class='btn btn-success btn-xl btn-block ' ><a class='letraaa' style='font-size:16px; margin-bottom: 16px;'>SELECCIONAR</a></button>
            <div class='row'>";//card-columns pt-3
                $i=0;
                while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
                    
                    $ver0=$ver['id']; 
                    $ver1=$ver['id_cat'];
                    $ver2=$ver['nombre'];
                    $ver3=$ver['descripcion'];
                    $ver4=$ver['udm'];
                    $ver5=$ver['precio'];
                    $ver6=$ver['padre'];
                    $ver7=$ver['hijo'];
                    $ver8=$ver['cantidad'];
                    $cadena=$cadena."<div class='panel-group col-12' style='margin-top:10px; '>";
                     $cadena=$cadena."
                    <div class='panel panel-default'>
                    <div class='btn btn-light btn-block' style='background-color: #00528b; color: white;'  href='#a$ver0"."a$ver6' data-toggle='collapse'><span class='letche' style='font-size:16px;'>$ver2</span>
                    <i class='fas fa-chevron-down' style='float:right; font-size:20px;'></i>
                    </div>
                    
                    <div id='a$ver0"."a$ver6' class='panel-collapse collapse'>
                    ";
                        $resultt = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$ver0'");
                        $j=0;
                        while($var = $resultt->fetch_array(MYSQLI_ASSOC)) {
                                $var0=$var['id']; 
                                $var1=$var['id_cat'];
                                $var2=$var['nombre'];
                                $var3=$var['descripcion'];
                                $var4=$var['udm'];
                                $var5=$var['precio'];
                                $var6=$var['padre'];
                                $var7=$var['hijo'];
                                $var8=$var['cantidad'];
                                $pad=$var0;
                                $resulttt = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$var0'");

                                //$resulttt = $conn->query("select pr.id,pr.id_cat,pr.nombre,pr.descripcion,pr.udm,pr.precio,pr.orden,rel.hijo,rel.padre,rel2.cantidad from productos as pr JOIN relacion_producto as rel ON rel.hijo= pr.id JOIN relacion_producto as rel2 ON rel2.padre=rel.hijo where rel.padre=$var0");
                                $reg= $resulttt->num_rows;
                                if($reg>0){
                                    $cadena=$cadena."
                                    <div class='panel-group pt-3'>
                                        <div class='panel panel-default'>
                                        <input style='float:left; margin:5px; position:absolute' type='checkbox' onclick='todoOpc($var0)' id='selectTodoOpc$var0'  value='0'>
                                            <a class='btn btn-light btn-block'  href='#c$ver0"."c$pad' data-toggle='collapse'>
                                                <h4>
                                                <b>
                                                    <span style='float:left; font-size:12px;margin-left:12px;'>$var2</span></b>
                                                    <i class='fas fa-chevron-down' style='float:right; '></i>
                                                </h4>
                                                &nbsp;
                                            </a>
                                            <div id='c$ver0"."c$pad' class='panel-collapse collapse'>
                                                <ul class='list-group'>";
                                                    while($vir = $resulttt->fetch_array(MYSQLI_ASSOC)) {
                                                            $vir0=$vir['id'];
                                                            $vir2=$vir['nombre'];
                                                            $var8=$vir['cantidad'];
                                                            $disabled="disabled";
                                                            $checked="";
                                                            $esta_registrado = $conn->query("SELECT * from cotizacion_detallada WHERE id_producto=$vir0 and id_usuario=$iduss and idsession='$idsession' limit 1;");
                                                            $esta_registrado_count =$esta_registrado->num_rows;
                                                            if($esta_registrado_count>0){
                                                                $disabled="";
                                                                $checked="checked";
                                                                while($repetido = $esta_registrado->fetch_array(MYSQLI_ASSOC)) {
                                                                    $var8=$repetido['cantidad'];
                                                                }
                                                            }

                                                            $cadena=$cadena."
                                                            <li class='list-group-item' style='margin-left:5px;'>
                                                            <div style='width:100%;'>
                                                                <div class='chalinoIzqu'style='float:left;'>
                                                                
                                                                    <input type='checkbox' $checked  onclick='actopca($var0)' id='compopc$var0' name='compopc$vir0' value='$vir0'><b><span class='letche' style='font-size:11px'> $vir2</span></b>
                                                                
                                                                </div>
                                                                <div class='chalinoDere' style='float:right;'>
                                                                
                                                                    <input $disabled style='max-width:50px; font-size:11px; text-align:center;'type='number' onchange='multiplicarTodo($var0,this)' onfocus='prevValue(this)' onkeypress='return event.charCode >= 48 && event.charCode <= 57' id='compopcc$var0' name='compopcc$vir0' min='1' value=$var8>
                                                                
                                                                </div>
                                                            </div>
                                                            </li>";
                                                            $opcionales_articulos_sap = $conn->query("SELECT p.nombre_producto_sap,rel.cantidad,rel.padre FROM productos_sap as p JOIN relacion_producto as rel ON rel.hijo=p.id_producto_madero and rel.padre='$vir0';");
                                                            $registros_sap= $opcionales_articulos_sap->num_rows;
                                                            if($registros_sap>0)
                                                            while($lista_arti_sap = $opcionales_articulos_sap->fetch_array(MYSQLI_ASSOC)) {
                                                                $nombre_opc_sap=$lista_arti_sap['nombre_producto_sap'];
                                                                $cantidad_opc_sap=$lista_arti_sap['cantidad']*$var8;
                                                                $cadena=$cadena."
                                                                
                                                                    <li class='list-group-item' style='margin-left:25px;'>
                                                                                <span class='letche' style='font-size:10px; float:left;'>$nombre_opc_sap </span>
                                                                            
                                                                                <input disabled style='max-width:50px; float:right; font-size:11px; text-align:right; background: transparent; -webkit-appearance: none; border: none;' type='number' value='$cantidad_opc_sap' id='opc_sap$var0'>
                                                                            
                                                                    </li>
                                                                ";
                                                            }
                                                    }
                                                    $cadena=$cadena."
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                    }else{
                                            $cadena=$cadena."
                                            <ul class='list-group'>
                                            <li class='list-group-item' style='margin-left:20px;'>
                                            <div style='width:100%;'>
                                                <div class='chalinoIzqu' style='float:left;'>
                                                    <input onclick='actopca($var0)' type='checkbox' id='compopc$var0' name='compopc$var0' value='$var0'><span class='letche'> $var2</span>
                                                </div>
                                                <div class='chalinoDere' style='float:right;'>
                                                    <input disabled style='max-width:40px; ' type='number' onkeypress='return event.charCode >= 48 && event.charCode <= 57' id='compopcc$var0' name='compopcc$var0' min='1' value='1'>
                                                </div>
                                            </div>
                                            </li>
                                            </ul>
                                            ";
                                    }
                                    $j++;
                            }
                            $cadena=$cadena. "</div>
                </div>
                ";
                $cadena=$cadena."</div>";
                $i++;
                }
                echo $cadena."</div>";
        break;
//////////////////////////////////////CLAUSURA CATEGORIAS OPCIONALES////////////////////////////      
        
//////////////////////////////////////APERTURA INSERCION OPCIONALES//////////////////////////// 
        case 24:
            $i=0;
            $catopc=array();
            $compcatop= array();
            $todosnom=array();
            $todosnoum=array();
            $result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre='0' and C.id_cat=6");
            while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
                $catopc[$i]=$ver['id'];
                $i++; 
            }
            $k=0;
            $l=0;
            for($j=0;$j<count($catopc);$j++){ 
                $id=$catopc[$j]; $resultt=$conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre='$id'");
                while($var = $resultt->fetch_array(MYSQLI_ASSOC)) {
                        $compcatop[$k]=$var['id'];
                        
                        $idart=$compcatop[$k];
                        $resultttt = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$idart'");
                        $reg= $resultttt->num_rows;
                        if($reg>0){
                                while($vor = $resultttt->fetch_array(MYSQLI_ASSOC)) {
                                    $todosnom[$l]=$vor['nombre'];
                                    $todosnoum[$l]=$vor['id'];
                                    $l++;
                                }
                        }else{
                            $todosnom[$l]=$var['nombre'];
                            $todosnoum[$l]=$var['id'];
                            $l++;
                        }
                $k++;
                }
            }
        
            $user=$_SESSION['usuario'];
            $idsession=$_SESSION['num'];
            $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
            while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                $iduss=$vat['id_usuario'];
            }
            $cleanSecure= $conn->query("DELETE cot FROM cotizacion_detallada cot INNER JOIN productos pro ON pro.id=cot.id_producto inner JOIN categoria  cat ON cat.id_cat=pro.id_cat WHERE cot.id_usuario=$iduss and cat.id_cat=8; ");
            for ($m=0;$m<count($todosnoum);$m++){
                    $check="compopc".$todosnoum[$m];
                    //echo "<script type=\"text/javascript\">console.log(\"$check\");</script>";
                    if(isset($_POST[$check])){
                            $canti="compopcc".$todosnoum[$m];
                            $cantidad=$_POST[$canti];   
                            $idinsert=$_POST[$check];
                            //echo "<script type=\"text/javascript\">console(\"$_POST[$check]\");</script>";
                            $resul=$conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.hijo='$idinsert' ");
                            $reg= $resul->num_rows;
                            $o=0;
                            while($x = $resul->fetch_array(MYSQLI_ASSOC)) {
                                    $nucot=$conn->query("SELECT * FROM rotatorio WHERE id_usuario=$iduss and idsession='$idsession' ");
                                    $nnuu=0;
                                    if($nn = $nucot->fetch_array(MYSQLI_ASSOC)) {
                                       $nnuu= $nn['numcotizacion'];
                                    }
                                    if($o==0){
                                            $x0=$x['id'];
                                            $x2=$x['nombre'];
                                            $x2=str_replace("'","",$x2); 
                                            $orden=$x['orden'];//DELETE FROM cotizacion_detallada WHERE id_component=$x0 and id_usuario=$iduss; 
                                            $cleanSecure2= $conn->query("DELETE FROM cotizacion_detallada WHERE id_component=$x0 and id_usuario=$iduss; ");
                                            $resull = $conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,cantidad,uc,precio,id_usuario,idsession,numcotizacion,ischeck,orden) values($x0,$x0,'$x2',$cantidad,1,'0',$iduss,'$idsession','$nnuu',1,$orden)");
                                            $o++;
                                            //echo "<script type=\"text/javascript\">alert(\"$o\");</script>";
                                    }
                            }
                            $contcompid=array();
                            $contcomprelaid=array();
                            $contcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE idsession='$idsession' and id_producto=$idinsert and id_component=$idinsert");
                            $regcocom= $contcomp->num_rows;
                            if($regcocom>0){
                                    $u=0;
                                    while($var = $contcomp->fetch_array(MYSQLI_ASSOC)) {
                                            $var1=$var['id_producto'];
                                            $contcompid[$u]=$var['id_producto'];
                                            $u++;
                                            $contcomprela=$conn->query("SELECT * FROM relacion_producto WHERE padre='$var1'");
                                            $v=0;
                                            while($ver = $contcomprela->fetch_array(MYSQLI_ASSOC)) {
                                                    $ver1=$ver['hijo'];
                                                    $contcomprelaid[$v]=$ver['hijo'];
                                                    $contcompsap=$conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$var1' and C.id_producto_madero='$ver1'");
                                                    while($vor = $contcompsap->fetch_array(MYSQLI_ASSOC)) {
                                                            $vor2=$vor['nombre_producto_sap'];
                                                            $vor3=$vor['precio_producto_sap'];
                                                            $vor4=$vor['id_producto_madero'];
                                                            $vor5=$vor['costos'];
                                                            $vor9=$vor['cantidad'];
                                                            $canop=$vor9*$cantidad;
                                                            $vor2=str_replace("'","",$vor2); 

                                                            $moneda=$vor['moneda_articulo'];
                                                            /*if($moneda=="MXN"){
                                                                $predlr=$conn->query("SELECT * FROM precio_dolar");
                                                                while($dlr = $predlr->fetch_array(MYSQLI_ASSOC)){
                                                                    $pre=$dlr['valor_usd'];
                                                                }
                                                                $vor3=$vor3/$pre;
                                                                $vor5=$vor5/$pre;
                                                            }*/
                                                            
                                                            $contcompsapinst=$conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,costos,id_usuario,idsession,cantidad,numcotizacion,ischeck) values($var1,$vor4,'$vor2','$vor3','$vor5',$iduss,'$idsession',$canop,'$nnuu',1)");
                                                    }
                                                    $v++;
                                            }
                                    }
                                    for($i=0;$i<count($contcompid);$i++){ 
                                        $sub=0; $s=0; $subtotal=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$contcompid[$i]'");
                                        while($mon = $subtotal->fetch_array(MYSQLI_ASSOC)) {
                                                $s=$mon['cantidad']*$mon['precio'];
                                                $sub=$sub+$s;
                                        }
                                        $total=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario=$iduss and idsession='$idsession'and id_producto='$contcompid[$i]'");
                                    }
                            }
                    }
            }
       print "<img style='display:block;position:absolute;left:42.5%;width:15%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/loadi.gif' />";
        
       header("Refresh:1; url=carrito.php");
        break;
//////////////////////////////////////CLAUSURA INSERCION OPCIONALES////////////////////////////         
        
//////////////////////////////////////APERTURA INSERCION COMPONENTES////////////////////////////         
        case 26:
        $id_cat= $_POST['comcat'];
        //$idcomp=$_POST['comid'];
        $nomcomp=$_POST['comnom'];
        $descomp=$_POST['comdes'];

        // $numcot=$conn->query("SELECT * FROM prodcuctos ORDER BY id ASC");
        // $reghis= $numcot->num_rows;
        // if($reghis==0){
        //     $numecotizacion=1;
        // }else{
        //     $i=1;
        //     while($numcott=$numcot->fetch_array(MYSQLI_ASSOC)){
        //         if($numcott['numcotizacion']==$i){
        //             $numecotizacion=$numcott['numcotizacion']+1;
        //         }else{
        //             $numecotizacion=$i;
        //             break;
        //         }
        //         $i++;
        //     }
        // }
        if($id_cat==1){
            $numero=10001;
        }else if($id_cat==2){
            $numero=20001;
        }else if($id_cat==3){
            $numero=30001;
        }else if($id_cat==4){
            $numero=40001;
        }else if($id_cat==5){
            $numero=50001;
        }else if($id_cat==6){
            $numero=60001;
        }else if($id_cat==7){
            $numero=70001;
        }else if($id_cat==8){
            $numero=80001;
        }

        $numm=$numero-1;
        $numn=$numero+9999;
        $numeroid=$conn->query("SELECT * FROM productos WHERE id>$numm and id<$numn ORDER BY id ASC");
        $reghis= $numeroid->num_rows;
       // $numero=5001;
        $ids= array();
        
        while($numerid=$numeroid->fetch_array(MYSQLI_ASSOC)){
           
            if($numero==$numerid['id']){
                $numero=$numero+1;
            }
        }
        


        $result=$conn->query("INSERT INTO productos(id,id_cat, nombre, descripcion) values('$numero','$id_cat', '$nomcomp', '$descomp')");
        if($id_cat==1 or $id_cat==6){
            $resul=$conn->query("INSERT INTO relacion_producto(padre, hijo) values(0,'$numero')");
        }
        $cadea="
        <input type='text' id='idcom' name='idcoma'  placeholder='ID MADERO' class='input-48 letr inputt' style='text-transform:uppercase;' onkeyup='comprobarId()' onKeypress='if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;' value='$numero' disabled required  >
        <input type='text' id='nomcoma' name='nomcom'  placeholder='NOMBRE' class='input-48 letr inputt' style='text-transform:uppercase;' onkeyup='javascript:this.value=this.value.toUpperCase();' value='$nomcomp' disabled required>
        <input id='opccion' type='text' value='16' style='display:none' >
        <br><input type='text' name='txtpieza' id='txtpieza' class='input-100' placeholder='TECLA EN NOMBRE DEL COMPONENTE' value'' onkeyup=\"busqueda();\"><br>";
		echo $cadea;	
        break;
//////////////////////////////////////CIERRE INSERCION COMPONENTES////////////////////////////    
        
 ///////////////// APERTURA-BUSCADOR DE PARTES, COMPONENTES, UNIDADES, TAMAÑOS, PLATAFORMAS/////////////////////////////           
        case 33:
            $tmp="";
            $cadena="";
            $id_categoria="";
            $id_categoria=$_POST['idcat'];
            $id_categoriaSec="";
            if($id_categoria==6 or $id_categoria==7){
                $idcatcat=8;
                $id_categoriaSec=$idcatcat;
            }else{
                if($id_categoria==2){
                    $idcatcat=$id_categoria+2;
                    $id_categoriaSec=6;
                }else{
                    $idcatcat=$id_categoria+1;
                    $id_categoriaSec=$idcatcat;
                }
            }
            
        $ressss=$conn->query("SELECT * FROM categoria WHERE id_cat='$id_categoria'");
            $nomcategoria="";
            while($varo = $ressss->fetch_array(MYSQLI_ASSOC)) {

                    $nomcategoria=$varo['nombre'];
        
            }
        
        
        
        
        
         if($nomcategoria=="COMPONENTE" || $nomcategoria=="COMPONENTE OPCIONAL"){  
            if($_POST["texto"]!=""){
                
               
             $result=$conn->query("SELECT nombre_producto_sap, id_producto_madero FROM productos_sap WHERE (nombre_producto_sap LIKE '%".$_POST["texto"]."%' OR id_producto_madero LIKE '%".$_POST["texto"]."%')  ORDER BY nombre_producto_sap");
                
                
                
                
                $reg= $result->num_rows;
               // echo "<script type=\"text/javascript\">alert(\"ayuda\");</script>"; 
                    
                if($reg>0){

                $tmp=" <table class='table table-striped' id='componentes' style='overflow: auto; max-height:200px'>
                    <tr>
                        <td style='width:70%'>NOMBRE</td>
                        <td  style='width:15%'></td>
                        <td   style='width:15%'></td>

                    </tr>
                    ";

                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            $id_madero=""; 
                            $id_hijo=$row["id_producto_madero"];
                            $id_madero=$_POST['idmadero'];
                            $resul=$conn->query("SELECt * FROM relacion_producto WHERE padre='$id_madero' and hijo='$id_hijo'");
                            $regg= $resul->num_rows;

                            if($regg>0){
                            }else{
                            $tmp.="<tr>
                                <td class='letra'  style='width:70%'>".$row["id_producto_madero"]." ".$row["nombre_producto_sap"]."</td>
                                <td  style='width:15%'>";
                                    $tmp.="<input class='letra inputt' type='text' maxlength='6'  id='numcom$id_hijo' style='max-width:70px; max-height: 30px; text-align:center' value='1' ></td>
                                    <td  style='width:15%'>
                                    
                                    <button id='bbttnn$id_hijo' style='max-width:100px; max-height: 30px; text-align:left 'type='button' class='btn-enviara letra' Onclick='agregarnuevocomponete(`$id_hijo`);' value='$id_hijo' name='btnagrnvo'><a style='float:left;' class='letra'>AGREGAR</a></button>
                                    
                                    </td>";
                                    }
                        }
                        $tmp.="
                    </tr>
                </table>";
                }
                }}else{
                if($_POST["texto"]!=""){
                    
                    
                 if($id_categoria==6){
                     $result=$conn->query("SELECT * FROM productos WHERE (descripcion LIKE '%".$_POST["texto"]."%' OR id LIKE '%".$_POST["texto"]."%') AND (id_cat=7) ORDER BY nombre");
                    $reg= $result->num_rows; 
                 }else{
                     $result=$conn->query("SELECT * FROM productos WHERE (descripcion LIKE '%".$_POST["texto"]."%' OR id LIKE '%".$_POST["texto"]."%') AND (id_cat='$idcatcat' or id_cat=$id_categoriaSec) ORDER BY nombre");
                    $reg= $result->num_rows;
                 }   
                
                
                
                if($reg>0){

                $tmp="<br><br> <table class='table table-striped' id='componentes'>
                    <tr>
                        <td >NOMBRES</td>
                        <td></td>
                        <td></td>

                    </tr>
                    ";

                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            $id_madero=""; 
                            $id_hijo=$row["id"];
                            $id_madero=$_POST['idmadero'];
                            $resul=$conn->query("SELECt * FROM relacion_producto WHERE padre='$id_madero' and hijo='$id_hijo'");
                            $regg= $resul->num_rows;

                            if($regg>0){
                            }else{
                            $tmp.="<tr>
                                <td style='width:70%'  class='letra'>".$row["id"]." ".$row["descripcion"]."</td>
                                <td>";
                                    $tmp.="<input style='display:none'  class='letra inputt' type='text' id='numcom' style='max-width:70px; max-height: 30px; text-align:center' value='1' ></td>
                                    <td><button id='bbttnn$id_hijo' type='button' class='btn-enviara letra' Onclick='agregarnuevocomponete(`$id_hijo`);' value='$id_hijo' name='btnagrnvo' style='max-width:100px; max-heith:30px; text-align:left'><a class='letra' style=' text-align:left''>AGREGAR</a></button></td>";
                                    }

                        }
                        $tmp.="
                    </tr>
                </table>";
                }
                }
                }
             
         if($nomcategoria=="COMPONENTE" || $nomcategoria=="COMPONENTE OPCIONAL"){
              $id_madero=$_POST['idmadero'];
        $result=$conn->query("SELECT * FROM productos_sap S, relacion_producto R WHERE S.id_producto_madero=R.hijo and R.padre='$id_madero' ORDER BY nombre_producto_sap");
        $reg= $result->num_rows;
                
                if($reg>0){

                $cadena=" <table class='table table-striped' id='componentess'>
                    <tr>
                        
                        <td style='width:70%'  class='letra verdesitoo'>NOMBRE</td>
                        <td style='width:30%' class='letra verdesitoo'></td>

                    </tr>
                    ";
                    $i=1;
                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $cadena.="<tr>
                        <td  class='letra verdesito' style='width:75%'>$i<img style='width:18px' src='img/x.png' Onclick='quitarcomp(`".$row["id_producto_madero"]."`)'> &nbsp".$row["id_producto_madero"]." ".$row["nombre_producto_sap"]."</td>
                        <td class='letra verdesito' style='width:25% float:right;'>";
                            $cadena.="
                            <img  class='letra' style='width:20px' src='img/minus.png' Onclick='quitarcantidad(`".$row["id_producto_madero"]."`)'>
                            <input  class='letra inputt' type='text' disabled style='max-width:70px; max-height: 15px; text-align:center' value='".$row["cantidad"]."' >
                            <img  class='letra' style='width:20px' src='img/plus.png' Onclick='sumarcantidad(`".$row["id_producto_madero"]."`)'>
                        </td>";
                        $i++;
                        }
                        $tmp.="
                    </tr>
                </table>

                ";
                }
         }else{
             $id_madero=$_POST['idmadero'];
        $result=$conn->query("SELECT * FROM productos S, relacion_producto R WHERE S.id=R.hijo and R.padre='$id_madero' ORDER BY nombre");
        $reg= $result->num_rows;
                if($reg>0){
                $cadena=" 
                <table class='table table-striped' id='componentess'>
                    <tr>
                    
                        <td style='width:75%' class='letra verdesitoo'>NOMBRE</td>
                        <td class='letra verdesitoo'></td>

                    </tr>
                    ";
                    $i=1;
                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $cadena.="<tr>
                        <td class='verdesito letra' style='width:75%'>$i <img style='width:18px' src='img/x.png' Onclick='quitarcomp(`".$row["id"]."`)'> &nbsp".$row["id"]." ".$row["descripcion"]."</td>
                        <td  class='verdesito letra' style='width:25%'>";
                        $cadena.="
                        <img style='display:none' class='letra' style='width:20px' src='img/minus.png' Onclick='quitarcantidad(`".$row["id"]."`)'>
                        <input style='display:none'  class='letra inputt' type='text' disabled style='max-width:70px; max-height: 15px; text-align:center' value='".$row["cantidad"]."' >
                        <img style='display:none'  class='letra' style='width:20px' src='img/plus.png' Onclick='sumarcantidad(`".$row["id"]."`)'>
                    </td>";
                        $i++;
                        }
                        $cadena.="
                    </tr>
                </table>
                ";
                }
         }
       
        echo $cadena;
        echo $tmp;
        
        break;
  ///////////////// CIERRE-BUSCADOR DE PARTES, COMPONENTES, UNIDADES, TAMAÑOS, PLATAFORMAS/////////////////////////////     

        
//////////////////////////////// APERTURA-NUEVA PARTE A UN COMPONENTE/////////////////////////////        
        case 34:
        $padre=$_POST['idcom'];
        $hijo=$_POST['idnvo'];
        $cant=$_POST['numcomp'];
        
        if($cant==""){
            $cant=1;
        }
        
        $result=$conn->query("INSERT INTO relacion_producto(padre,hijo,cantidad) VALUES('$padre','$hijo','$cant')");
        echo "ok";
        
        break;
//////////////////////////////// CIERRE-NUEVA PARTE A UN COMPONENTE/////////////////////////////         

//////////////////////////////// APERTURA-SUMAR PARTE A UN COMPONENTE///////////////////////////// 
        case 35:
        $idsuma=$_POST['idsuma'];
        $idpadre=$_POST['idpadre'];
        $result= $conn->query("SELECT * FROM relacion_producto WHERE padre='$idpadre' and hijo='$idsuma'");
        $catidad=0;
        while($x = $result->fetch_array(MYSQLI_ASSOC)) {
            $cantidad=$x['cantidad'] + 1;
        }     
        
        $resultt=$conn->query("UPDATE relacion_producto SET cantidad='$cantidad' WHERE padre='$idpadre' and hijo='$idsuma' ");
        break;
//////////////////////////////// CIERRE-SUMAR PARTE A UN COMPONENTE/////////////////////////////         
        
//////////////////////////////// APERTURA-RESTAR PARTE A UN COMPONENTE///////////////////////////// 
        case 36:
        $idsuma=$_POST['idresta'];
        $idpadre=$_POST['idpadre'];
        $result= $conn->query("SELECT * FROM relacion_producto WHERE padre='$idpadre' and hijo='$idsuma'");
        $catidad=0;
        while($x = $result->fetch_array(MYSQLI_ASSOC)) {
            $cantidad=$x['cantidad'] - 1;
        }   
        if($cantidad<1){
            $resultt=$conn->query("DELETE FROM relacion_producto WHERE padre='$idpadre' and hijo='$idsuma' ");
        }else{
            $resultt=$conn->query("UPDATE relacion_producto SET cantidad='$cantidad' WHERE padre='$idpadre' and hijo='$idsuma' ");
        }
        
        
        break;
//////////////////////////////// CIERRE-RESTAR PARTE A UN COMPONENTE///////////////////////////// 
 
   ////////////////////////////////APERTURA ELIMINAR COMPONENTE/////////////////////////////////////////////////////////////
        case 37:
            $comelim=$_POST['elicomponente'];
            $result=$conn->query("DELETE FROM productos WHERE id='$comelim'");
            $resul=$conn->query("DELETE FROM relacion_producto WHERE padre='$comelim'");
            $resu=$conn->query("DELETE FROM relacion_producto WHERE hijo='$comelim'");
        break;
   ////////////////////////////////CIERRE ELIMINAR COMPONENTE/////////////////////////////////////////////////////////////
        /////////////////////////APERTURA ELIMINAR COMPONENTE ASIGNACION/////////////////////////////////////////////////////////////
        case 38:
            $idsuma=$_POST['idquitar'];
            $idpadre=$_POST['idpadre'];
            $resultt=$conn->query("DELETE FROM relacion_producto WHERE padre='$idpadre' and hijo='$idsuma' ");
            
        break;
    /////////////////////////CIERRE ELIMINAR COMPONENTE ASIGNACION/////////////////////////////////////////////////////////////
 /////////////////////////APERTURA ACTUALIZAR COMPONENTE /////////////////////////////////////////////////////////////
        case 39:
            $id=$_POST['idcompp'];
            $nombre=$_POST['nomcomp'];
            $descripcion=$_POST['descomp'];
            $result=$conn->query("UPDATE productos SET nombre='$nombre', descripcion='$descripcion' WHERE id='$id'");
        //if(isset($_POST['image'])){
            $res=$conn->query("SELECT * FROM imagenes WHERE id_comp='$id'");
             $reg= $res->num_rows;
            if($reg>0){
                
                    
                    $nombre_archivo = "img";
                    $nombre_archivo.=$id.".jpg";
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$nombre_archivo)) {
                        //more code here...
                       
                        //echo "img/".$nombre_archivo;
                    } else {
                       // echo 0;
                    }
                
            }else{
                
                        
                        $nombre_archivo = "img";
                        $nombre_archivo.=$id.".jpg";
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$nombre_archivo)) {
                            //more code here...
                            $dir="img/".$nombre_archivo;
                            $img= $conn->query("INSERT INTO imagenes(id_comp,dir_img) VALUES('$id','$dir')");
                            echo "img/".$nombre_archivo;
                        } else {
                           // echo 0;
                        }
                   
            }
           
      //  }
        
        
        
       print "<img style='display:block;position:absolute;left:42.5%;width:15%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/loadi.gif' />";
      header("Refresh:1; url=componentes.php");
        break;
    /////////////////////////CIERRE ACTUALIZAR COMPONENTE /////////////////////////////////////////////////////////////
/////////////////////////APERTURA MOSTRAR CARRITO FINAL/////////////////////////////////////////////////////////////
        case 40:
        $abrircolapse=$_POST['colapse'];
        $cadena="";
         $user=$_SESSION['usuario'];
         $idsession=$_SESSION['num'];
         $ressull=$conn->query("SELECT id_usuario FROM usuarios WHERE usuario='$user'");        
        while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
             $iduss=$vat['id_usuario'];
         }
        $cot=array();
        $cott=array();
        $i=0;
        $carritofinal=0;
        $result=$conn->query("SELECT id_component FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and ischeck=1 ORDER BY id_component");
        while($var = $result->fetch_array(MYSQLI_ASSOC)) {
                 $cot[$i]=$var['id_component'];
                 
                $i++;
        }
        $carritofinal=$cot[0];
        //var_dump($cot);
        
        for($j=0;$j<count($cot);$j++){
            $resul=$conn->query("SELECT id FROM productos WHERE id='$cot[$j]' and (id_cat='5' or id_cat='8')");
             while($ver = $resul->fetch_array(MYSQLI_ASSOC)) {
                $cott[$j]=$ver['id'];
            } 
        }
        $aa=array();
        //$resultado = array_unique($cott);
        $resultado =  array_values(array_unique($cott));
        //var_dump($cott);
        //var_dump($resultado);
        
         $n=0;
        for($m=0;$m<count($resultado);$m++){
            
             $resultt=$conn->query("SELECT id_producto FROM cotizacion_detallada WHERE id_producto='$resultado[$m]' and id_usuario='$iduss' and idsession='$idsession' ORDER BY descripcion"); //añadir al procedimiento el ORDER by no jalaaaaaa jajajaaj
           while($vor = $resultt->fetch_array(MYSQLI_ASSOC)) {
                $aa[$n]=$vor['id_producto'];
                $n++;
            }
        }
       //var_dump($aa);
        
        $user=$_SESSION['usuario'];
        $idsession=$_SESSION['num'];
					$ressull=$conn->query("SELECT id_usuario FROM usuarios WHERE usuario='$user'");
                     while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
						$iduss=$vat['id_usuario'];
						
					}
        
        
        
		$cadena="
        
    <button type='button' Onclick='regcot($carritofinal)' class='btn btn-warning' style='margin-bottom:10px;'>
                        <li class='fas fa-reply'></li>
                    </button>
                            <div class='row'>
                            <div class='col-12 pt-2'>
                                <div class='letra'><b>DESCRIPCION
                                
                                
                                <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
                                </b></div>
                            </div>
                            
                           </div>
                ";
        
                $busca_plataforma =  $conn->query("SELECT precio,id_producto,descripcion,ischeck FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritofinal' and descripcion LIKE '%PLATAFORMA%'");
                $existe= $busca_plataforma->num_rows;
            if($existe>0)
                $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>PLATAFORMA</div></b>";
                while($ver = $busca_plataforma->fetch_array(MYSQLI_ASSOC)) {
                    $prec=1*$ver['precio'];
                    $decimales_plat = number_format($prec,2);
                    $id_plat=$ver['id_producto'];
                    $desc_plat=$ver['descripcion'];
                    $checado=$ver['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    $classcolapse="";
                    $classcolapseshow="";
                    if($abrircolapse==$id_plat)
                    {
                        $classcolapse="aria-expanded='true'";
                        $classcolapseshow="show in";
                    
                    }
                    $cadena=$cadena."
                    <div class='row'>
                        <div class='col-12'>
                            <div class='letra'>
                                <div class='panel-group'>
                                    <div class='panel panel-default'>
                                        <div style='width:100%;'>
                                            <a class='btn-coti' href='#c$id_plat' data-toggle='collapse'  $classcolapse>
                                                <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                                <div class='chalinoDer'>
                                                    <span style='float:right;' class='letchicacoll'>
                                                    
                                                        
                                                    </span>
                                                    
                                                    <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                                    
                                                </div>
                                            </a>
                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarritoFinal(`$id_plat`,1,$id_plat);'>
                                        </div>
                                        <div id='c$id_plat' class='panel-collapse collapse  $classcolapseshow'  $classcolapse>
                                            <ul class='list-group'>";
                                                $partcomp=$conn->query("SELECT cantidad,precio,id_producto,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                                $numcomp= $partcomp->num_rows;
                                                $num=1;       
                                                  
                                                $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp='$id_plat'");
                                                $regg= $imagen->num_rows;
                                                $dirrr="";
                                                while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                    $dirrr=$imgggg['dir_img'];
                                                } 
                                                $cadena=$cadena." 
                                                <div class='contenedor-input'>
                                                    <span class='input-29'>";
                                                    if($num==1){
                                                        $cadena=$cadena."
                                                         <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                    }
                                                    $cadena=$cadena."   
                                                    </span>
                                                    <span class='input-69'>";
                                                while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                                $p=0;
                                                $p=$vi['cantidad']*$vi['precio'];
                                                $deci = number_format($p,2);
                                                $id_sub=$vi['id_producto'];
                                                $vi1=$vi['id_producto'];
                                                $vi2=$vi['descripcion'];
                                                $checadosub=$vi['ischeck'];
                                                $cantidadsub=$vi['cantidad'];
                                                $checkbool="";
                                                if($checadosub=="1")
                                                {
                                                    $checkbool="checked";
                                                }
                                                 $cadena=$cadena." 
                                                        <li class='list-group-item' style='margin-left:20px;'>
                                                            <div style='width:100%;'>
                                                                <div class='chalinoIzq'>
                                                                <b>
                                                                <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProductoFinal(`$id_sub`,this.value,$id_plat)'>
                                                                </b><span > $vi2 </span> 
                                                                    
                                                                </div>
                                                                <div class='chalinoDer' style='vertical-align:middle;'>
                                                                    
                                                                <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarritoFinal(`$id_sub`,2,$id_plat);'>
                                                            </div>
                                                        </li>
                                                    
                                                
                                                ";
                                                $num++;
                                                }
                                                $cadena=$cadena."</span></div> </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            }

            $busca_ordeno=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritofinal' and (descripcion LIKE '%ORDEÑO%' or descripcion LIKE '%GLANDULA%' or descripcion LIKE '%BOMBAS DE LECHE%' or descripcion LIKE '%GRUPOS DE RECIBO%' or descripcion LIKE '%GRUPO DE RECIBO%' or descripcion LIKE '%LINEAS DE LECHE%' or descripcion LIKE '%SISTEMA DE PULSACION%' or descripcion LIKE '%TUBERIA DE PVC PULSACION%' or descripcion LIKE '%SOPORTERIA%' or descripcion LIKE '%FILTROS DE LECHE%' or descripcion LIKE '%SISTEMA DE VACIO%' or descripcion LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' or descripcion LIKE '%SISTEMA DE LAVADO%' or descripcion LIKE '%ARREADOR%' or descripcion LIKE '%ARRASTRE DE LECHE%' or descripcion LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' or descripcion LIKE '%FILTROS A TANQUE%' or descripcion LIKE '%SUCCION DE LAVADO%' OR descripcion LIKE '%CONTROL DE VACIO%' OR descripcion LIKE '%TRAMPA SANITARIA%' OR descripcion  LIKE '%LINEA DE LECHE%' OR descripcion LIKE '%CONTROLADOR DE VACIO%') ORDER BY orden");
            $existe= $busca_ordeno->num_rows;
            if($existe>0)
            $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>EQUIPOS DE ORDEÑO</div></b>";
            while($ver = $busca_ordeno->fetch_array(MYSQLI_ASSOC)) {
                $prec=1*$ver['precio'];
                $decimales_plat = number_format($prec,2);
                $id_plat=$ver['id_producto'];
                $desc_plat=$ver['descripcion'];
                $checado=$ver['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    $classcolapse="";
                    $classcolapseshow="";
                    if($abrircolapse==$id_plat)
                    {
                        $classcolapse="aria-expanded='true'";
                        $classcolapseshow="show in";
                    
                    }
                $cadena=$cadena."
                <div class='row'>
                    <div class='col-12'>
                        <div class='letra'>
                            <div class='panel-group'>
                                <div class='panel panel-default'>
                                    <div style='width:100%;'>
                                        <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' $classcolapse>
                                            <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                            <div class='chalinoDer'>
                                                <span style='float:right;' class='letchicacoll'>
                                                    <input name='elim' value='$id_plat' style='display:none;'>
                                                    <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                        <i class='fa fa-times'></i>
                                                    </button-->
                                                </span>
                                                <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                            </div>
                                        </a>
                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarritoFinal(`$id_plat`,1,$id_plat);'>
                                    </div>
                                    <div id='c$id_plat' class='panel-collapse collapse $classcolapseshow' $classcolapse>
                                        <ul class='list-group'>";
                                            $partcomp=$conn->query("SELECT cantidad,precio,id_producto,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                            $numcomp= $partcomp->num_rows;
                                            $num=1;       
                                              
                                            $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp='$id_plat'");
                                            $regg= $imagen->num_rows;
                                            $dirrr="";
                                            while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                $dirrr=$imgggg['dir_img'];
                                            } 
                                            $cadena=$cadena." 
                                            <div class='contenedor-input'>
                                                <span class='input-29'>";
                                                if($num==1){
                                                    $cadena=$cadena."
                                                     <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                }
                                                $cadena=$cadena."   
                                                </span>
                                                <span class='input-69'>";
                                            while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                            $p=0;
                                            $p=$vi['cantidad']*$vi['precio'];
                                            $deci = number_format($p,2);
                                            $vi1=$vi['id_producto'];
                                            $vi2=$vi['descripcion'];
                                            $id_sub=$vi['id_producto'];
                                            $checadosub=$vi['ischeck'];
                                            $cantidadsub=$vi['cantidad'];
                                            $checkbool="";
                                            if($checadosub=="1")
                                            {
                                                $checkbool="checked";
                                            }
                                             $cadena=$cadena." 
                                                    <li class='list-group-item' style='margin-left:20px;'>
                                                        <div style='width:100%;'>
                                                            <div class='chalinoIzq'>
                                                            <b>
                                                            <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProductoFinal(`$id_sub`,this.value,$id_plat)'>
                                                            </b> <span > $vi2 </span> 
                                                                
                                                            </div>
                                                            <div class='chalinoDer' style='vertical-align:middle;'>
                                                                <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                                <o class='fa fa-times'></o>
                                                            </button-->
                                                            <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarritoFinal(`$id_sub`,2,$id_plat);'>
                                                        </div>
                                                    </li>
                                                
                                            
                                            ";
                                            $num++;
                                            }
                                            $cadena=$cadena."</span></div> </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        }
        $busca_complementarios=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritofinal' and descripcion NOT LIKE '%ORDEÑO%' and descripcion NOT LIKE '%PLATAFORMA%' and descripcion NOT LIKE '%GLANDULA%' AND descripcion NOT LIKE '%BOMBAS DE LECHE%' AND descripcion NOT LIKE '%GRUPOS DE RECIBO%' AND descripcion NOT LIKE '%GRUPO DE RECIBO%' AND descripcion NOT LIKE '%LINEAS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE PULSACION%' AND descripcion NOT LIKE '%TUBERIA DE PVC PULSACION%' AND descripcion NOT LIKE '%SOPORTERIA%' AND descripcion NOT LIKE '%FILTROS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE VACIO%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' AND descripcion NOT LIKE '%SISTEMA DE LAVADO%' AND descripcion NOT LIKE '%ARREADOR%' AND descripcion NOT LIKE '%ARRASTRE DE LECHE%' AND descripcion NOT LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' AND descripcion not LIKE '%FILTROS A TANQUE%' AND descripcion not LIKE '%SUCCION DE LAVADO%' AND descripcion not LIKE '%CONTROL DE VACIO%' AND descripcion not LIKE '%TRAMPA SANITARIA%' AND descripcion not LIKE '%LINEA DE LECHE%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO%' ORDER BY orden;");
        $existe= $busca_complementarios->num_rows;
            if($existe>0)
        $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>COMPLEMENTARIOS</div></b>";
        while($ver = $busca_complementarios->fetch_array(MYSQLI_ASSOC)) {
            $prec=1*$ver['precio'];
            $decimales_plat = number_format($prec,2);
            $id_plat=$ver['id_producto'];
            $desc_plat=$ver['descripcion'];
            $checado=$ver['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    $classcolapse="";
                    $classcolapseshow="";
                    if($abrircolapse==$id_plat)
                    {
                        $classcolapse="aria-expanded='true'";
                        $classcolapseshow="show in";
                    
                    }
            $cadena=$cadena."
            <div class='row'>
                <div class='col-12'>
                
                    <div class='letra'>
                        <div class='panel-group'>
                            <div class='panel panel-default'>
                                <div style='width:100%;'>
                                    <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' $classcolapse>
                                        <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                        <div class='chalinoDer'>
                                            <span style='float:right;' class='letchicacoll'>
                                                <input name='elim' value='$id_plat' style='display:none;'>
                                                <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                    <i class='fa fa-times'></i>
                                                </button-->
                                            </span>
                                            <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                        </div>
                                    </a>
                                    <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarritoFinal(`$id_plat`,1,$id_plat);'>
                                </div>
                                <div id='c$id_plat' class='panel-collapse collapse $classcolapseshow' $classcolapse>
                                    <ul class='list-group'>";
                                        $partcomp=$conn->query("SELECT cantidad,precio,id_producto,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                        $numcomp= $partcomp->num_rows;
                                        $num=1;       
                                          
                                        $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp='$id_plat'");
                                        $regg= $imagen->num_rows;
                                        $dirrr="";
                                        while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                            $dirrr=$imgggg['dir_img'];
                                        } 
                                        $cadena=$cadena." 
                                        <div class='contenedor-input'>
                                            <span class='input-29'>";
                                            if($num==1){
                                                $cadena=$cadena."
                                                 <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                            }
                                            $cadena=$cadena."   
                                            </span>
                                            <span class='input-69'>";
                                        while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                        $p=0;
                                        $p=$vi['cantidad']*$vi['precio'];
                                        $deci = number_format($p,2);
                                        $vi1=$vi['id_producto'];
                                        $vi2=$vi['descripcion'];
                                        $id_sub=$vi['id_producto'];
                                        $checadosub=$vi['ischeck'];
                                        $cantidadsub=$vi['cantidad'];
                                        $checkbool="";
                                        if($checadosub=="1")
                                        {
                                            $checkbool="checked";
                                        }
                                         $cadena=$cadena." 
                                                <li class='list-group-item' style='margin-left:20px;'>
                                                    <div style='width:100%;'>
                                                        <div class='chalinoIzq'>
                                                        <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center;border:none' onChange='cambiarCantidadProductoFinal(`$id_sub`,this.value,$id_plat)'>
                                                            <span > $vi2 </span> 
                                                            
                                                        </div>
                                                        <div class='chalinoDer' style='vertical-align:middle;'>
                                                            <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                            <o class='fa fa-times'></o>
                                                        </button-->
                                                        <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                        </div>
                                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarritoFinal(`$id_sub`,2,$id_plat);'>
                                                    </div>
                                                </li>
                                            
                                        
                                        ";
                                        $num++;
                                        }
                                        $cadena=$cadena."</span></div> </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
    }
    $busca_opcionales=  $conn->query("SELECT cot.id_component,cot.id_producto,cot.descripcion,cot.cantidad,cot.uc,cot.precio,cot.costos,cot.id_usuario,cot.idsession,cot.numcotizacion,cot.moneda,cot.ischeck FROM cotizacion_detallada as cot 
    join productos as pro ON pro.id=cot.id_producto
    join categoria as cat on cat.id_cat=pro.id_cat
    WHERE cot.id_usuario='$iduss' and cot.idsession='$idsession' and pro.id_cat=8 ; ");
        $existe= $busca_opcionales->num_rows;
        if($existe>0)
        $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>OPCIONALES</div></b>";
        while($ver = $busca_opcionales->fetch_array(MYSQLI_ASSOC)) {
            $prec=1*$ver['precio'];
            $decimales_plat = number_format($prec,2);
            $id_plat=$ver['id_producto'];
            $desc_plat=$ver['descripcion'];
            $checado=$ver['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    $classcolapse="";
                    $classcolapseshow="";
                    if($abrircolapse==$id_plat)
                    {
                        $classcolapse="aria-expanded='true'";
                        $classcolapseshow="show in";
                    
                    }
            $cadena=$cadena."
            <div class='row'>
                <div class='col-12'>
                
                    <div class='letra'>
                        <div class='panel-group'>
                            <div class='panel panel-default'>
                                <div style='width:100%;'>
                                    <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' $classcolapse>
                                        <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                        <div class='chalinoDer'>
                                            <span style='float:right;' class='letchicacoll'>
                                                <input name='elim' value='$id_plat' style='display:none;'>
                                                <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                    <i class='fa fa-times'></i>
                                                </button-->
                                            </span>
                                            <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                        </div>
                                    </a>
                                    <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarritoFinal(`$id_plat`,1,$id_plat);'>
                                </div>
                                <div id='c$id_plat' class='panel-collapse collapse $classcolapseshow' $classcolapse>
                                    <ul class='list-group'>";
                                        $partcomp=$conn->query("SELECT cantidad,precio,id_producto,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                        $numcomp= $partcomp->num_rows;
                                        $num=1;       
                                          
                                        $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp='$id_plat'");
                                        $regg= $imagen->num_rows;
                                        $dirrr="";
                                        while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                            $dirrr=$imgggg['dir_img'];
                                        } 
                                        $cadena=$cadena." 
                                        <div class='contenedor-input'>
                                            <span class='input-29'>";
                                            if($num==1){
                                                $cadena=$cadena."
                                                 <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                            }
                                            $cadena=$cadena."   
                                            </span>
                                            <span class='input-69'>";
                                        while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                        $p=0;
                                        $p=$vi['cantidad']*$vi['precio'];
                                        $deci = number_format($p,2);
                                        $vi1=$vi['id_producto'];
                                        $vi2=$vi['descripcion'];
                                        $id_sub=$vi['id_producto'];
                                        $checadosub=$vi['ischeck'];
                                        $cantidadsub=$vi['cantidad'];
                                        $checkbool="";
                                        if($checadosub=="1")
                                        {
                                            $checkbool="checked";
                                        }
                                         $cadena=$cadena." 
                                                <li class='list-group-item' style='margin-left:20px;'>
                                                    <div style='width:100%;'>
                                                        <div class='chalinoIzq'>
                                                        <b>
                                                        <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProductoFinal(`$id_sub`,this.value,$id_plat)'>
                                                        </b>  <span > $vi2 </span> 
                                                            
                                                        </div>
                                                        <div class='chalinoDer' style='vertical-align:middle;'>
                                                            <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                            <o class='fa fa-times'></o>
                                                        </button-->
                                                        <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                        </div>
                                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarritoFinal(`$id_sub`,2,$id_plat);'>
                                                    </div>
                                                </li>
                                            
                                        
                                        ";
                                        $num++;
                                        }
                                        $cadena=$cadena."</span></div> </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
    }
		$subt=0;
        
        
		$resulti = $conn->query("SELECT precio FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and uc=1 and ischeck=1");
                $reg= $resulti->num_rows;
                while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                    $subt = $subt+$vari['precio'];
                }
                $decimales_sub = number_format($subt,2);
                echo "<span class='letra' style='float:right;'><b>SUBTOTAL $".$decimales_sub."</b> </span><br>";
                echo $cadena."</divv>";
               echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarDescuento()'>SIGUIENTE</button>";
		break;
/////////////////////////CIERRE MOSTRAR CARRITO FINAL/////////////////////////////////////////////////////////////
        
        
/////////////////////////APERTURA ELIMINAR COMPONENTE CARRITO FINAL/////////////////////////////////////////////////////////////
        case 41:
         $user=$_SESSION['usuario'];
         $idsession=$_SESSION['num'];
         $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
        while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
            $iduss=$vat['id_usuario'];

         }
        $elim=$_POST['elimcompfinal'];
        // echo "<script type=\"text/javascript\">alert(\"vamos a eliminar $elim\");</script>"; 
                $result=$conn->query("DELETE FROM cotizacion_detallada WHERE id_producto='$elim' and id_usuario='$iduss' and idsession='$idsession'");
                $resul=$conn->query("DELETE FROM cotizacion_detallada WHERE id_component='$elim' and id_usuario='$iduss' and idsession='$idsession'");
        break;
/////////////////////////CIERRE ELIMINAR COMPONENTE CARRITO FINAL/////////////////////////////////////////////////////////////
        
/////////////////////////APERTURA ELIMINAR PARTES CARRITO FINAL/////////////////////////////////////////////////////////////
        case 42:
         $user=$_SESSION['usuario'];
         $idsession=$_SESSION['num'];
         $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
        while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
            $iduss=$vat['id_usuario'];

         }
        $elim=$_POST['elimpartfinal'];
        
        $resul=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_producto='$elim' and id_usuario='$iduss' and idsession='$idsession'");
        $padre=0;
        while($var = $resul->fetch_array(MYSQLI_ASSOC)) {
            $padre=$var['id_component'];
        }
        
                $result=$conn->query("DELETE FROM cotizacion_detallada WHERE id_producto='$elim' and id_usuario='$iduss' and idsession='$idsession'");
        
        $res=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$padre' and id_usuario='$iduss' and idsession='$idsession' ");
        $sub=0;
        $s=0;
        while($ver = $res->fetch_array(MYSQLI_ASSOC)) {
            if($ver['id_component']!=$ver['id_producto']){
            $sub=$ver['cantidad']*$ver['precio'];
            $s=$s+$sub;
            }
        }
        $re=$conn->query("UPDATE cotizacion_detallada SET precio='$s' WHERE id_producto='$padre' and id_usuario='$iduss' and idsession='$idsession' ");   
        break;
/////////////////////////CIERRE ELIMINAR PARTES CARRITO FINAL/////////////////////////////////////////////////////////////
/////////////////////////APERTURA DESCUENTO CARRITO FINAL/////////////////////////////////////////////////////////////
        case 43:
             $user=$_SESSION['usuario'];
             $idsession=$_SESSION['num'];
             $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
            while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                $iduss=$vat['id_usuario'];
             }
        
        $precio=0;
        $resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and uc=1 and ischeck=1");
                $reg= $resulti->num_rows;
                while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                    $precio = $precio+$vari['precio'];
                    
                }
        $rr=$conn->query("UPDATE rotatorio SET precio='$precio'  WHERE id_usuario='$iduss' and idsession='$idsession'");
        $m=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
        while($r = $m->fetch_array(MYSQLI_ASSOC)) {
            $ee=$r['sub'];
            //echo $ee;
           if($ee==0.000000){
               $ivv=$precio*.16; 
                
                $tt=$precio+$ivv+$ee;

                $subttt=$precio+$ivv;

                $rrr=$conn->query("UPDATE rotatorio SET sub='$precio', iva='$ivv',total='$tt' WHERE id_usuario='$iduss' and idsession='$idsession'");
           }
            
        }
        
        
               
        
        
        
        
        $sistema="";
        $plataforma="";
        $capacidad="";
        $unidad="";
        $precio="";
        $decuento=0;
        $decuento2=0;
        $iva=0;
        $subtotal=0;
        $gastos=0;
        $total=0;
        $nota="";
        $show_descripcion=1;
        $show_descuento=1;
              $result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
                while($var = $result->fetch_array(MYSQLI_ASSOC)) {
                    $sistema=$var['sistema'];
                    $plataforma=$var['plataforma'];
                    $capacidad=$var['capacidad'];
                    $unidad=$var['unidad'];
                    $precio=$var['precio'];
                    $decuento=$var['descuento'];
                    $decuento2=$var['descuento2'];
                    $iva=$var['IVA'];
                    $subtotal=$var['sub'];
                    $gastos=$var['ginstalacion'];
                    $total=$var['total'];
                    $nota=$var['observaciones'];
                    $show_descripcion=$var['show_descripcion'];
                    $show_descuento=$var['show_descuentos'];
                }
                
                $checkbool_descripcion="";
                if($show_descripcion==1)
                {
                    $checkbool_descripcion="checked";
                }
                $checkbool_descuento="";
                if($show_descuento==1)
                {
                    $checkbool_descuento="checked";
                }
                $nota=utf8_encode($nota);
        
                    
                    
                    $decuentos=number_format($decuento,2);
                    $decuentos2=number_format($decuento2,2);
                    $ivas=number_format($iva,2);
                    $subtotals=number_format($subtotal,2);
                    $gastoss=number_format($gastos,2);
                    $totals=number_format($total,2);
                
        
         //$ss=$conn->query("UPDATE rotatorio SET iva='$sub', sub=''  WHERE id_usuario='$iduss' and idsession='$idsession'");
        
        
        
         $resultt=$conn->query("SELECT * FROM productos");
        while($ver = $resultt->fetch_array(MYSQLI_ASSOC)) {
            if($sistema==$ver['id']){
                $sistema=$ver['nombre'];
            }else if($plataforma==$ver['id']){
                 $plataforma=$ver['nombre'];
            }else if($capacidad==$ver['id']){
                 $capacidad=$ver['nombre'];
            }else if($unidad==$ver['id']){
                 $unidad=$ver['nombre'];
            }
        }
        
        
               $ggg = number_format($gastos,2);
         $decimales_sub = number_format($precio,2);
        
        
        $nombrerotatorio=$plataforma;
        $nomrot=$conn->query("UPDATE rotatorio SET nombre='$nombrerotatorio', usuario='$iduss' WHERE id_usuario='$iduss' and idsession='$idsession'");
            
            $cadena="
                    <div class='contenedor-input'>
                            <span  class='sinborde input-70 nombre'><b>DESCRIPCION:</b> $nombrerotatorio</span>
                            <span  class='sinborde input-30 nombre'><b>PRECIO:</b> $$decimales_sub</span>
                    </div>
                    <div class='contenedor-input'>
                            <span  class='sinborde input-30 nombre'><b>DESCUENTO INICIAL:</b></span>
                            <span  class='sinborde input-70 nombre'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='d80' maxlength='2' id='des' onblur='aplicardescuento()' style='float:left; text-align: right;' type='text' value='$decuento'><input class='d20' style='width:25px; float:left ' type='text' value='%'  disabled></span>
                            <span  class='sinborde input-30 nombre'> $decuento% APLICADO</span>
                    </div>
                    <div class='contenedor-input'>
                            <span  class='sinborde input-30 nombre'><b>DESCUENTO NEGOCIABLE:</b></span>
                            <span  class='sinborde input-70 nombre'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='d80' maxlength='2' id='des2' onblur='aplicardescuento()' style='float:left; text-align: right;' type='text' value='$decuento2'><input class='d20' style='width:25px; float:left ' type='text' value='%'  disabled></span>
                            <span  class='sinborde input-30 nombre'> $decuento2% APLICADO</span>
                    </div>
                    <div class='contenedor-input'>
                            <span  class='sinborde input-30 nombre'><b>GASTOS DE INSTALACION:</b></span>
                            <span  class='sinborde input-70 nombre'><input class='d20' style='width:25px; float:left ' type='text' value='$'  disabled><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='d80' maxlength='8'  id='gas' onblur='aplicargastos()' style='float:left;' type='text' value='$ggg'></span>
                            <span  class='sinborde input-30 nombre'> $$ggg APLICADO</span>
                    </div>
                    <div class='contenedor-input'>
                            <span  class='sinborde input-30 nombre'><b>SUBTOTAL:</b></span>
                            <span  class='sinborde input-70 nombre' style='float:left '>$$subtotals</span>
                            
                    </div>
                    <div class='contenedor-input'>
                            <span  class='sinborde input-30 nombre'><b>IVA:</b></span>
                            <span  class='sinborde input-70 nombre' style='float:left '>$$ivas</span>
                            
                    </div>
                    <div class='contenedor-input'>
                            <span  class='sinborde input-30 nombre'><b>TOTAL:</b></span>
                            <span  class='sinborde input-70 nombre' style='float:left '>$$totals</span>
                    </div>
                    <div class='contenedor-input'>
                    <span  class='sinborde input-30 nombre'><b>OBSERVACIONES</b></span>
                            <span  class='sinborde input-70 nombre'><textarea style='height:200px; width:100%; padding:5px;'  class='d80' id='obs' COLS='72' ROWS='5' WRAP='HARD' maxlength='2000'  type='text' value='$nota'>$nota</textarea></span>
                        
                    </div>   
                    <div class='row' style='float:right;margin:5px;'>
                    <input type='checkbox' $checkbool_descripcion  class='form-check-input' id='checkdescripc' value='$show_descripcion' onclick='checkMostrarDescripcion(this.value);' style='position:relative; margin-right:10px;'><span style='font-size: 15px;margin-right:50px;'>Mostrar descripción</span>
                    <input type='checkbox' $checkbool_descuento  class='form-check-input' id='checkdescuento'  value='$show_descuento' onclick='checkMostrarDescuento(this.value);' style='position:relative;'><span style='font-size: 15px; margin-right:50px;'>Mostrar descuentos</span>
                    </div> <br>  
                    <script>
                            var input = document.getElementById('des');
                            input.addEventListener('keyup', function(event) {
                            if (event.keyCode === 13) {
                                aplicardescuento();
                            }
                            });
                            var input2 = document.getElementById('des2');
                            input2.addEventListener('keyup', function(event) {
                            if (event.keyCode === 13) {
                                aplicardescuento();
                            }
                            });
                            var input3 = document.getElementById('gas');
                            input3.addEventListener('keyup', function(event) {
                            if (event.keyCode === 13) {
                                aplicargastos();
                            }
                            });
                    </script>

                    ";
            
        
            $cadenaa="
                    <div class='row'>
                        <div class='col-6'>DESCRIPCION</div>
                        <div class='col-2'>CANTIDAD</div>
                        <div class='col-2'>PRECIO</div>
                        <div class='col-2'></div>
                    </div>
                    <div class='row'>
                        <div class='col-6'>ROTATORIO $sistema $plataforma $capacidad $unidad</div>
                        <div class='col-2'>1</div>
                        <div class='col-2'>$$decimales_sub</div>
                        <div class='col-2'></div>
                    </div>
                    <br><br><br>
                    <div class='row'>
                        <div class='col-2'>DESCUENTO: </div>
                        <div class='col-7'><input style='width:25px; float:left' type='text' value='%'  disabled> <input maxlength='2' id='des' onblur='aplicardescuento()' style='float:left;' type='text' value='0'> $decuento% APLICADO</div>
                        <div class='col-3'></div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='col-2'>GASTOS DE INSTALACION: </div>
                        <div class='col-7'><input style='width:25px; float:left' type='text' value='$' disabled> <input maxlength='8'  id='gas' onblur='aplicargastos()' style='float:left;' type='text' value='0'> $ggg APLICADO </div>
                        <div class='col-3'></div>
                    </div>
                    <br>
                    <div class='row'>
                        <div class='col-2'>SUBTOTAL: </div>
                        <div class='col-7'>$$subtotals</div>
                        <div class='col-3'></div>
                    </div>
                    <br>
                     <div class='row'>
                        <div class='col-2'>IVA: </div>
                        <div class='col-7'>$$ivas</div>
                        <div class='col-3'></div>
                    </div>
                    <br>
                     
                     <div class='row'>
                        <div class='col-2'>TOTAL: </div>
                        <div class='col-7'>$$totals</div>
                        <div class='col-3'></div>
                    </div>
            
            
            
            ";
         echo $cadena;
        
        break;
        case 44:
            $user=$_SESSION['usuario'];
             $idsession=$_SESSION['num'];
             $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
             while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                $iduss=$vat['id_usuario'];
             }
        
           $descuento=$_POST['cantdescuento'];
           $descuento2=$_POST['cantdescuento2'];
           $updes= $conn->query("UPDATE rotatorio SET descuento='$descuento',descuento2='$descuento2' WHERE id_usuario='$iduss' and idsession='$idsession'");
           $result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
                $precio=0;
                $iva=0;
                $decuento=0;
                $decuento2=0;
                $subtotal=0;
                $gastos=0;
            //while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
            //if($ver=mysqli_fetch_row($result)){
            if($ver = $result->fetch_array(MYSQLI_ASSOC)){
                $precio=$ver['precio'];
                $decuento=$ver['descuento'];
                $decuento2=$ver['descuento2'];
                $ctoInst = $ver['ginstalacion']; 
            }
          
           $precio=$precio*((100-$descuento-$descuento2)/100);
           $subtotal=$precio+$ctoInst;
           $iva=$subtotal*.16;
            $total = $subtotal+$iva;
        
        $upde= $conn->query("UPDATE rotatorio SET total='$total', IVA='$iva', sub='$subtotal' WHERE id_usuario='$iduss' and idsession='$idsession'");
        
        
        
        
        
        
        break;
        
         case 45:
            $user=$_SESSION['usuario'];
             $idsession=$_SESSION['num'];
             $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
            while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                $iduss=$vat['id_usuario'];
             }
        
           $gastos=$_POST['cantgasto'];
        if($gastos>0){
            $g=$_POST['cantgasto'];
        }else{
            $g=0;
        }
        //$updes= $conn->query("CALL actrotcos1($gastos,$iduss,$idsession)");
        $updes= $conn->query("UPDATE rotatorio SET ginstalacion='$gastos' WHERE id_usuario='$iduss' and idsession='$idsession'");
           
        
        //$result=$conn->query("CALL obtdatrot($iduss,$idsession)");
        $result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
                $precio=0;
                $iva=0;
                $decuento=0;
                $subtotal=0;
                //$gastos=0;
                $sub=0;
            
            if($ver = $result->fetch_array(MYSQLI_ASSOC)){
                $precio=$ver['precio'];
                $decuento=$ver['descuento'];
                $decuento2=$ver['descuento2'];
                $ctoInst = $ver['ginstalacion']; 
            }
          
        //echo "<script type=\"text/javascript\">alert(\"PRECIO = $PRECIO, DESCUENTO= $DESCUENTO, INSTALACION = $ctoInst\");</script>"; 
        
            $decuento=$decuento+$decuento2;
           $precio=$precio*((100-$decuento)/100);
           $subtotal=$precio+$ctoInst;
           $iva=$subtotal*.16;
           $total = $subtotal+$iva;
        
        $upde= $conn->query("UPDATE rotatorio SET total='$total', IVA='$iva', sub='$subtotal' WHERE id_usuario='$iduss' and idsession='$idsession'"); 
        //$upde= $conn->query("CALL actrotcos($total,$iva,$subtotal,$iduss,$idsession)");
        //$upde= $conn->query("UPDATE rotatorio SET total='$total', IVA='$iva', sub='$subtotal' WHERE id_usuario='$iduss' and idsession='$idsession'");
        
        
       // $upde= $conn->query("UPDATE rotatorio SET total='$precio' WHERE id_usuario='$iduss' and idsession='$idsession'");
        
        
        
        
        
        break;
        
        
/////////////////////////CIERRE DESCUENTO CARRITO FINAL/////////////////////////////////////////////////////////////
//////////////////////// APERTURA HISTORIAL DE COTIZACIONES////////////////////////////////////////////// 
        case 46:
            $rol=$_SESSION['rol'];
            $cadena="";
            if($rol==2){     
            $cadena="
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered' id='dataTable' style='margin-bottom: 0' >
                        <thead>
                            <tr class='titulos'>
                                <th>NUM</th>
                                <th>NOMBRE SISTEMA</th>
                                <th>TOTAL</th>
                                <th>CLIENTE</th>
                                <th>FECHA</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
        
                $user=$_SESSION['usuario'];
                $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
                while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                    $iduss=$vat['id_usuario'];
                 }
                
                 
                $result=$conn->query("SELECT * FROM histrotatorio WHERE id_usuario='$iduss' ORDER BY numcotizacion ASC");
                while($his= $result->fetch_array(MYSQLI_ASSOC)){
                     $decimales_sub = number_format($his['total'],2);
                     $cadena=$cadena."
                                    <tr class='contenido'>
                                        <td>".$his['numcotizacion']."</td>
                                        <td>".$his['nombre']."</td>
                                        <td style='aling:right;'>$$decimales_sub</td>
                                        <td style='aling:right;'>".$his['cliente']."</td>
                                        <td style='aling:right;'>".$his['fecha']."</td>
                                        <td><button id='elicar' class='btn btn-success btn-sm' Onclick='elimcompo()' data-toggle='modal' data-target='#myModal".$his['numcotizacion']."'>VER PDFS</button>
                                        </td>
                                        
                                    </tr>";
                }
        $cadena=$cadena."
                        </tbody>
                    </table>
                </div>";
        $resultt=$conn->query("SELECT * FROM histrotatorio WHERE id_usuario='$iduss' ORDER BY numcotizacion ASC");
        while($his= $resultt->fetch_array(MYSQLI_ASSOC)){
                     
                     $cadena=$cadena.'
                                        <div class="modal fade" id="myModal'.$his['numcotizacion'].'"role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <h4 class="modal-title">'.$his['nombre'].'</h4>
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
                                  <td style="width:150px">
                                      <form action="Cotizadorhist/generar/generar-pdf-cliente.php" method="post" target="_blank">
                                      <input type="text" value="'.$his['numcotizacion'].'" name="nuncot" style="display:none;">
                                      <button type="input" class="btn btn-link"><img src="img/pdf.png" width="50px" heigth="50px" ></button>
                                      </form>
                                  </td>
                                  <td style="width:150px">
                                        <form action="Cotizadorhist/generar/generar-pdf-interna.php" method="post" target="_blank">
                                      <input type="text" value="'.$his['numcotizacion'].'" name="nuncot" style="display:none;">
                                      <button type="input" class="btn btn-link"><img src="img/pdf.png" width="50px" heigth="50px" ></button>
                                      </form>
                                  </td>
                                  <td style="width:150px">
                                        <form action="Cotizadorhist/generar/generar-pdf-costos.php" method="post" target="_blank">
                                            <input type="text" value="'.$his['numcotizacion'].'" name="nuncot" style="display:none;">
                                            <button type="input" class="btn btn-link"><img src="img/pdf.png" width="50px" heigth="50px" ></button>
                                        </form>
                                  </td>
                               </tr>
                           </tbody>
                       </table>
                        
                    </div></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
                     
                                    ';
                }
            }
            //Es un consultor o admin
            else{
                $cadena="
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered' id='dataTable' style='margin-bottom: 0' >
                        <thead>
                            <tr class='titulos'>
                                <th>NUM</th>
                                <th>NOMBRE SISTEMA</th>
                                <th>TOTAL</th>
                                <th>CLIENTE</th>
                                <th>FECHA</th>
                                <th>USUARIO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
                $result=$conn->query("SELECT his.numcotizacion,his.cliente,his.fecha,his.nombre,his.total,us.nombre as nombrev FROM histrotatorio as his join usuarios as us on us.id_usuario=his.id_usuario  ORDER BY numcotizacion ASC");
                while($his= $result->fetch_array(MYSQLI_ASSOC)){
                     $decimales_sub = number_format($his['total'],2);
                     $cadena=$cadena."
                                    <tr class='contenido'>
                                        <td>".$his['numcotizacion']."</td>
                                        <td>".$his['nombre']."</td>
                                        <td style='aling:right;'>$$decimales_sub</td>
                                        <td style='aling:right;'>".$his['cliente']."</td>
                                        <td style='aling:right;'>".$his['fecha']."</td>
                                        <td style='aling:right;'>".$his['nombrev']."</td>
                                        <td><button id='elicar' class='btn btn-success btn-sm' Onclick='elimcompo()' data-toggle='modal' data-target='#myModal".$his['numcotizacion']."'>VER PDFS</button>
                                        </td>
                                        
                                    </tr>";
                }
        $cadena=$cadena."
                        </tbody>
                    </table>
                </div>";
        $resultt=$conn->query("SELECT his.numcotizacion,his.cliente,his.fecha,his.nombre,his.total,us.nombre as nombrev FROM histrotatorio as his join usuarios as us on us.id_usuario=his.id_usuario ORDER BY numcotizacion ASC");
        while($his= $resultt->fetch_array(MYSQLI_ASSOC)){
                     
                     $cadena=$cadena.'
                                        <div class="modal fade" id="myModal'.$his['numcotizacion'].'"role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <h4 class="modal-title">'.$his['nombre'].'</h4>
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
                                  <td style="width:150px">
                                      <form action="Cotizadorhist/generar/generar-pdf-cliente.php" method="post" target="_blank">
                                      <input type="text" value="'.$his['numcotizacion'].'" name="nuncot" style="display:none;">
                                      <button type="input" class="btn btn-link"><img src="img/pdf.png" width="50px" heigth="50px" ></button>
                                      </form>
                                  </td>
                                  <td style="width:150px">
                                        <form action="Cotizadorhist/generar/generar-pdf-interna.php" method="post" target="_blank">
                                      <input type="text" value="'.$his['numcotizacion'].'" name="nuncot" style="display:none;">
                                      <button type="input" class="btn btn-link"><img src="img/pdf.png" width="50px" heigth="50px" ></button>
                                      </form>
                                  </td>
                                  <td style="width:150px">
                                        <form action="Cotizadorhist/generar/generar-pdf-costos.php" method="post" target="_blank">
                                            <input type="text" value="'.$his['numcotizacion'].'" name="nuncot" style="display:none;">
                                            <button type="input" class="btn btn-link"><img src="img/pdf.png" width="50px" heigth="50px" ></button>
                                        </form>
                                  </td>
                               </tr>
                           </tbody>
                       </table>
                        
                    </div></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
                     
                                    ';
                }
            }
                echo $cadena;
        
                            
        break;
//////////////////////// CIERRE HISTORIAL DE COTIZACIONES////////////////////////////////////////////// 
///////////////////////////APERTUTA-GUARDAR ROTATORIO////////////////////////////////////////////////
        case 47:
        
            $idsession=$_SESSION['num'];
		    $user=$_SESSION['usuario'];
					$ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
                    while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                        $iduss=$vat['id_usuario'];
                    }
                    $numcot=$conn->query("SELECT numcotizacion FROM histrotatorio ORDER BY numcotizacion DESC limit 1");
                    $reghis= $numcot->num_rows;
                    if($reghis==0){
                        $numecotizacion=1;
                    }else{
                        
                        while($numcott=$numcot->fetch_assoc()){
                            $numecotizacion=$numcott['numcotizacion']+1;
                            
                        }
                    }
                    $resul=$conn->query("UPDATE cotizacion_detallada set numcotizacion=$numecotizacion WHERE id_usuario=$iduss and idsession='$idsession'");
                    $result=$conn->query("UPDATE rotatorio set numcotizacion=$numecotizacion WHERE id_usuario=$iduss and idsession='$idsession'");
                    
        $resul=$conn->query("INSERT INTO histrotatorio SELECT * FROM rotatorio WHERE id_usuario=$iduss and idsession='$idsession'");
        $result=$conn->query("INSERT INTO hist_cotizacion_detallada SELECT * FROM cotizacion_detallada WHERE id_usuario=$iduss and idsession='$idsession'");
        $borrador=0;
        $borrador=$_COOKIE['borrador'];
        if($borrador!=0){
            $clearborra=$conn->query("DELETE FROM borrador_cotizacion_detallada WHERE id_usuario=$iduss and id_borrador=$borrador");
            $clearborra2=$conn->query("DELETE FROM borrador_rotatorio WHERE id_usuario=$iduss and id_borrador=$borrador");
        }
        $resu=$conn->query("DELETE * FROM rotatorio WHERE id_usuario=$iduss and idsession='$idsession'");
        $resultt=$conn->query("DELETE * FROM cotizacion_detallada WHERE id_usuario=$iduss and idsession='$idsession'");
        header("Refresh:1; url=cotizaciones.php");
        break;
///////////////////////////CIERRE-GUARDAR ROTATORIO////////////////////////////////////////////////
        case 48:
            $user=$_SESSION['usuario'];
             $idsession=$_SESSION['num'];
             $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
            while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                $iduss=$vat['id_usuario'];
             }
             $nota=$_POST['nota'];
             $upde= $conn->query("UPDATE rotatorio SET observaciones='$nota' WHERE id_usuario='$iduss' and idsession='$idsession'"); 
                
                
        break;
        case 49:
        $user=$_SESSION['usuario'];
        $idsession=$_SESSION['num'];
        $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
       while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
           $iduss=$vat['id_usuario'];
        }
             $result=$conn->query("UPDATE rotatorio SET precio=0, descuento=0, IVA=0, sub=0, ginstalacion=0, total=0,descuento2=0 WHERE id_usuario='$iduss' and idsession='$idsession'");
        break;
        //Cambiar ischeck en BDD PARA DETERMINAR PRODUCTOS SELECCIONADOS
        case 50:
            $iduss=$_SESSION['num_usu'];
            $idsession=$_SESSION['num'];
            $upvalor=$_POST['upvalor'];
            $nivel=$_POST['nivel'];
            if($nivel==1)
            {
                $upt=$conn->query("UPDATE cotizacion_detallada SET ischeck=$upvalor WHERE id_producto='$checkup' and idsession='$idsession' and id_usuario=$iduss");
                $resuk=$conn->query("UPDATE cotizacion_detallada SET ischeck=$upvalor WHERE id_component=$checkup and id_usuario=$iduss and idsession='$idsession'");
            }else if ($nivel==2){
                $upt=$conn->query("UPDATE cotizacion_detallada SET ischeck=$upvalor WHERE id_producto='$checkup' and id_component=$padreprod and idsession='$idsession'and id_usuario='$iduss'");
                
                $sub=0;
                if($upvalor==0){
                $resultr = $conn->query("SELECT * FROM cotizacion_detallada  WHERE id_usuario=$iduss and idsession='$idsession' and id_component=$padreprod and id_producto!=$padreprod and ischeck=1 ORDER BY id_producto");
                $rege= $resultr->num_rows;
                if($rege<1){
                    $resultaer= $conn->query("UPDATE cotizacion_detallada set ischeck=0 WHERE id_producto='$padreprod' and id_usuario=$iduss and idsession='$idsession'");
                }else{
                $prec=0;
                $s=0;
                $sub=0;
                    while ($vur=mysqli_fetch_row($resultr)) {
                        $s=$vur[3]*$vur[5];
                                $sub=$sub+$s;
                        //echo "<script type=\"text/javascript\">alert(\"le sume $vur[4] y decimal vale $sub\");</script>"; 
                        
                    }
                    $resta=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession' and id_producto='$padreprod'");
                    $d="<script language='JavaScript'>
                    alert('prueba');
                
                </script>";
                echo $d;
                }
                }else{
                    $resultaer= $conn->query("UPDATE cotizacion_detallada set ischeck=1 WHERE id_producto='$padreprod' and id_usuario='$iduss' and idsession='$idsession'");
                    $prec=0;
                    $resultr = $conn->query("SELECT * FROM cotizacion_detallada  WHERE id_usuario=$iduss and idsession='$idsession' and id_component=$padreprod and id_producto!=$padreprod and ischeck=1 ORDER BY id_producto");
                    $s=0;
                    $sub=0;
                    while ($vur=mysqli_fetch_row($resultr)) {
                        $s=$vur[3]*$vur[5];
                                $sub=$sub+$s;
                        //echo "<script type=\"text/javascript\">alert(\"le sume $vur[4] y decimal vale $sub\");</script>"; 
                        $resta=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario=$iduss and idsession='$idsession' and id_producto='$padreprod'");
                    }	
                    $d="<script language='JavaScript'>
                    alert('prueba');
                
                </script>";
                echo $d;
                }
                
            }
            $d="<script language='JavaScript'>
                    alert('prueba');
                
                </script>";
                echo $d;
        break;
        //agregar opcionales check
        case 51:
            $iduss=$_SESSION['num_usu'];
            $idsession=$_SESSION['num'];
            $upvalor=$_POST['upvalor'];
            $nivel=$_POST['nivel'];
            if($nivel==1)
            {
                $upt=$conn->query("UPDATE cotizacion_detallada SET ischeck=$upvalor WHERE id_producto='$checkup' and idsession='$idsession' and id_usuario=$iduss");
                $resuk=$conn->query("UPDATE cotizacion_detallada SET ischeck=$upvalor WHERE id_component=$checkup and id_usuario=$iduss and idsession='$idsession'");
            }else if ($nivel==2){
                $upt=$conn->query("UPDATE cotizacion_detallada SET ischeck=$upvalor WHERE id_producto='$checkup' and id_component=$padreprod and idsession='$idsession'and id_usuario=$iduss");
                
            
                if($upvalor==0){
                $resultr = $conn->query("SELECT * FROM cotizacion_detallada  WHERE id_usuario=$iduss and idsession='$idsession' and id_component=$padreprod and id_producto!=$padreprod and ischeck=1 ORDER BY id_producto");
                $rege= $resultr->num_rows;
                if($rege<1){
                    $resultaer= $conn->query("UPDATE cotizacion_detallada set ischeck=0 WHERE id_producto='$padreprod' and id_usuario=$iduss and idsession='$idsession'");
                }else{
                $prec=0;
                $s=0;
                $sub=0;
                    while ($vur=mysqli_fetch_row($resultr)) {
                        $s=$vur[3]*$vur[5];
                                $sub=$sub+$s;
                        //echo "<script type=\"text/javascript\">alert(\"le sume $vur[4] y decimal vale $sub\");</script>"; 
                        
                    }	
                    $resta=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario=$iduss and idsession='$idsession' and id_producto='$padreprod'");
                }
                }else{
                    
                    $resultaer= $conn->query("UPDATE cotizacion_detallada set ischeck=1 WHERE id_producto='$padreprod' and id_usuario=$iduss and idsession='$idsession'");
                    $prec=0;
                    $resultr = $conn->query("SELECT * FROM cotizacion_detallada  WHERE id_usuario=$iduss and idsession='$idsession' and id_component=$padreprod and ischeck=1 and id_producto!=$padreprod ORDER BY id_producto");
                    $s=0;
                    $sub=0;
                    while ($vur=mysqli_fetch_row($resultr)) {
                        $s=$vur[3]*$vur[5];
                                $sub=$sub+$s;
                        //echo "<script type=\"text/javascript\">alert(\"le sume $vur[4] y decimal vale $sub\");</script>"; 
                        
                    }	
                    $resta=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario=$iduss and idsession='$idsession' and id_producto='$padreprod'");
                }
            }
        
        break;
        
        case 52:
            $id_nueva_cant=$_POST['nuevacantidad_id'];
            $num_nueva_cant=$_POST['nuevacantidad'];
            $iduss=$_SESSION['num_usu'];
            $idsession=$_SESSION['num'];
            $upt=$conn->query("UPDATE cotizacion_detallada as cot  SET  cot.cantidad=$num_nueva_cant where cot.idsession='$idsession' and cot.id_usuario=$iduss and cot.id_producto='$id_nueva_cant' and cot.id_component=$padreprod ");
        
            
            
           
            $resultr = $conn->query("SELECT * FROM cotizacion_detallada  WHERE id_usuario=$iduss and idsession='$idsession' and id_component=$padreprod and ischeck=1 and id_producto!=$padreprod ORDER BY id_producto");
            $rege= $resultr->num_rows;
            if($rege<1){
                $resultaer= $conn->query("UPDATE cotizacion_detallada set ischeck=0 WHERE id_producto='$padreprod' and id_usuario=$iduss and idsession='$idsession'");
            }else{
            $prec=0;
            $s=0;
            $sub=0;
                while ($vur=mysqli_fetch_row($resultr)) {
                    $s=$vur[3]*$vur[5];
                    $sub=$sub+$s;
                
                    //echo "<script type=\"text/javascript\">alert(\"le sume $vur[4] y decimal vale $sub\");</script>"; 
                    $resta=$conn->query("UPDATE cotizacion_detallada SET precio=$sub WHERE id_usuario=$iduss and idsession='$idsession' and id_producto='$padreprod'");
                }	
            }

        break;
        
        case 53:
            $bool_show=$_POST['showinfopdf'];
            $tipo_show=$_POST['show_tipo'];
            $iduss=$_SESSION['num_usu'];
            $idsession=$_SESSION['num'];
            if($tipo_show==1)
            {
                $upt=$conn->query("UPDATE rotatorio SET show_descripcion=$bool_show WHERE id_usuario=$iduss and idsession='$idsession'");
            }else{
                $upt2=$conn->query("UPDATE rotatorio SET show_descuentos=$bool_show WHERE id_usuario=$iduss and idsession='$idsession'");
            }
        
        break;
        // ----------------------------------- Insertar borrador ------------------------------
        case 54:
            $query_last_id = $conn->query("SELECT id_borrador FROM borrador_rotatorio ORDER BY id_borrador DESC limit 1;");
            $last= $query_last_id->num_rows;
            $last_id=0;
            if ($last>0){
                while($rs = $query_last_id->fetch_array(MYSQLI_ASSOC)) {
                    $last_id=$rs['id_borrador']+1;
                }
            }else{
                $last_id=1;
            }
            
            $query_insert_borra = $conn->query("INSERT INTO borrador_cotizacion_detallada (id_component,id_producto,descripcion,cantidad,uc,precio,costos,id_usuario,idsession,numcotizacion,moneda,ischeck,orden,id_borrador)
            SELECT *,$last_id FROM cotizacion_detallada WHERE id_usuario=$iduss and idsession='$idsession';");
            

           

            $query_insert_borra_rot = $conn->query("INSERT INTO borrador_rotatorio (Id,sistema,plataforma,capacidad,unidad,precio,descuento,IVA,sub,ginstalacion,total,id_usuario,idsession,sale,nombre,numcotizacion,fecha,cliente,usuario,observaciones,descuento2,show_descripcion,show_descuentos,id_borrador)
            SELECT *,$last_id FROM rotatorio WHERE id_usuario=$iduss and idsession='$idsession';");
        
            setcookie("borrador", $last_id, time()+3600,'./');
        
        break;
        // ----------------------- mostrar tus borradores ---------------------------------
        case 55:
            $query_borradores = $conn->query("SELECT * FROM borrador_rotatorio WHERE id_usuario=$iduss ORDER BY id_borrador");
            $borras= $query_borradores->num_rows;
            $plantilla="";
            if ($borras>0){
                $plantilla="
               <div class='table-responsive' style='font-size: 14px;'>
                    <table class='table table-striped table-bordered' id='dataTable' style='margin-bottom: 0;' >
                    <thead>
                        <tr></tr>
                           
                        <th style='width: 20%;'>NUM</th>
                        <th style='width: 200px !important'>NOMBRE SISTEMA</th>
                        <th style='width: 20%'>CLIENTE</th>
                        <th style='width: 10%'>FECHA</th>
                        <th style='width: 10%'>VER</th>
                        <th style='width: 10%'>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>";
                    while($his= $query_borradores->fetch_array(MYSQLI_ASSOC)){
                        $decimales_sub = number_format($his['total'],2);
                        $id_borra = $his['id_borrador'];
                        $plantilla=$plantilla."
                                       <tr class='contenido'>
                                           <td>".$his['numcotizacion']."</td>
                                           <td style='width: 30%'>".$his['nombre']."</td>
                                           <td style='aling:right;'>".$his['cliente']."</td>
                                           <td style='aling:right;'>".$his['fecha']."</td>
                                           <td><button id='verborra' style='width: fit-content; height:auto; display: flex; margin: auto;' class='btn btn-success btn-sm' Onclick='abrirCotizacionBorrador($id_borra)'><i class='fa fa-check-square' aria-hidden='true' style='font-size: 30px;'></i></button>
                                           <td><button id='dborra' style='width: fit-content; height:auto; display: flex; margin: auto;' class='btn btn-danger btn-sm' Onclick='eliminarBorrador($id_borra)'><i class='fa fa-window-close' aria-hidden='true' style='font-size: 30px;'></i></button>
                                           </td>
                                           
                                       </tr>";
                   }
           $plantilla=$plantilla."
                           </tbody>
                       </table>
                   </div>";
            }else{
                $plantilla="";
            }
            echo $plantilla;
        break;
        
        // ------------------------- COTIZAR BORRADOR -------------------------------
        case 56:
            $clear= $conn->query("CALL proc0701($iduss,'$idsession')");
            $cadena="
                <script language='JavaScript'>
                function bunload(event){
                    event.returnValue = '¿Estas seguro que quieres salir?';
                }
                function unload(e){
                    $.ajax({
                        type:'POST',
                        url:'validar.php',
                        data:'eliminartodo=' + 7,
                        success:function(r){
                            
                        }
                    });
                }
            window.addEventListener('beforeunload', bunload);
            
            window.addEventListener('unload', unload);
            
            </script>
            
            
                <div class='row'>
                    <div class='col-12 pt-2'>
                        <div class='letra'><b>DESCRIPCION
                                <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
                            </b></div>
                    </div>
                </div>
                ";
                setcookie("borrador", $id_borra, time()+3600,'./');
            $uptSes=$conn->query("UPDATE borrador_cotizacion_detallada SET idsession='$idsession' WHERE id_usuario=$iduss and id_borrador=$id_borra");
            $uptSes2=$conn->query("UPDATE borrador_rotatorio SET idsession='$idsession' WHERE id_usuario=$iduss and id_borrador=$id_borra");
            $llenaRota=$conn->query("INSERT INTO rotatorio SELECT Id,sistema,plataforma,capacidad,unidad,precio,descuento,IVA,sub,ginstalacion,total,id_usuario,idsession,sale,nombre,numcotizacion,fecha,cliente,usuario,observaciones,descuento2,show_descripcion,show_descuentos from borrador_rotatorio WHERE id_usuario=$iduss and idsession='$idsession' and id_borrador=$id_borra");
            $llenaCot=$conn->query("INSERT INTO cotizacion_detallada SELECT id_component,id_producto,descripcion,cantidad,uc,precio,costos,id_usuario,idsession,numcotizacion,moneda,ischeck,orden from borrador_cotizacion_detallada WHERE id_usuario=$iduss and idsession='$idsession' and id_borrador=$id_borra");
            $getData=$conn->query("SELECT plataforma from borrador_rotatorio WHERE id_usuario=$iduss and idsession='$idsession' and id_borrador=$id_borra");
            $carritos=0;
            while($get_plat = $getData->fetch_array(MYSQLI_ASSOC)) {
                $carritos=$get_plat['plataforma'];
            }
                $busca_plataforma =  $conn->query("SELECT precio,id_producto,descripcion,ischeck FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component=$carritos and descripcion LIKE '%PLATAFORMA%'");
                $existe= $busca_plataforma->num_rows;
                if($existe>0)
                $cadena=$cadena."
                 <button id='btnmoscar' name='btnmagico' value='$carritos' style='opacity:0; position:absolute;'>SELECCIONAR</button>
        <div class='letra' style='color: #00528b!important;'><b>PLATAFORMA</div></b>
       ";
                while($ver_plat = $busca_plataforma->fetch_array(MYSQLI_ASSOC)) {
                    $prec=1*$ver_plat['precio'];
                    $decimales_plat = number_format($prec,2);
                    $id_plat=$ver_plat['id_producto'];
                    $desc_plat=$ver_plat['descripcion'];
                    $checado=$ver_plat['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                    
                    $cadena=$cadena."
                    <div class='row'>
                        <div class='col-12'>
                            <div class='letra'>
                                <div class='panel-group'>
                                    <div class='panel panel-default'>
                                        <div style='width:100%;'>
                                            <a class='btn-coti' href='#c$id_plat' data-toggle='collapse' >
                                                <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                                <div class='chalinoDer'>
                                                    <span style='float:right;' class='letchicacoll'>
                                                    
                                                        
                                                    </span>
                                                    
                                                    <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                                    
                                                </div>
                                            </a>
                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                        </div>
                                        <div id='c$id_plat' class='panel-collapse collapse >
                                            <ul class='list-group'>";
                                                $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                                $numcomp= $partcomp->num_rows;
                                                $num=1;       
                                                  
                                                $imagen=$conn->query("SELECT dir_img FROM imagenes WHERE id_comp='$id_plat'");
                                                $regg= $imagen->num_rows;
                                                $dirrr="";
                                                while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                    $dirrr=$imgggg['dir_img'];
                                                } 
                                                $cadena=$cadena." 
                                                <div class='contenedor-input'>
                                                    <span class='input-29'>";
                                                    if($num==1){
                                                        $cadena=$cadena."
                                                         <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                    }
                                                    $cadena=$cadena."   
                                                    </span>
                                                    <span class='input-69'>";
                                                while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                                $p=0;
                                                $p=$vi['cantidad']*$vi['precio'];
                                                $deci = number_format($p,2);
                                                $id_sub=$vi['id_producto'];
                                                $vi1=$vi['id_producto'];
                                                $vi2=$vi['descripcion'];
                                                $checadosub=$vi['ischeck'];
                                                $checkbool="";
                                                $cantidadsub=$vi['cantidad'];
                                                if($checadosub=="1")
                                                {
                                                    $checkbool="checked";
                                                }
                                                 $cadena=$cadena." 
                                                        <li class='list-group-item' style='margin-left:20px;'>
                                                            <div style='width:100%;'>
                                                                <div class='chalinoIzq'>
                                                                <b>
                                                                <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                                </b><span > $vi2 </span> 
                                                                    
                                                                </div>
                                                                <div class='chalinoDer' style='vertical-align:middle;'>
                                                                    
                                                                <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                            </div>
                                                        </li>
                                                    
                                                
                                                ";
                                                $num++;
                                                }
                                                $cadena=$cadena."</span></div> </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
            }

            $busca_ordeno=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component=$carritos and (descripcion LIKE '%ORDEÑO%' or descripcion LIKE '%GLANDULA%' or descripcion LIKE '%BOMBAS DE LECHE%' or descripcion LIKE '%GRUPOS DE RECIBO%' or descripcion LIKE '%GRUPO DE RECIBO%' or descripcion LIKE '%LINEAS DE LECHE%' or descripcion LIKE '%SISTEMA DE PULSACION%' or descripcion LIKE '%TUBERIA DE PVC PULSACION%' or descripcion LIKE '%SOPORTERIA%' or descripcion LIKE '%FILTROS DE LECHE%' or descripcion LIKE '%SISTEMA DE VACIO%' or descripcion LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' or descripcion LIKE '%SISTEMA DE LAVADO%' or descripcion LIKE '%ARREADOR%' or descripcion LIKE '%ARRASTRE DE LECHE%' or descripcion LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' or descripcion LIKE '%FILTROS A TANQUE%' or descripcion LIKE '%SUCCION DE LAVADO%' OR descripcion LIKE '%CONTROL DE VACIO%' OR descripcion LIKE '%TRAMPA SANITARIA%' OR descripcion  LIKE '%LINEA DE LECHE%' OR descripcion  LIKE '%CONTROLADOR DE VACIO%') ORDER BY orden");
            $existe= $busca_ordeno->num_rows;
                if($existe>0)
            $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>EQUIPOS DE ORDEÑO</div></b>";
            while($ver_ordeno = $busca_ordeno->fetch_array(MYSQLI_ASSOC)) {
                $prec=1*$ver_ordeno['precio'];
                $decimales_plat = number_format($prec,2);
                $id_plat=$ver_ordeno['id_producto'];
                $desc_plat=$ver_ordeno['descripcion'];
                $checado=$ver_ordeno['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
                $cadena=$cadena."
                <div class='row'>
                    <div class='col-12'>
                        <div class='letra'>
                            <div class='panel-group'>
                                <div class='panel panel-default'>
                                    <div style='width:100%;'>
                                        <a class='btn-coti' href='#c$id_plat' data-toggle='collapse'>
                                            <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                            <div class='chalinoDer'>
                                                <span style='float:right;' class='letchicacoll'>
                                                    <input name='elim' value='$id_plat' style='display:none;'>
                                                    <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                        <i class='fa fa-times'></i>
                                                    </button-->
                                                </span>
                                                <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                            </div>
                                        </a>
                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                    </div>
                                    <div id='c$id_plat' class='panel-collapse collapse'>
                                        <ul class='list-group'>";
                                            $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                            $numcomp= $partcomp->num_rows;
                                            $num=1;       
                                              
                                            $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp='$id_plat'");
                                            $regg= $imagen->num_rows;
                                            $dirrr="";
                                            while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                                $dirrr=$imgggg['dir_img'];
                                            } 
                                            $cadena=$cadena." 
                                            <div class='contenedor-input'>
                                                <span class='input-29'>";
                                                if($num==1){
                                                    $cadena=$cadena."
                                                     <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                                }
                                                $cadena=$cadena."   
                                                </span>
                                                <span class='input-69'>";
                                            while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                            $p=0;
                                            $p=$vi['cantidad']*$vi['precio'];
                                            $deci = number_format($p,2);
                                            $vi1=$vi['id_producto'];
                                            $vi2=$vi['descripcion'];
                                            $id_sub=$vi['id_producto'];
                                            $checadosub=$vi['ischeck'];
                                            $cantidadsub=$vi['cantidad'];
                                            $checkbool="";
                                            if($checadosub=="1")
                                            {
                                                $checkbool="checked";
                                            }
                                             $cadena=$cadena." 
                                                    <li class='list-group-item' style='margin-left:20px;'>
                                                        <div style='width:100%;'>
                                                            <div class='chalinoIzq'>
                                                            <b>
                                                            <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                               </b> <span > $vi2 </span> 
                                                                
                                                            </div>
                                                            <div class='chalinoDer' style='vertical-align:middle;'>
                                                                <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                                <o class='fa fa-times'></o>
                                                            </button-->
                                                            <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                                </div>
                                                                <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                        </div>
                                                    </li>
                                                
                                            
                                            ";
                                            $num++;
                                            }
                                            $cadena=$cadena."</span></div> </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        }
        $busca_complementarios=  $conn->query("SELECT precio,id_producto,descripcion,ischeck,orden FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component=$carritos and descripcion NOT LIKE '%ORDEÑO%' and descripcion NOT LIKE '%PLATAFORMA%' and descripcion NOT LIKE '%GLANDULA%' AND descripcion NOT LIKE '%BOMBAS DE LECHE%' AND descripcion NOT LIKE '%GRUPOS DE RECIBO%' AND descripcion NOT LIKE '%GRUPO DE RECIBO%' AND descripcion NOT LIKE '%LINEAS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE PULSACION%' AND descripcion NOT LIKE '%TUBERIA DE PVC PULSACION%' AND descripcion NOT LIKE '%SOPORTERIA%' AND descripcion NOT LIKE '%FILTROS DE LECHE%' AND descripcion NOT LIKE '%SISTEMA DE VACIO%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO DE RESPALDO%' AND descripcion NOT LIKE '%SISTEMA DE LAVADO%' AND descripcion NOT LIKE '%ARREADOR%' AND descripcion NOT LIKE '%ARRASTRE DE LECHE%' AND descripcion NOT LIKE '%UNIDAD MOTRIZ DE EMERGENCIA%' AND descripcion not LIKE '%FILTROS A TANQUE%' AND descripcion not LIKE '%SUCCION DE LAVADO%' AND descripcion not LIKE '%CONTROL DE VACIO%' AND descripcion not LIKE '%TRAMPA SANITARIA%' AND descripcion not LIKE '%LINEA DE LECHE%' AND descripcion NOT LIKE '%CONTROLADOR DE VACIO%' ORDER BY orden;");
        $existe= $busca_complementarios->num_rows;
        if($existe>0)
        $cadena=$cadena."
        <div class='letra' style='color: #00528b!important;'><b>COMPLEMENTARIOS</div></b>";
        while($ver_com = $busca_complementarios->fetch_array(MYSQLI_ASSOC)) {
            $prec=1*$ver_com['precio'];
            $decimales_plat = number_format($prec,2);
            $id_plat=$ver_com['id_producto'];
            $desc_plat=$ver_com['descripcion'];
            $checado=$ver_com['ischeck'];
                    $checkbool="";
                    if($checado==1)
                    {
                        $checkbool="checked";
                    }
            $cadena=$cadena."
            <div class='row'>
                <div class='col-12'>
                
                    <div class='letra'>
                        <div class='panel-group'>
                            <div class='panel panel-default'>
                                <div style='width:100%;'>
                                    <a class='btn-coti' href='#c$id_plat' data-toggle='collapse'>
                                        <div class='chalinoIzq'><i class='fas fa-chevron-down' style=''></i>&nbsp;$desc_plat</div>
                                        <div class='chalinoDer'>
                                            <span style='float:right;' class='letchicacoll'>
                                                <input name='elim' value='$id_plat' style='display:none;'>
                                                <!--button style='float:rigth;' id='elicar$id_plat' value='$id_plat' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo(`$id_plat`)'>
                                                    <i class='fa fa-times'></i>
                                                </button-->
                                            </span>
                                            <span style='float:right; margin-right:20px' class='letchicacoll'>$$decimales_plat&nbsp;</span>
                                        </div>
                                    </a>
                                    <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_plat' name='checkEli$id_plat' value='$checado' onclick='checkEliminarCarrito(`$id_plat`,1,$id_plat);'>
                                </div>
                                <div id='c$id_plat' class='panel-collapse collapse'>
                                    <ul class='list-group'>";
                                        $partcomp=$conn->query("SELECT id_producto,cantidad,precio,descripcion,ischeck FROM cotizacion_detallada as cot JOIN productos_sap as ps ON ps.id_producto_madero=cot.id_producto where cot.id_usuario='$iduss' and cot.idsession='$idsession' and cot.id_component='$id_plat' ORDER BY cot.descripcion"); // Agregar el ORDER BY al procedimiento
                                        $numcomp= $partcomp->num_rows;
                                        $num=1;       
                                          
                                        $imagen=$conn->query("SELECT dir_img FROM imagenes WHERE id_comp='$id_plat'");
                                        $regg= $imagen->num_rows;
                                        $dirrr="";
                                        while($imgggg = $imagen->fetch_array(MYSQLI_ASSOC)) {
                                            $dirrr=$imgggg['dir_img'];
                                        } 
                                        $cadena=$cadena." 
                                        <div class='contenedor-input'>
                                            <span class='input-29'>";
                                            if($num==1){
                                                $cadena=$cadena."
                                                 <img src='$dirrr' style='width:100%; height:200px; position:relative;  margin-top:20px;'>";
                                            }
                                            $cadena=$cadena."   
                                            </span>
                                            <span class='input-69'>";
                                        while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) { 
                                        $p=0;
                                        $p=$vi['cantidad']*$vi['precio'];
                                        $deci = number_format($p,2);
                                        $vi1=$vi['id_producto'];
                                        $vi2=$vi['descripcion'];
                                        $id_sub=$vi['id_producto'];
                                        $checadosub=$vi['ischeck'];
                                        $cantidadsub=$vi['cantidad'];
                                        $checkbool="";
                                        if($checadosub=="1")
                                        {
                                            $checkbool="checked";
                                        }
                                         $cadena=$cadena." 
                                                <li class='list-group-item' style='margin-left:20px;'>
                                                    <div style='width:100%;'>
                                                        <div class='chalinoIzq'>
                                                        <b>
                                                        <input type='number' value='$cantidadsub' min=1 id='cant$id_sub' style='width:40px; text-align:center; border:none' onChange='cambiarCantidadProducto(`$id_sub`,this.value,$id_plat)'>
                                                        </b> <span > $vi2 </span> 
                                                            
                                                        </div>
                                                        <div class='chalinoDer' style='vertical-align:middle;'>
                                                            <!--button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right; vertical-align:middle;'>
                                                            <o class='fa fa-times'></o>
                                                        </button-->
                                                        <span class='letche' style='float:right; vertical-align:middle; margin-right: 25px;'>$$deci&nbsp;</span>
                                                        </div>
                                                        <input type='checkbox' $checkbool  class='form-check-input checado' id='checkEli$id_sub$id_plat' name='checkEli$id_sub$id_plat' value='$checadosub' onclick='checkEliminarCarrito(`$id_sub`,2,$id_plat);'>
                                                    </div>
                                                </li>
                                            
                                        
                                        ";
                                        $num++;
                                        }
                                        $cadena=$cadena."</span></div> </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ";
    }
                
                $subt=0;
                $resulti = $conn->query("SELECT precio FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component=$carritos and ischeck=1");
                $reg= $resulti->num_rows;
                if($reg==0){
                    echo 0;
                
                }else{




                while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
                $subt = $subt+$vari['precio'];
                }
                $decimales_sub = number_format($subt,2);
                echo "<span style='float:right;'><b> <input value='SUBTOTAL $$decimales_sub' readonly style='border:none; outline:none; text-align:right' id='txtsubtotal'> </b> </span><br>";
                echo $cadena."</divv>";
                echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()' class='letche'>SIGUIENTE</button>";
                }
        break;

        case 57:
            echo "<script type=\"text/javascript\">alert(\"fe\");</script>";
            $query_borra_cota = $conn->query("DELETE FROM borrador_cotizacion_detallada WHERE id_borrador=$id_borra;");
            $query_borra_rota = $conn->query("DELETE FROM borrador_rotatorio WHERE id_borrador=$id_borra;");
            
        break;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        case 27:
       
        $cadena="";
            echo $cadena."<button type='Upload File Now' class='btn btn-success btn-lg btn-block'>AGREGAR</button>";
        break;
        case 28:
            $cadena="";
            echo $cadena;
        break;
        case 100:
            print "<span>No tienes permiso</span>";//"<img style='display:block;position:absolute;left:10%;width:75%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/largate.jpg' />";
      // header('location:http://www.imss.gob.mx/');
        
        break;

}


?>
