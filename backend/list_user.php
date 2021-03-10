<?php include_once "./header.php" ?>
<?php include_once "./sidebar.php" ?>
<?php 
 $sql = "SELECT  * FROM user" ; 
 $stmt = $connect->prepare($sql) ; 
 $stmt->execute() ; 
 $stmt->setFetchMode(PDO::FETCH_ASSOC) ; 
 $users = $stmt->fetchAll() ; 

 


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quản trị thành viên </h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="add_product.php"></a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <table class="table table_hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ và tên</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Quyền</th>
                    <th>Số điện thoại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php   $count = 1 ;     foreach ($users as $user)  { ?>     

                      <tr>
                          <td><?= $count  ?></td> 
                          <td><?= $user['fullname']  ?></td> 
                          <td><?= $user['username'] ?></td> 
                          <td><?= $user['email'] ?></td> 
                          <td>  <?php if (strlen($user['image_user']) > 0) { ?>
                                      <img src="<?php echo FILE_URL . $user['image_user'] ?>" alt="" srcset="" width="150px">
                                  <?php } ?></td> 
                          <td><?php echo ($user['premission'] == 0 ) ? "Khách hàng" : "Quản trị viên" ;   ?></td>  
                          <td><?= $user['phone'] ?></td> 
                          <td>
                            <a class="btn btn-info" href="<?php echo SITE_URL . "edit_user.php?id=".$user['id'] ?>">Sửa</a>
                            <a class="btn btn-danger" href="<?php echo SITE_URL . "destroy_user.php?id=".$user['id'] ?>" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                         </td> 
                      </tr>           
                <?php $count ++ ;  } ?> 


            </tbody>
        </table>
    </section>

</div>

<?php include_once "./footer.php" ?>
</body>

</html>