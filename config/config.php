<?php 
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'sqldmp');
  define('DB_PASSWORD', 'sqldmp123');
  define('DB_DATABASE', 'equipo5');
  
  $db = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE)
        OR die('Could not connect to database'.mysqli_connect_error());

  if (!$db) {
    echo mysqli_error();
  }
?>