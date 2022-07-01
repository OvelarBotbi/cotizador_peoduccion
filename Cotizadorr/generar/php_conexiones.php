    <?php
        header('Content-Type: text/html; charset=UTF-8');
        $user='root';
        $password='';
        $db='cotiz';
        $host='localhost';
        $port='3306';
        $conn = new mysqli($host, $user,$password, $db);
        $conn->query("SET NAMES 'utf8'");
    ?>