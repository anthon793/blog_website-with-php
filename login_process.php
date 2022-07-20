<?php
//login.php

include('includes/connection.php');



$message = '';

if(isset($_POST["login"]))
{
    $email= $_POST["email"];
	$query = "SELECT * FROM users WHERE email= '$email'";
	$statement = $conn->query($query) or die($conn->error);
	
	
	if(!empty($statement) && $statement->num_rows > 0)
	{
		
		while($row = $statement->fetch_assoc())
		{
            $email= $row["email"];
            $password= $row["password"];
            $id= $row["id"];
			
				if(password_verify($_POST["user_password"], $password))
				{
				
					
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					header("location:dashboard/index.php");
				}
				else
				{
					header("location:login.php");
					//$message = "<label>Wrong Password</label>";
				}
			
			
		}
	}
	else
	{
		$message = "<label>Wrong Email Address</labe>";
	}
}

?>
