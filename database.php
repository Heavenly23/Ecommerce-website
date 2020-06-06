<?php 

//connect to db
$con = mysqli_connect("localhost", "grader", "allowme", "mb");

//test connection
if(mysqli_connect_errno()){
	echo "Failed to connect to Databse: ".mysqli_connect_error();
}

 ?>
