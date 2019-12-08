<?php
 
    

    header("Access-Control-Allow-Origin: *");
	$con = mysqli_connect("localhost","root","","vue");

	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}
    $id = $_GET['user_id'];
	$region=$_POST['region_info'];
	$role = $_POST['region_info3'];
	$level=$_POST['region_info1'];
	$language=$_POST['region_info2'];
	
	$sql = "UPDATE `userdetails` 
	SET `Region`='$region',`role` = '$role',
	`Level`='$level',
	`Language`='$language' WHERE `id`=$id";
	if (mysqli_query($con, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}

?>