<?php session_start ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    
</head>
<body>
    <?php
        if(isset($_SESSION['s_email'])) echo"<script>location.href='index.php'</script>";
    ?>  
    <div class="login-box">
        <div class="lb-header">
            <a>사업장 등록</a>
        </div>
        <form class="email-signup" action="process/user.php?mode=owner" method="post">
            <div class="u-form-group">
                <input type="email" placeholder="이메일" id="owner-email" name="email"/>
            </div>
            <div class="u-form-group">
                <input type="password" onkeydown="pwCheck();" onkeyup="pwCheck();" placeholder="비밀번호" id="owner-pw" name="password"/>
            </div>
            <div class="u-form-group">
                <input type="password" onkeydown="pwCheck();" onkeyup="pwCheck();" id="owner-pwChk" placeholder="비밀번호 확인"/>
            </div>
            <p id="pwChk_str" style="color:red;"> </p>
            <div class="u-form-group">
                <input type="text" id="owner-name" placeholder="이름" name="name" />
            </div>
            <div class="u-form-group">
                <input type="text" id="owner-ematelil" placeholder="전화번호" name="tel"/>
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
                <input type="text" id="owner-address" placeholder="(선택) 주소" name="address"/>
                <!-- 나중에 data.go.kr 도로명 주소 구현-->
            </div>
            <div class="u-form-group">
                <input type="hidden" name="grant" value="manager"/>
            </div>
            
            <div class="u-form-group">
                <a href='login.php'><b>일반 회원 가입으로</b></a>
            </div>
            <div class="u-form-group">
                <input type="submit" onclick="return email_signupChk();" value="Sign Up">
            </div>
        </form>
    </div>
    <script>
        function maxLengthCheck(object){
            if (object.value.length > object.maxLength){
                object.value = object.value.slice(0, object.maxLength);
            }    
        }
        function email_signupChk() {
            if($("#owner-email").val() == "") {
                alert('아이디를 입력하세요.');
                return false;
            }
            if($("#owner-pw").val() == "") {
                alert('비밀번호를 입력해 주세요');
                return false;
            }
            if($("#owner-pw").val() != $("#owner-pwChk").val()) {
                alert('비밀번호가 다릅니다.');
                return false;
            }
            if($("#owner-name").val() == "") {
                alert('이름 입력해 주세요');
                return false;
            }
            if($("#owner-tel").val() == "") {
                alert('전화번호를 입력해 주세요');
                return false;
            }
            if($("#owner-tel").val().length < 11) {
                alert('전화번호를 정확히 입력해 주세요');
                return false;
            }
            if($("#owner-brnum").val() == "") {
                alert('사업자 번호를 입력해 주세요');
                return false;
            }
        }

        function pwCheck() {
            if($('#owner-pw').val()!=$('#owner-pwChk').val()) {
                $("#pwChk_str").html("비밀번호가 다릅니다.");
            }else {
                $("#pwChk_str").html("");
            }    
        }
    </script>
</body>
</html>