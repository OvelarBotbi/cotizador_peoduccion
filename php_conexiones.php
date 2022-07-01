    <?php
        header('Content-Type: text/html; charset=UTF-8');
        $user='cotizaciones';
        $password='D514jq&i';
        $db='merkanet_cotizaciones';
        $host='cotizaciones.maderoequipos.com.mx';
        $port='3306';
        $conn = new mysqli($host, $user,$password, $db);
        $conn->query("SET NAMES 'utf8'");
    ?>