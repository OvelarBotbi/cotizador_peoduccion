<?php
    include_once 'php_conexiones.php';
    $numeroid=$conn->query("SELECT * FROM productos WHERE id>50000 and id<60000 ORDER BY id ASC");
    $reghis= $numeroid->num_rows;
    $numero=50001;
    $ids= array();
    
    while($numerid=$numeroid->fetch_array(MYSQLI_ASSOC)){
        echo $numerid['id']."<br>";
        if($numero==$numerid['id']){
            $numero=$numero+1;
        }
    }
    echo $numero."id";
    


?>