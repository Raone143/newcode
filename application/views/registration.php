<?php
if(isset($data)) print_r($data);
if(isset($error)) print_r($error);

?>
<form method="post" name="frmRegistration" id="frmRegistration" enctype="multipart/form-data">
	Email: <input type="text" name="email" id="email" autocomplete="off"><br>
	Password: <input type="password" name="password" id="password" autocomplete="off"><br />
    UploadFile:<input type="file" name="ufile"  id="ufile" /><br />
	<input type="submit" name="registration" id="registration" value="Submit">
</form>