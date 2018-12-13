<?php session_start();
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    include_once "dbconn.php";

    $order_num = $_GET['order_num'];

    $store_id = $_GET['store_id'];
    

    $sql = " SELECT * FROM webpos.order WHERE isdone='n' AND store_id='$store_id' ORDER BY order_time ASC; " ;

    $result = $dbconn->query($sql);

    $count = 1;
    while($row = $result->fetch_array()) {
        
        $db_order_num = $row['order_num'];
        if($db_order_num==$order_num) {
            break;
        } else $count++; 
    }
    

    echo "data: $count\n\n";
    flush();
?>