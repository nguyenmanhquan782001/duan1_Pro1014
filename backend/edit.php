<?php include "./header.php" ?>
<?php include "./sidebar.php" ?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM category where id = '$id'";
  $stmt = $connect->prepare($sql);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $category = $stmt->fetch();
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
    <?php

    if (isset($_SESSION["errorMessege"]) && !empty($_SESSION["errorMessege"])) {
      echo "<div style='color:red'>" . $_SESSION["errorMessege"] . "</div>";
      unset($_SESSION["errorMessege"]);
    }
    ?>
    <form name="" method="post" action="<?php echo SITE_URL . "update.php?id=".$id ?>" enctype="multipart/form-data">

      <div class="form-group">
        <label for="exampleInputEmail1">Tên danh mục</label>
        <input value="<?php echo $category['name_category'] ?>" type="text" name="name_category" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tên danh mục">
      </div>
      <div class="form-group">
        <div class="form-group">
          <label for="exampleInputPassword1">Ảnh danh mục</label>
          <input name="image_category" type="file" class="form-control" id="exampleInputPassword1">
        </div>
        <br>
        <?php
        if (strlen($category['image_category']) > 0) {
          echo "<img style='width:250px' src='" . FILE_URL . $category['image_category'] . "' />";
        }

        ?>
        <input type="hidden" name="image_category" value="<?php echo $category['image_category'] ?>" />
      </div>

      <button name="update" type="submit" class="btn btn-primary">Update</button>
    </form>

  </section>

</div>

<?php include "./footer.php" ?>

</body>

</html>