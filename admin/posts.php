<?php include 'includes/adminheader.php';
?> 
<?php include 'includes/adminnav.php';?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="publish.php" class="btn btn-primary">Add New</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<?php if($_SESSION['role'] == 'superadmin')  
{ ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Posts Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
    <th>S/N</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Image</th>
                        <!-- <th>Tags</th> -->
                        <th>Category</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Publish</th>
        </tr>
    </thead>
    <tbody>
    <?php

// $query = "SELECT * FROM posts ORDER BY id DESC";
$query = "SELECT * FROM posts 
    INNER JOIN categories ON categories.category_id = posts.category_id ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
   $count++;
    $post_id = $row['id'];
    $post_title = $row['title'];
    $post_author = $row['author'];
    $post_date = $row['postdate'];
    $post_image = $row['image'];
    $post_content = $row['content'];
    $post_tags = $row['tag'];
    $post_status = $row['status'];
    // $query2 = "SELECT category_name FROM categories "
    $category_display = $row['category_name'];

    echo "<tr>";
    echo "<td>$count</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_title</td>";
    echo "<td>$post_status</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
    // echo "<td>$post_tags</td>";
    echo "<td>$category_display</td>";
    echo "<td>$post_date</td>";
    echo "<td><a href='viewposts.php?post=$post_id' style='color:green'>See Post</a></td>";
    echo "<td><a href='editposts.php?id=$post_id'><span class='fa fa-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class= 'btn btn-danger btn-sm' onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'>Delete</a></td>";
    echo "<td><a  class= 'btn btn-success btn-sm' onClick=\"javascript: return confirm('Are you sure you want to publish this post?')\"href='?pub=$post_id'>Publish</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('Not any news yet! Start Posting now');
    window.location.href= 'publish.php';</script>";
}
?>

    </tbody>
 </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <?php
    if (isset($_GET['del'])) {
        $post_del = mysqli_real_escape_string($conn, $_GET['del']);
        $del_query = "DELETE FROM posts WHERE id='$post_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('post deleted successfully');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }
        if (isset($_GET['pub'])) {
        $post_pub = mysqli_real_escape_string($conn,$_GET['pub']);
        $pub_query = "UPDATE posts SET status='published' WHERE id='$post_pub'";
        $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('post published successfully');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }

?>
<!--Added section-->
<?php 
}
else if($_SESSION['role'] == 'admin') {
    ?>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Posts Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Publish</th>
        </tr>
    </thead>
    <tbody>
    <?php
$currentuser = $_SESSION['firstname'];
$query = "SELECT * FROM posts WHERE author = '$currentuser' ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_title = $row['title'];
    $post_author = $row['author'];
    $post_date = $row['postdate'];
    $post_image = $row['image'];
    $post_content = $row['content'];
    $post_tags = $row['tag'];
    $post_status = $row['status'];

    echo "<tr>";
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_title</td>";
    echo "<td>$post_status</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
    echo "<td>$post_tags</td>";
    echo "<td>$post_date</td>";
    echo "<td><a href='viewposts.php?post=$post_id' style='color:green'>See Post</a></td>";
    echo "<td><a href='editposts.php?id=$post_id'><span class='fa fa-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class= 'btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'></i>Delete</a></td>";
    echo "<td><a class= 'btn btn-success' onClick=\"javascript: return confirm('Are you sure you want to publish this post?')\"href='?pub=$post_id'></i>Publish</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('You have not posted any news yet! Start Posting now');
    window.location.href= 'publish.php';</script>";
}
?>
    </tbody>
 </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <?php
    if (isset($_GET['del'])) {
        $post_del = mysqli_real_escape_string($conn, $_GET['del']);
        $del_query = "DELETE FROM posts WHERE id='$post_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('post deleted successfully');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }
        if (isset($_GET['pub'])) {
        $post_pub = mysqli_real_escape_string($conn,$_GET['pub']);
        $pub_query = "UPDATE posts SET status='published' WHERE id='$post_pub'";
        $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('post published successfully');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }

?>
<?php 
}
else {
    ?>
<!--end-->

<!--User Section -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Posts Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Edit</th>
                        <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
                 $currentuser = $_SESSION['firstname'];

$query = "SELECT * FROM posts WHERE author = '$currentuser' ORDER BY id DESC";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
    $post_id = $row['id'];
    $post_title = $row['title'];
    $post_author = $row['author'];
    $post_date = $row['postdate'];
    $post_image = $row['image'];
    $post_content = $row['content'];
    $post_tags = $row['tag'];
    $post_status = $row['status'];

    echo "<tr>";
    echo "<td>$post_title</td>";
    echo "<td>$post_status</td>";
    echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
    echo "<td>$post_tags</td>";
    echo "<td>$post_date</td>";
    echo "<td><a href='viewposts.php?post=$post_id' style='color:green'>See Post</a></td>";
    echo "<td><a  href='editposts.php?id=$post_id'><span class='fa fa-edit' style='color: #265a88;'></span></a></td>";
    echo "<td><a class= 'btn btn-danger'onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$post_id'>Delete</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('You have not posted any news yet! Start Posting now');
    window.location.href= 'publish.php';</script>";
}
?>
    </tbody>
 </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <?php
    if (isset($_GET['del'])) {
        $post_del = mysqli_real_escape_string($conn , $_GET['del']);
        $del_query = "DELETE FROM posts WHERE id='$post_del' AND author='$currentuser'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('post deleted successfully');
            window.location.href='posts.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }
        ?>
<?php    
}
?>
    <!-- /.content -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include ('includes/adminfooter.php');
    ?>
