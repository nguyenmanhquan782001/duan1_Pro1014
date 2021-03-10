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
$errorMessege = [];





$image_category_old = isset($_POST['image_category']) ? $_POST['image_category'] : "";

$id = isset($_GET['id']) ? $_GET['id'] : 0;


if ($uploadFileSever == false) {

    header("Location:" . SITE_URL . "edit.php?id=" . $id);
}
if ($id > 0) {
    if (isset($_POST['update'])) {
        $name_category = $_POST['name_category'];
        // $check = "SELECT * FROM  category where  name_category = '$name_category'";
        // $count = $connect->prepare($check);
        // $count->execute();
        // if ($count->rowCount() > 0) {
        //     $errorMessege[] = "Danh mục đã tồn tại vui lòng nhập tên khác";
        // }

        if ($name_category === "") {
            $errorMessege[] = "Tên danh mục không để trống";
        }

        if (isset($_FILES["image_category"]["tmp_name"]) && $_FILES["image_category"]["tmp_name"]) {
            $target_file_name = time() . basename($_FILES['image_category']['name']);
            // echo $target_file_name . "<br>";

            $target_file = SITE_UPLOAD . "/" . $target_file_name;

            // echo $target_file;

            $target_file_url = FILE_URL . $target_file_name;

            // echo  "<br>" . $target_file_url;

            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // echo "<br>" . $imageFileType;

            $check = getimagesize($_FILES['image_category']['tmp_name']);
            if ($check === false) {
                $uploadOk = 0;
                $errorMessege[] = "Ảnh có kích thước không hợp lệ ";
            }
            if (file_exists($target_file)) {
                $uploadOk = 0;
                $errorMessege[] = "Ảnh đã có trên hệ thống";
            }
            $fileSize = $_FILES['image_category']['size'];
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
                $uploadFileSever = move_uploaded_file($_FILES['image_category']['tmp_name'], $target_file);
            }
        }

        if (empty($errorMessege)) {
            if ($uploadFileSever == true) {

                $sql  = "UPDATE category SET  name_category = ? , image_category = ?   where id = ?";
            } else {
                $sql  = "UPDATE category SET   name_category = ? where id = ?";
            }
            $stmt = $connect->prepare($sql);

            if ($uploadFileSever == true) {
                $image_category = $target_file_name;
            }
            if ($uploadFileSever == true) {
                $imagePath = SITE_UPLOAD . "/" . $image_category_old;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }


                $stmt->execute([$name_category,  $image_category, $id]);
            } else {
                $stmt->execute([$name_category, $id]);
            }
        }
        if (is_array($errorMessege) && !empty($errorMessege)) {
            $_SESSION["errorMessege"] = implode("<br>", $errorMessege);
        } else {
            $_SESSION["errorMessege"] = "";
        }
    }
    if (empty($errorMessege)) {
        header("Location:" . SITE_URL . "list_category.php");
    }
}
