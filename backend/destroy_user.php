<?php
session_start();

define("SITE_PATH", dirname(__FILE__));
// echo SITE_PATH . "<br>";

define("SITE_UPLOAD", SITE_PATH . "/../upload");
// echo  SITE_UPLOAD  . "<br>";

define("SITE_URL", "http://localhost/duan1_Pro1014/backend/");
// echo SITE_URL  . "<br>";

define("FILE_URL", SITE_URL . "../upload/");
// echo FILE_URL;

require_once SITE_PATH . "/../lib/connect.php"; 
 $id = isset($_GET['id']) ? $_GET['id'] : 0 ; 
  
  if ($id > 0) {
      $sql =  "DELETE  FROM  user  WHERE  id = '$id'" ; 
      $stmt = $connect->prepare($sql) ; 
      $stmt->execute () ;  
      header("Location: ".SITE_URL."list_user.php");
      exit();
  }


?>