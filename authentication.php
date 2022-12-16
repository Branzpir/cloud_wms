<?php
    require_once 'utility.php';
    $C = connect();

    if(isset($_POST['enter']))
    {
        $result = sqlSelect($C, "SELECT * FROM user WHERE username=? AND password=?", "ss", $_POST['username'], $_POST['password']);
        if($result && $result->num_rows == 1)
        {
            header('location:cloudwms.php');
        }
    }
?>

<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
body {background-color:#f2f2f2;}
.logBtn{color:white;background-color:#1a8dff;border-color:lightgrey}
.userForm{border-color:lightgrey}
.passForm{border-color:lightgrey}
</style>
<body>
    <h1 style="margin-top:100px;text-align:center">Eurotech</h1>
    <div class="container" style="text-align:center">
    <div class="container" style="display-inline:block">
    <form method="POST" action="">
	    <input class='userForm rounded' name='username' placeholder='Enter your username.' style='margin-top:50px;width:250px'/><br><br>
        <input class='passForm rounded' name='password' placeholder='Enter your account password.' style='margin-top:30px;width:250px'/>
    <br><button class="logBtn rounded" name='enter' type='submit' style="margin-top:10px;width:250px;height:30px">Log in</button>
</form>
</div>
</div>
<script>
if (window.history.replaceState) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>