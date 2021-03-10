<?php include "./header.php" ?>
<?php include "./sidebar.php" ?>
<?php
$sql = "SELECT * FROM slide ";
$stmt = $connect->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$sliders =   $stmt->fetchAll();


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quản trị slider</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="add_slider.php">Thêm mới slider</a></li>
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
                    <th>Hình ảnh</th>
                    <th>Link đến sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>

            </thead>
            <tbody>
                <?php $count = 1;
                foreach ($sliders as $slider) { ?>
                    <tr>
                        <td><?= $count ?></td>
                        <td><?= $slider['link'] ?></td>
                        <td>
                            <?php if (strlen($slider['slide_image']) > 0) { ?>
                                <img src="<?php echo FILE_URL . $slider['slide_image'] ?>" alt="" srcset="" width="200px">
                            <?php } ?>
                        </td> 
                        <td>
                            <?php echo ($slider['status'] == 0) ? "Hiển thị" : "Ẩn" ;  ?>
                        </td> 
                        <td><?= $slider['create_at'] ?></td>
                        <td>
                            <a class="btn btn-info" href="<?php echo SITE_URL . "edit_slider.php?id=".$slider['id'] ?>">Sửa</a>
                            <a class="btn btn-danger" href="<?php echo SITE_URL . "destroy_slider.php?id=".$slider['id'] ?>" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                        </td>
                    </tr>

                <?php $count++;
                }   ?>
            </tbody>
        </table>
    </section>

</div>

<?php include "./footer.php" ?>
</body>

</html>