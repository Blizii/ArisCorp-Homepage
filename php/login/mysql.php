<?php
$host = "localhost";
$name = "ArisCorpHomepage";
$user = "blizii";
$passwort = "cmdaplag3";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
 ?>
