<?php ob_start(); include "./header.php" ?>
  <?php include "./sidebar.php" ?>
  <?php 
    $sql = "SELECT * FROM category";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $categories = $stmt->fetchAll();
    // print_r($categories);
    ?> 
    <?php 
     ?>


  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Quản trị danh mục</h1>
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
         
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>STT</th> 
                          <th>Id</th>
                          <th>Tên danh mục</th>
                          <th>Hình ảnh</th>
                          <th>Hành động</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php $count = 1 ;  foreach ($categories as $category) { ?>
                          <tr> 
                              <td><?= $count ?></td>
                              <td><?= $category['id'] ?></td>
                              <td><?= $category['name_category'] ?></td>
                              <td>
                                  <?php if (strlen($category['image_category']) > 0) { ?>
                                      <img src="<?php echo FILE_URL . $category['image_category'] ?>" alt="" srcset="" width="200px">
                                  <?php } ?>
                              </td> 
                             <td>
                               <a class="btn btn-info" href="<?php echo SITE_URL."edit.php?id=".$category['id'] ?>">Sửa danh mục</a>
                               <a class="btn btn-danger" href="<?php echo SITE_URL."destroy.php?id=".$category['id'] ?>"  onclick="return confirm('Bạn có muốn xóa không?')" >Xóa danh mục</a>
                             </td>
                            
                          </tr>
                      <?php $count++ ;  } ?>
                  </tbody>
              </table>
      </section>

  </div>

  <?php require_once "./footer.php" ?>
  </body>

  </html>