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

    header("Location:" . SITE_URL . "add_product.php");
}

if (isset($_POST['add_product'])) {
    $name_product = $_POST['name_product'];
    $price = $_POST['price_product'];
    $sale = isset($_POST['price_sale']) ? $_POST['price_sale'] : 0;
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    $category = $_POST['categories'];
    $status = $_POST['status'];
    $create_at = date("Y/m/d");
   (int) $views = 1 ;
   


    if ($name_product == "") {
        $errorsMessage[] = "Tên sản phẩm không được để trống";
    }
    if ($price == 0) {
        $errorsMessage[] = "Giá sản phẩm phải khác 0";
    }
    if ($desc == "") {
        $errorsMessage[] = "Thêm mô tả";
    }
    if (!isset($_POST['status'])) {
        $errorsMessage[] = "Vui lòng chọn trạng thái sản phẩm";
    }
    if (!isset($_POST['categories'])) {
        $errorsMessage[] = "Vui lòng chọn danh mục";
    }

    if ($quantity <= 0) {
        $errorsMessage[] = "Số lượng sản phẩm ko hợp lệ";
    }


    if (isset($_FILES["image_product"]["tmp_name"]) && $_FILES["image_product"]["tmp_name"]) {
        $target_file_name = time() . basename($_FILES['image_product']['name']);
        // echo $target_file_name . "<br>";

        $target_file = SITE_UPLOAD . "/" . $target_file_name;

        // echo $target_file;

        $target_file_url = FILE_URL . $target_file_name;

        // echo  "<br>" . $target_file_url;

        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // echo "<br>" . $imageFileType;

        $check = getimagesize($_FILES['image_product']['tmp_name']);
        if ($check === false) {
            $uploadOk = 0;
            $errorsMessage[] = "Ảnh có kích thước không hợp lệ ";
        }
        if (file_exists($target_file)) {
            $uploadOk = 0;
            $errorsMessage[] = "Ảnh đã có trên hệ thống";
        }
        $fileSize = $_FILES['image_product']['size'];
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
            $uploadFileSever = move_uploaded_file($_FILES['image_product']['tmp_name'], $target_file);
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
        $sql = "INSERT INTO products (name_product , image_product , price_product , quantity , descr ,sale  , view , create_at , id_category , status_product)  
        VALUES (:name_product , :image_product , :price_product , :quantity , :descr ,:sale  , :view , :create_at , :id_category , :status_product)  ";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":name_product", $name_product);
        $stmt->bindParam(":image_product", $image_category);
        $stmt->bindParam(":price_product", $price);
        $stmt->bindParam(":sale", $sale);
        $stmt->bindParam(":descr", $desc);
        $stmt->bindParam(":view", $views);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":create_at", $create_at);
        $stmt->bindParam(":status_product", $status);
        $stmt->bindParam(":id_category", $category);
        $stmt->execute();
      
        header("Location:" . SITE_URL . "list_product.php");
    }
}


?>