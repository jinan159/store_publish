<?php  session_start();?>
<meta charset='utf-8'>
<?php

    include_once "dbconn.php";
    
    $mode = $_GET['mode'];

    //메뉴 삭제
    if($mode=="menu") {
        // $menu_img = trim($_POST['menu_img']);
        $menu_id = trim($_GET['menu_id']);

        $sql = " DELETE FROM webpos.menu WHERE menu_id='$menu_id' ";

        if($dbconn->query($sql)===TRUE) {
            echo "<script>location.href='../index.php?reload=o-menu-manage';</script>";
        }else {
            echo $dbconn->error;
        }
    }else if($mode=="order") {
        $order_num = trim($_GET['order_num']);

        $sql = " DELETE FROM webpos.order_detail WHERE order_num='$order_num' ";

        if($dbconn->query($sql)===TRUE) {

            $sql = " DELETE FROM webpos.order WHERE order_num='$order_num' ";

            if($dbconn->query($sql)===TRUE) {
                $sql = " DELETE FROM webpos.order_detail WHERE order_num=$order_num ";
                echo "<script>alert('주문 삭제 완료')</script>";
                echo "<script>location.href='../index.php?reload=o-order-his';</script>";
            }else {
                echo $dbconn->error;
            }
        }else {
            echo $dbconn->error;
        }
    }
?>