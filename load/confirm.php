<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="../css/order.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/common.css" />
    
</head>
<body>
    <?php 

        $order_num = $_GET['order_num'];
    ?>
    <ol class="progtrckr" data-progtrckr-steps="4">
        <li class="progtrckr-done" id="selStore">점포선택</li>
        <li class="progtrckr-done" id="selMenu">메뉴선택</li>
        <li class="progtrckr-done" id="purchase">상품결제</li>
        <li class="progtrckr-done" id="confirm">주문확인</li>
        <!-- <li class="progtrckr-todo">Delivered</li> -->
    </ol>
    <?php
            $store_id = $_GET['store_id'];
            // echo $store_id;
            include_once "../process/dbconn.php";

            $sql = " SELECT od.order_num onum, o.order_time time, m.mname mname, od.count count, od.price price, o.isdone isdone";
            $sql .= " FROM webpos.order_detail od JOIN webpos.order o ";
            $sql .= " ON (od.order_num=o.order_num) JOIN webpos.menu m ";
            $sql .= " ON (od.menu_id=m.menu_id) ";
            $sql .= " WHERE od.order_num='$order_num' ";
            $sql .= " AND o.isdone='n' ";
            $sql .= " ORDER BY o.order_time ASC; ";

            $result = $dbconn->query($sql);
            if($result->num_rows<=0) {
                echo "<script>alert('완료된 주문입니다...'); location.href='../index.php?reload=u-order-his'</script>";
            }
            else {
        ?>
    <div class="menu">
        <h1>주문 확인</h1>
        <table>
        <tr>
            <th>대기 순번</th>
            <td colspan="2"><span id="result"></span></td>
        </tr>
        <tr>
            <th>주문 번호</th>
            <td colspan="2"><?=$order_num?></td>
        </tr>
        <tr>
            <th colspan="3">주문 내역</th>
        </tr>
        <tr>
            <th>시간</th>
            <th>메뉴이름</th>
            <th>수량</th>
        </tr>
        <?php
            
            
                while ($row=$result->fetch_array()) { 
                ?>
                    <tr>
                        <td><?=$row['time']?></td>
                        <td><?=$row['mname']?></td>
                        <td><?=$row['count']?></td>
                    </tr>
                <?php
                }
            }
        ?>
        
        </table>

        
    </div>
    <div style="text-align:center; margin:50px 0;">
        <a href="../index.php" class="submit-btn secondary">메인으로 돌아가기</a>
    </div>
    <script>
        var source = new EventSource("../process/load_cur_wait.php?order_num=<?=$order_num?>&store_id=<?=$store_id?>");
        source.addEventListener("message",function(e) {
            document.getElementById("result").innerHTML = e.data; 
        });
    </script>
</body>

</html>
<!--process/load_cur_wait.php?order_num=201812131544695527308&store_id=1544488690_2efe2de6fe-->


