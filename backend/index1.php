<?php require_once "header.php" ?>  
<?php require_once "sidebar.php" ?> 
<?php 

 $sql = "SELECT  count(*)From  products " ; 
 $stmt = $connect->prepare($sql) ; 
 $stmt->execute() ;  
 $full = $stmt->fetch() ; 
  

 $sql = "SELECT  count(*)From  category " ; 
 $stmt = $connect->prepare($sql) ; 
 $stmt->execute() ;  
 $full1 = $stmt->fetch() ;  

 $sql = "SELECT  count(*)From  user " ; 
 $stmt = $connect->prepare($sql) ; 
 $stmt->execute() ;  
 $full2 = $stmt->fetch() ;  

 $sql = "SELECT  count(*)From  orders " ; 
 $stmt = $connect->prepare($sql) ; 
 $stmt->execute() ;  
 $full3 = $stmt->fetch() ;  
?>
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                               
                               <li><a href="<?php echo SITE_URL. "../index1.php" ?>" class="nav-link">Home</a></li> 
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    
                                    <h3><?= $full[0] ?></h3>

                                    <p>Sản phẩm</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $full1[0] ?><sup style="font-size: 20px"></sup></h3>

                                    <p>Danh mục</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= $full2[0] ?></h3>

                                    <p>Tài khoản </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $full3[0] ?></h3>

                                    <p>Đơn hàng</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                            <!-- Custom tabs (Charts with tabs)-->

                            <!-- /.card -->

                            <!-- DIRECT CHAT -->

                            <!-- /.card -->
                        </section>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div> 
        <?php require_once "./footer.php" ?> 
           
</body>

</html>