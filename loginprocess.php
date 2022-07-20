<?php
include('includes/connection.php');

if (isset($_POST['login'])) {
	$email  = $_POST['email'];
	$password = $_POST['user_password'];
	mysqli_real_escape_string($conn, $email);
	mysqli_real_escape_string($conn, $password);
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn , $query) or die (mysqli_error($conn));
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$id = $row['id'];
		$user = $row['username'];
		$pass = $row['password'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$email = $row['email'];
		$role= $row['role'];
		// $image = $row['image'];
		if (password_verify($password, $pass )) {
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $user;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname'] = $lastname;
			$_SESSION['email']  = $email;
			$_SESSION['role'] = $role;
			// $_SESSION['image'] = $image;
			header('location: dashboard/index.php');
		}
		else {
			echo "<script>alert('invalid username/password');
			window.location.href= 'login.php';</script>";

		}
	}
}
else {
			echo "<script>alert('invalid username/password');
			window.location.href= 'index.php';</script>";

		}
}
else {
	header('location: index.php');
}
?>