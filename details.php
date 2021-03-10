<?php
include_once "./header2.php";
?>
<?php
if(isset($_POST['add']) && isset($_GET['id'])) {  
    $id = $_GET['id'] ; 
     $quantity = $_POST['quantity'] ;   
     $_SESSION['cart'][$id]['quantity']=  $quantity ;  
    
    
}
?>
<?php
$id = null;
$id_pro = null;
(int) $view = 1;
if (isset($_GET['id_cmt'])) {
    $id_cmt = $_GET['id_cmt'];
    $sql_del = "DELETE FROM comment where id = '$id_cmt'";
    $stmt = $connect->prepare($sql_del);
    $stmt->execute();
}
if (isset($_GET['id']) && isset($_GET['id_cate'])) {
    $id = $_GET['id'];
    $id_category = $_GET['id_cate'];
    $select = "SELECT * FROM products where id = '$id'";
    $stmt = $connect->prepare($select);
    $stmt->execute();
    $product = $stmt->fetch();
    $array = array($product);
    //     echo "<pre>" ; 
    //     print_r(
    // $array
    //     ) ; 
    //     exit ; 

    foreach ($array as $pro) {
        $id = $pro['id'];
        $view += $pro['view'];
        $update = "UPDATE products SET view = '$view' where id = '$id'";
        $stmt = $connect->prepare($update);
        $stmt->execute();
    }
}

$sql = "SELECT * FROM products where id_category = '$id_category' ORDER BY RAND() LIMIT 3";
$products = $connect->query($sql);





if (isset($_SESSION['user']) && isset($_POST['comment'])) {
    $date = date("Y/m/d");
    $user = $_SESSION['user'];
    $content = $_POST['content'];
    $sql = "SELECT * FROM user where username = '$user'";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $users = $stmt->fetch();
    $name = $users['id'];
    $insert = "INSERT INTO comment (content , id_product , id_user , create_at) VALUES (:content , :id_product , :id_user , :create_at)";
    $stmt = $connect->prepare($insert);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":id_product", $id);
    $stmt->bindParam(":id_user", $name);
    $stmt->bindParam(":create_at", $date);
    $stmt->execute();
}
if (isset($_SESSION['admin']) && isset($_POST['comment'])) {
    $date = date("Y/m/d");
    $admin = $_SESSION['admin'];
    $content = $_POST['content'];
    $sql =  "SELECT * FROM user WHERE username = '$admin'";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $res = $stmt->fetch();
    $admins = $res['id'];
    $insert = "INSERT INTO comment (content , id_product , id_user , create_at) VALUES (:content , :id_product , :id_user , :create_at)";
    $stmt = $connect->prepare($insert);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":id_product", $id);
    $stmt->bindParam(":id_user", $admins);
    $stmt->bindParam(":create_at", $date);
    $stmt->execute();
} elseif (!isset($_SESSION['user']) && isset($_POST['comment'])) {
    echo "<script>alert('Vui lòng đăng nhập trước khi bình luận!')</script>";
}
?>

<script>
    $(function() {
        $('input[type="number"]').niceNumber({
            buttonDecrement:'-',
            buttonIncrement:"+",
            buttonPosition:'around'

        });
    });
</script>
<style>
    .nice-number button {
        margin-top: 10px;
        width: 50px;
        margin: 0 10px implements;
        outline: none;
        border: none;

    }

    button:hover {
        outline: none;

    }

    .nice-number input {
        width: 100ch;
    }
