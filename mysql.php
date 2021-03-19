<?php
    // stelle eine DB-Verbindung per PDO her
    $host = "localhost";
    $name = "kinoticketing";
    $user = "root";
    $passwort = "";
    try{
        $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
    } catch (PDOException $e){
        echo "SQL Error: ".$e->getMessage();
    }
 ?>