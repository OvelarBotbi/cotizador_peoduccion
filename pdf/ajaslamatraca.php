 <?php 
case 33:
            $tmp="";
            $cadena="aaaaaaaaa";
            $id_categoria="";
            $id_categoria=$_POST['idcat'];
            //$result=$conn->query("SELECT nombre_producto_sap FROM productos_sap");
         if($id_categoria==5){   
            if($_POST["texto"]!=""){
                $result=$conn->query("SELECT nombre_producto_sap, id_producto_madero, a FROM productos_sap WHERE (nombre_producto_sap LIKE '%".$_POST["texto"]."%' OR id_producto_madero LIKE '%".$_POST["texto"]."%') and (a=1) ORDER BY nombre_producto_sap");
                $reg= $result->num_rows;
                
                
                if($reg>0){

                $tmp=" <table class='table'>
                    <tr>
                        <td>NOMBRE</td>
                        <td></td>

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
                                <td>".$row["nombre_producto_sap"]."</td>
                                <td>";
                                    $tmp.="<button class='btn btn-success'>AGREGAR</button>";
                                    }
                            
                        //}
                        
                        
                   


                        }
                        $tmp.="
                    </tr>
                </table>";
                }
                }
         }else if($id_categoria==4){
             $result=$conn->query("SELECT * FROM productosWHERE (nombre LIKE '%".$_POST["texto"]."%' OR id LIKE '%".$_POST["texto"]."%') ORDER BY nombre");
                $reg= $result->num_rows;
                
                
                if($reg>0){

                $tmp=" <table class='table'>
                    <tr>
                        <td>NOMBRE</td>
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
                                <td>".$row["nombre"]."</td>
                                <td>";
                                    $tmp.="<button class='btn btn-success'>AGREGAR</button>";
                                    }
                            
                        //}
                        
                        
                   


                        }
                        $tmp.="
                    </tr>
                </table>";
                }
                }
         }
        echo $cadena;
        echo $tmp;
        
        break;