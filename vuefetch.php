<?php
header("Access-Control-Allow-Origin: *");
$con = mysqli_connect("localhost","root","","vue");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$sql = "select * from userdetails";

if ($result = mysqli_query($con, $sql)) {
  // Fetch one and one row
  while ($row = mysqli_fetch_assoc($result)) {
	    
        $rows[$row['id']] = $row;
		
  }

}

$region_query = "select * from region";
if ($result = mysqli_query($con, $region_query )) {
			  // Fetch one and one row
			  while ($row = mysqli_fetch_assoc($result)) {
					
					$rows1[] = $row;
					
			  }
			 
	}
$region_query1 = "select * from level";
			 if ($result = mysqli_query($con, $region_query1 )) {
			  // Fetch one and one row
			  while ($row = mysqli_fetch_assoc($result)) {
					
					$rows2[] = $row;
					
			  }
			 
	}
	
$region_query2 = "select * from language";
			 if ($result = mysqli_query($con, $region_query2 )) {
			  // Fetch one and one row
			  while ($row = mysqli_fetch_assoc($result)) {
					
					$rows3[] = $row;
					
			  }
			 
	}
$region_query3 = "select * from role";
			 if ($result = mysqli_query($con, $region_query3 )) {
			  // Fetch one and one row
			  while ($row = mysqli_fetch_assoc($result)) {
					
					$rows4[] = $row;
					
			  }
			 
	}
header('Content-Type:application/json');
$a = array("users" => $rows, "regions" => $rows1 ,"level" => $rows2 ,"language" => $rows3,"role" => $rows4);
echo json_encode($a);

?>