<?php
$link = 'mysql:host=mpkwcorp.cz6tqxi7hawr.us-east-2.rds.amazonaws.com;dbname=mpkwcorp';
$usuario = 'admin';
$pass = '12345qweR';
try {
    $cn = new PDO($link, $usuario, $pass);
} catch (PDOException $e) {
    print "!Error¡: " . $e->getMessage() . "<br/>";
    die();
}
