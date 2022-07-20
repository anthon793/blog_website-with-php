<?php include 'includes/connection.php';?>
<?php include 'header.php';?>
<?php include 'includes/adminnav.php';?>
<?php
if (isset($_GET['post'])) {
	$post = mysqli_real_escape_string($conn, $_GET['post']);  
}
else {
    header('location:posts.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
$query = "SELECT * FROM posts WHERE id='$post'";
}
else {
    $query = "SELECT * FROM posts WHERE id='$post' AND author = '$currentuser'" ;
}
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0 ) {
while ($row = mysqli_fetch_array($run_query)) {
	$post_title = $row['title'];
	$post_id = $row['id'];
	$post_author = $row['author'];
	$post_date = $row['postdate'];
	$post_image = $row['image'];
	$post_content = $row['content'];
	$post_tags = $row['tag'];
	$post_status = $row['status'];

	?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div id="wrapper">
       
    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <hr>
	       		<p><h2><a href="#"><?php echo $post_title; ?></a></h2></p>
                <p><h3>by <a href="#"><?php echo $post_author; ?></a></h3></p>
                <p><span class="glyphicon glyphicon-time"></span>Posted on <?php echo $post_date; ?></p>
                <hr>
                <div class="form-group">
                <img class="img-responsive img-rounded" width="600" height="400" src="../allpostpics/<?php echo $post_image; ?>" alt="300 * 300">
                </div>
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>
                <?php } }
                else { echo"<script>alert('error');</script>"; } ?>
          </div>
        </div>
      </div>
</div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">Dashboard</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../dashboard/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dashboard/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dashboard/dist/js/demo.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
