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
        <li class="progtrckr-todo" id="selMenu">메뉴선택</li>
        <li class="progtrckr-todo" id="purchase">상품결제</li>
        <li class="progtrckr-todo" id="confirm">주문확인</li>
        <!-- <li class="progtrckr-todo">Delivered</li> -->
    </ol>
    <div class="menu">
        <h1>점포 선택<br></h1>
        <!-- <h2><a href="#">감사합니다.</a></h2> -->
        
    </div>
    <div class="search">
        <div>
            <!-- <h2>초성 검색</h2>
            <p>아직 마지막자리만 초성검색 가능</p> -->
            <input type="text" style="width:57%; min-width:300px;" name="search2" onkeydown="searchname(this)" onkeyup="searchname(this)" id="search2"><br>
            선택한 가게 : <span id="snameBox"></span>
            <table id="container2" align="center" style="width:70% ; min-width:300px; text-align='center';" border="1">
            </table>
        </div>
    </div>
    <div style="text-align:center">
        <form action="selMenu.php" method="GET">
            <input type="hidden" name="store_id" id="store_id"><br>
            <div style="text-align:center">
                <a class="submit-btn" onclick="return next();">다음 단계</a>
            </div>
        </form>         
    </div>
    <div style="text-align:center; margin:50px 0;">
        <a href="../index.php" class="submit-btn secondary">메인으로 돌아가기</a>
    </div>
<script>
    function searchname(text) {
            if(text.value=="") {
                $("#container2").empty();
                $("#container2").show();
            }else{
                $.get("../process/getNameTable.php?mode=store&name="+text.value,function (data, status) {
                    if(status=="success") {
                    // alert("Data: " + data + "\nStatus: " + status);
                    $("#container2").empty();
                    $("#container2").append(data);
                    }            
                });
            }
    }
    function setValue(span,id) {
        // alert(span.innerText);
        $('#snameBox').text(span.innerText);
        $('#search2').val(span.innerText);
        $('#store_id').val(id);
        $('#container2').hide();
        // alert(p);
    }
    function next() {
        if($('#store_id').val()!="" && $('#store_id').val()!=null) {
            $('form').submit();
        }else alert('가게를 골라주세요')
        
    }
</script>
</body>

</html>



