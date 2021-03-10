<?php include_once "./header2.php" ?>
<?php
if (isset($_GET['id'])) { 
    $tong = 0 ; 
    $id = $_GET['id'];
    $sql = "SELECT customer_name , customer_phone , customer_address FROM orders INNER JOIN user ON  user.id = orders.id_user  WHERE orders.id = $id";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $bill = $stmt->fetch();

    $sql = "SELECT  name_product , products.price_product , quantity_product , sale , image_product FROM orderdetail INNER JOIN products ON products.id = orderdetail.id_product WHERE orderdetail.order_id = $id";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $bill2 = $stmt->fetchAll();
}
?>
<div class="row">
    <div class="col-sm-3">

    </div>
    <div class="col-sm-6">
         <div class="alert alert-success">
                <h5>Chúc mừng bạn đã đặt hàng thành công</h5>
         </div>
        <div style="width:100% ; min-height:500px; border:1px solid gray ; border-radius:5px;  padding:10px;  ">
            <h4 style="text-align:center">Thông tin đơn hàng</h4>
            <div style="border-bottom: 2px solid #f4f4f4;">
            </div>
            <div>
                <h6>Họ và tên : <i style="color: red;"> <?= $bill['customer_name'] ?> </i></h6>
                <h6>Địa chỉ giao hàng : <i style="color: red;"> <?= $bill['customer_address'] ?></i></h6>
                <h6>Số điện thoại người nhận : <i style="color: red;"><?= $bill['customer_phone'] ?></i> </h6>

            </div>
            <div style="border-bottom: 2px solid #f4f4f4;">
            </div>

            <div>
                <h4 style="text-align: center; margin-top:20px;">Sản phẩm đã đặt hàng</h4>
                <?php foreach ($bill2 as $product) { ?>
                    <div style="border:2px solid #f4f4f4 ; min-height:50px ; width:600px ; margin:10px auto ; display:flex;     ">
                        <div style="padding: 10px;">
                            <?php if (strlen($product['image_product']) > 0) { ?>
                                <img src="<?php echo FILE_URL . $product['image_product'] ?>" alt="" srcset="" width="100px">
                            <?php } ?>
                        </div>
                        <div style="margin-left: 10px; margin-top:17px; ">
                            <h6>Tên sản phẩm : <i style="color: red;"><?= $product['name_product'] ?></i></h6>
                            <h6>Giá sản phẩm : <i style="color: red;"><?= number_format(($product['price_product'] - ($product['sale'] / 100) * $product['price_product'])) . " " . "VNĐ" ?></i></h6>
                            <h6>Số lượng mua : <i style="color: red;"><?= $product['quantity_product'] ?></i></h6>

                        </div>

                    </div> 
                     
                <?php 
            $tong += ($product['price_product'] - ($product['sale'] / 100) * $product['price_product']) * $product['quantity_product'] ; 
            } ?>

               <div>
                   <b>Tổng số tiền phải thanh toán : <?= number_format($tong) . " " . "VNĐ" ?></b>
               </div>
            </div>

        </div>

    </div>
    <div class="col-sm-3">

    </div>
</div>


<?php include_once "./footer.php" ?>