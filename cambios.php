<?php
		$user=$_SESSION['usuario'];
		$idsession=$_SESSION['num'];
		$ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
        while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
		      $iduss=$vat['id_usuario'];
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
		$result = $conn->query("SELECT * FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' ORDER BY id_producto");
        while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
		$prec=1*$ver['precio'];
        $decimales = number_format($prec,2);
        $ver1=$ver['id_producto'];
        $ver2=$ver['descripcion'];
		$cadena=$cadena."
		<div class='row'>
		    <div class='col-12 pt-2'>
		        <div class='letra'>
		            <div class='panel-group pt-3'>
		                <div class='panel panel-default'>
		                    <a class='btn btn-light btn-block' href='#c$ver1' data-toggle='collapse'>
		                        <h4>
		                            <i class='fas fa-chevron-down' style='float:left;'></i>
		                            &nbsp;&nbsp;
		                            <span style='float:left;'>$ver2</span>
		                            <span style='float:right;'>
		                                <input name='elim' value='$ver1' style='display:none;'>
		                                <button id='elicar$ver1' value='$ver1' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo($ver1)'>
		                                    <o class='fa fa-times'></o>
		                                </button>
		                            </span>
		                            <span style='float:right;'>$$decimales &nbsp;&nbsp;</span>
		                        </h4>
		                        &nbsp;
		                    </a>
		                    <div id='c$ver1' class='panel-collapse collapse'>
		                        <ul class='list-group'>";
		                            $partcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$ver1'");
                                    while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) {
		                            $p=0;
                                    $p=$vi['cantidad']*$vi['precio'];
                                    $deci = number_format($p,2);
                                    $vi1=$vi['id_producto'];
                                    $vi2=$vi['descripcion'];
		                            $cadena=$cadena." <li class='list-group-item' style='margin-left:20px;'>
		                                <button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right;'>
		                                    <o class='fa fa-times'></o>
		                                </button>
		                                <span class='letche'> $vi2</span><span style='float:right;'>$$deci </span></li>";
		                            }
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
        while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
		$subt = $subt+$vari['precio'];
		}
		$decimales_sub = number_format($subt,2);
		echo "<span style='float:right;'><b>SUBTOTAL $".$decimales_sub."</b> </span><br>";
		echo $cadena."</divv>";
		echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()'>SIGUIENTE</button>";




































































