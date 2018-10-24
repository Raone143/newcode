
<?php $this->load->view ( 'logoutlink' ); ?>




<?php
echo "<table border='1' class='table'>";
echo "<tr>";
echo "<td>id</td>";
echo "<td>UploadFile</td>";
echo "<td>Email</td>";
echo "<td>Password</td>";
echo "<td>Action</td>";
echo "</tr>";


for($i = 0; $i < count($us); $i++) {

	echo "<tr><td>".$us[$i]->id."</td>";
	echo "<td><img src='".base_url()."/application/uploads/".$us[$i]->ufile."' width='50' height='50'/></td>";
	echo "<td>".$us[$i]->email."</td>";
	echo "<td>".$us[$i]->password."</td>";
	echo "<td><a href='edit_user/".$us[$i]->id."'>Edit</a>&nbsp;<a href='delete_user/".$us[$i]->id."'>Delete</a></td>";
	echo "</tr>";
}

echo'</tr>';
echo '</table>';


?>