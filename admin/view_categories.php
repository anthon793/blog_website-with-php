<?php include ('includes/connection.php'); 
include "includes/adminheader.php";
include "functions.php";
$count = 0;
if (isset($_SESSION['role'])) {
$currentrole = $_SESSION['role'];
}
if ( $currentrole == 'user') {
echo "<script> alert('ONLY ADMIN CAN VIEW USERS');
window.location.href='../dashboard/index.php'; </script>";
}
else if ($currentrole == 'superadmin'|| $currentrole = 'admin') {
    ?>
  <?php include "includes/adminnav.php"; ?>
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
              <li class="breadcrumb-item">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Add new
                </button>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <form class="modal fade" id="modal-default" method = "POST" action = "addcategory.php">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="text" name="category" id="" placeholder = "Add New Category" class= "form-control" required>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type ="submit" class="btn btn-primary" name= "addCategory" >Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
      <!-- /.modal -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categories</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Categories</th>
            <th>Number of Posts</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
    <?php
$query = "SELECT * FROM categories ORDER BY category_id DESC";
// $query = "SELECT * FROM categories
//     INNER JOIN posts ON posts.category_id = categories.category_id";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
while ($row = mysqli_fetch_array($run_query)) {
   $count++;
    $category_id = $row['category_id'];
    $category_name = $row['category_name'];

    echo "<tr>";
    echo "<td>$count</td>";
    echo "<td>$category_name</td>";
    echo "<td>TBH</tb>";
    echo "<td><a  class= 'btn btn-success btn-sm' onClick=\"javascript: return confirm('Are you sure you want to publish this post?')\"href='?pub=$category_id'>Update</a></td>";
    echo "<td><a class= 'btn btn-danger btn-sm' onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$category_id'>Delete</a></td>";

    echo "</tr>";

}
}
else {
    echo "<script>alert('Not any news yet! Start Posting now');
    window.location.href= 'publish.php';</script>";
}
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
        $del_query = "DELETE FROM categories WHERE category_id ='$post_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Category deleted successfully');
            window.location.href='view_categories.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }
        
        // if (isset($_GET['pub'])) {
        // $post_pub = mysqli_real_escape_string($conn,$_GET['pub']);
        // $pub_query = "UPDATE posts SET status='published' WHERE id='$post_pub'";
        // $run_pub_query = mysqli_query($conn, $pub_query) or die (mysqli_error($conn));
        // if (mysqli_affected_rows($conn) > 0) {
        //     echo "<script>alert('post published successfully');
        //     window.location.href='posts.php';</script>";
        // }
        // else {
        //  echo "<script>alert('error occured.try again!');</script>";   
        // }
        // }

?>


  <!-- Added section
  
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>
              </div>
             
              <div class="card-body">
              <table class="table table-bordered table-hover">
    <thead>
        <tr>
            
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            
        </tr>
    </thead>

    <tbody>

    </tbody>
 </table>
 
              </div>
            </div>
            </div>
          </div>
          
        </div>
        
      </div>
      
    </section> -->
 
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy;<a href="https://adminlte.io">Dashboard</a>.</strong> All rights reserved.
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
