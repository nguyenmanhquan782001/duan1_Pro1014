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
$errorsMessage = [];
if ($uploadFileSever == false) {

    header("Location:" . SITE_URL . "seting.php");
}

if (isset($_POST['add_seting'])) {
    $adress = $_POST['adress'];
    $chinhsach = $_POST['chinhsach'];
    $lienhe = $_POST['lienhe'];
    $created_at = date("Y/m/d");
   


    if ($adress == "") {
        $errorsMessage[] = "Dia chi da ton tai";
    }
    if ($chinhsach == '') {
        $errorsMessage[] = "chinh sach da ton tai";
    }
    if ($lienhe == "") {
        $errorsMessage[] = "lien he da ton tai";
    }
    if (isset($_FILES["image_logo"]["tmp_name"]) && $_FILES["image_logo"]["tmp_name"]) {
        $target_file_name = time() . basename($_FILES['image_logo']['name']);
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
        echo "<br>" . $fileSize;

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
        $image_category = $target_file_name;
    } else {

        $errorsMessage[] = "Upload không thành công";
    }

    if (is_array($errorsMessage) && !empty($errorsMessage)) {
        $_SESSION["errorsMessage"] = implode("<br>", $errorsMessage);
    } else {
        $_SESSION["errorsMessage"] = "";
    }


    if (empty($errorsMessage)) {
        $sql = "INSERT INTO seting (adress , chinhsach , lienhe , created_at , logo)  
        VALUES (:adress , :chinhsach , :lienhe, :created_at , :image_logo)  ";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":adress", $adress);
        $stmt->bindParam(":image_logo", $image_category);
        $stmt->bindParam(":chinhsach", $chinhsach);
        $stmt->bindParam(":lienhe", $lienhe);
        $stmt->bindParam(":created_at", $created_at);
        $stmt->execute();
      
        header("Location:" . SITE_URL . "list_seting.php");
    }
}


?>