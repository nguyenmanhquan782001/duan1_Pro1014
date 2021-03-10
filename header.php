<?php ob_start();
session_start();
define("SITE_PATH", dirname(__FILE__));
// echo SITE_PATH . "<br>";
define("SITE_UPLOAD", SITE_PATH . "/upload");
// echo  SITE_UPLOAD  . "<br>";
define("SITE_URL", "http://localhost/duan1_Pro1014/");
// echo SITE_URL  . "<br>";
define("FILE_URL", SITE_URL . "/upload/");
// echo FILE_URL;
require_once SITE_PATH . "/lib/connect.php";
$sql = "SELECT * FROM category";
$stmt = $connect->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll();



?>
<?php
if (isset($_POST['add'])) {
    header("Refresh:0");
    $id_cart = $_POST['id_cart'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (!isset($_SESSION['cart'][$id_cart])) {
        $_SESSION['cart'][$id_cart]['quantity'] = 1;
    } else {
        $_SESSION['cart'][$id_cart]['quantity']++;
    }
}


?> 
<?php 
$sql  = "SELECT * FROM slide where status = 0 " ; 
$stmt = $connect->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$sliders = $stmt->fetchAll();

?> 
<?php
 if(isset($_SESSION['cart'])) {
     $count = $_SESSION['cart'] ; 
     $sum = 0 ; 
     foreach ($count as $key => $values)  {
         $sum += $values['quantity'] ; 
     }

 }
?>
<?php
$sql = "SELECT * FROM seting";
$stmt = $connect->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$seting = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Shop giày 24h </title>

</head>
<style>
    .dropdown ul {
        list-style-type: none;
        position: absolute;
        margin: 0px;
        padding: 0px;
        width: 100%;
        transform: perspective(1000px) rotateX(-90deg);
        transform-origin: top;
        transition: 0.5s;
    }

    .dropdown ul.active {
        transform: perspective(1000px) rotateX(0deg);
    }


    .dropdown ul .side:hover {
        background-color: olivedrab;

    }

    .dropdown ul li a {
        display: block;
        padding: 10px;
        text-align: center;
        color: black;

    }

    ul .side a:hover {
        text-decoration: none;

    } 
    .dropdowns ul {
        list-style-type: none;
        position: absolute;
        margin: 0px;
        padding: 0px;
        width: 100%;
        /* transform: perspective(1000px) rotateX(-90deg); */
        transform-origin: top;
        transition: 0.5s;
    }
    .dropdowns ul.active {
        transform: perspective(1000px) rotateX(0deg);
    }
    .dropdowns ul .side:hover {
        background-color: olivedrab;

    }

    .dropdowns ul li a {
        display: block;
        padding: 10px;
        text-align: center;
        color: black;

    }

</style>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("button").click(function() {
                $('ul').toggleClass('active')
            });
        });
    </script>

    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $("button").click(function() {
                $('ul').toggleClass('active')
            });
        });
    </script> -->


    <div class="container-fluid">
        <div class="row" style="background-color: #f4f4f4; padding-top:20px; margin-top:10px;  ">
            <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4">
                <i class="fas fa-mail-bulk"></i>
                yummi@gmail.com
            </div>
            <div class="col-sm-5 col-lg-5 col-xs-5 col-md-5">

                <p>Miễn phí giao hàng sản phẩm từ 99.000</p>

            </div>
            <div class="col-sm-3 col-md-3 col-xs-3 col-lg-3" style="padding-left:20px ; font-size:20px">

                <div style="width:35px ; height:35px;  margin-bottom:10px; border-radius:999px;">
                    <?php if (isset($_SESSION['admin'])) {
                        $user = $_SESSION['admin'];
                        $select = "SELECT * FROM user where username = '$user'";
                        $stmt = $connect->prepare($select);
                        $stmt->execute();
                        $users = $stmt->fetch();
                    ?>
                        <img src="upload/<?= $users['image_user'] ?>" alt="" srcset="" width="100%" style="border-radius: 9999px;">

                    <?php } elseif (isset($_SESSION['user'])) {
                        $user = $_SESSION['user'];
                        $select = "SELECT * FROM user where username = '$user'";
                        $stmt = $connect->prepare($select);
                        $stmt->execute();
                        $users = $stmt->fetch();

                    ?>

                        <img src="upload/<?= $users['image_user'] ?>" alt="" srcset="" width="100%" style="border-radius: 9999px;">

                    <?php } else { ?>
                        <img src="1.png" alt="" srcset="" width="100%">
                    <?php } ?>
                </div>
                <ul style="list-style-type: none; position:absolute ; top:0px;">

                    <?php if (isset($_SESSION['admin'])) { ?>
                        <nav class="dropdown">
                            <button id="user" class="btn btn-default" style="color: red;"><?= $_SESSION['admin'] ?></button>
                            <ul>
                                <li style="font-size: 15px;"><a href="logout.php" onclick="return alert('Bạn chắc chắn muốn đăng xuất chứ ?')">Logout</a></li>
                                <li style="font-size: 15px; position:relative ; top:-15px;  "><a href="<?php echo SITE_URL . "profile.php?user=" . $_SESSION['admin'] ?>">Profile</a></li>
                            </ul>
                        </nav>
                        <li style="position:absolute ; right:-80px; top:6px; font-size:17px ;  "><a href="backend/index1.php">Quản trị</a></li>

                    <?php } elseif (isset($_SESSION['user'])) { ?>
                        <nav class="dropdown">
                            <button class="btn btn-default" style="color: red;"><?= $_SESSION['user'] ?></button>
                            <ul>
                                <li style="font-size: 15px;"><a href="logout.php" onclick="return alert('Bạn chắc chắn muốn đăng xuất chứ ?')">Logout</a></li>
                                <li style="font-size: 15px; position:relative ; top:-15px;  "><a href="<?php echo SITE_URL . "profile.php?user=" . $_SESSION['user'] ?>">Profile</a></li>
                            </ul>
                        </nav>
                    <?php  } else { ?>
                        <li style="display:inline-block ; padding-right:10px;  "><a style="font-size: 17px; " href="login.php">Đăng nhập</a></li>
                        <li style="display:inline-block"><a style="font-size:17px; " href="reg.php">Đăng kí</a></li>
                    <?php } ?>

                </ul>
            </div>

        </div>
        <div class="row" style="margin-top:35px">
            <div class="col-sm-3" style="padding-left:50px; ">
                <img src="./upload/<?= $seting['logo'] ?>" alt="" srcset="" style="width:140px">
            </div>
            <div class="col-sm-6">
                <form action="search.php" name="search" method="post">
                    <input name="name" class="form-control" type="text" placeholder="Search" aria-label="Search" style="margin-top: 35px;">
                    <button name="submit" type="submit" class="btn btn-primary" style="position: absolute; top:34px; right:16px;  ">Search</button>
                </form>
            </div>
            <div class="col-sm-3" style="padding-top:35px; padding-left: 40px ">
                <i class="fas fa-cart-plus" style="font-size: 25px;"></i>
                <a href="<?php echo SITE_URL . "add_to_cart.php" ?>"><span style="margin-left: 10px;">Giỏ hàng</span><br></a>
                <i class="fas fa-phone-square-alt" style="font-size: 25px ; margin-top:10px;">
                <?php if(!isset($sum)) { ?>  
                
                <?php echo "<p style = 'position:absolute ; top:20px; color:red; right:257px'>0</p>" ;  }else{ ?>  
                    <p  style = 'position:absolute ; top:20px; color:red; right:257px'><?= $sum ?></p>
                <?php } ?>
                
                </i>
                <span>Liên hệ : 0971.399.424</span>
            </div>
        </div>

        <div class="row" style=" min-height:100px ; margin-top:20px">
            <div class="col-sm-3">
                <nav class="dropdowns">
                    <button class="btn btn-info" style="margin-left: 68px; font-size:20px; ">Danh mục sản phẩm</button>
                    <ul>
                        <?php foreach ($categories as $category) { ?>
                            <li class="side" style="width:210px; border:1px solid black ; margin-left:66px; border-radius:10px;"><a href="<?= SITE_URL . "product.php?id=" . $category['id'] ?>"><?= $category['name_category'] ?></a></li>
                        <?php } ?>
                    </ul>

                </nav>
            </div>

            <div class="col-sm-9">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <?php foreach ($sliders as $i => $slider) { ?>                
                   <div class="carousel-item <?php if ($i==0) echo 'active' ?>">
                      <a href="<?= $slider['link'] ?>"><img class="d-block w-100" src="./upload/<?= $slider['slide_image'] ?>" alt=""></a> 
                   </div>
                  
           <?php } ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>

        </div>




    </div>
</body>

</html>