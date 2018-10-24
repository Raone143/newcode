

<?php if(isset($error_message)) echo "<span style='color:red'>".$error_message."</span><br>"; ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form  method="post">
<table>
<tr><th>username</th><td><input type="text" name="email" id="email" class="form-control"/></td></tr>
<tr><th>password</th><td><input type="password" name="password" id="password" class="form-control"  /></td></tr>
<tr><th>&nbsp;</th><td><input type="submit" name="login"  id="login"   /></td></tr></table>
</form>
</body>
</html>