<?php
$sql = "SELECT * FROM products  ORDER BY  id  desc LIMIT 0,4";
$stmt = $connect->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$products = $stmt->fetchAll();
//  echo "<pre>" ; 
//  print_r($product) ; 
//  exit ;  

?>
<div class="container-fluid">
    <div class="row" style="margin: 10px 0px;">
        <div class="col-sm-12">
            <h3 style="text-align: center;">Sản phẩm mới về</h3>
        </div>
    </div>
    <div class="row" style="margin-bottom:10px ; margin-left:15px;  ">

        <?php foreach ($products as $product) { ?>
            <div class="col-sm-3" style="border: 1px solid black; padding : 10px 10px ; border-radius:10px ;  ">
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
    <div class="row">
        <div class="col-sm-12">
            <h3 style="text-align: center; margin:10px 0px ; ">Sản phẩm xem nhiều</h3>
        </div>
    </div>
    <div class="row" style="margin-bottom:10px ; margin-left:15px;  ">
        <?php
        $sql = "SELECT * FROM  products ORDER BY view  DESC LIMIT 0,4";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC) ; 
        $products = $stmt->fetchAll() ; 

        ?>
         <?php foreach ($products as $product) { ?>
        <div class="col-sm-3" style="border: 1px solid black; padding : 10px 10px ; border-radius:10px ;  "> 
       
            <i class="far fa-eye" style="position: absolute; top:0px; left:5px; opacity:0.6;  "><span><?= $product['view'] ?></span></i>
            <a href="<?php echo SITE_URL . "details.php?id=" . $product['id'] . "&id_cate=" . $product['id_category'] ?>"><img src="./upload/<?= $product['image_product'] ?>" alt="" srcset="" width="250px" style="margin-left:25px;  "></a>
            <br>
            <h5 style="text-align: center;"><?= $product['name_product'] ?></h5>
            <p style="text-align: center; font-weight:bold ;  font-size:18px;  "><?= number_format($product['price_product'] - ($product['sale'] / 100) * $product['price_product']) . " " . "VNĐ" ?></p>
            <form action="" method="post">
                    <a href="<?php echo SITE_URL . "add_to_cart.php?id=" . $product['id']; ?>"><button name="add" class="btn btn-danger" style="margin-left:69px; ">Thêm vào giỏ hàng</button></a>
                    <input type="hidden" name="id_cart" value="<?php echo $product['id'] ?>">
                </form>

        </div>
        <?php } ?>
    </div>


</div>