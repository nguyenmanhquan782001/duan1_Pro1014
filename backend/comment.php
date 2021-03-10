<?php include_once "./header.php" ?> 
<?php include_once "./sidebar.php" ?>  
<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Quản trị bình luận </h1>
                  </div><!-- /.col -->

                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                          <li class="breadcrumb-item"><a href="add_category.php">Khác</a></li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
         
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>STT</th> 
                          <th>Tên sản phẩm</th>
                          <th>Ảnh sản phẩm</th>
                          <th>Số bình luận</th>        
                          <th>Xem chi tiết</th>
                      </tr>
                  </thead>
                  <tbody> 
                  <?php

try {
    $stmt = $connect->prepare("SELECT DISTINCT id_product  FROM comment ");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $cmts = $stmt->fetchAll();
    $index = 1;
    foreach ($cmts as $cmt) {
        $id_product =  $cmt['id_product'];

        $stmt = $connect->prepare("SELECT  *  FROM products  WHERE id  = $id_product ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $products = $stmt->fetch();

        $stmt = $connect->prepare(" SELECT COUNT(*) FROM comment WHERE id_product = $id_product ");
        $stmt->execute();
        $tong = $stmt->fetchColumn();

        $stmt = $connect->prepare("SELECT  *  FROM comment WHERE id_product = $id_product ORDER BY id  DESC LIMIT 1 ");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $date = $stmt->fetch();

?>
        <tr>
            <td> <?php echo $index++; ?></td>
            <td><?php echo $products['name_product'] ?></td>
            <td> <?php if (strlen($products['image_product']) > 0) { ?>
                                      <img src="<?php echo FILE_URL . $products['image_product'] ?>" alt="" srcset="" width="200px">
                                  <?php } ?></td>
            <td><?= $tong; ?></td>
           
            <td>
                <a href='detailComment.php?id=<?php echo $id_product; ?>' name='delete_product' class='btn btn-danger'>Chi tiết</a> </td>
        </tr>
        </tr>
<?php
    }
} catch (Exception $e) {
    echo "<br> Lỗi truy vấn cơ sở dữ liệu" . $e->getMessage();
}
?>
                     
                  </tbody>
              </table>
      </section>

  </div>
<?php include_once "./footer.php" ?>