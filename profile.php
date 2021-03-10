<?php include_once "./header2.php" ?>
<?php
if (isset($_GET['user'])) {
    $user = $_GET['user'];
    $sql = "SELECT * FROM user where username = '$user' ";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetch();
    // echo "<pre>" ; 
    // print_r($users) ; 
    $uploadFileSever = 0;
    $errorMessege = [];

    $avatar_old = isset($_POST['avatar']) ? $_POST['avatar'] : "";
    if (isset($_POST['profile'])) {
        $password_old = $_POST['password_old'];
        $password_new = $_POST['password_new'];
        $select = "SELECT * FROM user where username = '$user' AND password = '$password_old'";
        $check = $connect->prepare($select);
        $check->execute();
        if ($check->rowCount() == 0) {
            $e['old'] = "Thông tin mật khẩu cũ không chính xác";
        }
        if ($password_new == "") {
            $e['new'] = "Vui lòng nhập mật khẩu mới";
        }
        if (isset($_FILES["avatar"]["tmp_name"]) && $_FILES["avatar"]["tmp_name"]) {
            $target_file_name = time() . basename($_FILES['avatar']['name']);


            $target_file = SITE_UPLOAD . "/" . $target_file_name;



            $target_file_url = FILE_URL . $target_file_name;



            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



            $check = getimagesize($_FILES['avatar']['tmp_name']);
            if ($check === false) {
                $uploadOk = 0;
                $errorMessege[] = "Ảnh có kích thước không hợp lệ ";
            }
            if (file_exists($target_file)) {
                $uploadOk = 0;
                $errorMessege[] = "Ảnh đã có trên hệ thống";
            }
            $fileSize = $_FILES['avatar']['size'];


            if ($fileSize > 5000000) {
                $uploadOk = 0;
                $errorMessege[] = "File ảnh có dung lượng khá lớn . Không thể upload";
            }
            $imageFileTypeValidate = ['jpg', 'png', 'jpeg'];
            if (!in_array($imageFileType, $imageFileTypeValidate)) {
                $uploadOk = 0;
                $errorMessege[] = "Đuôi file ảnh không hợp lệ";
            }
            if ($uploadOk == 1) {
                $uploadFileSever = move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);
            }
        }
        if (is_array($errorMessege) && !empty($errorMessege)) {
            $errors = implode("<br>", $errorMessege);
        } else {
            $errors = "";
        }
        if (empty($e) && empty($errors)) {
            if ($uploadFileSever == true) {

                $sql  = "UPDATE user SET password = ? , image_user = ? where username = ? ";
            } else {
                $sql  = "UPDATE user SET password = ? where username = ?";
            }
            $stmt = $connect->prepare($sql); 
            if ($uploadFileSever == true) {
                $image_category = $target_file_name;
            }
            if ($uploadFileSever == true) {
             
                $stmt->execute([$password_new,  $image_category, $user]); 
                echo "<div>Cập nhật tài khoản và ảnh đại diện thành công </div>" ; 
            }
            else {
                $stmt->execute([$password_new, $user]); 
                echo "<div class = 'alert alert-danger'>Cập nhật tài khoản và mật khẩu thành công</div>" ; 
            }


            
        }
    }
}
?>
<div class="row">
    <div class="col-sm-3">

    </div>
    <div class="col-sm-6">
         <?php if(!empty ($errors)) { ?>  
            <p><?= $errors ?></p>
         <?php } else {
             echo "" ; 
         } ?>


        <h3 style="text-align:center">Cập nhật tài khoản</h3>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label style="font-weight: bold;" for="">Username</label>
                <input value="<?= $users['username'] ?>" name="username" type="text" class="form-control" placeholder="Nhập username" id="email" disabled>
            </div>

            <div class="form-group">
                <label style="font-weight: bold;" for="pwd">Password</label>
                <input value="" name="password_old" type="password" class="form-control" placeholder="Nhập lại mật khẩu cũ" id="pwd">
            </div>

            <?php if (isset($e['old']) && !empty($e['old'])) { ?>
                <i style="color:red ; margin-bottom:10px; "><?= $e['old'] ?></i>

            <?php } ?>

            <div class="form-group">
                <label style="font-weight: bold;" for="pwd">Password new</label>
                <input value="" name="password_new" type="password" class="form-control" placeholder="Nhập mật khẩu mới" id="pwd">
            </div>

            <?php if (isset($e['new']) && !empty($e['new'])) { ?>
                <i style="color:red ; margin-bottom:10px; "><?= $e['new'] ?></i>

            <?php } ?>

            <div class="form-group">
                <label style="font-weight: bold;" for="pwd">Thêm ảnh đại diện</label>
                <input value="" name="avatar" type="file" class="form-control" id="pwd">
            </div>

            <?php if (isset($errors['password']) && !empty($errors['password'])) { ?>
                <i style="color:red ; margin-bottom:10px; "><?= $errors['password'] ?></i>

            <?php } ?>

            <div style="margin-left:250px; margin-bottom:10px;  ">
                <button type="submit" class="btn btn-primary" name="profile">Cập nhật</button>
                <button type="submit" class="btn btn-danger"><a href="index1.php" style="color:white; text-decoration:none ; ">Quay lại</a></button>
            </div>



        </form>


    </div>
    <div class="col-sm-3">

    </div>

</div>
<?php include_once "./footer.php" ?>