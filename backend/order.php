<?php include_once "./header.php" ?>
<?php include_once "./sidebar.php" ?> 

<?php
$sql = "SELECT * FROM  orders ";
$stmt = $connect->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$orders = $stmt->fetchAll();



?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quản trị đơn hàng</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="add_product.php"></a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <table class="table table_hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Chi tiết đơn hàng</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1;
                foreach ($orders as $order) { ?>
                    <tr>
                        <td><?= $count  ?></td>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['customer_name'] ?> </td>
                        <td><?= $order['customer_address'] ?></td>
                        <td><a href="orderdetail.php?id=<?= $order['id'] ?>">Xem chi tiết</a></td>
                        <td><?= $order['create_at'] ?></td>
                        <td>
                           <?php if($order['order_status'] == 1) { ?>  


                           <?php echo "Đã giao hàng" ;   } else { ?>  
                            <a href="<?= SITE_URL . "confirm.php?id=". $order['id'] ?>" onclick="return confirm('Bạn có muốn xác nhận không?')">Xác nhận giao hàng</a>
                           <?php } ?>
                        </td> 
                        <td>
                        <a class="btn btn-danger" href="<?php echo SITE_URL."delete_order.php?id=".$order['id'] ?>"  onclick="return confirm('Bạn có muốn xóa không?')" >Xóa </a>
                        </td>

                    </tr>
                <?php $count++;
                } ?>

            </tbody>
        </table>
    </section>

</div>
<?php include_once "./footer.php" ?>