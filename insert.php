<?php
    date_default_timezone_set('Australia/Perth');
    require_once 'utility.php';
    $C = connect();
    sqlInsert($C, 'INSERT INTO item_log VALUES(NULL, ?, ?, ?)', 'sss', $_POST['item'], $_POST['location'], date('Y/m/d h:i:s'));
?>