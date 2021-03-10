<?php include "./header.php" ?>
<?php include "./sidebar.php" ?>
<?php   
if(isset($_GET['id'])) {
  $id = $_GET['id'] ; 

 $sql = "SELECT * FROM slide WHERE id = '$id' " ; 
 $stmt = $connect->prepare($sql) ; 
 $stmt->execute() ; 
 $stmt->setFetchMode(PDO::FETCH_ASSOC) ; 
 $slider = $stmt->fetch() ; 
}

?>
<div class="content-wrapper">


  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Sửa danh mục</h1>
        </div><!-- /.col -->

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
            <li class="breadcrumb-item"><a href="add_category.php">Thêm danh mục</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
   
    <form name="" method="post" action="<?php echo SITE_URL . "update_slider.php?id=".$id ?>" enctype="multipart/form-data">

      <div class="form-group">
        <label for="exampleInputEmail1">Đường dẫn sản phẩm</label>
        <input value="<?= $slider['link']  ?>" type="text" name="link" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Đường dẫn sản phẩm">
      </div>
      <div class="form-group">
        <div class="form-group">
          <label for="exampleInputPassword1">Ảnh slider</label>
          <input name="slide_image" type="file" class="form-control" id="exampleInputPassword1">
        </div>
        <br>
        <?php
        if (strlen($slider['slide_image']) > 0) {
          echo "<img style='width:250px' src='" . FILE_URL . $slider['slide_image'] . "' />";
        }

        ?>
        <input type="hidden" name="slide_image" value="<?php echo $slider['slide_image'] ?>" />
      </div> 
      <label for="exampleFormControlTextarea1">Trạng thái :</label>
            <div class="radio"> 

                <label><input value="0" type="radio" name="status" <?php if ($slider['status'] == 0 ) { echo "checked" ;  }  ?> >Hiển thị</label>
            </div>
            <div class="radio">
                <label><input value="1" type="radio" name="status" <?php if ($slider['status'] == 1 ) { echo "checked" ;  }  ?>  >Ẩn</label>
            </div>

      <button name="update" type="submit" class="btn btn-danger">Cập nhật</button>
    </form>

  </section>

</div>



<?php include "./footer.php" ?>

</body>

</html>