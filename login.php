<?php include_once "./header2.php";

// session_destroy();
?> 
<?php 
if (isset($_SESSION['user']) ||isset($_SESSION['admin']) ) {
    header("Location:" . SITE_URL . "index1.php") ; 
} 

if (isset($_POST['login'])) {
    $username = $_POST['username'] ; 
    $password = ($_POST['pass']);  
    $check_user =  "SELECT * FROM user where username = '$username' AND  password = '$password' AND premission =:premission " ;
    $count_user = $connect->prepare($check_user) ; 
    $count_user->execute(array(":premission" => 0 )) ; 
    // echo "<pre>";
    // print_r($_POST);
    // exit;


    $check_admin =  "SELECT * FROM user where username = '$username' AND  password = '$password' AND premission =:premission " ;
    $count_admin = $connect->prepare($check_admin) ; 
    $count_admin->execute(array(":premission" => 1  )) ;   


    if($count_user->rowCount() > 0) {
        $_SESSION['user'] = $username ; 
        header("Location:" . SITE_URL . "index1.php") ; 

    } elseif ($count_admin->rowCount() > 0) {
        $_SESSION['admin'] = $username ; 
        header("Location:" . SITE_URL. "backend/index1.php") ;
    } 
    else {
        $e = "Thông tin tài khoản hoặc mật khẩu không chính xác" ; 
    }
    

}


?> 
 
<div class="row">
    <div class="col-sm-3">

    </div>
    <div class="col-sm-6"> 
      

        <h3 style="text-align:center">Đăng nhập</h3>  


        <?php if (isset($e)) { ?>
            <div class="alert alert-danger" role="alert">
                  <?= $e ?>
              </div>
          <?php  } else {
                echo " <p> Đăng nhập tại đây  :*</p>";
            }
            ?>
        <form action="" method="post">
           
            <div class="form-group">
                <label style="font-weight: bold;" for="">Username</label>
                <input value="" name="username" type="text" class="form-control" placeholder="Nhập username" id="email">
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
        
            <div style="margin-left:250px; margin-bottom:10px;  ">
                <button type="submit" class="btn btn-primary" name="login">Đăng nhập</button>
                <button type="submit" class="btn btn-danger"><a href="index1.php" style="color:white; text-decoration:none ; ">Quay lại</a></button>
            </div>



        </form>


    </div>
    <div class="col-sm-3">

    </div>

</div>


<?php include_once "./footer.php" ?>