</style>
<div class="container-fluid">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-sm-7">
            <img src="<?php echo SITE_URL . "upload/" . $product['image_product'] ?>" alt="" srcset="" width="85%" style="margin-left:50px; ">
        </div>
        <div class="col-sm-5" style="padding-left:-10px;   ">
            <h4><?= $product['name_product'] ?></h4>
            <div style="border-bottom:1px dotted gray ; width:80% ; ">
            </div>
            <h5 style="margin-top: 20px;"><?= number_format($product['price_product'] - ($product['sale'] / 100) * $product['price_product']) . " " . "VNĐ" ?></h5>
            <div style="border-bottom:1px dotted gray ; width:80% ; ">
            </div>
            <h5 style="margin-top: 20px;"> Trạng thái :<?= " " .  $kqs = $product['quantity'] != 0 ? "Còn hàng" : 'Hết hàng';  ?></h5>
            <div style="border-bottom:1px dotted gray ; width:80% ;  ">

            </div>
         
                
                <form action="" method="post" ">
                <input name="quantity" value="1" style="margin-top:10px; width: 100ch " type="number" min="0" /> <br>
                    <a href="<?php echo SITE_URL . "add_to_cart.php?id=" . $product['id']; ?>">
                    <button  name="add" class="btn btn-danger" style="margin-top:25px;  ">Thêm vào giỏ hàng</button></a>
                    <input type="hidden" name="id_cart" value="<?php echo $product['id'] ?>">
                    <button d class="btn btn-info" style="margin-top:25px " type="submit">
                        Mua ngay
                    </button>
                  
                </form>


            <div style="margin-top:10px; border:1px solid red ; padding :5px 10px; width:80%;">
                <i class="fas fa-phone" style="color:gray"> Gọi tư vấn đặt hàng nhanh <b style="margin-left: 10px; color:red ;">0971.399.424</b> </i> <br>

            </div>
            <i style="color:gray ; margin-top:10px; " class="fas fa-truck"> MIỄN PHÍ GIAO HÀNG TOÀN QUỐC</i>
            <br>
            <i style="color:gray ; margin-top:20px; " class="fas fa-book"> DỄ DÀNG ĐỔI TRẢ</i>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-8">
            <h5 style="text-align:center">Mô tả sản phẩm</h5>
            <div style="border-bottom: 1px dotted gray; margin:10px 0; ">

            </div>
            <p><?= $product['descr'] ?></p>

        </div>
        <div class="col-sm-2">

        </div>

    </div>
    <div class="row" style="margin-bottom:10px ;">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-8" style="min-height:60px ; border:1px solid #f4f4f4 ;  border-radius:10px;">
            <h5>Đánh giá sản phẩm </h5>
            <form method="post" id="cmt">
                <div class="form-group">
                    <label for="comment" style="font-weight: bold;">Comment:</label>
                    <textarea name="content" class="form-control" rows="1" id="comment" style="border-radius: 999px;"></textarea>

                    <button type="submit" name="comment" class="fas fa-angle-double-right" style="border:none ; background:none ; outline:none; font-size:20px; position:absolute ; top:72px; right:29px; " onclick="cmt()"></button>
                </div>
            </form>
            <div style="margin:20px 0px;border-bottom:1px solid #cdcdcd">

                <div>
                    <?php


                    $stmt = $connect->prepare("SELECT  *  FROM comment WHERE id_product =  $id ORDER BY id DESC");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $cmts =   $stmt->fetchAll();
                    foreach ($cmts as $bl) {
                        $id_user = $bl['id_user'];
                        $stmt = $connect->prepare("SELECT  *  FROM user WHERE id =  $id_user");
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $names =   $stmt->fetchAll();
                        foreach ($names as $lon) {
                            $tt =   $bl['status'];
                            if ($tt == 1) {   ?>

                                <span style="font-weight:bold; "></span>
                                <div style="margin:20px 0px;border-bottom:1px solid #cdcdcd">
                                    <b><?= $lon['fullname'] ?></b><span style="float:right;font-size:10px"><?= $bl['create_at'] ?></span>
                                    <p class="m_text"><?= $bl['content'] ?>
                                    </p>
                                    <?php if (isset($_SESSION['user'])) { ?>
                                        <?php if ($_SESSION['user'] == $lon['username']) { ?>
                                            <a href="details.php?id=<?= $id ?>&id_cate=<?= $id_category ?>&id_cmt=<?= $bl['id'] ?>">Xóa</a>
                                        <?php }
                                        ?>
                                    <?php } elseif (isset($_SESSION['admin'])) {  ?>
                                        <?php if ($_SESSION['admin'] == $lon['username']) { ?>
                                            <a href="details.php?id=<?= $id ?>&id_cate=<?= $id_category ?>&id_cmt=<?= $bl['id'] ?>">Xóa</a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>


                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-8">
            <h5 style="text-align: center;">Có thể bạn thích</h5>
            <div class="row">
                <?php foreach ($products as $productss) { ?>
                    <div class="col-sm-4">
                        <img src="<?php echo SITE_URL . "upload/" . $productss['image_product'] ?>" alt="" srcset="" width="250px" style="margin-left:25px; ">
                        <br>
                        <h5 style="text-align: center;"><?= $productss['name_product'] ?></h5>
                        <p style="text-align: center; font-weight:bold ;  font-size:18px;"><?= number_format($productss['price_product'] - ($productss['sale'] / 100) * $productss['price_product']) . " " . "VNĐ" ?></p>

                    </div>
                <?php } ?>


            </div>
        </div>
        <div class="col-sm-2">

        </div>

    </div>

</div>
<script>
function cmt() {
    window.location.href = '#cmt' ; 
}
</script>

<?php
include_once "./footer.php"
?>