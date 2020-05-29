<?php 
$servername = "picachosystems.com:3306";
$username = "sqldmp";
$password = "sqldmp123";
$database = "equipo5";
  
try{
  
  $conn = new PDO("mysql:host=$servername;dbname=$database;",$username,$password);
}catch (PDOExeption $e){
  die('Connected failed: '.$e->getMessage());

}

?>