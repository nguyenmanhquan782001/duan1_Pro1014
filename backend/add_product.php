<?php require_once "./header.php" ?>
<?php include "./sidebar.php" ?>
<?php
$sql = "SELECT * FROM category";
$stmt = $connect->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll();

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Thêm sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="list_product.php">Quay lại</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        <form name="" method="post" action="<?php echo SITE_URL . "store1.php" ?>" enctype="multipart/form-data">

            <?php

            if (isset($_SESSION["errorsMessage"]) && !empty($_SESSION["errorsMessage"])) {
                echo "<div style='color:red'>" . $_SESSION["errorsMessage"] . "</div>";
                unset($_SESSION["errorsMessage"]);
            }
            ?>

            <div class="form-group">
                <label for="exampleInputEmail1">Tên sản phẩm</label>
                <input type="text" name="name_product" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tên sản phẩm">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Ảnh sản phẩm</label>
                <input name="image_product" type="file" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Giá sản phẩm</label>
                <input  type="number" name="price_product" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Giá sản phẩm">
            </div>

            
            <div class="form-group">
                <label for="exampleInputEmail1">Tồn kho</label>
                <input type="number" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Số lượng sản phẩm">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Sale</label>
                <input type="number" name="price_sale" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sale %">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Mô tả sản phẩm</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Danh mục</label>
                <select name="categories" class="form-control" id="exampleFormControlSelect1">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name_category'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <label for="exampleFormControlTextarea1">Trạng thái :</label>
            <div class="radio">
                <label><input value="0" type="radio" name="status">Đang mở bán</label>
            </div>
            <div class="radio">
                <label><input value="1" type="radio" name="status">Ngừng bán</label>
            </div>

            <button name="add_product" type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </section>
    <!-- /.content -->
</div>
<?php require_once "./footer.php" ?>
<script>
    CKEDITOR.replace('exampleFormControlTextarea1');
</script>
</body>
</htm>