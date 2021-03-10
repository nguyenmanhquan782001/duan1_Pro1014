<?php include_once "./header2.php" ?>
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
if (isset($_GET['id']) <= 0) {
    die();
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">


            <ul>
                <?php foreach ($categories as $category) { ?>
                    <li class="side" style="list-style-type:none; padding-top:20px;  "><a style="color: gray;" href="<?= SITE_URL . "product.php?id=" . $category['id'] ?>"><?= $category['name_category'] ?></a></li>
                <?php } ?>
            </ul>



        </div>
        <div class="col-sm-9">
            <div class="row" style="padding:20px;">
                <?php foreach ($products as $product) { ?>
                    <div class="col-sm-4" style="border: 1px solid black; padding : 10px 10px ; border-radius:10px ; margin-top:10px;   ">
                        <p style="position: absolute; top :0px; right:0px;  font-family : Chilanka; font-size : 25px; color:red;   "><?= $product['sale'] . "%" ?></p>
                        <a href="<?php echo SITE_URL . "details.php?id=" . $product['id'] . "&id_cate=" . $product['id_category'] ?>"><img src="./upload/<?= $product['image_product'] ?>" alt="" srcset="" width="250px" style="margin-left:25px;  "></a>
                        <br>
                        <h5 style="text-align: center;"><?= $product['name_product'] ?></h5>
                        <strike style="margin-left:100px"><?= number_format($product['price_product'])  . " " . "VNĐ" ?></strike>
                        <br>

                        <p style="text-align: center; font-weight:bold ;  font-size:18px;  "><?= number_format($product['price_product'] - ($product['sale'] / 100) * $product['price_product']) . " " . "VNĐ" ?></p>
                        <form action="" method="post">
                            <a href="<?php echo SITE_URL . "add_to_cart.php?id=" . $product['id']; ?>"><button name="add" class="btn btn-danger" style="margin-left:69px; ">Thêm vào giỏ hàng</button></a>
                            <input type="hidden" name="id_cart" value="<?php echo $product['id'] ?>">
                        </form>
                    </div>
                <?php  } ?>

            </div>

        </div>

    </div>

</div>


<?php include_once "./footer.php" ?>