<?php
      $host = 'localhost' ;
      $user = 'root' ;
      $pass = '' ;
      $name_db = 'duan1_pro1014' ;
      $charset = 'utf8mb4';
    //   $connect = null ;
      try {

          $connect = new PDO("mysql:host=$host; dbname=$name_db;" ,$user ,$pass);
          $connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION) ;
        //  echo "Kết nối dữ liệu thành công" ;
      }catch (PDOException $er) {
          die("Lỗi kết nối cơ sở dữ liêu : ".$er->getMessage()) ;

      }