<?php 
session_start();
include_once 'app/Usuario.inc.php';
include("php_conexiones.php");
include("arreglos.php");
//include("js/direcciones.php");
	$data = file_get_contents("php://input");
	$objData = json_decode($data);
    


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
    echo "<script type=\"text/javascript\">alert(\"puto madero\");</script>"; 
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
}else{
	$accion = 100;
}
  //echo "<script type=\"text/javascript\">alert(\"entro al $accion\");</script>";  

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
		print "<img style='display:block;position:absolute;left:37.5%;width:25%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/load.gif' />";
        session_destroy();
        header("Refresh:1; url=index.php");
	break;
	
	case 3:
		$result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre =$sistemas");
		if($sistemas>0){
			$sel="SELECCIONAR";
			$val=0;
			$click="recargarTamanos()";
		$cadena="<a class='letche'>PLATAFORMA</a>
			<select id='pla' name='idplataforma' class='form-control'>
			<option value'$val' disabled  selected>$sel</option>";

			while ($ver=mysqli_fetch_row($result)) {
				
				$cadena=$cadena.'<option value='.$ver[0].' Onclick='.$click.'>'.utf8_encode($ver[2]).'</option>';
			}

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
		$result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre =$plataformas");
		if($plataformas!=0){
			$sel="SELECCIONAR";
			$val=0;
			$click="recargarUnidades()";
		    $cadena="<a class='letche'>CAPACIDAD</a>
			<select id='cap' name='idcapacidad' class='form-control'>
			<option value'$val' disabled  selected>$sel</option>";

			while ($ver=mysqli_fetch_row($result)) {
				$cadena=$cadena.'<option value='.$ver[0].' Onclick='.$click.'>'.utf8_encode($ver[2]).'</option>';
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
		$result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre =$tamanos");
		if($tamanos!=0){
			$sel="SELECCIONAR";
			$val=0;
			$click="recargarBotton()";
		    $cadena="<a class='letche'>UNIDADES</a>
			<select id='uni' name='idunidades' class='form-control'>
			<option value'$val' disabled selected>$sel</option>";

			while ($ver=mysqli_fetch_row($result)) {
				$cadena=$cadena.'<option value='.$ver[0].' Onclick='.$click.'>'.$ver[2].'</option>';
			}
           
			echo $cadena."</select>";
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
        $idsession=$_SESSION['num'];
		$user=$_SESSION['usuario'];
					$ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
					while($vat=mysqli_fetch_row($ressull)){
						$iduss=$vat[0];
						
					}
		$resulta= $conn->query("DELETE FROM cotizacion_detallada WHERE id_producto>0 and id_usuario='$iduss' and idsession='$idsession'");
        $result= $conn->query("DELETE FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession' and sale='0'");
		$cadena="";
		
           
			echo $cadena."";
	break;
        
////////////////////APERTURA-MOSTRAR CARRITO CUANDO SELECCIONA EL TIPO DE PLATAFORMA////////////////////////    
		case 8:
        
                      
         
                $resultt = $conn->query("SELECT * FROM productos WHERE id='$carritos'");
        
                $reg= $resultt->num_rows;
               // echo "<script type=\"text/javascript\">alert(\" UNIDAD $reg\");</script>"; 
        
                while ($ver=mysqli_fetch_row($resultt)) {
                  $user=$_SESSION['usuario'];
                  $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
                    
                    $reg= $ressull->num_rows;
                   // echo "<script type=\"text/javascript\">alert(\"USUARIO $reg\");</script>";
                    
                  while($vat=mysqli_fetch_row($ressull)){
                    $iduss=$vat[0];
                  }
                  $resultta = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$carritos' ORDER BY id");
                     
                    
                    $reg= $resultta->num_rows;
                   // echo "<script type=\"text/javascript\">alert(\"COMPONENTES  $reg----$iduss\");</script>";
                    
                    
                    
                    
                    
                    
                    $resulttaaaaa = $conn->query("  SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$carritos' ORDER BY id");

                       $id_componentes= array();
                       $i=0;
                       $precioscompo=array();
                       while ($ids=mysqli_fetch_row($resulttaaaaa)) {
                           $id_componentes[$i]=$ids[0];
                          
                           $id_componentes2=$ids[0];

                           $resulttaaaaat = $conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$id_componentes2'ORDER BY id_producto_madero");
                           $id_partes= array();
                           $totalcomponente=0;
                           $totalcomponentee=array();
                           $j=0;
                           while ($ids=mysqli_fetch_row($resulttaaaaat)) {
                               $id_partes[$j]=$ids[4];
                               $totalcomponente=$ids[3];
                               $totalcomponentee[$j]=$totalcomponente;
                               $j++;
                              // echo $totalcomponente."---".$id_componentes2."-----".$ids[4]."<br>";
                           }
                           
                           //echo "tamaño de partes=".count($id_partes);
                           $n=0;
                            $total=array();
                           $ccc=0;
                           for($m=0;$m<count($id_partes);$m++){
                               $idsap=$id_partes[$m];
                               
                               //echo "----".$idsap."----";
                              // echo "----".$id_componentes2."----";
                              
                               $cantidadporprecio=$conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$id_componentes2' and  C.id_producto_madero='$idsap'");
                                while ($mulpre=mysqli_fetch_row($cantidadporprecio)) {
                                    $b=$mulpre[3];
                                    $b=number_format($b,8,'.',''); 
                                    $a=$mulpre[3]*$mulpre[9];
                                     
                                }
                                $total[$m]=$a;
                               $ccc=$ccc+$total[$m];
                              // echo $m."m---";
                              
                               $n++;
                              // echo $n."n---";
                               $precioscompo[$i]=$ccc;
                             } 
                           
                         //  echo "<br>".$ccc;
                           
                           
                           
                           
                           
                           // echo "precios";
                         // var_dump($totalcomponentee);
                          // var_dump($total);
                            
                          // echo "partes";
                     // var_dump($id_partes);
                           
                            $i++;
                       }
                        
                   // echo "componente";
                      // var_dump($id_componentes);var_dump($precioscompo);
                    
                    
                    
                    
                    
                    $z=0;
                    $precom=0;
                   while ($var=mysqli_fetch_row($resultta)) {
                       
                       $idsession=$_SESSION['num'];
                       
                       
                       $precom=$precioscompo[$z];
                       $precom=number_format($precom,8,'.',''); 
                       $resulttaaa = $conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,id_usuario,idsession) values('$var[6]','$var[0]','$var[2]','0','$iduss','$idsession')");
                       $z++;
                       
                   }
                    
                }
            $sistema=$_POST['sistema'];
            $plataforma=$_POST['plataforma'];
            $capacidad=$_POST['capacidad'];
            $unidad=$_POST['unidad'];
            $rotatorio=$conn->query("INSERT INTO rotatorio(sistema,plataforma,capacidad,unidad,id_usuario,idsession) VALUES('$sistema','$plataforma','$capacidad','$unidad','$iduss','$idsession')");  
             $contcompid=array();
             $contcomprelaid=array();
             $contcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE idsession='$idsession'");
            $regcocom= $contcomp->num_rows;
        if($regcocom>0){
            $u=0;
                 while ($var=mysqli_fetch_row($contcomp)) {
                     $contcompid[$u]=$var[1];
                     $u++;
                     $contcomprela=$conn->query("SELECT * FROM relacion_producto WHERE padre='$var[1]'");
                         $v=0;
                         while ($ver=mysqli_fetch_row($contcomprela)) {
                             $contcomprelaid[$v]=$ver[1];
                               $contcompsap=$conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$var[1]' and  C.id_producto_madero='$ver[1]'");
                                 while ($vor=mysqli_fetch_row($contcompsap)) {
                                     $contcompsapinst=$conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,id_usuario,idsession,cantidad) values('$var[1]','$vor[4]','$vor[2]','$vor[3]','$iduss','$idsession','$vor[9]')");
                                 }
                              
                             $v++;
                         }
                     //var_dump($contcomprelaid);
                 }
              //var_dump($contcompid);
            
                 for($i=0;$i<count($contcompid);$i++){
                    $sub=0;
                    $s=0;
                    $subtotal=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$contcompid[$i]'");
                     while ($mon=mysqli_fetch_row($subtotal)){
                         $s=$mon[3]*$mon[4];
                         $sub=$sub+$s;
                    }  
                    $total=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession'and id_producto='$contcompid[$i]'");
                    
                }
              
        }
                $cadena="
                        
                            <div class='row'>
                            <div class='col-12 pt-2'>
                                <div class='letra'><b>DESCRIPCION
                                
                                
                                <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
                                </b></div>
                            </div>
                            
                           </div>
                ";
                $result = $conn->query("SELECT * FROM cotizacion_detallada  where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' ORDER BY id_producto");
                while ($ver=mysqli_fetch_row($result)) {
                    $prec=1*$ver[4];
                    $decimales = number_format($prec,2);
                    $cadena=$cadena."
                                    <div class='row'>
                                    <div class='col-12 pt-2'>
                                        <div class='letra'>
                                        
                                        
                                        <div class='panel-group pt-3'>
                                            <div class='panel panel-default'>
                                                <a class='btn btn-light btn-block' href='#c$ver[1]' data-toggle='collapse'>
                                                    <h4>
                                                        <i class='fas fa-chevron-down' style='float:left;'></i>
                                                        &nbsp;&nbsp;
                                                        <span style='float:left;'>$ver[2]</span>
                                                        <span style='float:right;'>
                                                        
                                                        <input name='elim' value='$ver[1]' style='display:none;'>
                                        <button id='elicar$ver[1]'  value='$ver[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo($ver[1])'><o class='fa fa-times'></o></button>
                                                        
                                                        
                                                        </span>
                                                        <span style='float:right;'>$$decimales &nbsp;&nbsp;</span>

                                                    </h4>
                                                    &nbsp;
                                                </a>
                                                <div id='c$ver[1]' class='panel-collapse collapse'>
                                                    <ul class='list-group'>";
                                                    
                                            $partcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$ver[1]'");
                                                        
                                                     while ($vi=mysqli_fetch_row($partcomp)) {
                                                         $p=0;
                                                         $p=$vi[3]*$vi[4];
                                                         $deci = number_format($p,2);
                                                      $cadena=$cadena."  <li class='list-group-item' style='margin-left:20px;'>
                                                      
                                                      
                                                      
                                                      
                                                      <button id='elipartcarr$vi[1]'  value='$vi[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi[1])' style='float:right;'><o class='fa fa-times'></o></button>
                                                      
                                                      <span class='letche'> $vi[2] </span> <span class='letche' style='float:right;'>$$deci &nbsp;&nbsp;</span>
                                                      
                                                      
                                                      </li>";
                                                     }
                                                        //<input type='checkbox' id='compopc$vi[1]' name='compopc$vi[1]' value='$vi[1]'>


                                                   $cadena=$cadena." </ul>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        </div>
                                    </div>
                                    
                                    </div>
                    ";
                }
                $subt=0;
                $resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos'");
                $reg= $resulti->num_rows;
                while ($vari=mysqli_fetch_row($resulti)){
                    $subt = $subt+$vari[4];
                }
                $decimales_sub = number_format($subt,2);
                echo "<span style='float:right;'><b>SUBTOTAL $".$decimales_sub."</b> </span><br>";
                echo $cadena."</divv>";
               echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()' class='letche'>SIGUIENTE</button>";
            
		break;
////////////////////CIERRE-MOSTRAR CARRITO CUANDO SELECCIONA EL TIPO DE PLATAFORMA////////////////////////    
	   case 9:
        
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
            }
            
            $prec=0;
            $s=0;
            $sub=0;
            while ($vur=mysqli_fetch_row($resultr)) {
                $s=$vur[3]*$vur[4];
                         $sub=$sub+$s;
                //echo "<script type=\"text/javascript\">alert(\"le sume $vur[4] y decimal vale $sub\");</script>"; 
                $resta=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession' and id_producto='$padre'");
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
		while ($ver=mysqli_fetch_row($result)) {
			$prec=$ver[3]*$ver[4];			
				$cadena=$cadena."<div class='row'>
								<div class='col-8 pt-2'>
									<div>$ver[2]</div>
								</div>
								<div class='col-2 pt-2'>
									<div>$prec</div>
								</div>
								<div class='col-2 pt-2'>
									
                                    <div><input name='elim' value='$ver[1]' style='display:none;'><button id='elicar' type='submit' name='submit' value='$ver[1]' class='btn btn-danger btn-sm '><o class='fa fa-times'></o></button></div>
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
        //echo "a";
		$user=$_SESSION['usuario'];
        $idsession=$_SESSION['num'];
					$ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
					while($vat=mysqli_fetch_row($ressull)){
						$iduss=$vat[0];
						
					}
        
        
        
		$cadena="
                        
                            <div class='row'>
                            <div class='col-12 pt-2'>
                                <div class='letra'><b>DESCRIPCION
                                
                                
                                <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
                                </b></div>
                            </div>
                            
                           </div>
                ";
                $result = $conn->query("SELECT * FROM cotizacion_detallada  where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' ORDER BY id_producto");
                while ($ver=mysqli_fetch_row($result)) {
                    $prec=1*$ver[4];
                    $decimales = number_format($prec,2);
                    $cadena=$cadena."
                                    <div class='row'>
                                    <div class='col-12 pt-2'>
                                        <div class='letra'>
                                        
                                        
                                        <div class='panel-group pt-3'>
                                            <div class='panel panel-default'>
                                                <a class='btn btn-light btn-block' href='#c$ver[1]' data-toggle='collapse'>
                                                    <h4>
                                                        <i class='fas fa-chevron-down' style='float:left;'></i>
                                                        &nbsp;&nbsp;
                                                        <span style='float:left;'>$ver[2]</span>
                                                        <span style='float:right;'>
                                                        
                                                        <input name='elim' value='$ver[1]' style='display:none;'>
                                        <button id='elicar$ver[1]'  value='$ver[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo($ver[1])'><o class='fa fa-times'></o></button>
                                                        
                                                        
                                                        </span>
                                                        <span style='float:right;'>$$decimales &nbsp;&nbsp;</span>

                                                    </h4>
                                                    &nbsp;
                                                </a>
                                                <div id='c$ver[1]' class='panel-collapse collapse'>
                                                    <ul class='list-group'>";
                                                    
                                            $partcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$ver[1]'");
                                                     while ($vi=mysqli_fetch_row($partcomp)) {
                                                          $p=0;
                                                         $p=$vi[3]*$vi[4];
                                                         $deci = number_format($p,2);
                                                      $cadena=$cadena."  <li class='list-group-item' style='margin-left:20px;'>
                                                      
                                                      
                                                      
                                                      <button id='elipartcarr$vi[1]'  value='$vi[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi[1])' style='float:right;'><o class='fa fa-times'></o></button>
                                                      
                                                      <span class='letche'> $vi[2]</span><span style='float:right;'>$$deci </span></li>";
                                                     }
                                                        //<input type='checkbox' id='compopc$vi[1]' name='compopc$vi[1]' value='$vi[1]'>


                                                   $cadena=$cadena." </ul>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        </div>
                                    </div>
                                    
                                    </div>
                    ";
                }
		$subt=0;
		$resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos'");
                $reg= $resulti->num_rows;
                while ($vari=mysqli_fetch_row($resulti)){
                    $subt = $subt+$vari[4];
                }
                $decimales_sub = number_format($subt,2);
                echo "<span style='float:right;'><b>SUBTOTAL $".$decimales_sub."</b> </span><br>";
                echo $cadena."</divv>";
               echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()'>SIGUIENTE</button>";
		break;
	   case 11:
		$cadena="
		
				<div class='table-responsive'>
				<table class='table table-striped table-bordered' style='margin-bottom: 0'>	
					<thead>
						<tr>
							<th>ID</th>
							<th>DESCRIPCION</th>
							<th>CATEGORIA</th>
							<th>UDM</th>
							<th>SE VENDE</th>
							<th>ELIMINAR</th>
							<th>EDITAR </th>
						</tr>
					</thead>
					<tbody>
						
						";
				$resulti = $conn->query("SELECT * FROM productos ORDER BY id");
				
				while ($vari=mysqli_fetch_row($resulti)){
                    $ressss=$conn->query("SELECT * FROM categoria");
                    $nomcategoria="";
                    while($varo=mysqli_fetch_row($ressss)){
                        if($vari[1]==$varo[0]){
                            $nomcategoria=$varo[1];
                        }
                        
                    }
				$cadena=$cadena."
								<tr>
									<td>$vari[0]</td>
									<td>$vari[2]</td>
									<td>$nomcategoria</td>
									<td>PZA</td>
									<td>SI</td>
									<td><button id='elicar' class='btn btn-danger btn-sm' Onclick='elimcompo($vari[0])' ><o class='fa fa-times'></o></button></td>
                                    <td><form action='editarcomponente' method='post'><input class='d-none' name='indice' value='$vari[0]'><button name='editcomp' type='submit' value='2' id='editcomp$vari[0]' class='btn btn-warning btn-sm' ><o class='fas fa-edit'></o></button></form></td>
									
								</tr>";
			
		}
		$cadena=$cadena."
					</tbody>
				</table>
				</div>";
		echo $cadena;
		
		break;
		case 12:
		$cadena="<select id='cat' name='cat' class='input-100' required>
					<option disabled selected value='0'>SELECCIONAR CATEGORIA</option>
				";
		
		$result=$conn->query("SELECT * FROM categoria ORDER BY id_cat");
		while ($var=mysqli_fetch_row($result)){
			$cadena=$cadena."<option value=$var[0]>$var[1]</option>";
		}
			
	  						
		  					
		  					
		  				echo $cadena."</select>";
		break;
		case 13:
		$cadena="<select  name='catcom' class='form-control'>
					<option disabled selected>CATEGORIA</option>
				";
				$result=$conn->query("SELECT * FROM categoria");
				while ($var=mysqli_fetch_row($result)){
					$cadena=$cadena."<option value=$var[0]>$var[1]</option>";
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
				<table class='table table-striped' >	
					<thead>
						<tr>
							<th>ID</th>
							<th>NOMBRE</th>
						</tr>
					</thead>
					<tbody>
						
						";
				$resulti = $conn->query("SELECT * FROM categoria ORDER BY id_cat");
				
				while ($vari=mysqli_fetch_row($resulti)){
				$cadena=$cadena."
								<tr>
									<td>$vari[0]</td>
									<td>$vari[1]</td>
								</tr>";
			
		}
		$cadena=$cadena."
					</tbody>
				</table>
				</div>";
		echo $cadena;

		break;
		case 16:
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
				
				while ($vari=mysqli_fetch_row($resulti)){
					$rol="";
					if($vari[5]==1){
						$rol="ADMINISTRADOR";
					}else{
						$rol="VENDEDOR";
					}
					
				$cadena=$cadena."
								<tr>
									<td>$vari[0]</td>
									<td>$vari[1]</td>
									<td>$vari[2]</td>
									<td>$vari[4]</td>
									<td>$rol</td>
									<td> ";if($vari[0]!=1){ $cadena=$cadena."<button value='$vari[0]' id='eliusua$vari[0]' class='btn btn-danger btn-sm'  Onclick='eliminarUsuario($vari[0])'><o class='fa fa-times'></o></button>";} $cadena=$cadena."</td>";
									$cadena=$cadena."<td><form action='editarusuario' method='post'><input class='d-none' name='indice' value='$vari[0]'><button name='editusua' type='submit' value='2' id='editusua$vari[0]' class='btn btn-warning btn-sm' ><o class='fas fa-edit'></o></button></form></td>
									
								</tr>";
			
		}
		$cadena=$cadena."
					</tbody>
				</table>
				</div>";
		echo $cadena;
			
		break;
		case 18:
			$rol=$_POST['rolusu'];
			$nombre=$_POST['nomusu'];
			$usuario=$_POST['nickusu'];
			$contrasena=$_POST['conusu'];
			$correo=$_POST['corusu'];
		
		    $resultt=$conn->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
			$reg= $resultt->num_rows;
			
			if($reg>0){
				echo "<script type=\"text/javascript\">alert(\"YA EXISTE UN USUARIO CON ESTE NICKNAME\"); window.location.href = './agregarusuario.php'; </script>";  
			}else{
				$result = $conn->query("INSERT INTO usuarios(nombre,usuario,pass,correo,rol) values('$nombre','$usuario','$contrasena','$correo','$rol')");
				echo "<script type=\"text/javascript\">alert(\"USUARIO CREADO CORRECTAMENTE\"); window.location.href = './usuarios.php'; </script>";  
			}
		
		
			
			
			
		break;
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
				
				while ($vari=mysqli_fetch_row($resulti)){
					$rol="";
					if($vari[5]==1){
						$rol="ADMINISTRADOR";
					}else{
						$rol="VENDEDOR";
					}
				$cadena=$cadena."
								<tr>
									<td>$vari[0]</td>
									<td>$vari[1]</td>
									<td>$vari[2]</td>
									<td>$vari[4]</td>
									<td>$rol</td>
									<td> ";if($vari[0]!=1){ $cadena=$cadena."<button value='$vari[0]' id='eliusua$vari[0]' class='btn btn-danger btn-sm'  Onclick='eliminarUsuario($vari[0])'><o class='fa fa-times'></o></button>";} $cadena=$cadena."</td>";
									$cadena=$cadena."<td><form action='editarusuario' method='post'><input class='d-none' name='indice' value='$vari[0]'><button name='editusua' type='submit' value='2' id='editusua$vari[0]' class='btn btn-warning btn-sm' ><o class='fas fa-edit'></o></button></form></td>
									
								</tr>";
			
		}
		$cadena=$cadena."
					</tbody>
				</table>
				</div>";
		echo $cadena;
			
		break;
	case 20:
			$idusuu=$_POST['idusu'];
			$rol=$_POST['rolusu'];
			$nombre=$_POST['nomusu'];
			$usuario=$_POST['nickusu'];
			$contrasena=$_POST['conusu'];
			$correo=$_POST['corusu'];
            $resultt=$conn->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
			$reg= $resultt->num_rows;
			
		$result = $conn->query("UPDATE usuarios SET nombre='$nombre', usuario='$usuario', pass='$contrasena', correo='$correo', rol='$rol' WHERE  id_usuario='$idusuu'");
				
				
		echo "<script type=\"text/javascript\">alert(\"USUARIO EDITADO CORRECTAMENTE\"); </script>";  
			
				    $user=$_SESSION['usuario'];
					$ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
					$reg= $ressull->num_rows;
						if($reg==0){
							echo "<script type=\"text/javascript\">alert(\"EDITASTE AL USUARIO ACTUAL, SE CERRARA LA SESION\"); </script>";  
							header("Refresh:1; url=index.php");
							session_destroy();
							
						}else{
							echo "<script type=\"text/javascript\"> window.location.href = './usuarios.php'; </script>";  
							
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
				
				while ($vari=mysqli_fetch_row($resulti)){
				$cadena=$cadena."
								<tr>
									<td>$vari[0]</td>
									<td>$vari[1]</td>
									<td><button id='elicat' Onclick='elimCat($vari[0])' class='btn btn-danger btn-sm' ><o class='fa fa-times'></o></button></td>
									<td><button id='editcat' class='btn btn-warning btn-sm' ><o class='fas fa-edit'></o></button></td>
									
								</tr>";
			
		}
		$cadena=$cadena."
					</tbody>
				</table>
				</div>";
        echo $cadena;
        break;
//////////////////////////////////////APERTURA CARRITO YA CON EL ROTATORIO/////////////////////////        
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
        
             while($var=mysqli_fetch_row($result)){
                 
                 if($var[0]==$sistema){
                    $sistemaa=$var[2]; 
                 }else if($var[0]==$plataforma){
                    $plataformaa=$var[2];  
                 }else if($var[0]==$capacidad){
                    $capacidada=$var[2];  
                 }else if($var[0]==$unidad){
                    $unidada=$var[2];  
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
            $result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = c.id and padre=0 and id_cat=6");
            $val=0;
        
            $cadenaa="";
            $cadena="<button id='btnmosca' type='submit' name='submit' value='' class='btn btn-success btn-xl btn-block '><a class='letraaa'>SELECCIONAR</a></button>
            
            <div class='card-columns pt-3'>";
            $i=0;
			while ($ver=mysqli_fetch_row($result)) {
                
               
                    $cadena=$cadena."
                                     
                                <div class='card tco border-primary' >
                                    <div class='card-header bg-primary'><span class='letche'>$ver[2]</span></div>
                                    <div class='card-body'>";
                 $resultt = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre =$ver[0]");
                $j=0;
                while ($var=mysqli_fetch_row($resultt)) {
                    $pad=$var[0];
                    $resulttt = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id  and O.padre =$pad");
                    $reg= $resulttt->num_rows;
                        //echo "---->".$reg."<-----"; 
                    
                    if($reg>0){
                        $cadena=$cadena."
                        <div class='panel-group pt-3' >
                                  <div class='panel panel-default'>
                                    <a class='btn btn-light btn-block' href='#c$ver[0]c$pad' data-toggle='collapse'>
                                      <h4>
                                        <span style='float:left;'>$var[2]</span>
                                        <i class='fas fa-chevron-down' style='float:right;'></i>
                                      </h4>
                                      &nbsp;
                                    </a>
                                    <div id='c$ver[0]c$pad' class='panel-collapse collapse'>
                                      <ul class='list-group'>";
                                         while ($vir=mysqli_fetch_row($resulttt)) {
                                             $cadena=$cadena."<li class='list-group-item' style='margin-left:20px;'><input type='checkbox' id='compopc$vir[0]' name='compopc$vir[0]' value='$vir[0]'><span class='letche'> $vir[2]</span></li>";
                                         }
                        
                                    $cadena=$cadena."
                                      </ul>
                                      
                                    </div>
                                  </div>
                                </div> 
                                ";
                       // echo $cad;
                        
                    }else{
                        $cadena=$cadena."
                                     <input type='checkbox' id='compopc$var[0]' name='compopc$var[0]' value='$var[0]'><span class='letche'> $var[2]</span><br>
                    
                    
                                    ";
                        
                    }
                    
                    $j++;
                }
                $cadena=$cadena. "</div>
                </div>
                ";
                $i++;
			}

			echo  $cadena."</div>";
			
        
        break;
//////////////////////////////////////CLAUSURA CATEGORIAS OPCIONALES////////////////////////////          
        case 24:
            $i=0;
            $catopc=array();
            $compcatop= array();
            $todosnom=array();
            $todosnoum=array();
            $result = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = c.id and padre=0 and id_cat=6");
            while ($ver=mysqli_fetch_row($result)) {
                $catopc[$i]=$ver[0];
                $i++; 
            }
        // var_dump($catopc);
            $k=0;
            $l=0;
            for($j=0;$j<count($catopc);$j++){ $id=$catopc[$j]; $resultt=$conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = c.id and padre='$id'");
                while ($var=mysqli_fetch_row($resultt)) {
                       // echo $k;
                        $compcatop[$k]=$var[0];

                        $idart=$compcatop[$k];
                        $resultttt = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre =$idart");
                        $reg= $resultttt->num_rows;
                       // echo "---->".$reg."<-----"; 
                        if($reg>0){
                                while ($vor=mysqli_fetch_row($resultttt)) {
                                    $todosnom[$l]=$vor[2];
                                    $todosnoum[$l]=$vor[0];
                                    $l++;
                                }

                        }else{
                            $todosnom[$l]=$var[2];
                            $todosnoum[$l]=$var[0];
                            $l++;
                        }

                            $k++;
                }
            }
       // echo "<br>".$j."<br>";
       // echo $k."<br>";
        
       // var_dump($compcatop);
        //var_dump($todosnom);
       // var_dump($todosnoum);
         $user=$_SESSION['usuario'];
        $idsession=$_SESSION['num'];
                  $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
                  while($vat=mysqli_fetch_row($ressull)){
                    $iduss=$vat[0];
                  }
       // var_dump($todosnoum);
        for ($m=0;$m<count($todosnoum);$m++){
            
            
            
            $check="compopc".$todosnoum[$m];
            if(isset($_POST[$check])){
                //echo $_POST[$check]."<br>";
                $idinsert=$_POST[$check];
                //echo $idinsert;
                $resul=$conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.hijo='$idinsert'");
                $reg= $resul->num_rows;
                   // echo "fue el num ".$reg;
                $o=0;
                while($x=mysqli_fetch_row($resul)){ 
                    //echo "quitoy".$idsession;
                    if($o==0){
                     
                        
                     $resull = $conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,cantidad,precio,id_usuario,idsession) values('$x[0]','$x[0]','$x[2]',0,'0','$iduss','$idsession')");
                        $o++;
                    }
                  
                }
                
                
            
                
            
        
        
        
              $contcompid=array();
             $contcomprelaid=array();
            $contcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE idsession='$idsession' and id_producto='$idinsert' and id_component='$idinsert'");
            $regcocom= $contcomp->num_rows;
        if($regcocom>0){
            $u=0;
                 while ($var=mysqli_fetch_row($contcomp)) {
                     $contcompid[$u]=$var[1];
                     $u++;
                     $contcomprela=$conn->query("SELECT * FROM relacion_producto WHERE padre='$var[1]'");
                         $v=0;
                         while ($ver=mysqli_fetch_row($contcomprela)) {
                             $contcomprelaid[$v]=$ver[1];
                               $contcompsap=$conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$var[1]' and  C.id_producto_madero='$ver[1]'");
                                 while ($vor=mysqli_fetch_row($contcompsap)) {
                                     $contcompsapinst=$conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,id_usuario,idsession,cantidad) values('$var[1]','$vor[4]','$vor[2]','$vor[3]','$iduss','$idsession','$vor[9]')");
                                 }
                              
                             $v++;
                         }
                     //var_dump($contcomprelaid);
                 }
              //var_dump($contcompid);
            
                 for($i=0;$i<count($contcompid);$i++){
                    $sub=0;
                    $s=0;
                    $subtotal=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$contcompid[$i]'");
                     while ($mon=mysqli_fetch_row($subtotal)){
                         $s=$mon[3]*$mon[4];
                         $sub=$sub+$s;
                    }  
                    $total=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession'and id_producto='$contcompid[$i]'");
                    
                }
              
        }}}
       print "<img style='display:block;position:absolute;left:37.5%;width:25%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/loa.gif' />";
       
        header("Refresh:1; url=carrito");
        
        break;
        
        case 26:
        
       /* $currentDir = getcwd();
        $img = $_POST['fd'];

       // $fileSize = $_FILES[$img]['size'];
        $nombreImg = "imagen".$_POST['comid'];
        $fileTmpName = $_FILES[$img]['tmp_name'];
        
        
        $nuevoNombreImagen = $nombreImg;
        $uploadPath = $currentDir."/img/".basename($nuevoNombreImagen);
        $didupload = move_uploaded_file($fileTmpName,$uploadPath);*/
        
        
        
        
        $id_cat= $_POST['comcat'];
        $idcomp=$_POST['comid'];
        $nomcomp=$_POST['comnom'];
        $descomp=$_POST['comdes'];
        $result=$conn->query("INSERT INTO productos(id,id_cat, nombre, descripcion) values('$idcomp','$id_cat', '$nomcomp', '$descomp')");
        if($id_cat==1 or $id_cat==6){
            $resul=$conn->query("INSERT INTO relacion_producto(padre, hijo) values(0,'$idcomp')");
        }
            
        
        
        $cadea="
        
         
        
        
        <br><input type='text' name='txtpieza' id='txtpieza' class='input-100' placeholder='TECLA EN NOMBRE DEL COMPONENTE' value'' onkeyup=\"busqueda();\"><br>";
		
		echo $cadea;	
        break;
        
 ///////////////// APERTURA-BUSCADOR DE PARTES, COMPONENTES, UNIDADES, TAMAÑOS, PLATAFORMAS/////////////////////////////           
        case 33:
            $tmp="";
            $cadena="";
            $id_categoria="";
            $id_categoria=$_POST['idcat'];
         
            if($id_categoria==6 or $id_categoria==7){
                $idcatcat=8;
            }else{
                $idcatcat=$id_categoria+1;
            }
            //echo "<script type=\"text/javascript\">alert(\"la categoria es $id_categoria\");</script>"; 
            //$result=$conn->query("SELECT nombre_producto_sap FROM productos_sap");
        
        
        
        
        $ressss=$conn->query("SELECT * FROM categoria WHERE id_cat='$id_categoria'");
            $nomcategoria="";
            while($varo=mysqli_fetch_row($ressss)){

                    $nomcategoria=$varo[1];
        
            }
        
        
        
        
        
         if($nomcategoria=="COMPONENTE" || $nomcategoria=="COMPONENTE OPCIONAL"){  
            if($_POST["texto"]!=""){
                
               
                    $result=$conn->query("SELECT nombre_producto_sap, id_producto_madero, a FROM productos_sap WHERE (nombre_producto_sap LIKE '%".$_POST["texto"]."%' OR id_producto_madero LIKE '%".$_POST["texto"]."%') ORDER BY nombre_producto_sap");
                
                
                
                
                $reg= $result->num_rows;
               // echo "<script type=\"text/javascript\">alert(\"ayuda\");</script>"; 
                
                if($reg>0){

                $tmp=" <table class='table table-striped'>
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
                                <td class='letra'  style='width:70%'>".$row["nombre_producto_sap"]."</td>
                                <td  style='width:15%'>";
                                    $tmp.="<input class='letra' type='text' maxlength='6'  id='numcom$id_hijo' style='max-width:70px; max-height: 30px; text-align:center' value='1' ></td>
                                    <td  style='width:15%'>
                                    
                                    <button style='max-width:100px; max-height: 30px; text-align:left 'type='button' class='btn-enviara letra' Onclick='agregarnuevocomponete($id_hijo);' value='$id_hijo' name='btnagrnvo'><a style='float:left;' class='letra'>AGREGAR</a></button>
                                    
                                    </td>";
                                    }
                        
                            
                        //}
                        
                        
                   


                        }
                        $tmp.="
                    </tr>
                </table>";
                }
                }}else{
                if($_POST["texto"]!=""){
                    
                    
                 if($id_categoria==6){
                     $result=$conn->query("SELECT * FROM productos WHERE (nombre LIKE '%".$_POST["texto"]."%' OR id LIKE '%".$_POST["texto"]."%') AND (id_cat='$idcatcat' or id_cat=7) ORDER BY nombre");
                    $reg= $result->num_rows; 
                 }else{
                     $result=$conn->query("SELECT * FROM productos WHERE (nombre LIKE '%".$_POST["texto"]."%' OR id LIKE '%".$_POST["texto"]."%') AND (id_cat='$idcatcat') ORDER BY nombre");
                    $reg= $result->num_rows;
                 }   
                
                
                
                if($reg>0){

                $tmp="<br><br> <table class='table table-striped'>
                    <tr>
                        <td >NOMBRE</td>
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
                                <td style='width:70%'  class='letra'>".$row["nombre"]."</td>
                                <td>";
                                    $tmp.="<input  class='letra' type='text' style='display:none;' id='numcom' style='max-width:70px; max-heith:30px; text-align:center' value='1' ></td>
                                    <td><button type='button' class='btn-enviara letra' Onclick='agregarnuevocomponete($id_hijo);' value='$id_hijo' name='btnagrnvo' style='max-width:100px; max-heith:30px; text-align:left'><a class='letra' style=' text-align:left''>AGREGAR</a></button></td>";
                                    }
                            
                        //}
                        
                        
                   


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

                $cadena=" <table class='table table-striped'>
                    <tr>
                        
                        <td style='width:70%'  class='letra verdesitoo'>NOMBRE</td>
                        <td style='width:30%' class='letra verdesitoo'></td>

                    </tr>
                    ";
                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $cadena.="<tr>
                        
                        <td  class='letra verdesito' style='width:75%'><img style='width:18px' src='img/x.png' Onclick='quitarcomp(".$row["id_producto_madero"].")'> &nbsp".$row["nombre_producto_sap"]."</td>
                        <td class='letra verdesito' style='width:25% float:right;'>";
                            
                            $cadena.="
                            
                            
                            <img  class='letra' style='width:20px' src='img/minus.png' Onclick='quitarcantidad(".$row["id_producto_madero"].")'>
                            <input  class='letra' type='text' disabled style='max-width:70px; max-height: 15px; text-align:center' value='".$row["cantidad"]."' >
                            
                            <img  class='letra' style='width:20px' src='img/plus.png' Onclick='sumarcantidad(".$row["id_producto_madero"].")'>
                            
                        </td>";
                        }
                   // <input type='button' class='btn-enviarr' value='+' Onclick='sumarcantidad(".$row["id_producto_madero"].")'>
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
               
                <table class='table table-striped'>
                    <tr>
                    <td class='letra verdesitoo'></td>
                        <td style='width:100%' class='letra verdesitoo'>NOMBRE</td>
                        <td class='letra verdesitoo'></td>

                    </tr>
                    ";
                    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    $cadena.="<tr>
                    <td class='verdesito letra'><img style='width:18px' src='img/x.png' Onclick='quitarcomp(".$row["id"].")'></td>
                        <td class='verdesito letra' style='width:100%'>".$row["nombre"]."</td>
                        <td>";
                            
                            /*$cadena.="
                            <button class='btn btn-danger' value='".$row["id"]."'><i class='fas fa-minus' Onclick=''></i></button>
                            <input type='text' disabled style='max-width:50px; text-align:center' value='".$row["cantidad"]."' >
                            <button class='btn btn-success'><i class='fas fa-plus' Onclick=''></i></button>
                        </td>";*/
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
        
        case 35:
        $idsuma=$_POST['idsuma'];
        $idpadre=$_POST['idpadre'];
        $result= $conn->query("SELECT * FROM relacion_producto WHERE padre='$idpadre' and hijo='$idsuma'");
        $catidad=0;
        while($x=mysqli_fetch_row($result)){ 
            $cantidad=$x[2] + 1;
        }     
        
        $resultt=$conn->query("UPDATE relacion_producto SET cantidad='$cantidad' WHERE padre='$idpadre' and hijo='$idsuma' ");
        break;
        
        case 36:
        $idsuma=$_POST['idresta'];
        $idpadre=$_POST['idpadre'];
        $result= $conn->query("SELECT * FROM relacion_producto WHERE padre='$idpadre' and hijo='$idsuma'");
        $catidad=0;
        while($x=mysqli_fetch_row($result)){ 
            $cantidad=$x[2] - 1;
        }   
        if($cantidad<1){
            $resultt=$conn->query("DELETE FROM relacion_producto WHERE padre='$idpadre' and hijo='$idsuma' ");
        }else{
            $resultt=$conn->query("UPDATE relacion_producto SET cantidad='$cantidad' WHERE padre='$idpadre' and hijo='$idsuma' ");
        }
        
        
        break;
 ///////////////// CIERRE-BUSCADOR DE PARTES, COMPONENTES, UNIDADES, TAMAÑOS, PLATAFORMAS/////////////////////////////  
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
        print "<img style='display:block;position:absolute;left:42.5%;width:15%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/loadi.gif' />";
             header("Refresh:1; url=productos.php");
        break;
    /////////////////////////CIERRE ACTUALIZAR COMPONENTE /////////////////////////////////////////////////////////////
/////////////////////////APERTURA MOSTRAR CARRITO FINAL/////////////////////////////////////////////////////////////
        case 40:
         $user=$_SESSION['usuario'];
         $idsession=$_SESSION['num'];
         $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
         while($vat=mysqli_fetch_row($ressull)){
             $iduss=$vat[0];
         }
        $cot=array();
        $cott=array();
        $i=0;
       
        $result=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession'");
        while($var=mysqli_fetch_row($result)){
                 $cot[$i]=$var[0];
                $i++;
        }
        
        //var_dump($cot);
        
        for($j=0;$j<count($cot);$j++){
            $resul=$conn->query("SELECT * FROM productos WHERE id='$cot[$j]' and (id_cat='5' or id_cat='8')");
            while($ver=mysqli_fetch_row($resul)){
                $cott[$j]=$ver[0];
                // echo $ver[0]."---".$ver[1]."<br>";
            }
           
        }
        $aa=array();
        //$resultado = array_unique($cott);
        $resultado =  array_values(array_unique($cott));
        //var_dump($cott);
        //var_dump($resultado);
        
         $n=0;
        for($m=0;$m<count($resultado);$m++){
            
             $resultt=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_producto='$resultado[$m]' and id_usuario='$iduss' and idsession='$idsession'");
           
            while($vor=mysqli_fetch_row($resultt)){
                //echo "este es".$vor[1];
                $aa[$n]=$vor[1];
                $n++;
            }
        }
       //var_dump($aa);
        
        $user=$_SESSION['usuario'];
        $idsession=$_SESSION['num'];
					$ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
					while($vat=mysqli_fetch_row($ressull)){
						$iduss=$vat[0];
						
					}
        
        
        
		$cadena="
                        
                            <div class='row'>
                            <div class='col-12 pt-2'>
                                <div class='letra'><b>DESCRIPCION
                                
                                
                                <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
                                </b></div>
                            </div>
                            
                           </div>
                ";
        
               for($o=0;$o<count($aa);$o++){
                $result = $conn->query("SELECT * FROM cotizacion_detallada  where id_usuario='$iduss' and idsession='$idsession' and id_producto='$aa[$o]' ORDER BY id_producto");
                while ($ver=mysqli_fetch_row($result)) {
                    $prec=1*$ver[4];
                    $decimales = number_format($prec,2);
                    $cadena=$cadena."
                                    <div class='row'>
                                    <div class='col-12 pt-2'>
                                        <div class='letra'>
                                        
                                        
                                        <div class='panel-group pt-3'>
                                            <div class='panel panel-default'>
                                                <a class='btn btn-light btn-block' href='#c$ver[1]' data-toggle='collapse'>
                                                    <h4>
                                                        <i class='fas fa-chevron-down' style='float:left;'></i>
                                                        &nbsp;&nbsp;
                                                        <span style='float:left;'>$ver[2]</span>
                                                        <span style='float:right;'>
                                                        
                                                        <input name='elim' value='$ver[1]' style='display:none;'>
                                        <button id='elicar$ver[1]'  value='$ver[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarritooo($ver[1])'><o class='fa fa-times'></o></button>
                                                        
                                                        
                                                        </span>
                                                        <span style='float:right;'>$$decimales &nbsp;&nbsp;</span>

                                                    </h4>
                                                    &nbsp;
                                                </a>
                                                <div id='c$ver[1]' class='panel-collapse collapse'>
                                                    <ul class='list-group'>";
                                                    
                                            $partcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$ver[1]'");
                                                     while ($vi=mysqli_fetch_row($partcomp)) {
                                                          $p=0;
                                                         $p=$vi[3]*$vi[4];
                                                         $deci = number_format($p,2);
                                                         if($ver[0]!=$vi[1]){
                                                      $cadena=$cadena."  <li class='list-group-item' style='margin-left:20px;'>
                                                      
                                                      
                                                      
                                                      <button id='elipartcarr$vi[1]'  value='$vi[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarrit($vi[1])' style='float:right;'><o class='fa fa-times'></o></button>
                                                      
                                                      <span class='letche'> $vi[2]</span><span class='letche' style='float:right;'>$$deci &nbsp; </span></li>";
                                                     }}
                                                        //<input type='checkbox' id='compopc$vi[1]' name='compopc$vi[1]' value='$vi[1]'>


                                                   $cadena=$cadena." </ul>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        </div>
                                    </div>
                                    
                                    </div>
                    ";
                }}
		$subt=0;
        
        
		$resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and cantidad=0 ");
                $reg= $resulti->num_rows;
                while ($vari=mysqli_fetch_row($resulti)){
                    $subt = $subt+$vari[4];
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
         while($vat=mysqli_fetch_row($ressull)){
            $iduss=$vat[0];

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
         while($vat=mysqli_fetch_row($ressull)){
            $iduss=$vat[0];

         }
        $elim=$_POST['elimpartfinal'];
        
        $resul=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_producto='$elim' and id_usuario='$iduss' and idsession='$idsession'");
        $padre=0;
        while($var=mysqli_fetch_row($resul)){
            $padre=$var[0];
        }
        //echo $padre;
        
        //echo "<script type=\"text/javascript\">alert(\"vamos a eliminar $elim\");</script>"; 
                $result=$conn->query("DELETE FROM cotizacion_detallada WHERE id_producto='$elim' and id_usuario='$iduss' and idsession='$idsession'");
        
        $res=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_component='$padre' and id_usuario='$iduss' and idsession='$idsession' ");
        $sub=0;
        $s=0;
        while($ver=mysqli_fetch_row($res)){
            if($ver[0]!=$vi[1]){
            $sub=$ver[3]*$ver[4];
            $s=$s+$sub;
            }
            
           // echo "<script type=\"text/javascript\">alert(\" este $ver[3] por este $ver[4] es igual a $sub  s $s\");</script>"; 
        }
        
        
        //echo "<script type=\"text/javascript\">alert(\"deci $deci\");</script>"; 
        $re=$conn->query("UPDATE cotizacion_detallada SET precio='$s' WHERE id_producto='$padre' and id_usuario='$iduss' and idsession='$idsession' ");
        
        
        
                
        break;
/////////////////////////CIERRE ELIMINAR PARTES CARRITO FINAL/////////////////////////////////////////////////////////////
/////////////////////////APERTURA DESCUENTO CARRITO FINAL/////////////////////////////////////////////////////////////
        case 43:
             $user=$_SESSION['usuario'];
             $idsession=$_SESSION['num'];
             $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
             while($vat=mysqli_fetch_row($ressull)){
                $iduss=$vat[0];
             }
        
        $precio=0;
        $resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and cantidad=0 ");
                $reg= $resulti->num_rows;
                while ($vari=mysqli_fetch_row($resulti)){
                    $precio = $precio+$vari[4];
                    
                }
        $rr=$conn->query("UPDATE rotatorio SET precio='$precio'  WHERE id_usuario='$iduss' and idsession='$idsession'");
        $m=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
        while($r=mysqli_fetch_row($m)){
            $ee=$r[8];
            //echo $ee;
           if($ee==0.000000){
               $ivv=$precio*.16; 
                
                $tt=$precio+$ivv+$ee;

                $subttt=$precio+$ivv;

                $rrr=$conn->query("UPDATE rotatorio SET sub='$subttt', iva='$ivv',total='$tt' WHERE id_usuario='$iduss' and idsession='$idsession'");
           }
            
        }
        
        
               
        
        
        
        
        $sistema="";
        $plataforma="";
        $capacidad="";
        $unidad="";
        $precio="";
        $decuento=0;
        $iva=0;
        $subtotal=0;
        $gastos=0;
        $total=0;
              $result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
                while($var=mysqli_fetch_row($result)){
                    $sistema=$var[1];
                    $plataforma=$var[2];
                    $capacidad=$var[3];
                    $unidad=$var[4];
                    $precio=$var[5];
                    $decuento=$var[6];
                    $iva=$var[7];
                    $subtotal=$var[8];
                    $gastos=$var[9];
                    $total=$var[10];
                }
        
                    
                    
                    $decuentos=number_format($decuento,2);
                    $ivas=number_format($iva,2);
                    $subtotals=number_format($subtotal,2);
                    $gastoss=number_format($gastos,2);
                    $totals=number_format($total,2);
                
        
         //$ss=$conn->query("UPDATE rotatorio SET iva='$sub', sub=''  WHERE id_usuario='$iduss' and idsession='$idsession'");
        
        
        
         $resultt=$conn->query("SELECT * FROM productos");
        while($ver=mysqli_fetch_row($resultt)){
            if($sistema==$ver[0]){
                $sistema=$ver[2];
            }else if($plataforma==$ver[0]){
                 $plataforma=$ver[2];
            }else if($capacidad==$ver[0]){
                 $capacidad=$ver[2];
            }else if($unidad==$ver[0]){
                 $unidad=$ver[2];
            }
        }
        
        
               $ggg = number_format($gastos,2);
         $decimales_sub = number_format($precio,2);
        
        
        $nombrerotatorio=$sistema." ".$plataforma." ".$capacidad." ".$unidad;
        $nomrot=$conn->query("UPDATE rotatorio SET nombre='$nombrerotatorio' WHERE id_usuario='$iduss' and idsession='$idsession'");
            $cadena="
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
                        <div class='col-7'><input style='width:25px; float:left' type='text' value='%' disabled> <input id='des' onblur='aplicardescuento()' style='float:left;' type='text' value='0'> $decuento% APLICADO</div>
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
                        <div class='col-2'>SUBTOTAL: </div>
                        <div class='col-7'>$$subtotals</div>
                        <div class='col-3'></div>
                    </div>
                    <br>
                     <div class='row'>
                        <div class='col-2'>GASTOS DE INSTALACION: </div>
                        <div class='col-7'><input style='width:25px; float:left' type='text' value='$' disabled> <input  id='gas' onblur='aplicargastos()' style='float:left;' type='text' value='0'> $ggg APLICADO </div>
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
             while($vat=mysqli_fetch_row($ressull)){
                $iduss=$vat[0];
             }
        
           $descuento=$_POST['cantdescuento'];
           $updes= $conn->query("UPDATE rotatorio SET descuento='$descuento' WHERE id_usuario='$iduss' and idsession='$idsession'");
           $result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
                $precio=0;
                $iva=0;
                $decuento=0;
                $subtotal=0;
                $gastos=0;
            
            if($ver=mysqli_fetch_row($result)){
                $precio=$ver[5];
                $decuento=$ver[6];
                $ctoInst = $ver[9]; 
            }
        
           $precio=$precio*((100-$descuento)/100);
           $iva=$precio*.16;
           $subtotal=$iva+$precio;
            $total = $subtotal+$ctoInst;
        
        $upde= $conn->query("UPDATE rotatorio SET total='$total', IVA='$iva', sub='$subtotal' WHERE id_usuario='$iduss' and idsession='$idsession'");
        
        
        
        
        
        
        break;
        
         case 45:
            $user=$_SESSION['usuario'];
             $idsession=$_SESSION['num'];
             $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
             while($vat=mysqli_fetch_row($ressull)){
                $iduss=$vat[0];
             }
        
           $gastos=$_POST['cantgasto'];
           $updes= $conn->query("UPDATE rotatorio SET ginstalacion='$gastos' WHERE id_usuario='$iduss' and idsession='$idsession'");
           
        
        $result=$conn->query("SELECT * FROM rotatorio WHERE id_usuario='$iduss' and idsession='$idsession'");
                $precio=0;
                $iva=0;
                $decuento=0;
                $subtotal=0;
                $gastos=0;
            
            if($ver=mysqli_fetch_row($result)){
                $precio=$ver[8];
                $decuento=$ver[6];
                $ctoInst = $ver[9]; 
            }
        
           $precio=$precio+$ctoInst;
           
           
        
        $upde= $conn->query("UPDATE rotatorio SET total='$precio' WHERE id_usuario='$iduss' and idsession='$idsession'");
        
        
        
        
        
        break;
        
        
/////////////////////////CIERRE DESCUENTO CARRITO FINAL/////////////////////////////////////////////////////////////
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        case 27:
       
        $cadena="";
            echo $cadena."<button type='Upload File Now' class='btn btn-success btn-lg btn-block'>AGREGAR</button>";
        break;
        case 28:
            $cadena="";
            echo $cadena;
        break;
        case 100:
            print "<img style='display:block;position:absolute;left:10%;width:75%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/largate.jpg' />";
      // header('location:http://www.imss.gob.mx/');
        
        break;

}


?>
