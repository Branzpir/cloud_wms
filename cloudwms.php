<?php
	require_once 'utility.php';
	$C = connect();
	date_default_timezone_set('Australia/Perth');
	if(isset($_POST['submit']))
	{
		sqlInsert($C, 'INSERT INTO item_log VALUES(NULL, ?, ?, ?)', 'sss', $_POST['item'], $_POST['loc'], date('Y/m/d h:i:s'));
	}
?>
<!DOCTYPE html>
<html>
<body>
<form method='POST' action=''>
	<input type='text' name='item'>
	<input type='text' name='loc'>
	<input type='submit' name='submit'>
</form>
</body>
</html>