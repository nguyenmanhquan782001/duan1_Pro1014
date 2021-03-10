<?php include_once "./header.php" ?>
<?php include_once "./sidebar.php" ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quản trị bình luận </h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="add_category.php">Khác</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ảnh sản phẩm</th>
                    <th>Nội dung bình luận</th>
                    <th>Ngày bình luận</th>
                  
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_GET['id_cmt']) ) {
                    $cmtss = $_GET['id_cmt'];
                    $stmt = $connect->prepare(" DELETE FROM comment  WHERE id = $cmtss ");
                    $stmt->execute();
                    header("Location:" . SITE_URL . "comment.php");
                }



                if (isset($_GET['id'])) {
                    $id_product = $_GET['id'];
                    $stmt = $connect->prepare("SELECT * FROM comment  WHERE id_product = $id_product");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $comments = $stmt->fetchAll();
                    $index = 1;

                    $stmt = $connect->prepare("SELECT * FROM products  WHERE id = $id_product");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $product = $stmt->fetch();
                    foreach ($comments  as $comments) {
                        $id_cmts =  $comments['id'];
                ?>
                        <tr>
                            <td><?php echo $index++; ?></td>
                            <td> <?php if (strlen($product['image_product']) > 0) { ?>
                                      <img src="<?php echo FILE_URL . $product['image_product'] ?>" alt="" srcset="" width="200px">
                                  <?php } ?></td><td><?= $comments['content']; ?></td>
                            <td><?= $comments['create_at']; ?></td>

                          
                            <td>
                                <a href='detailComment.php?id_cmt=<?php echo  $id_cmts; ?>' onclick="return confirm('Đồng ý xóa bình luận của khách hàng ? ')" name='delete_product' class='btn btn-danger'>Xóa</a> </td>
                        </tr>
                <?php
                    }
                    if (isset($_POST['hide_cmt'])) {
                        $id_cm =  $comments['id'];
                        $status = $_POST['statuss'];
                        $stmt = $connect->prepare("UPDATE comment SET status =:status  WHERE id  =$id_cm ");
                        $stmt->bindParam(":status", $status);
                        $stmt->execute();
                    }
                }
                ?>




            </tbody>
        </table>
    </section>

</div>
<?php include_once "./footer.php" ?>