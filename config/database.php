<?php
    $host     = "localhost";
    $db_name  = "cepmari";
    $user = "root";
    $password = "";

        try{
            $pdo = new PDO("mysql:host=$host;dbname=$db_name",
            $user, $password);


            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $exception){
            echo json_encode(['erro' =>
            $e->getMessage()]);
        }
?>