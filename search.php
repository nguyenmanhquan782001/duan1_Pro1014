<?php include "./header2.php" ?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
} else {
    header("Location:index1.php");
}
$sql = "SELECT * FROM products where name_product  like '%$name%'";
$stmt = $connect->prepare($sql) ; 
$stmt->execute() ;
$stmt->setFetchMode(PDO::FETCH_ASSOC) ; 
$products =  $stmt->fetchAll() ; 



?>
<style>
    .containers {
        position: relative;

    }

    .overlay {
        position: absolute;
        top: 80%;
        left: 14%;
        right: 0;
        height: 10%;
        width: 83%;
        opacity: 0;
        transition: .5s ease;
        justify-content: center;
    }

    .col-sm-3:hover .overlay {
        opacity: 1;
    }

    .texts {
        color: white;
        font-size: 20px;
        position: absolute;
        top: -151%;
        left: 51%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-56%, -50%);
        text-align: center;
    }

    /* .texts div {
      width: 50px; height: 50px; border: 1px solid black; 
      display: flex;
  } */
    .texts i {
        font-size: 20px;
        margin-left: 15px;
        cursor: pointer;
        border: 1px solid;
        padding: 5px 5px;
        border-radius: 50%;
        color: black;
        padding: 10px 10px;
        background: white;
        border: none;
        transition-delay: .1s;
        transition: .5s;
    }

    .texts i:hover {
        background-color: red;
        transition: .4s;
    }

    .texts div {
        border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-border-radius: 50%;
        color: white;
    }

    .img1 img {
        width: 250px;
        margin-left: 45px;
        cursor: pointer;
        transition: .5s;
        margin-bottom: 10px;
        border-radius: 5px;

    }
</style>
<div class="row"> 
    <?php foreach ($products as $product ){ ?>
    <div class="col-sm-3">
        <div class="img1">
             <a href="<?php echo SITE_URL . "details.php?id=" . $product['id'] . "&id_cate=" . $product['id_category'] ?>"><img src="./upload/<?= $product['image_product'] ?>" alt="" srcset="" width="250px" style="margin-left:25px;  "></a>
                 
            <div class="overlay">
                <div class="texts">
                <form action="" method="post">
                    <a href="<?php echo SITE_URL . "add_to_cart.php?id=" . $product['id']; ?>"><button name="add" class="fas fa-cart-arrow-down" style="margin-left:-50px; border:none ; color:black ; border-radius:999px; padding:5px;  "></button></a>
                    <input type="hidden" name="id_cart" value="<?php echo $product['id'] ?>">
                   
                </form>
                    <!-- <i class="far fa-heart"></i>
                    <i class="fas fa-cart-arrow-down"></i> -->
                </div>
            </div>
            <b style="margin-left:70px; font-size:21px;"><?= $product['name_product'] ?></b>
            <div style="display:flex; margin-top:7px;  ">
                <strike style="margin-left: 50px;"><?= number_format($product['price_product'])  . " " . "VNĐ" ?></strike>
                <p style="margin-left: 10px; font-size:17px; font-weight:bold ; color:red"><?= number_format($product['price_product'] - ($product['sale'] / 100) * $product['price_product']) . " " . "VNĐ" ?></p>
            </div>
        </div>
    </div>
    <?php } ?>


  
  
  

</div>
<?php include "./footer.php" ?>