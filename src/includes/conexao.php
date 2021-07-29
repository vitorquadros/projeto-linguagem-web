<?php
   try {
    $conexao = new PDO("mysql:host=127.0.0.1; dbname=projeto; charset=utf8", "root","8642");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
?>