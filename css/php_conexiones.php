    <?php
        header('Content-Type: text/html; charset=UTF-8');
        $user='madero';
        $password='M4d3r0.2019';
        $db='sdcmadero';
        $host='50.62.209.107';
        $port='3306';
        $conn = new mysqli($host, $user,$password, $db);
        $conn->query("SET NAMES 'utf8'");
    ?>