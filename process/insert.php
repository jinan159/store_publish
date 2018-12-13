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
        $email = "anonymous";
        if(isset($_SESSION['s_email'])) {
            $email = $_SESSION['s_email'];
        }
        
        

        $sql = " INSERT INTO webpos.order (order_num, order_time, store_id, email) ";
        $sql .= "VALUES ('$order_num','$order_time','$store_id','$email'); ";

        

        if($dbconn->query($sql)===TRUE) {
            
            $menu_id = $_POST['menu_id'];
            $count = $_POST['count'];
            $price = $_POST['price'];
            $length = count($menu_id);

            for($i=0; $i<$length; $i++) {
                $sql = " INSERT INTO webpos.order_detail "; 
                $sql .= "(order_num, menu_id, count, price) ";
                $sql .= "VALUES ('$order_num','$menu_id[$i]','$count[$i]','$price[$i]'); ";

                $result = mysqli_query($dbconn,$sql);
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

    // //GET에서 mode가 update일때, 
    // if($mode=="update") {
    //     $dep_code = $_GET['dep_code'];

    //     if($money_type == 'out'){
    //         if($money > 0)  {
    //             $money *= (-1);
    //         }
    //     } else {
    //         if($money < 0)  {
    //             $money *= (-1);
    //         }
    //     }

    //     $sql = " SELECT * FROM dephistory WHERE dep_code = '" . $dep_code . "'; ";
    //     $result = mysqli_query($dbconn,$sql);
    //     $row = mysqli_fetch_array($result);

    //     $prev_file = "./".$row['dep_file'];
    //     if(is_file($prev_file)) {
    //         if(is_writable($prev_file)) {
    //             unlink($prev_file);  //파일삭제(절대경로 "/" 불가능)
    //             echo "<script>console.log('파일 삭제됨.')</script>";
    //         } else {
    //             echo "<script>console.log('파일에 대한 쓰기(삭제) 권한 없음.')</script>";
    //         }
    //     } else {
    //         echo "<script>console.log('파일이 없음.')</script>";
    //     } 

        
    //     if($_FILES["depfile"]["name"]) {
    //         include "../img/insert_img.php";
    //     }


    //     $sql = " UPDATE dephistory SET  dep_date = '" . date("y-m-d H:i:s") . "', ";
    //     $sql .= " dep_ctcode = '". $category ."', ";
    //     $sql .= " dep_location = '". $where ."', ";
    //     $sql .= " dep_money = '". $money ."', ";
    //     if($target_file) {
    //         $sql .= "dep_file = '". $target_file ."', ";
    //     }
    //     $sql .= " dep_money_type = '". $money_type ."' ";
    //     $sql .= " WHERE  dephistory.dep_code =  '" . $dep_code . "' LIMIT 1; ";

    //     $result = mysqli_query($dbconn,$sql);
        
    //     if($result > 0) {
    //         echo("<script>console.log('data insert success')</script>");
    //         echo "<script>alert('수정이 완료되었습니다.');</script>";
    //         echo "<script>location.replace('/dep2/meeting/deplist.php');</script>";
    //     }

        
    // //GET에서 mode가 설정되어있지 않을때, 
    // //default로 insert로 되어있다.
    // }else {
    //     include "./insert_img.php";

    //     if($money_type == 'out'){
    //         if($money > 0)  {
    //             $money *= (-1);
    //         }
    //     } else {
    //         if($money < 0)  {
    //             $money *= (-1);
    //         }
    //     }

    //     $category = trim($_POST['his_category']);
    //     $discription = trim($_POST['his_discription']);
    //     $where = trim($_POST['his_where']);
    //     $mem_id = $_SESSION['ss_mem_id'];
    //     $mtcode = $_SESSION['ss_mtcode'];
    //     //$target_file 이 변수는 insert_img에 있음. 
    //     //저장된 파일의 경로를 담은 변수

    //     $id = date("ymd") . "_". $_SESSION['ss_mtcode'] . "_" . time();

    //     $sql = " INSERT INTO dephistory (dep_code, mt_code, dep_date, dep_ctcode, dep_dis, dep_location, dep_author, dep_money,dep_money_type , dep_file) ";
    //     $sql .= " values ('".$id ."',";
    //     $sql .= "" . $mtcode . ",";
    //     $sql .= "'" . date("y-m-d H:i:s") . "',";
    //     $sql .= "'" . $category . "',";
    //     $sql .= "'" . $discription . "',";
    //     $sql .= "'" . $where . "',";
    //     $sql .= "'" . $mem_id . "',";
    //     $sql .= "" . $money . ",";
    //     $sql .= "'" . $money_type . "',";
    //     $sql .= "'" . $target_file . "')";

    //     $result = mysqli_query($dbconn,$sql);

    //     if($result > 0){
    //         echo("<script>console.log('mtcode=".$mtcode."')</script>");
    //         echo("<script>console.log('data insert success')</script>");
    //         echo "<script>alert('입력이 완료되었습니다.');</script>";
    //         echo "<script>location.href='/dep2/meeting/deplist.php'</script>";    
    //     }
    // }
    
    
    
    

?>