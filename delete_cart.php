<?php
session_start();

define("SITE_PATH", dirname(__FILE__));
echo SITE_PATH . "<br>";

define("SITE_UPLOAD", SITE_PATH . "/../upload");
echo  SITE_UPLOAD  . "<br>";

define("SITE_URL", "http://localhost/duan1_Pro1014/");
echo SITE_URL  . "<br>";

define("FILE_URL", SITE_URL . "../upload/");
echo FILE_URL;

require_once SITE_PATH . "/lib/connect.php"; 
  if(isset($_GET['delete'])) {
      $delete = $_GET['delete'] ; 
      unset($_SESSION['cart'][$delete]) ; 
      header("Location:" . SITE_URL. "add_to_cart.php") ; 

  }

?>