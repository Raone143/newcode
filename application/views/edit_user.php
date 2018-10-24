


<form method="post"  enctype="multipart/form-data">
<input type="text" name="email" value="<?php echo $email;  ?>">
<input type="text" name="password" value="<?php echo $password; ?>">
<input type="file" name="ufile" >
<td><img src='<?php echo base_url();  ?>/application/uploads/<?php echo $ufile;  ?>' width='50' height='50'/></img></td>
<input type="submit" name="submit" value="update" />
</form>
