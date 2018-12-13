<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/order.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    
</head>
<body>
    <?php 
        $name = $_GET['store_name'];
        $id = $_GET['store_id']; 

    ?>
    <ol class="progtrckr" data-progtrckr-steps="4">
        <li class="progtrckr-done" id="selStore">점포 선택</li>
        <li class="progtrckr-todo" id="selMenu">메뉴 선택</li>
        <li class="progtrckr-todo" id="purchase">상품 결제</li>
        <li class="progtrckr-todo" id="confirm">주문 확인</li>
        <!-- <li class="progtrckr-todo">Delivered</li> -->
    </ol>
    <div class="menu">
        <h1>'<?= $name ?>' 주문페이지<br></h1>
        <!-- <h2><a href="#">감사합니다.</a></h2> -->
        <?= $id ?>      
        
    </div>
    <div id="loader"></div>
</body>
</html>