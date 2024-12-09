<?php 
    try{
            $pdo = new PDO("mysql:dbname=DbGeniusFit;host=localhost:3307","root","");

    }catch (Exception $e){
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
?>