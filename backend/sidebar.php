<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

        <img src="../public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Trang quản trị</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info"> 
                <?php if(isset($_SESSION['admin'])) { ?>
                <a href="#" class="d-block"><?= $_SESSION['admin'] ?></a> 
                <?php } ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="index1.php" class="nav-link active">
                        Dashboard
                    </a>

                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="list_category.php" class="nav-link active">
                        Quản trị danh mục
                    </a>

                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="list_product.php" class="nav-link active">
                        Quản trị sản phẩm
                    </a>

                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="list_user.php" class="nav-link active">
                        Quản trị thành viên
                    </a>

                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="list_slider.php" class="nav-link active">
                        Quản trị slider
                    </a>

                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="order.php" class="nav-link active">
                        Quản trị đơn hàng
                    </a>

                </li>

                <li class="nav-item has-treeview menu-open">
                    <a href="comment.php" class="nav-link active">
                      Quản trị bình luận
                    </a>

                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="list_seting.php" class="nav-link active">
                      Cài đặt
                    </a>

                </li>
                
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>