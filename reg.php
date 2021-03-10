<?php include_once "./header2.php" ?>
<?php

$errors = [] ; 

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = ($_POST['pass']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $avatar = "";  
    $premission = 0 ; 

    $day = date("Y/m/d");
    $sql = "SELECT * FROM user where email = '$email'";
    $count = $connect->prepare($sql);
    $count->execute();
    $sql1  = "SELECT * FROM user where username = '$username'";
    $count1 = $connect->prepare($sql1);
    $count1->execute();
    
    if ($count->rowCount() > 0) {
        $errors['email'] = "Email đã có người sử dụng . Vui lòng chọn email khác";    
    }
    if ($email == "") {
        $errors['email'] = "Không được để trống email";
    }
    if ($fullname == "") {
        $errors['fullname'] = "Không được để trống họ và tên";
    }
    if ($username == "") {
        $errors['username'] = "Vui lòng nhập tài khoản đăng kí";
    }
    if ($count1->rowCount() > 0) {
        $errors['username'] = "Tài khoản đã tồn tại . Vui lòng tạo tài khoản mới";
    }
    if ($password == "") {
        $errors['password'] = "Password không để trống";
    }
  
    if ($phone == "") {
        $errors['phone'] = "Vui lòng để lại số điện thoại liên lạc";
    } 

    if (empty($errors)) {
        $insert  = "INSERT INTO  user (fullname , password , username , email , phone , create_at  , image_user , premission)    VALUES (:fullname , :password , :username , :email , :phone , :create_at  , :image_user , :premission)" ;
        $stmt = $connect->prepare($insert) ; 
        $stmt->bindParam(":fullname" , $fullname) ; 
        $stmt->bindParam(":username" , $username) ; 
        $stmt->bindParam(":password" , $password) ; 
        $stmt->bindParam(":email" , $email) ; 
        $stmt->bindParam(":phone" , $phone) ;
        $stmt->bindParam(":create_at" , $day) ; 
        $stmt->bindParam(":image_user" , $avatar) ;  
        $stmt->bindParam(":premission" , $premission) ;  
        $stmt->execute() ; 
        $e = "Đăng kí thành công" ; 
 
    }



} 


?>



<div class="row">
    <div class="col-sm-3">

    </div>
    <div class="col-sm-6"> 
      

        <h3 style="text-align:center">Đăng kí</h3>  


        <?php if (isset($e)) { ?>
              <div class="alert alert-danger" role="alert">
                  <?= $e ?>
              </div>
          <?php  } else {
                echo " <p> Tạo tài khoản mới ngay : </p>";
            }
            ?>
        <form action="" method="post">
            <div class="form-group">
                <label style="font-weight: bold;" for="">Họ và tên</label>
                <input value="" name="fullname" type="text" class="form-control" placeholder="Nhập họ tên" id="email">
            </div>
            <?php  if(isset($errors['fullname']) && !empty($errors['fullname'])) { ?>  
                <i style="color:red ; margin-bottom:10px; "><?= $errors['fullname'] ?></i>

            <?php } ?>



            <div class="form-group">
                <label style="font-weight: bold;" for="">Username</label>
                <input value="" name="username" type="text" class="form-control" placeholder="Nhập họ tên" id="email">
            </div>

            <?php  if(isset($errors['username']) && !empty($errors['username'])) { ?>  
                <i style="color:red ; margin-bottom:10px; "><?= $errors['username'] ?></i>

            <?php } ?>

            <div class="form-group">
                <label style="font-weight: bold;" for="pwd">Password</label>
                <input value="" name="pass" type="password" class="form-control" placeholder="Nhập password" id="pwd">
            </div>
            <?php  if(isset($errors['password']) && !empty($errors['password'])) { ?>  
                <i style="color:red ; margin-bottom:10px; "><?= $errors['password'] ?></i>

            <?php } ?>
            <div  class="form-group">
                <label style="font-weight: bold;" for="pwd">Số điện thoại</label>
                <input value="" type="text" class="form-control" placeholder="Nhập số điện thoại" id="pwd" name="phone">
            </div>
            <?php  if(isset($errors['phone']) && !empty($errors['phone'])) { ?>  
                <i style="color:red ; margin-bottom:10px; "><?= $errors['phone'] ?></i>

            <?php } ?>

            <div class="form-group">
                <label style="font-weight: bold;" for="">Email</label>
                <input  value="" type="email" class="form-control" placeholder="Nhập email" id="email" name="email" autocomplete="off">
            </div>

            <?php  if(isset($errors['email']) && !empty($errors['email'])) { ?>  
                <i style="color:red ; margin-bottom:10px; "><?= $errors['email'] ?></i>

            <?php } ?>

            <div style="margin-left:250px; margin-bottom:10px;  ">
                <button type="submit" class="btn btn-primary" name="submit">Đăng kí</button>
                <button type="submit" class="btn btn-danger"><a href="login.php" style="color:white; text-decoration:none ; ">Quay lại</a></button>
            </div>



        </form>


    </div>
    <div class="col-sm-3">

    </div>

</div>

<?php include_once "./footer.php" ?>