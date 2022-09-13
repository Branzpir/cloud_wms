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
<form method='POST' action=''>
	<input type='text' name='search'>
	<input type='submit' name='sub'>
</form>
<form method='POST' action=''>
	<input type='text' name='item' style='text-transfrom:uppercase'>
	<input type='text' name='quantity'>
	<input type='submit' name='print' value='Print'>
</form>
<!--https://stackoverflow.com/questions/16894683/how-to-print-html-content-on-click-of-a-button-but-not-the-page-->
<?php
	if(isset($_POST['sub']))
	{
		$search = $_POST['search'];
		if($res=sqlSelect($C, "SELECT item, location FROM item_log WHERE item LIKE '%$search%'"))
		{
			if($count1=$res->num_rows)
        	{
				while(($res1=$res->fetch_object()))
				{                                   
                ?>
                    <div class="col-md-4">
                    <?php echo $res1->item . ' ' . $res1->location?>
                </div><?php
            	} 
        	}
        	else
        	{
            	echo "<p class='message'>No results for this search entered</p>";
        	}
    	//$res1->free();  
		}
	}
	
?>
</body>
</html>
