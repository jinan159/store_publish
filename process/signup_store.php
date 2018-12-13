<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
    
    include_once "dbconn.php";
    
    $store_id = time()."_".substr(md5(microtime()),0,10);//21자리 가게아이디
    // echo date("Y-m-d H:i:s");
    $sname = $_POST['sname'];
    $stel = $_POST['stel'];
    $location = $_POST['location'];
    $brnum = $_POST['brnum'];
    $car_num = $_POST['car_num'];
    $email = $_SESSION['s_email'];
    $register_date = date("Y-m-d H:i:s");
    
    $sql = " INSERT INTO webpos.store (store_id, sname, stel, location, brnum, car_num, owner_email, confirm, register_date) ";
    $sql .= " VALUES ('$store_id', '$sname', '$stel', '$location','$brnum','$car_num', '$email', 'n', '$register_date'); ";

    if($dbconn->query($sql)===TRUE){
        $_SESSION['s_store_id'] = $store_id;
        $_SESSION['s_sname'] = $sname;
      
        echo "<script>alert('사업장등록이 완료되었습니다. 메뉴를 등록해 주세요.');location.href='../index.php?reload=o-menu-manage';</script>";
    } else {
        echo "<script>alert('일시 오류입니다. 다시 신청해 주세요.');";
        echo "history.back();</script>";
        // echo "<script>alert('$dbconn->error');";
        // echo "history.back();</script>";
    }
?>