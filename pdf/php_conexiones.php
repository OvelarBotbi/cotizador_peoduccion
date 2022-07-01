    <?php
        header('Content-Type: text/html; charset=UTF-8');
        $user='Daniel_Fuentes';
        $password='b3x73c.2019@';
        $db='sdc_madero';
        $host='localhost';
        $port='3306';
        $conn = new mysqli($host, $user,$password, $db);
        $conn->query("SET NAMES 'utf8'");
    ?>