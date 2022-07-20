<?php

//$conn = mysqli_connect("localhost","root","","blog_website" ) or die ("error" . mysqli_error($conn));

$conn = new mysqli('localhost','root', '', 'blog_website')or die($conn->error);

session_start();

?>