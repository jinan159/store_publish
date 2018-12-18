<?php
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    

    

    function sendMsg($sid, $onum) {
        include_once "dbconn.php";

        $sql = " SELECT * FROM webpos.order WHERE isdone='n' AND store_id='$sid' ORDER BY order_time ASC; " ;

        $result = $dbconn->query($sql);
        $count=1;
        while($row = $result->fetch_array()) {
            
            $db_order_num = $row['order_num'];
            if($db_order_num==$onum) {
                
                break;
            }else {
                $count+=1; 
            }
            
        }
    
        echo "data:$count\n\n";
        flush();
    }
    $order_num = $_GET['order_num'];
    // echo $order_num."<br>";
    $store_id = $_GET['store_id'];
    // echo $store_id."<br>";
    // 201812181545135967162 1544542766_1b55760981

    sendMsg($store_id, $order_num);
    
    

    
?>