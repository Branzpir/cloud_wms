<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
	@media print{ .kPrint{display:none;} }
	
</style>
<body>
<div class="container">
	<br><h2 style="text-align:center">Print product</h2>
    <div class="container" style="text-align:center">
    <div class="container" style="display-inline:block"> 
	<form method='POST' action=''>
        <input type='text' name='item' style='text-transfrom:uppercase' placeholder='Enter Product Code'>
        <input type='text' name='quantity' placeholder='Enter Product Quantity'>
        <input type="submit" name="buscar"></input>
        <?php if(isset($_POST['buscar'])) {
            ?><!--button onclick="window.print();" class="kPrint" name="print">Print</button-->
            <input type="button" onclick="printDiv('printableArea')" value="Print"/>
            <?php
            }
        ?>
    </form>
    <div id="printableArea">
    <?php
        if(isset($_POST['quantity']))
        {
            $item = $_POST['item'];
            $quantity = $_POST['quantity'];
            $time = time();
            echo "<div class='container' style='text-align:center'>Item : $item<br> Quantity : $quantity <br> <img alt='".$item.$quantity.$time."' src='barcode.php?codetype=Code39&size=80&text=".$item.$quantity.$time."&print=true'/></div>";
        }
    ?>
    </div>
    <br>
		<a style="color:#000000; underline:" href="cloudwms.php"><h5>< Search Products</h5></a>
    </div>
</div>
<script>
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
</body>
</html>