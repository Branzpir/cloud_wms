<?php
	error_reporting(0);
	require_once 'utility.php';
	$C = connect();
?>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<style></style>
<body>
		<br><h2 style="text-align:center">Eurotech Product Lookup</h2>
		<div class="container" style="text-align:center">
		<div class="container" style="display-inline:block">
		<form method='POST' action=''>
			<input type='text' name='search' placeholder='Enter Product Code'>
			<input type='submit' name='sub'>
		</form>

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
							<div class="col">
							<?php echo $res1->item . '->' . $res1->location?>
						</div><?php
						} 
					}
					else
					{
						echo "<p class='message'>No results for this search entered</p>";
						echo json_encode($time);
					} 
				}
			}
		?>
		<br>
		<a style="color:#000000; underline:" href="print.php"><h5>> Print Label</h5></a>
		</div>
		</div>
	<script>
	if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}
	</script>	
</body>
</html>
