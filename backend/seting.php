<?php require_once "./header.php" ?>
<?php include_once "./sidebar.php" ?>  
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
            <li class="breadcrumb-item"><a href="list_slider.php">Quay lại</a></li>
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

    <form name="" method="post" action="<?php echo SITE_URL . "store_seting.php" ?>" enctype="multipart/form-data">
     
      <div class="form-group">
        <label for="exampleInputEmail1">Thong tin dia chi</label>
        <input type="text" name="adress" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="thong tin dia chi">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">chinh sach</label>
        <input type="text" name="chinhsach" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="thong tin dia chi">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Thong tin lien he</label>
        <input type="text" name="lienhe" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="thong tin dia chi">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Logo website</label>
        <input name="image_logo" type="file" class="form-control" id="exampleInputPassword1">
      </div> 
    
      <button name="add_seting" type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
  </section>
  <!-- /.content -->
</div>
<?php include_once "./footer.php" ?>
</body>
</html>