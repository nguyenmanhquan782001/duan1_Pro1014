<?php ob_start();
include "./header.php" ?>
<?php include "./sidebar.php" ?>
<?php
$sql = "SELECT products.id,  name_product , image_product , status_product , price_product , sale , id_category , name_category , quantity FROM products INNER JOIN category  ON products.id_category =  category.id ";
$stmt = $connect->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$products = $stmt->fetchAll();


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quản trị sản phẩm</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="add_product.php">Thêm sản phẩm</a></li>
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
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Giá sale</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1;
                foreach ($products as $product) { ?>
                    <tr>
                        <td><?= $count ?></td>
                        <td><?= $product['name_product'] ?></td>
                        <td>
                            <?php if (strlen($product['image_product']) > 0) { ?>
                                <img src="<?php echo FILE_URL . $product['image_product'] ?>" alt="" srcset="" width="200px">
                            <?php } ?>
                        </td>
                        <td><?= $product['price_product'] ?></td>
                        <td><?= $product['sale'] ?> %</td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['name_category'] ?></td>
                        <td><?= ($product['status_product'] == 0) ? "Đang mở bán"  : "Ngừng bán" ?></td>
                        <td>
                            <a class="btn btn-info" href="<?php echo SITE_URL . "editproduct.php?id=".$product['id'] ?>">Sửa</a>
                            <a class="btn btn-danger" href="<?php echo SITE_URL . "destroy_product.php?id=".$product['id'] ?>" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                        </td>
                    </tr>
                <?php $count++;
                } ?>
            </tbody>
        </table>
    </section>

</div>











<?php require_once "./footer.php" ?>
</body>

</html>