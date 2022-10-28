<?php
    date_default_timezone_set('Australia/Perth');
    require_once 'utility.php';
    $C = connect();
    if($_SERVER['REQUEST_METHOD']=='GET'){
		$loc  = $_GET['id'];
        if($q1 = sqlSelect($C, 'SELECT * from item_log WHERE location = ?', 's', $loc))
        {
            if($count=$q1->num_rows)
            {
                $result = array();
                while($res1 = mysqli_fetch_array($q1))
                {
                    array_push($result, array(
                        "item"=>$res1[1],
                        "location"=>$res1[2],
                        "time"=>$res1[3]
                        )
                    );
                    
                }
                
            }
            for($x=0;$x<count($result)-1;$x++)
            {
                echo json_encode(array("result"=>$result));    
            }
        }
		mysqli_close($C);
    }
?>