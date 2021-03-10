<?php include_once "./header.php" ?> 
<?php 
 if(isset($_GET['id']))  {
     $id = $_GET['id'] ;  
     $delete = "DELETE  FROM orderdetail where id = '$id' " ;  
     $stmt = $connect->prepare($delete) ; 
     $stmt->execute() ;   
 }
   
?>
<?php
if (isset($_GET['id'])) {
    $tong = 0;
    $id = $_GET['id'];
    $sql = "SELECT  name_product , products.price_product , quantity_product , sale , image_product ,  orderdetail.id  FROM orderdetail INNER JOIN products ON products.id = orderdetail.id_product WHERE orderdetail.order_id = $id";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $bill2 = $stmt->fetchAll();
}
?>

<?php 
//  if(isset($_GET['id_detail'])) {
//      $id = $_GET['id_detail'] ; 
//      $select = "SELECT * FROM orderdetail where id = '$id'" ; 
//      $stmt = $connect->prepare($select); 
//      $stmt->execute() ; 
//      $stmt->setFetchMode(PDO::FETCH_ASSOC) ; 
//      $det = $stmt->fetch() ; 

//  }
?>
<div class="content-wrapper"> 
<?php echo SITE_URL ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Chi tiết đơn hàng</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content"> 

        <h5 style="text-align: center;">Thông tin</h5> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th> 
                    <th>Số lượng</th>
                </tr>
            </thead> 
            <tbody>
            <?php foreach ($bill2 as $tt) { ?>
                <tr>
                    <td><?php echo  $tt['name_product'] ?></td>
                    <td> <?php echo $tt['quantity_product'] ?></td>
                  
                </tr>
                <?php
            $tong += ($tt['price_product'] - ($tt['sale'] / 100) * $tt['price_product']) * $tt['quantity_product'];
        } ?>

            </tbody>
        </table>
      
        <h6>Tổng tiền thanh toán : <?= number_format($tong) ?></h6>
        <td> <a href="<?php echo  SITE_URL . "order.php" ?>" class="btn btn-danger">Quay lại đơn hàng</a></td>
   
    </section>


</div>
<?php include_once "./sidebar.php" ?>
<?php include_once "./footer.php" ?>