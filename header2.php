<?php
session_start();
ob_start();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/style/jquery.nice-number.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <script src="public/style/jquery.nice-number.js" ></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Shop giày 24h </title>


</head> 

<style> 
body {
    overflow-x:hidden ;
}
    nav ul {
        margin: 0px 380px;
        list-style-type: none;


    }

    nav ul li {

        display: inline-block;
        margin-left: 20px;
    }

    nav ul li a {
        text-decoration: none;
        font-size: 18px;
        color: black;
    } 


</style>

<body>
   

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
                            <button class="btn btn-default" style="color: red;"><?= $_SESSION['admin'] ?></button>
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
                                <li style="font-size: 15px; position:relative ; top:-15px;  "><a href="logout.php">Profile</a></li>
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
                <a href="<?php echo SITE_URL . "index1.php" ?>">   <img src="./upload/<?= $seting['logo'] ?>" alt="" srcset="" style="width:140px"></a>
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

        <div class="row" style=" min-height:100px ; margin-top:20px ">
            <div class="col-sm-12">
                <nav>
                    <ul>

                        <?php foreach ($categories as $category) { ?>
                            <li><a href="<?= SITE_URL . "product.php?id=" . $category['id'] ?>"><?= $category['name_category'] ?></a></li>

                        <?php } ?>
                    </ul>

                </nav>

            </div>


        </div>





    </div>
</body>

</html>