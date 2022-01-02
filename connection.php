<?php
header('Access-Control-Allow-Origin: *');
$user="root";
$pass="";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=notlar;charset=utf8', $user, $pass);


    }
catch (PDOException $e) {
    print "Hata!: " . $e->getMessage() . "<br/>";
    die();
}
?>