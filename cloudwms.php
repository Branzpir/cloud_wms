<?php
	date_default_timezone_set('Australia/Perth');
	require_once 'utility.php';
	$C = connect();
	if(isset($_POST['submit']))
	{
		sqlInsert($C, 'INSERT INTO item_log VALUES(NULL, ?, ?, ?)', 'sss', $_POST['item'], $_POST['loc'], date('Y/m/d h:i:s'));
	}
	
?>
<!DOCTYPE html>
<html>
<body>
<style>
	@media print{ .kPrint{display:none;} }
</style>

<h1>Search for product</h1>
<form method='POST' action=''>
	<input type='text' name='search'>
	<input type='submit' name='sub'>
</form>
<h1>Print product</h1>
<form method='POST' action=''>
	<input type='text' name='item' style='text-transfrom:uppercase'>
	<input type='text' name='quantity'>
	<input type="submit" name="buscar"></input>
	<?php if(isset($_POST['buscar'])) {
		?><button onclick="window.print();" class="kPrint" name="print">Print</button>
		<?php
	}
		?>
</form>
<?php
if(isset($_POST['quantity']))
{
 $item = $_POST['item'];
 $quantity = $_POST['quantity'];
 $time = time();
 echo "Item : $item<br> Quantity : $quantity <br> <img alt='".$item.$quantity.$time."' src='barcode.php?codetype=Code39&size=80&text=".$item.$quantity.$time."&print=true'/>";
}
?>
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
		}
	}
	
?>
</body>
</html>