//        $resultt = $conn->query("SELECT * FROM productos WHERE id='$carritos'");
//                $reg= $resultt->num_rows;
//                while($ver = $resultt->fetch_array(MYSQLI_ASSOC)) {
//                        $user=$_SESSION['usuario'];
//                        $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
//                        $reg= $ressull->num_rows;
//                        while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
//                                $iduss=$vat['id_usuario'];
//                        }
//                        $resultta = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$carritos' ORDER BY id");
//                        $reg= $resultta->num_rows;
//                        $resulttaaaaa = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$carritos' ORDER BY id");
//                        $id_componentes= array();
//                        $i=0;
//                        $precioscompo=array();
//                        while($ids = $resulttaaaaa->fetch_array(MYSQLI_ASSOC)) {
//                                $id_componentes[$i]=$ids['id'];
//                                $id_componentes2=$ids['id'];
//                                $resulttaaaaat = $conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$id_componentes2'ORDER BY id_producto_madero");
//                                $id_partes= array();
//                                $totalcomponente=0;
//                                $totalcomponentee=array();
//                                $j=0;
//                                while($ids = $resulttaaaaat->fetch_array(MYSQLI_ASSOC)) {
//                                        $id_partes[$j]=$ids['id_producto_madero'];
//                                        $totalcomponente=$ids['precio_producto_sap'];
//                                        $totalcomponentee[$j]=$totalcomponente;
//                                        $j++;
//                                }
//                                $n=0;
//                                $total=array();
//                                $ccc=0;
//                                for($m=0;$m<count($id_partes);$m++){ 
//                                    $idsap=$id_partes[$m];
//                                    $cantidadporprecio=$conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$id_componentes2' and  C.id_producto_madero='$idsap'");    
//                                    while($mulpre = $cantidadporprecio->fetch_array(MYSQLI_ASSOC)) {
//                                            $b=$mulpre['precio_producto_sap'];
//                                            $b=number_format($b,8,'.','');
//                                            $a=$mulpre['precio_producto_sap']*$mulpre['cantidad'];
//                                    }
//                                    $total[$m]=$a;
//                                    $ccc=$ccc+$total[$m]; $n++;
//                                    $precioscompo[$i]=$ccc;
//                                }
//                                $i++;
//                        }
//                            $z=0;
//                            $precom=0;
//                            while($var = $resultta->fetch_array(MYSQLI_ASSOC)) {
//                                    $idsession=$_SESSION['num'];
//                                    $precom=$precioscompo[$z];
//                                    $precom=number_format($precom,8,'.','');
//                                    $id_comp=$var['padre'];
//                                    $id_prod=$var['id'];
//                                    $desc=$var['nombre'];
//                                    $resulttaaa = $conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,id_usuario,idsession) values('$id_comp','$id_prod','$desc','0','$iduss','$idsession')");
//                                    $z++;
//                            }
//                }
//
//        $sistema=$_POST['sistema'];
//        $plataforma=$_POST['plataforma'];
//        $capacidad=$_POST['capacidad'];
//        $unidad=$_POST['unidad'];
//        $rotatorio=$conn->query("INSERT INTO rotatorio(sistema,plataforma,capacidad,unidad,id_usuario,idsession) VALUES('$sistema','$plataforma','$capacidad','$unidad','$iduss','$idsession')");
//        $contcompid=array();
//        $contcomprelaid=array();
//        $contcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE idsession='$idsession'");
//        $regcocom= $contcomp->num_rows;
//        if($regcocom>0){
//                $u=0;
//                while($var = $contcomp->fetch_array(MYSQLI_ASSOC)) {
//                        $contcompid[$u]=$var['id_producto'];
//                        $padre=$var['id_producto'];
//                        $u++;
//                        $contcomprela=$conn->query("SELECT * FROM relacion_producto WHERE padre='$padre'");
//                        $v=0;
//                        while($ver = $contcomprela->fetch_array(MYSQLI_ASSOC)) {
//                                $contcomprelaid[$v]=$ver['hijo'];
//                                $hijo=$ver['hijo'];
//                                $contcompsap=$conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$padre' and C.id_producto_madero='$hijo'");
//                                while($vor = $contcompsap->fetch_array(MYSQLI_ASSOC)) {
//                                        $idprod=$vor['id_producto_madero'];
//                                        $descr=$vor['nombre_producto_sap'];
//                                        $preci=$vor['precio_producto_sap'];
//                                        $cant=$vor['cantidad'];
//                                        $contcompsapinst=$conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,id_usuario,idsession,cantidad) values('$padre','$idprod','$descr','$preci','$iduss','$idsession','$cant')");
//                                }
//                                $v++;
//                        }
//                }
//            
//                for($i=0;$i<count($contcompid);$i++){ 
//                        $sub=0; $s=0; $subtotal=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$contcompid[$i]'");
//                        while($mon = $subtotal->fetch_array(MYSQLI_ASSOC)) {
//                                $s=$mon['cantidad']*$mon['precio'];
//                                $sub=$sub+$s;
//                        }
//                        $total=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession'and id_producto='$contcompid[$i]'");
//                }
//        }
//        $cadena="
//        <div class='row'>
//            <div class='col-12 pt-2'>
//                <div class='letra'><b>DESCRIPCION
//                        <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
//                    </b></div>
//            </div>
//        </div>
//        ";
//        $result = $conn->query("SELECT * FROM cotizacion_detallada where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' ORDER BY id_producto");
//        while($ver = $result->fetch_array(MYSQLI_ASSOC)) {
//                $prec=1*$ver['precio'];
//                $decimales = number_format($prec,2);
//                $ver1=$ver['id_producto'];
//                $ver2=$ver['descripcion'];
//                $cadena=$cadena."
//                <div class='row'>
//                    <div class='col-12 pt-2'>
//                        <div class='letra'>
//                            <div class='panel-group pt-3'>
//                                <div class='panel panel-default'>
//                                    <a class='btn btn-light btn-block' href='#c$ver1' data-toggle='collapse'>
//                                        <h4>
//                                            <i class='fas fa-chevron-down' style='float:left;'></i>
//                                            &nbsp;&nbsp;
//                                            <span style='float:left;'>$$ver2</span>
//                                            <span style='float:right;'>
//                                                <input name='elim' value='$ver1' style='display:none;'>
//                                                <button id='elicar$ver1' value='$ver1' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo($ver1)'>
//                                                    <o class='fa fa-times'></o>
//                                                </button>
//                                            </span>
//                                            <span style='float:right;'>$$decimales &nbsp;&nbsp;</span>
//                                        </h4>
//                                        &nbsp;
//                                    </a>
//                                    <div id='c$ver1' class='panel-collapse collapse'>
//                                        <ul class='list-group'>";
//                                            $partcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$ver1'");
//                                            while($vi = $partcomp->fetch_array(MYSQLI_ASSOC)) {
//                                            $p=0;
//                                            $p=$vi['cantidad']*$vi['precio'];
//                                            $deci = number_format($p,2);
//                                            $vi1=$vi['id_producto'];
//                                            $vi2=$vi['descripcion'];
//                                            $cadena=$cadena." <li class='list-group-item' style='margin-left:20px;'>
//                                                <button id='elipartcarr$vi1' value='$vi1' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi1)' style='float:right;'>
//                                                    <o class='fa fa-times'></o>
//                                                </button>
//                                                <span class='letche'> $vi2 </span> <span class='letche' style='float:right;'>$$deci &nbsp;&nbsp;</span>
//                                            </li>";
//                                            }
//                                            $cadena=$cadena." </ul>
//                                    </div>
//                                </div>
//                            </div>
//                        </div>
//                    </div>
//                </div>
//                ";
//        }
//        $subt=0;
//        $resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos'");
//        $reg= $resulti->num_rows;
//        while($vari = $resulti->fetch_array(MYSQLI_ASSOC)) {
//        $subt = $subt+$vari['precio'];
//        }
//        $decimales_sub = number_format($subt,2);
//        echo "<span style='float:right;'><b>SUBTOTAL $".$decimales_sub."</b> </span><br>";
//        echo $cadena."</divv>";
//        echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()' class='letche'>SIGUIENTE</button>";
//                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
//                $resultt = $conn->query("SELECT * FROM productos WHERE id='$carritos'");
//                $reg= $resultt->num_rows;
//                while ($ver=mysqli_fetch_row($resultt)) {
//                        $user=$_SESSION['usuario'];
//                        $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
//                        $reg= $ressull->num_rows;
//                        while($vat=mysqli_fetch_row($ressull)){
//                                $iduss=$vat[0];
//                        }
//                        $resultta = $conn->query("SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$carritos' ORDER BY id");
//                        $reg= $resultta->num_rows;
//                        $resulttaaaaa = $conn->query(" SELECT * FROM productos C, relacion_producto O WHERE O.hijo = C.id and O.padre ='$carritos' ORDER BY id");
//                        $id_componentes= array();
//                        $i=0;
//                        $precioscompo=array();
//                        while ($ids=mysqli_fetch_row($resulttaaaaa)) {
//                                $id_componentes[$i]=$ids[0];
//                                $id_componentes2=$ids[0];
//                                $resulttaaaaat = $conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$id_componentes2'ORDER BY id_producto_madero");
//                                $id_partes= array();
//                                $totalcomponente=0;
//                                $totalcomponentee=array();
//                                $j=0;
//                                while ($ids=mysqli_fetch_row($resulttaaaaat)) {
//                                        $id_partes[$j]=$ids[4];
//                                        $totalcomponente=$ids[3];
//                                        $totalcomponentee[$j]=$totalcomponente;
//                                        $j++;
//                                }
//                                $n=0;
//                                $total=array();
//                                $ccc=0;
//                                for($m=0;$m<count($id_partes);$m++){ 
//                                    $idsap=$id_partes[$m];
//                                    while ($mulpre=mysqli_fetch_row($cantidadporprecio)) {
//                                            $b=$mulpre[3];
//                                            $b=number_format($b,8,'.','');
//                                            $a=$mulpre[3]*$mulpre[9];
//                                    }
//                                    $total[$m]=$a;
//                                    $ccc=$ccc+$total[$m]; $n++;
//                                    $precioscompo[$i]=$ccc;
//                                }
//                                $i++;
//                        }
//                            $z=0;
//                            $precom=0;
//                            while ($var=mysqli_fetch_row($resultta)) {
//                                    $idsession=$_SESSION['num'];
//                                    $precom=$precioscompo[$z];
//                                    $precom=number_format($precom,8,'.','');
//                                    $resulttaaa = $conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,id_usuario,idsession) values('$var[6]','$var[0]','$var[2]','0','$iduss','$idsession')");
//                                    $z++;
//                            }
//                }   
//$sistema=$_POST['sistema'];
//            $plataforma=$_POST['plataforma'];
//            $capacidad=$_POST['capacidad'];
//            $unidad=$_POST['unidad'];
//            $rotatorio=$conn->query("INSERT INTO rotatorio(sistema,plataforma,capacidad,unidad,id_usuario,idsession) VALUES('$sistema','$plataforma','$capacidad','$unidad','$iduss','$idsession')");  
//             $contcompid=array();
//             $contcomprelaid=array();
//             $contcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE idsession='$idsession'");
//            $regcocom= $contcomp->num_rows;
//        if($regcocom>0){
//            $u=0;
//                 while ($var=mysqli_fetch_row($contcomp)) {
//                     $contcompid[$u]=$var[1];
//                     $u++;
//                     $contcomprela=$conn->query("SELECT * FROM relacion_producto WHERE padre='$var[1]'");
//                         $v=0;
//                         while ($ver=mysqli_fetch_row($contcomprela)) {
//                             $contcomprelaid[$v]=$ver[1];
//                               $contcompsap=$conn->query("SELECT * FROM productos_sap C, relacion_producto O WHERE O.hijo = C.id_producto_madero and O.padre ='$var[1]' and  C.id_producto_madero='$ver[1]'");
//                                 while ($vor=mysqli_fetch_row($contcompsap)) {
//                                     $contcompsapinst=$conn->query("INSERT INTO cotizacion_detallada(id_component,id_producto,descripcion,precio,id_usuario,idsession,cantidad) values('$var[1]','$vor[4]','$vor[2]','$vor[3]','$iduss','$idsession','$vor[9]')");
//                                 }
//                              
//                             $v++;
//                         }
//                     //var_dump($contcomprelaid);
//                 }
//              //var_dump($contcompid);
//            
//                 for($i=0;$i<count($contcompid);$i++){
//                    $sub=0;
//                    $s=0;
//                    $subtotal=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$contcompid[$i]'");
//                     while ($mon=mysqli_fetch_row($subtotal)){
//                         $s=$mon[3]*$mon[4];
//                         $sub=$sub+$s;
//                    }  
//                    $total=$conn->query("UPDATE cotizacion_detallada SET precio='$sub' WHERE id_usuario='$iduss' and idsession='$idsession'and id_producto='$contcompid[$i]'");
//                    
//                }
//              
//        }
//                $cadena="
//                        
//                            <div class='row'>
//                            <div class='col-12 pt-2'>
//                                <div class='letra'><b>DESCRIPCION
//                                
//                                
//                                <span style='float:right;'>PRECIO&nbsp;&nbsp;</span>
//                                </b></div>
//                            </div>
//                            
//                           </div>
//                ";
//                $result = $conn->query("SELECT * FROM cotizacion_detallada  where id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos' ORDER BY id_producto");
//                while ($ver=mysqli_fetch_row($result)) {
//                    $prec=1*$ver[4];
//                    $decimales = number_format($prec,2);
//                    $cadena=$cadena."
//                                    <div class='row'>
//                                    <div class='col-12 pt-2'>
//                                        <div class='letra'>
//                                        
//                                        
//                                        <div class='panel-group pt-3'>
//                                            <div class='panel panel-default'>
//                                                <a class='btn btn-light btn-block' href='#c$ver[1]' data-toggle='collapse'>
//                                                    <h4>
//                                                        <i class='fas fa-chevron-down' style='float:left;'></i>
//                                                        &nbsp;&nbsp;
//                                                        <span style='float:left;'>$ver[2]</span>
//                                                        <span style='float:right;'>
//                                                        
//                                                        <input name='elim' value='$ver[1]' style='display:none;'>
//                                        <button id='elicar$ver[1]'  value='$ver[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarritoo($ver[1])'><o class='fa fa-times'></o></button>
//                                                        
//                                                        
//                                                        </span>
//                                                        <span style='float:right;'>$$decimales &nbsp;&nbsp;</span>
//
//                                                    </h4>
//                                                    &nbsp;
//                                                </a>
//                                                <div id='c$ver[1]' class='panel-collapse collapse'>
//                                                    <ul class='list-group'>";
//                                                    
//                                            $partcomp=$conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$ver[1]'");
//                                                        
//                                                     while ($vi=mysqli_fetch_row($partcomp)) {
//                                                         $p=0;
//                                                         $p=$vi[3]*$vi[4];
//                                                         $deci = number_format($p,2);
//                                                      $cadena=$cadena."  <li class='list-group-item' style='margin-left:20px;'>
//                                                      
//                                                      
//                                                      
//                                                      
//                                                      <button id='elipartcarr$vi[1]'  value='$vi[1]' class='btn btn-danger btn-sm' Onclick='eliminarCarrito($vi[1])' style='float:right;'><o class='fa fa-times'></o></button>
//                                                      
//                                                      <span class='letche'> $vi[2] </span> <span class='letche' style='float:right;'>$$deci &nbsp;&nbsp;</span>
//                                                      
//                                                      
//                                                      </li>";
//                                                     }
//                                                        //<input type='checkbox' id='compopc$vi[1]' name='compopc$vi[1]' value='$vi[1]'>
//
//
//                                                   $cadena=$cadena." </ul>
//
//                                                </div>
//                                            </div>
//                                        </div>
//                                        
//                                        
//                                        </div>
//                                    </div>
//                                    
//                                    </div>
//                    ";
//                }
//                $subt=0;
//                $resulti = $conn->query("SELECT * FROM cotizacion_detallada WHERE id_usuario='$iduss' and idsession='$idsession' and id_component='$carritos'");
//                $reg= $resulti->num_rows;
//                while ($vari=mysqli_fetch_row($resulti)){
//                    $subt = $subt+$vari[4];
//                }
//                $decimales_sub = number_format($subt,2);
//                echo "<span style='float:right;'><b>SUBTOTAL $".$decimales_sub."</b> </span><br>";
//                echo $cadena."</divv>";
//               echo "<button id='btnsgcom' type='submit' name='submit' value='' class='btn btn-success btn-lg btn-block' Onclick='mostrarCarritorot()' class='letche'>SIGUIENTE</button>";
?>