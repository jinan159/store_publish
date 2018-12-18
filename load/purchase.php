<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/order.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/common.css" />
    
</head>
<body>
    <?php 

        $name = $_GET['store_name'];
        $id = $_GET['store_id']; 

    ?>
    <ol class="progtrckr" data-progtrckr-steps="4">
        <li class="progtrckr-done" id="selStore">점포선택</li>
        <li class="progtrckr-done" id="selMenu">메뉴선택</li>
        <li class="progtrckr-done" id="purchase">상품결제</li>
        <li class="progtrckr-todo" id="confirm">주문확인</li>
        <!-- <li class="progtrckr-todo">Delivered</li> -->
    </ol>
    <div class="menu">
        <h1>상품 결제<br></h1>
        <!-- <h2><a href="#">감사합니다.</a></h2> -->
        
    </div>
    <div class="search" >
            <div class="center">
            <?php
                
                include "../process/dbconn.php";

                $store_id = $_POST['store_id'];

                $sql = " SELECT * FROM webpos.store WHERE store_id='$store_id'; ";

                $result = mysqli_query($dbconn,$sql);

                $store_name;

                if($rows = $result->fetch_array()) {
                    $store_name=$rows['sname'];
                }
                
                $total = $_POST['total'];
                
                $menu_list = $_POST['menu_id'];
                $menu_count = $_POST['count'];

                $length = count( $menu_list);
                
            ?>
            
            <table align="center">
                <form action="../process/insert.php?mode=order" method="POST">
                <tr>
                    <th>가게 이름</th>
                    <td colspan="2"><?= $store_name ?>
                
                    </td>
                </tr>
                <tr>
                    <th colspan="3">주문 내역</th>
                </tr>
                <tr>
                    <th>메뉴 이름</th>
                    <th>주문 수량</th>
                    <th>가격</th>
                </tr>
                <input type="hidden" name="store_id" value="<?=$store_id?>"><!-- store_id -->
                <?php
                
                for($i=0; $i<$length; $i++) {
                    if($menu_count[$i]!=0) {
                        $sql = " SELECT * FROM webpos.menu WHERE menu_id='$menu_list[$i]'; ";
                        $result = mysqli_query($dbconn,$sql);
                        $rows = $result->fetch_array();
                        $menu_name = $rows['mname'];
                        $price = $rows['price'];
                        
                ?>
                
                <input type="hidden" name="menu_id[]" value="<?=$rows['menu_id']?>"><!-- menu id -->
                <input type="hidden" name="count[]" value="<?=$menu_count[$i]?>"><!-- count id -->
                <input type="hidden" name="price[]" value="<?=$rows['price']?>"><!-- price id -->
                <tr>
                    <td><?= $menu_name ?></td>
                    <td><?= $menu_count[$i] ?></td>
                    <td><?= $price ?></td>
                </tr>
                <?php
                    }
                }
                ?>
                <tr>
                    <th> 총액 </th>
                    <td colspan="2"><?= $total ?> 원</td>
                </tr>
                </form>
            </table>
            </div>
     </div>
      
    <div style="text-align:center; margin:100px 0;">
        <div class="left-div">
            <a class="submit-btn" href="selMenu.php?store_id=<?= $store_id ?>">이전 단계</a>
        </div>
        <div class="right-div">
            <a class="submit-btn danger" onclick="return next();">주문 하기</a>
        </div>
    </div>
    <div style="text-align:center; margin:50px 0;">
        <a href="../index.php" class="submit-btn secondary">메인으로 돌아가기</a>
    </div>
<script>
    function next() {
        $('form').submit();        
    }
</script>
</body>

</html>