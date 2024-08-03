<?php

include_once "db.php";
if (isset($_GET['name'])) {
    $name = $_GET['name'];
} 
$pdo = db_connect();
try {
   
   
    
    $sql = "DELETE FROM team WHERE tname=:name";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $name);
    

    $done=$statement->execute();
    if ($done){
       header("location:dashboard.php");
    }

  }
  catch (PDOException $e) {
      die($e->getMessage());
    }






?>