<?php ob_start();
include "./header.php" ?>
<?php include "./sidebar.php" ?>
<?php
$sql = "SELECT * FROM seting ";
$stmt = $connect->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$setings = $stmt->fetchAll();


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Cài đặt</h1>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="seting.php">Thêm </a></li>
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
                    <th>id</th>
                    <th>dia chi website</th>
                    <th>chinh sach</th>
                    <th>lien he</th>
                    <th>logo</th>
                    <th>thoi gian tao</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($setings as $seting) { ?>
                    <tr>
                        <td><?= $seting['id'] ?></td>
                        <td><?= $seting['adress'] ?></td>
                        <td><?= $seting['chinhsach'] ?></td>
                        <td><?= $seting['lienhe'] ?> </td>
                        <td>
                            <?php if (strlen($seting['logo']) > 0) { ?>
                                <img src="<?php echo FILE_URL . $seting['logo'] ?>" alt="" srcset="" width="200px">
                            <?php } ?>
                        </td>
                        <td><?= $seting['created_at'] ?></td>
                        <td>
                            <a class="btn btn-info" href="editseting.php?id=<?= $seting['id'] ?>">Sửa</a>
                            <a class="btn btn-danger" href="<?php echo SITE_URL . "delete_seting.php?id=".$seting['id'] ?>" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

</div>

<?php require_once "./footer.php" ?>
</body>

</html>