<?php
 define("SITE_PATH", dirname(__FILE__));
 // echo SITE_PATH . "<br>";
 define("SITE_UPLOAD", SITE_PATH . "/upload");
 // echo  SITE_UPLOAD  . "<br>";
 define("SITE_URL", "http://localhost/duan1_Pro1014/");
 // echo SITE_URL  . "<br>";
 define("FILE_URL", SITE_URL . "/upload/");
 // echo FILE_URL;
 require_once SITE_PATH . "/lib/connect.php"; 
session_start();
if (isset($_SESSION['user'])) {
	unset($_SESSION['user']);
	header("Location:" . SITE_URL . "index1.php");
} elseif (isset($_SESSION['admin'])) {
	unset($_SESSION['admin']);
	header("Location:" . SITE_URL . "index1.php");
}
?>