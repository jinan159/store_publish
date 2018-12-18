<?php  session_start();?>
<meta charset='utf-8'>
<?php

    include_once "dbconn.php";
    
    $mode = $_GET['mode'];

    //메뉴 넣기
    if($mode=="menu") {
        // $menu_img = trim($_POST['menu_img']);
        $mname = trim($_POST['mname']);
        $mcomment = trim($_POST['comment']);
        $price = trim($_POST['price']);
        $store_id = trim($_SESSION['s_store_id']);

        // include "insert_img.php";

        // $path = "http://localhost/img/";
        // $img_path = $path.$target_file;
        $img_path = "not supported";


        $sql = " INSERT INTO webpos.menu (mname, mcomment, price, store_id, menu_img) ";
        $sql .= " VALUES ('$mname','$mcomment',$price,'$store_id','$img_path'); ";

        if($dbconn->query($sql)===TRUE) {
            echo "<script>location.href='../index.php?reload=o-menu-manage';</script>";
        }else {
            echo $dbconn->error;
        }
    } else if($mode=="order") {
        // date("y-m-d H:i:s") - php
        //주문번호 만드는것 ex)20181212 . (서버시간 . 서버마이크로시간)앞에서 13자리 자르기
        //                                 11자리    2자리
        $order_num = date("Ymd") . substr(time() . md5(microtime()), 0, 13);
        $order_time = date("y-m-d H:i:s");
        $store_id = $_POST['store_id'];
        $email;
        
        if(isset($_POST['email']) && $_POST['email']!= "") {
            $email = $_POST['email'];
        }else {
            if(isset($_SESSION['s_email']) && $_SESSION['s_email']!="") {
                $email = $_SESSION['s_email'];
            }else {
                $email = "anonymous";
            }
        }
        
        

        $sql = " INSERT INTO webpos.order (order_num, order_time, store_id, email) ";
        $sql .= "VALUES ('$order_num','$order_time','$store_id','$email'); ";

        

        if($dbconn->query($sql)===TRUE) {
            
            $menu_id = $_POST['menu_id'];
            $price = $_POST['price'];
            $count = $_POST['count'];
            $length = count($menu_id);

            for($i=0; $i<$length; $i++) {
                if($count[$i]!=0) {
                    $sql = " INSERT INTO webpos.order_detail "; 
                    $sql .= "(order_num, menu_id, count, price) ";
                    $sql .= "VALUES ('$order_num','$menu_id[$i]','$count[$i]','$price[$i]'); ";

                    $result = mysqli_query($dbconn,$sql);
                }
            }       
            ?>
            <script>
                alert('주문이 완료되었습니다.');
                location.href="../load/confirm.php?order_num=<?=$order_num?>";
            </script>
            <?php
            
        }else {
            echo $dbconn->error;
        }

        

    }   

?>
