<?php include_once "./header.php" ?>
<?php include_once "./sidebar.php" ?>
<?php if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();
}  

if(isset($_POST['update'])) {
    $per = $_POST['per'] ; 
    $sql = "UPDATE user SET premission = '$per' where id = '$id'" ; 
    $stmt = $connect->prepare($sql)  ; 
    $stmt->execute() ;  
    $e = "Cập nhật trạng thái người sử dụng thành công" ; 


}




?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sửa thông tin tài khoản </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="list_user.php">Quay lại</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <?php if (isset($e)) { ?>
              <div class="alert alert-danger" role="alert">
                  <?= $e ?>
              </div>
          <?php  } else {
               echo "" ; 
            }
            ?>
        <form name="update"  method="POST">

            <div class="form-group">
                <label for="">Tài khoản</label>
                <input value="<?= $user['username'] ?>" type="text" class="form-control" placeholder="Nhập họ tên" id="email" name="user"  disabled>
            </div>  


              <label for="exampleFormControlTextarea1">Phân quyền người sử dụng :</label>
            <div class="radio"> 

                <label><input value="0" type="radio" name="per" <?php if ($user['premission'] == 0 ) { echo "checked" ;  } ?> >Khách hàng</label>
            </div>
            <div class="radio">
                <label><input value="1" type="radio" name="per" <?php if ($user['premission'] == 1 ) { echo "checked" ;  } ?> >Quản trị viên</label>
            </div>


            <button type="submit" class="btn btn-danger" name="update">Cập nhật</button>
        </form>
    </section>
    <!-- /.content -->
</div>


<?php include_once "./footer.php" ?>