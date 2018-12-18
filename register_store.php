<?php session_start();
    if(!isset($_SESSION['s_email'])) echo "<script>location.href='login.php';</script>";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/login.css" />
    
</head>
<body>
    <?php
        if(isset($_SESSION['s_email'])) echo"<script>location.href='index.php'</script>";
    ?>  
    <div class="login-box">
        <div class="lb-header">
            <a>점포 등록</a>
        </div>
        <form class="email-signup" action="process/signup_store.php" method="post">
            <div class="u-form-group">
                <input type="text" placeholder="점포 이름" id="owner-sname" name="sname"/><br>
                <!-- <span>공백이 없어야 합니다.</span> -->
            </div>       
            <div class="u-form-group">
                <input type="number" placeholder="사업장 전화번호(-없이)" oninput="maxLengthCheck(this)" maxlength="11" id="owner-tel" name="stel"/>
            </div>
            <div class="u-form-group">
                <input type="text" id="owner-address" placeholder="주 영업 지역" name="location"/>
                <!-- 나중에 data.go.kr 도로명 주소 구현-->
            </div>
            <div class="u-form-group">
            <!-- Business registration number : brnum -->
                <input type="number" maxlength="10" id="owner-brnum" oninput="maxLengthCheck(this)" placeholder="사업자 번호" name="brnum"/>
                <!-- 나중에 data.go.kr 이용하여 체크 -->
            </div>
            <div class="u-form-group">
                <input type="text" id="owner-car_num" placeholder="(선택)푸드트럭 차량번호" name="car_num"/>
            </div>
            <div class="u-form-group">
                <input type="submit" onclick="return store_regCheck();" value="점포등록 신청">
            </div>
            <div class="u-form-group">
                <hr>
                <br>
                <a href='index.php'><b>이전으로</b></a>
            </div>
        </form>
    </div>
    <script>
        function maxLengthCheck(object){
            if (object.value.length > object.maxLength){
                object.value = object.value.slice(0, object.maxLength);
            }    
        }
        function store_regCheck() {
            if($("#owner-tel").val() == "") {
                alert('전화번호를 입력해 주세요');
                return false;
            }
            if($("#owner-tel").val().length < 10) {
                alert('전화번호를 정확히 입력해 주세요');
                return false;
            }
            if($("#owner-brnum").val() == "") {
                alert('사업자 번호를 입력해 주세요');
                return false;
            }
            if($("#owner-brnum").val().length != 10) {
                alert('사업자 번호를 정확히 주세요');
                return false;
            }

            $('#owner-sname').val() = allTrim($('#owner-sname').val());
        }

        function pwCheck() {
            if($('#owner-pw').val()!=$('#owner-pwChk').val()) {
                $("#pwChk_str").html("비밀번호가 다릅니다.");
            }else {
                $("#pwChk_str").html("");
            }    
        }
    </script>
    <script>
        function allTrim(str) {
            return str.replace(/(\s*)/g,"");
        }   
        /*
            form안에 input을 document.getElementsByTagName으로 선택
            for문돌리기. 
        */
    </script>
</body>
</html>