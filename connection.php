<?php
 $db_host = "localhost";
 $db_name = "";
 $db_user = "";
 $db_pass = "secret";
 $utf8 = "utf8"; 
 try{
  
  $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset={$utf8}",$db_user,$db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
?>
