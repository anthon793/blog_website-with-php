<?php
include('../includes/connection.php');

if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
}
include('header.php');
include('dashboard.php');
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
                <h3>
                  <?php 
                  $query = "SELECT * FROM posts";
                        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        $post_num = mysqli_num_rows($result);
                        echo "<div class='text-left huge'>{$post_num}</div>";?>
                </h3>

                <p>Posts</p>
              </div>
              <div class="icon">
                <i class="ion ion-document"></i>
              </div>
              <a href="../admin/posts.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php $query = "SELECT * FROM users";
                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    $post_num = mysqli_num_rows($result);
                    echo "<div class='text-left huge'>{$post_num}</div>";
                    ?></h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="../admin/users.php" class="small-box-footer">View All Users <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy;</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?php
  
include("footer.php");

?>