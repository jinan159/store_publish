<?php 
    include_once "dbconn.php";


    $order_num = $_GET['order_num'];

    $sql = " UPDATE webpos.order SET  isdone =  'y' WHERE  webpos.order.order_num =  '$order_num' ; ";

    if($dbconn->query($sql)===TRUE) {
        ?>
        <script> location.href="../index.php?reload=o-order-cur"; </script>
        <?php
    }else {
        echo $dbconn->error;
        exit;
    }
?>