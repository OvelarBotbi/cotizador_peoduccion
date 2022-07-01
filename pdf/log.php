<?php
//include_once 'app/Usuario.inc.php';
	session_start();
	include("php_conexiones.php");

//	$data = file_get_contents("php://input");
//	$objData = json_decode($data);


    $uuss=$_POST['usuario'];
    $ppss=$_POST['pass'];   

//echo $pass;
    $result = $conn->query("SELECT * FROM usuarios WHERE usuario='$uuss'");
	  if($result->num_rows > 0) {
        //echo "existe ese nombre de usuario";
        $row = $result->fetch_array(MYSQLI_ASSOC);
      }
        //Cogemos la contraseña de la BD

        if (password_verify($ppss, $row['pass'])) {
            
            $rol=0;
           // $res = $conn->query("SELECT * FROM usuarios WHERE usuario='$uuss'");
           // while($vat=mysqli_fetch_row($res)){
            $rol=$row['rol'];
              // echo $row['pass'];
           // }

            $options = [
            'cost' => 5
            ];
            $s= password_hash($uuss,PASSWORD_BCRYPT,$options);
             $_SESSION['usuario']=$uuss;
             $_SESSION['num']=$s;
             $_SESSION['rol']=$rol;
      //    echo $rol;
             header("Refresh:1; url=cotizaciones.php");
            
            
            
          //$_SESSION['loggedin'] = true;
          //$_SESSION['username'] = $uuss;
          //$_SESSION['start'] = time();

         // echo "Sesión iniciada" . $_SESSION['username'];
        }
        else {
           echo "Username o password incorrectos";
            header("Refresh:1; url=login.php");
        }
        


//$rol=0;
//    while($vat=mysqli_fetch_row($result)){
//                $rol=$vat[5];
//             }
//
//    $options = [
//      'cost' => 5
//    ];
//   $s= password_hash($uuss,PASSWORD_BCRYPT,$options);
//
//    
//	if ($reg>0){
//		// crear variables de session
//		   //$usuario= new Usuario($usu,$pass);
//			
//		  // $_SESSION['usuario']=$usuario;
//		   $_SESSION['usuario']=$uuss;
//           $_SESSION['num']=$s;
//           $_SESSION['rol']=$rol;
//			
//		header("Refresh:1; url=cotizaciones.php");
//	}else{
//        print "<BR>No tienes permiso para acceder<BR>";
//        header("Refresh:1; url=login.php");
//    }













	print "<img style='display:block;position:absolute;left:42.5%;width:15%;top:50%;-ms-transform: translateY(-50%);transform: translateY(-50%);' src='img/loadi.gif' />";

?>