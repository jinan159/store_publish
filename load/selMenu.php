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

        $sname = $_GET['store_name'];
        $store_id = $_GET['store_id']; 

    ?>
    <ol class="progtrckr" data-progtrckr-steps="4">
        <li class="progtrckr-done" id="selStore">점포선택</li>
        <li class="progtrckr-done" id="selMenu">메뉴선택</li>
        <li class="progtrckr-todo" id="purchase">상품결제</li>
        <li class="progtrckr-todo" id="confirm">주문확인</li>
        <!-- <li class="progtrckr-todo">Delivered</li> -->
    </ol>
    <div class="menu">
        <h1>메뉴 선택</h1><br>
        <h2><?=$sname?></h2>
        <!-- <h2><a href="#">감사합니다.</a></h2> -->
        
    </div>
    <div class="search">
    
        <?php
            
            // echo $store_id;
            include_once "../process/dbconn.php";

            $sql = " SELECT * FROM webpos.menu WHERE store_id='$store_id'; ";

            $result = $dbconn->query($sql);
            


            //purchase로 값넘기기
            // 인덱스, menu_id[], count[], store_id, 총액




        ?>
            <table id="container2" align="center" style="width:100%; text-align='center';"> 
            <form action="purchase.php" method="POST">               
            <?php 
            $index = 1;
            while($row = $result->fetch_array()) {
            ?>
                <tr>
                    <td><?= $row['mname'] ?><input type="hidden" name="menu_id[]" value="<?= $row['menu_id'] ?>"></td>
                    <td><span id="price<?= $index ?>"><?= $row['price'] ?></span></td>
                    <td>
                        <select onchange="calcTotal()" name="count[]" id="count<?= $index ?>" style="min-width:90px;">
                            <option value="0">0개</option>
                            <option value="1">1개</option>
                            <option value="2">2개</option>
                            <option value="3">3개</option>
                            <option value="4">4개</option>
                            <option value="5">5개</option>
                        </select>
                    </td>
                    
                </tr>
            <?php
                $index++;
            }
            ?>
            <input type="hidden" name="store_id" value="<?= $store_id ?>"> <!--[store_id]--><br>
            <input type="hidden" name="index" value="<?=$index?>"><!--[인덱스]-->
            <input type="hidden" name="total" id="total_value">   <!--[총액]-->
            </form>
            </table>
            <div class="center"  style="margin:30px 0;">
                총 금액 : <span id="total">0</span> 원
            </div>
            
        </div>
        <div style="text-align:center">
            <div class="left-div">
                <a class="submit-btn" href="selStore.php">이전 단계</a>
            </div>
            <div class="right-div">
                <a class="submit-btn " onclick="return next();">다음 단계</a>
            </div>          
        </div>
        <div style="text-align:center; margin:50px 0;">
            <a href="../index.php" class="submit-btn secondary">메인으로 돌아가기</a>
        </div>

<script>
    function next() {
        if($('#total_value').val()==0 || $('#total_value').val()==null) {
            alert('메뉴를 골라주세요');
        }else $('form').submit();
        
    }
    function calcTotal() {
        var total = 0;
        for(var i=1; i < <?= $index ?>; i++) {
            total += $('#price'+i).text() * $('#count'+i).val();
        }
        $('#total').text(total);
        $('#total_value').val(total);
        
    }
</script>
</body>

</html>



