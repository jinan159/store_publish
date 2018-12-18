<?php session_start();

    echo "<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>";

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
            
        }else if($mode=="user") {
            $email = $_POST['email'];
            $s_email = $_SESSION['s_email'];
            //관리자가 아닌사람이 자신의 아이디가 아닌 아이디로 
            // 접근하려할때 막음
            if($email!=$s_email) {
                if(!isset($_SESSION['s_grade']) || $_SESSION['s_grade']!=99) {
                    echo "<script>alert('비정상적인 접근입니다.');</script>";
                    echo "<script>location.href='index.php';</script>";
                }
            }
            $password = $_POST['password'];
            $password = md5($password);
            $name = $_POST['name'];
            $tel = $_POST['tel'];
            $address = $_POST['address'];

            $sql = " UPDATE webpos.user "; 
            $sql .= " SET name = '$name', "; 
            $sql .= " tel = '$tel', "; 
            $sql .= " address = '$address' "; 
            $sql .= " WHERE webpos.user.email = '$email' LIMIT 1;";
            if($dbconn->query($sql)===TRUE) {
                echo "<script>console.log('success');</script>";
                if($_SESSION['s_grade']==99) {
                    echo "<script>location.href='../index.php?reload=a-user-manage'</script>";
                }else {
                    echo "<script>location.href='../index.php'</script>";
                }
                
            }else {
                echo $dbconn->error;
                exit;
            }
            
        }else if($mode=="owner") {
            $email = $_POST['email'];
            $s_email = $_SESSION['s_email'];
            //관리자가 아닌사람이 자신의 아이디가 아닌 아이디로 
            // 접근하려할때 막음
            if($email!=$s_email) {
                if(!isset($_SESSION['s_grade']) || $_SESSION['s_grade']!=99) {
                    echo "<script>alert('비정상적인 접근입니다.');</script>";
                    echo "<script>location.href='index.php';</script>";
                }
            }
            $password = $_POST['password'];
            $password = md5($password);
            $name = $_POST['oname'];
            $tel = $_POST['tel'];
            $address = $_POST['address'];

            $sql = " UPDATE webpos.owner "; 
            $sql .= " SET oname = '$name', ";
            $sql .= " tel = '$tel', "; 
            $sql .= " address = '$address' "; 
            $sql .= " WHERE webpos.owner.email = '$email' LIMIT 1;";
            if($dbconn->query($sql)===TRUE) {
                echo "<script>console.log('success');</script>";
                if($_SESSION['s_grade']==99) {
                    echo "<script>location.href='../index.php?reload=a-owner-manage'</script>";
                }else {
                    echo "<script>location.href='../index.php'</script>";
                }
                
            }else {
                echo $dbconn->error;
                exit;
            }
            
        }
    }
    
?>