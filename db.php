<?php
$dbhost = 'localhost';
$dbusername = 'c129_amani_2023';
$dbuserpassword = 'comp334!';
$default_dbname = 'c129_amani_11';

function db_connect($dbname = '', $username = '', $password = ''){
    global $dbhost, $dbusername, $dbuserpassword, $default_dbname;
    global $MYSQL_ERRNO, $MYSQL_ERROR;

    try {

        if (empty($dbname)) {
            $dbname = $default_dbname;
        }

       

        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbuserpassword);

        return $pdo;

    } catch (PDOException $e) {
        $MYSQL_ERRNO = 0;
        $MYSQL_ERROR = $e->getMessage();
        return 0;
    }
}


?>