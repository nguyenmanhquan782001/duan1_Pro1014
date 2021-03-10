<?php include_once "./header2.php" ?>
<?php
// session_destroy() ; 
if (!empty($_SESSION['cart'])) {
    $price_total = 0;
    $list_id = "";
    $list_quantity = [];
    if (isset($_POST['tru'])) {
        $id = $_POST['id_product'];
        $_SESSION['cart'][$id]['quantity']--; 
        header("Location:" . SITE_URL . "add_to_cart.php");

        if ($_SESSION['cart'][$id]['quantity'] == 0) {
            unset($_SESSION['cart'][$id]);
            header("Location:" . SITE_URL . "add_to_cart.php");
        }
    }
    if (isset($_POST['cong'])) {
        $id = $_POST['id_product'];
        $_SESSION['cart'][$id]['quantity']++;
        header("Location:" . SITE_URL . "add_to_cart.php");
    }
    if (isset($_GET['delete'])) {
        $delete = $_GET['delete'];
        unset($_SESSION['cart'][$delete]);
        header("Location:" . SITE_URL . "add_to_cart.php");
    }



    foreach ($_SESSION['cart'] as $key => $values) {
        $id_product = $key;
        $list_id .= "$key,";
        $list_quantity[$key] = $values['quantity'];
    }
    //  echo "<pre>" ; 
    //  print_r($list_quantity) ; 
    $list = rtrim($list_id, ',');
    //  echo "<pre>" ; 
    //  print_r($list) ;  
    $se = "SELECT *  FROM  products  where id IN ($list)";
    $stmt = $connect->prepare($se);
    $stmt->execute();
    $he = $stmt->fetchAll();
    //   echo "<pre>" ; 
    //   print_r($he) ; 

    //  exit ; 
} else {
    $msg = "Không tồn tại sản phẩm nào trong giỏ hàng";
}

?>
<?php
$sql = "SELECT * FROM category";
$categories = $connect->query($sql);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = "SELECT * FROM products where id_category = '$id'";
    $stmt = $connect->prepare($select);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $products = $stmt->fetchAll();
}

?>

<div class="row">

<?php if (!empty($msg)) {
        echo "<div style= 'margin-left:500px;' class='alert alert-danger' role='alert'> $msg </div>";
    } else {
    ?>
    <div class="col-sm-8">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh </th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($_SESSION['cart'])) { ?>
                    <?php $tong = 0;
                    foreach ($he as $product) { ?>
                        <tr>
                            <td><?= $product['name_product'] ?></td>
                            <td>
                                <?php if (strlen($product['image_product']) > 0) { ?>
                                    <img src="<?php echo FILE_URL . $product['image_product'] ?>" alt="" srcset="" width="200px">
                                <?php } ?>
                            </td>
                            <td><?= number_format($product['price_product'] - ($product['sale'] / 100) * $product['price_product']) . " " . "VNĐ" ?></td>
                            <td>
                                <form action="" method="post">
                                    <p style="font-size: 15px; display:flex ; width:20px;">
                                        <button class="btn btn-light" name="tru">-</button>
                                        <span style="margin-top: 10px;"><?php echo $list_quantity[$product['id']]; ?></span>
                                        <button class="btn btn-light" name="cong">+</button>
                                        <input type="hidden" name="id_product" value="<?php echo $product['id'] ?>">
                                    </p>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="<?php echo SITE_URL . "delete_cart.php?delete=" . $product['id'];   ?>" onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không?')">Xóa</a>
                            </td>
                            <?php $tong += ($product['price_product'] - ($product['sale'] / 100) * $product['price_product']) * $list_quantity[$product['id']];
                            ?>

                        </tr>
                    <?php

                    } ?>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>

                    <th></th>
                </tr>
            </tfoot>
        </table>



    </div>
    <div class="col-sm-4">
        <div style=" margin-bottom:10px ; border:1px solid #f4f4f4; min-height:200px; border-radius:5px;  box-shadow:2px 3px gray ;  ">
            <h4 style="text-align: center; font-family:tahoma; margin-top:10px; font-size:25px;">Tổng số</h4>
            <div style="border-bottom: 1px dotted gray;">
                <h5>Tạm tính :</h5>
                <span style=""><?= number_format($tong) . " " . "VND" ?></span>

            </div>
            <div style="margin-top: 25px;">
                <h5>Thành tiền:</h5>
                <span style=" font-size:20px; color:red ; font-weight:bold "><?= number_format($tong) . " " . "VND" ?></span>

            </div>



        </div>
        <div style="margin-left:60px;  ">
            <a class="btn btn-info" href="<?php echo SITE_URL . "index1.php" ?>">Tiếp tục mua hàng</a>
            <a class="btn btn-danger" href="<?php echo SITE_URL . "info_user_order.php" ?>">Tiến hành đặt hàng</a>
        </div>


    </div>


</div>
<div class="row">

    <div class="col-sm-3">

    </div>

    <div class="col-sm-6">

    </div>
    <div class="col-sm-3">

    </div>
<?php } ?>
</div>


<?php include_once "./footer.php" ?>