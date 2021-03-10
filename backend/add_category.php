<?php require_once "./header.php" ?>
<?php include "./sidebar.php" ?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Thêm danh mục</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
            <li class="breadcrumb-item"><a href="list_category.php">Quay lại</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content"> 
   
  <?php

if (isset($_SESSION["errorMessege"]) && !empty($_SESSION["errorMessege"])) {
  echo "<div style='color:red'>" . $_SESSION["errorMessege"] . "</div>";
  unset($_SESSION["errorMessege"]);
}
?>
    <form name="" method="post" action="<?php echo SITE_URL ."store.php" ?>" enctype="multipart/form-data">
     
      <div class="form-group">
        <label for="exampleInputEmail1">Tên danh mục</label>
        <input type="text" name="name_category" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tên danh mục">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Ảnh danh mục</label>
        <input name="image_category" type="file" class="form-control" id="exampleInputPassword1">
      </div>

      <button name="add" type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
  </section>
  <!-- /.content -->
</div>

<?php require_once "./footer.php" ?>

</body>
</htm>