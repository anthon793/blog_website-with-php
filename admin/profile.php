<?php
include "header.php";
include "includes/adminnav.php";
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$query = "SELECT * FROM users WHERE username = '$username'" ; 
	$result= mysqli_query($conn , $query) or die (mysqli_error($conn));
	if (mysqli_num_rows($result) > 0 ) {
		$row = mysqli_fetch_array($result);
		$userid = $row['id'];
		$usernm = $row['username'];
		$userpassword = $row['password'];
		$useremail = $row['email'];
		$userfirstname = $row['firstname'];
		$userlastname = $row['lastname'];

	}

if (isset($_POST['update'])) {
require "../gump.class.php";
$gump = new GUMP();
$_POST = $gump->sanitize($_POST); 


$gump->validation_rules(array(
	'firstname'   => 'required|alpha|max_len,30|min_len,2',
	'lastname'    => 'required|alpha|max_len,30|min_len,1',
	'email'       => 'required|valid_email',
	'currentpassword' => 'required|max_len,50|min_len,6',
	'newpassword'    => 'max_len,50|min_len,6',
));
$gump->filter_rules(array(
	'firstname' => 'trim|sanitize_string',
	'lastname' => 'trim|sanitize_string',
	'currentpassword' => 'trim',
	'newpassword' => 'trim',
	'email'    => 'trim|sanitize_email',
	));
$validated_data = $gump->run($_POST);
if($validated_data === false) {
	?>
	<center><font color="red" > <?php echo $gump->get_readable_errors(true); ?> </font></center>
	<?php
}

else if (!password_verify($validated_data['currentpassword'] ,  $userpassword))   
{
	echo  "<center><font color='red'>Current password is wrong! </font></center>";
}
else if (empty($_POST['newpassword'])) {
	$userfirstname = $validated_data['firstname'];
      $userlastname = $validated_data['lastname'];
      $useremail = $validated_data['email'];
      $updatequery1 = "UPDATE users SET firstname = '$userfirstname' , lastname='$userlastname' , email='$useremail' WHERE id = '$userid' " ;
      $result2 = mysqli_query($conn , $updatequery1) or die(mysqli_error($conn));
if (mysqli_affected_rows($conn) > 0) {
	echo "<script>alert('PROFILE UPDATED SUCCESSFULLY');</script>";
}
else {
	echo "<script>alert('An error occured, Try again!');</script>";
}
}
else if (isset($_POST['newpassword']) &&  ($_POST['newpassword'] !== $_POST['confirmnewpassword'])) 
{
	echo  "<center><font color='red'>New password and Confirm New password do not match </font></center>";
	
}
else {
      $userfirstname = $validated_data['firstname'];
      $userlastname = $validated_data['lastname'];
      $useremail = $validated_data['email'];
      $pass = $validated_data['newpassword'];
      $userpassword = password_hash("$pass" , PASSWORD_DEFAULT);

$updatequery = "UPDATE users SET password = '$userpassword', firstname='$userfirstname' , lastname= '$userlastname' , email= '$useremail' WHERE id='$userid'";
$result1 = mysqli_query($conn , $updatequery) or die(mysqli_error($conn));
if (mysqli_affected_rows($conn) > 0) {
	echo "<script>alert('PROFILE UPDATED SUCCESSFULLY');</script>";
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
              <li class="breadcrumb-item active">Profile</li>
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
                        <input type="text" name ="username" class="form-control" id="exampleInputEmail1" placeholder="Username" value="<?php echo $username; ?>" readonly>
                      </div>
                      <div class="form-group">
                          <label for="firstname">Firstname</label>
                          <input type="text" name="firstname" placeholder = "Firstname" class= "form-control" value="<?php echo $userfirstname; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" name="lastname" placeholder = "Lastname"  class="form-control" value="<?php echo $userlastname; ?>" required>
                      </div>
                      <div class="form-group">
                            <label for="user_tag">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $useremail; ?>" required>
                       </div>
                       <div class="form-group">
                            <label for="usertag">Current Password</label>
                            <input type="password" name="currentpassword" class="form-control" placeholder="Enter Current password" required>
                        </div>
                        <div class="form-group">
                            <label for="usertag">New Password <font color='brown'> (changing password is optional)</font></label>
                            <input type="password" name="newpassword" class="form-control" placeholder="Enter New Password">
                        </div>
                        <div class="form-group">
                            <label for="usertag">Confirm New Password</label>
                            <input type="password" name="confirmnewpassword" class="form-control" placeholder="Re-Enter New Password" >
                        </div>
                        <button type="submit" name="update" class="btn btn-primary" value="Update User">Update User</button>
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
