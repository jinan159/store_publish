<?php  session_start();?>
<meta charset='utf-8'>
<?php

    include_once "dbconn.php";
    
    $mode = $_GET['mode'];

    //메뉴 넣기
    if($mode=="menu") {
        // $menu_img = trim($_POST['menu_img']);
        $menu_id = trim($_GET['menu_id']);

        $sql = " DELETE FROM webpos.menu WHERE menu_id=$menu_id ";

        if($dbconn->query($sql)===TRUE) {
            echo "<script>location.href='../index.php?reload=o-menu-manage';</script>";
        }else {
            echo $dbconn->error;
        }
    }
?>