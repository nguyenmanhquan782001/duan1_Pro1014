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


$uploadFileSever = 0;



// echo "<pre>" ; 
// print_r($_POST) ; 
// exit ; 

$errorsMessage = [];

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$image_category_old = isset($_POST['image_logo']) ? $_POST['image_logo'] : "";

if($uploadFileSever == false) {

header ("Location:". SITE_URL . "editseting.php?id=".$id ) ;

}

if ($id > 0) {

    if (isset($_POST['btn_sm'])) {
        $diachi = $_POST['dia_chi'];
        $chinh_sach = $_POST['chinh_sach'];
        $lien_he = $_POST['lien_he'];
        $created_at = date("Y/m/d");
     echo $diachi;

        if ($diachi == "") {
            $errorsMessage[] = "Tên sản phẩm không được để trống";
        }
        if ($chinh_sach == "") {
            $errorsMessage[] = "adasd";
        }
        if ($lien_he == "") {
            $errorsMessage[] = "Thêm" ;
        }
        if (isset($_FILES["image_logo"]["tmp_name"]) && $_FILES["image_logo"]["tmp_name"]) {
            $target_file_name = time(). basename($_FILES['image_logo']['name']);
            // echo $target_file_name . "<br>";

            $target_file = SITE_UPLOAD . "/" . $target_file_name;

            // echo $target_file;

            $target_file_url = FILE_URL . $target_file_name;

            // echo  "<br>" . $target_file_url;

            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // echo "<br>" . $imageFileType;

            $check = getimagesize($_FILES['image_logo']['tmp_name']);
            if ($check === false) {
                $uploadOk = 0;
                $errorsMessage[] = "Ảnh có kích thước không hợp lệ ";
            }

            if (file_exists($target_file)) {
                $uploadOk = 0;
                $errorsMessage[] = "Ảnh đã có trên hệ thống";
            }
            $fileSize = $_FILES['image_logo']['size'];
            // echo "<br>" . $fileSize;

            if ($fileSize > 5000000) {
                $uploadOk = 0;
                $errorsMessage[] = "File ảnh có dung lượng khá lớn  . Không thể upload";
            }

            $imageFileTypeValidate = ['jpg', 'png', 'jpeg'];
            if (!in_array($imageFileType, $imageFileTypeValidate)) {
                $uploadOk = 0;
                $errorsMessage[] = "Đuôi file ảnh không hợp lệ";
            }


            if ($uploadOk == 1) {

                $uploadFileSever = move_uploaded_file($_FILES['image_logo']['tmp_name'], $target_file);
            }
        }

 
            if ($uploadFileSever == true) { 
              

                $sql  = "UPDATE seting SET  adress = ? , chinhsach = ? , lienhe = ? , created_at = ? , logo = ? where id = ?";
            
            } else {
                $sql  = "UPDATE seting SET  adress = ?  , chinhsach = ? , lienhe = ? , created_at = ?  where id = ?";
            
            }
            $stmt = $connect->prepare($sql);

            if ($uploadFileSever == true) {
                $image_category = $target_file_name;
            }  
            // echo " <br>Ổn nè" ;

            if ($uploadFileSever == true) {
                $imagePath = SITE_UPLOAD ."/". $image_category_old;
              
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                 
                }
                $stmt->execute([$diachi,  $chinh_sach , $lien_he , $created_at , $image_category, $id]);
            
            } else {
                $stmt->execute([$diachi, $chinh_sach , $lien_he , $created_at , $id]);
            
            }
            // echo "<br>Lỗi nữa đéo thèm làm :((" ;  
        

    
        if (is_array($errorsMessage) && !empty($errorsMessage)) {
            $_SESSION["errorsMessage"] = implode("<br>", $errorsMessage);
        } else {
            $_SESSION["errorsMessage"] = "";
        }


        if(empty($errorsMessage)) {
            header ("Location:". SITE_URL . "list_seting.php") ;
        }
        
    }
   
   
}
