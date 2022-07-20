<?php
include "header.php";
include "includes/adminnav.php";
if (isset($_SESSION['role'])) {
    $currentrole = $_SESSION['role'];
    }
    if ( $currentrole == 'user') {
    echo "<script> alert('ONLY ADMIN CAN ADD USER');
    window.location.href='../dashboard/index.php'; </script>";
    }
    else {
    if (isset($_POST['add'])) {
    require "../gump.class.php";
    $gump = new GUMP();
    $_POST = $gump->sanitize($_POST); 
    
    $gump->validation_rules(array(
        'username'    => 'required|alpha_numeric|max_len,20|min_len,4',
        'firstname'   => 'required|alpha|max_len,30|min_len,2',
        'lastname'    => 'required|alpha|max_len,30|min_len,1',
        'email'       => 'required|valid_email',
        'password'    => 'required|max_len,50|min_len,6',
    ));
    $gump->filter_rules(array(
        'username' => 'trim|sanitize_string',
        'firstname' => 'trim|sanitize_string',
        'lastname' => 'trim|sanitize_string',
        'password' => 'trim',
        'email'    => 'trim|sanitize_email',
        ));
    $validated_data = $gump->run($_POST);
    
    if($validated_data === false) {
        ?>
        <center><font color="red" > <?php echo $gump->get_readable_errors(true); ?> </font></center>
        <?php 
    }
    else if ($_POST['password'] !== $_POST['cpassword']) 
    {
        echo  "<center><font color='red'>Passwords do not match </font></center>";
    }
    else {
          $username = $validated_data['username'];
          $firstname = $validated_data['firstname'];
          $lastname = $validated_data['lastname'];
          $email = $validated_data['email'];
          $role = $_POST['role'];
          $pass = $validated_data['password'];
          $password = password_hash("$pass" , PASSWORD_DEFAULT);
          $query = "INSERT INTO users(username,firstname,lastname,email,password,role) VALUES ('$username' , '$firstname' , '$lastname' , '$email', '$password' , '$role')";
          $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
          if (mysqli_affected_rows($conn) > 0) {
              echo "<script>alert('NEW USER SUCCESSFULLY ADDED');
              window.location.href='adduser.php';</script>";
    }
    else {
        echo "<script>alert('An error occured, Try again!');</script>";
    }
        }
    }
    }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <form class="content" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title" id="logins-part-trigger">Publish Post</h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <p type="text" class="step-trigger" role="tab"  >
                        <b><span class="bs-stepper-label">Post Information</span></b>
                      </p>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name ="username" class="form-control" id="exampleInputEmail1" placeholder="Username" required>
                      </div>
                      <div class="form-group">
                          <label for="firstname">Firstname</label>
                          <input type="text" name="firstname" placeholder = "Firstname" class= "form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" placeholder = "Lastname"  class="form-control" >
                      </div>
                      <div class="input-group">
                            <select class="form-control" name="role" id="">
                                <label for="user_role">Role</label>
                            <?php
                                echo "<option value='admin'>Admin</option>";
                                echo "<option value='user'>User</option>";
                                ?>
                            </select>
                      </div>
                      <br>
                      <div class="form-group">
                            <label for="user_tag">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                      <div class="form-group">
                            <label for="user_tag">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="user_tag">Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control" required>
                        </div>
                      <button type="submit" name="add" class="btn btn-primary" value="Add user">Add User</button>
                    </div>
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                      
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</form>
    <!-- /.content -->
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

<?php
include('footer.php')
?>
