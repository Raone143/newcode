<?php
//error_reporting(E_ALL);
//servername(hostname), username, password
$con = mysql_connect('localhost', 'root', '');
$db  = mysql_select_db('firstdatabase', $con);

if(!$con) {
	echo "Connection Failed";
	exit;
}

//
$sel_users = mysql_query("SELECT * FROM users");

//mysql_fetch_assoc
?>
<table border="1" width="100%">
	<tr><td>User Name</td><td>Password</td><td>Created Date</td></tr>
<?php
while($row = mysql_fetch_assoc($sel_users)) {
	?>
	<tr><td><?php echo $row['username']?></td><td><?php echo $row['password']?></td><td><?php echo $row['createddate']?></td></tr>
	<?php	
}
?>
</table>