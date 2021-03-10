<?php session_start();

define("SITE_PATH", dirname(__FILE__));
// echo SITE_PATH . "<br>";

define("SITE_UPLOAD", SITE_PATH . "/../upload");
// echo  SITE_UPLOAD  . "<br>";

define("SITE_URL", "http://localhost/duan1_Pro1014/backend/");
// echo SITE_URL  . "<br>";

define("FILE_URL", SITE_URL . "../upload/");
// echo FILE_URL;

require_once SITE_PATH . "/../lib/connect.php";

// echo "<pre>";
// print_r($_FILES);
?>
<?php
$uploadFileSever = 0;
$errorMessege = [];

if ($uploadFileSever == false) {    
    header("Location:".SITE_URL."add_slider.php") ; 
}

if (isset($_POST['add'])) {
    $link =  $_POST['link']; 
    $create_at = date("Y/m/d") ; 
    $status  = 0 ;   
   
    if ($link == "") {
        $errorMessege[] = "Đường dẫn không để trống";
    }


    if (isset($_FILES["image_slider"]["tmp_name"]) && $_FILES["image_slider"]["tmp_name"]) {
        $target_file_name = time() . basename($_FILES['image_slider']['name']);
        // echo $target_file_name . "<br>";

        $target_file = SITE_UPLOAD . "/" . $target_file_name;

        // echo $target_file;

        $target_file_url = FILE_URL . $target_file_name;

        // echo  "<br>" . $target_file_url;

        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // echo "<br>" . $imageFileType;

        $check = getimagesize($_FILES['image_slider']['tmp_name']);
        if ($check === false) {
            $uploadOk = 0;
            $errorMessege[] = "Ảnh có kích thước không hợp lệ ";
        }
        if (file_exists($target_file)) {
            $uploadOk = 0;
            $errorMessege[] = "Ảnh đã có trên hệ thống";
        }
        $fileSize = $_FILES['image_slider']['size'];
        // echo "<br>" . $fileSize;

        if ($fileSize > 5000000) {
            $uploadOk = 0;
            $errorMessege[] = "File ảnh có dung lượng khá lớn  . Không thể upload";
        }
        $imageFileTypeValidate = ['jpg', 'png', 'jpeg'];
        if (!in_array($imageFileType, $imageFileTypeValidate)) {
            $uploadOk = 0;
            $errorMessege[] = "Đuôi file ảnh không hợp lệ";
        }
        if ($uploadOk == 1) {
            $uploadFileSever = move_uploaded_file($_FILES['image_slider']['tmp_name'], $target_file);
        }
    }
    if ($uploadFileSever == true) {
        $image_category = $target_file_name;
      
    } else {

        $errorMessege[] = "Upload không thành công";
    }

    if (is_array($errorMessege) && !empty($errorMessege)) {
        $_SESSION["errorMessege"] = implode("<br>", $errorMessege);
    } else {
        $_SESSION["errorMessege"] = "";
    } 
    if (empty($errorMessege)) {
     $sql ="INSERT INTO slide (link , slide_image , create_at , status) 
     VALUES (:link , :slide_image , :create_at , :status )" ; 
     $stmt = $connect->prepare($sql) ; 
     $stmt->bindParam(":link" , $link) ; 
     $stmt->bindParam(":slide_image" , $image_category) ;
     $stmt->bindParam(":create_at" , $create_at) ; 
     $stmt->bindParam(":status" , $status) ; 
     $stmt->execute() ; 
     header("Location:".SITE_URL."list_slider.php"); 
     

        } 


} 
?> 