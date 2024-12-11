<?php 
    try{
            $pdo = new PDO("mysql:dbname=DbGeniusFit;host=localhost:3306","root","cimatec");

    }catch (Exception $e){
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
?>