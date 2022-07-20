<?php include ('includes/connection.php'); 
include "includes/adminheader.php";
//include "includes/adminnnav.php";
$count = 0;
if (isset($_SESSION['role'])) {
$currentrole = $_SESSION['role'];
}
if ( $currentrole == 'user') {
echo "<script> alert('ONLY ADMIN CAN VIEW USERS');
window.location.href='../dashboard/index.php'; </script>";
}
else if ($currentrole == 'superadmin') {
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change Role</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        
        <?php 
            
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_users) > 0 ) {
            while ($row = mysqli_fetch_array($select_users)) {
              $count++;
              $user_id = $row['id'];
                $username = $row['username'];
                $user_firstname = $row['firstname'];
                $user_lastname = $row['lastname'];
                $user_email = $row['email'];
                $user_role = $row['role'];
                echo "<tr>";
                echo "<td>$count</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
            echo "<td><a class='nav-link' href='users.php?change_to_admin=$user_id''>Make Admin</a></td>";
                echo "<td><a class='btn btn-danger'onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'>Delete</a></td>";
                echo "</tr>";
             }
        ?>

    </tbody>
 </table>

<?php 
}

    if (isset($_GET['delete'])) {
        $the_user_id = $_GET['delete'];
        $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
        $result = mysqli_query($conn , $query0) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_array($result);
            $id1 = $row['role'];
        }
        if ($id1 == 'superadmin') {
            echo "<script>alert('super-admin cannot be deleted');</script>";
        }
        else {

        $query = "DELETE FROM users WHERE id = '$the_user_id'";

        $delete_query = mysqli_query($conn, $query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0 ) {
            echo "<script>alert('user deleted successfully');
            window.location.href= 'users.php';</script>";
        }
    }
}

    
    if (isset($_GET['change_to_admin'])) {
        $the_user_id = $_GET['change_to_admin'];

        $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
        $result = mysqli_query($conn , $query0) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_array($result);
            $id1 = $row['role'];
        }
        if ($id1 == 'admin') {
            echo "<script>alert('USER IS ALREADY ADMIN');</script>";
        }
        else if ($id1 == 'superadmin') {
            echo "<script>alert('Cannot change role for super-admin');</script>";
        }
else {
        $query = "UPDATE users SET role = 'admin' WHERE id = '$the_user_id'";

        $change_to_admin_query = mysqli_query($conn, $query) or die (mysqli_error($conn));
         if (mysqli_affected_rows($conn) > 0 ) {
            echo "<script>alert('changed to admin successfully');
            window.location.href= 'users.php'; </script>";
        }
    }
}
    ?>
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
}
else {
  ?>
  <!--Added section-->
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>
              </div>
              <!-- /.card-header -->
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
        
        <?php 
            
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_users) > 0 ) {
            while ($row = mysqli_fetch_array($select_users)) {
                $username = $row['username'];
                $user_firstname = $row['firstname'];
                $user_lastname = $row['lastname'];
                $user_email = $row['email'];
                $user_role = $row['role'];
                echo "<tr>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                echo "</tr>";
             }
        ?>

    </tbody>
 </table>
 <?php 
}
    ?>
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

}
?>
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
