<?php
$msg = '';
if(count($_REQUEST) > 0) {
	$msg = 'ass';
	header('Content-type: application/pdf');
	
	// It will be called downloaded.pdf
	header('Content-Disposition: attachment; filename="downloaded.pdf"');
}
?>
<?php echo $msg;?>
<form name="frm" id="frm" method="post">
<input type="text" name="tea" id="tea"/>
<input type="submit" name="s" id="s" value="sa"/>
</form>

