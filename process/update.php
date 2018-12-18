<?php 
    include_once "dbconn.php";

    if(isset($_GET['mode'])) {
        $mode = $_GET['mode'];
        if($mode == "order") {
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
        }//if ($mode=order)
        else if($mode=="store"){

            $store_id = $_POST['confirm_store'];
            // echo count($store_id);1544719224_70ebf1acd5
            if(isset($_POST['confirm_store']) && $store_id!="") {
                foreach ($store_id as $id) {
                    $sql = " UPDATE webpos.store SET confirm = 'y' WHERE  webpos.store.store_id =  '$id' ; ";    
                    if($dbconn->query($sql)===TRUE) {
                        echo "<script>console.log('success');</script>";
                    }else {
                        echo $dbconn->error;
                        exit;
                    }
                }
            }   

            $store_id = $_POST['stop_store'];
            // echo count($store_id);1544719224_70ebf1acd5
            if(isset($_POST['stop_store']) && $store_id!="") {
                foreach ($store_id as $id) {
                    $sql = " UPDATE webpos.store SET confirm = 'n' WHERE  webpos.store.store_id =  '$id' ; ";    
                    if($dbconn->query($sql)===TRUE) {
                        echo "<script>console.log('success');</script>";
                    }else {
                        echo $dbconn->error;
                        exit;
                    }
                }
            }     
            echo "<script>location.href='../index.php?reload=a-store-manage'</script>";
            
        }
    }
    
?>