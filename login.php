<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>로그인 페이지 입니다.</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/login.css" />
    
</head>
<body>
  
  <?php
        if(isset($_SESSION['s_email'])) echo"<script>location.href='index.php'</script>";
    ?>  
  <div class="login-box">
    <div style="text-align:center; color:#333;">
      <h2>Web POS</h2>
    </div>
    <div class="lb-header">
      <a href="#" class="active" id="login-box-link">로그인</a>
      <a href="#" id="signup-box-link">가입</a>
    </div>

    <div class="social-login">
      <form id="google_login" action="process/user.php?mode=login" method="post" >
        <input type="hidden" id="g_l_email" name="email">
        <input type="hidden" id="g_l_name" name="name">
        <input type="hidden" name="sns_type" value="google">
      </form>
      <a id="google_login_btn" href="#">
        <i class="fa fa-google-plus fa-lg"></i>
        Google 로 로그인
      </a>
    </div>
          

     <div class="social-signup">
      <form id="google_signup" action="process/user.php?mode=register" method="post" >
          <input type="hidden" id="g_s_email" name="email" >
          <input type="hidden" id="g_s_name" name="name" >
          <input type="hidden" name="sns_type" value="google">
      </form>
      <a id="google_signup_btn" href="#">
        <i class="fa fa-google-plus fa-lg"></i>
        Google 로 회원가입
      </a>
    </div>

    <form class="email-login" action="process/user.php?mode=login" method="post" >
      <div class="u-form-group">
        <input type="email" placeholder="이메일" id="el-email" name="email"/>
      </div>
      <div class="u-form-group">
        <input type="password" placeholder="비밀번호" id="el-pw" name="password"/>
      </div>
      <p id="el-check" style="color:red;"></p>
      <div class="u-form-group">
        <input type="submit" id="email-login-btn" onclick="return email_loginChk()" value="Log in">
      </div>
      <div class="u-form-group">
        <!-- <a href="#" class="forgot-password">Forgot password?</a> -->
      </div>
    </form>

    <form class="email-signup" action="process/user.php?mode=register" method="post">
      <div class="u-form-group">
        <input type="email"  placeholder="이메일" id="es-email" name="email"/>
      </div>
      <div class="u-form-group">
        <input type="password" placeholder="비밀번호" onkeydown="pwCheck();" onkeyup="pwCheck();"  id="es-pw" name="password"/>
      </div>
      <div class="u-form-group">
        <input type="password" placeholder="비밀번호 확인" onkeydown="pwCheck();" onkeyup="pwCheck();" id="es-pwChk"/>
      </div>
      <p id="pwChk_str" style="color:red;"> </p>
      <div class="u-form-group">
        <input type="text" placeholder="이름" id="es-name" name="name" />
      </div>
      <div class="u-form-group">
        <input type="number" maxlength="11" oninput="maxLengthCheck(this)" placeholder="전화번호(-없이)" id="es-tel" name="tel"/>
      </div>
      <div class="u-form-group">
        <input type="text" placeholder="주소"  id="es-address" name="address"/>
      </div>
      <div class="u-form-group">
        사업자 회원 가입은 <a href='owner_register.php'><b> 여기를 눌러주세요.</b></a>
      </div>
      <div class="u-form-group">
        <input type="submit" onclick="return email_signupChk();" value="Sign Up">
      </div>
    </form>
    
  </div>
  <!-- 전화번호 11자리 입력 -->
  <script>
    function maxLengthCheck(object){
      if (object.value.length > object.maxLength){
        object.value = object.value.slice(0, object.maxLength);
      }    
    }
  </script>

    <!-- 이메일 로그인 체크 -->
  <script>
  //email login form check
  function email_loginChk() {
    
    if($("").val() != "") {

      if($("#el-pw").val() != "") {
        return true;
      }else {
        alert('패스워드를 입력하세요.');
        return false;
      }
    }else {
      alert('아이디를 입력하세요.');
      return false;
    }
  }

  $('#el-email').keydown(function() {
    if($('#el-email').val()=="") {
      $('#el-check').html('아이디를 입력해 주세요');
    }
    else {
      $('#el-check').html('');
    }
  });

  $('#el-email').keyup(function() {
    if($('#el-email').val()=="") {
      $('#el-check').html('아이디를 입력해 주세요');
    }
    else {
      $('#el-check').html('');
    }
  });

  $('#el-pw').keydown(function() {
    if($('#el-pw').val()=="") {
      $('#el-check').html('비밀번호를 입력해 주세요');
    }
    else {
      $('#el-check').html('');
    }
  });
  $('#el-pw').keyup(function() {
    if($('#el-pw').val()=="") {
      $('#el-check').html('비밀번호를 입력해 주세요');
    }
    else {
      $('#el-check').html('');
    }
  });
  //~ email login form check
  </script>
  
  <!-- 이메일 가입 체크 -->
  <script>
  function email_signupChk() {
    if($("#es-email").val() == "") {
      alert('아이디를 입력하세요.');
      return false;
    }
    if($("#es-pw").val() == "") {
      alert('비밀번호를 입력해 주세요');
      return false;
    }
    if($("#es-pw").val() != $("#es-pw").val()) {
      alert('비밀번호가 다릅니다.');
      return false;
    }
    if($("#es-name").val() == "") {
      alert('이름 입력해 주세요');
      return false;
    }
    if($("#es-tel").val() == "") {
      alert('전화번호를 입력해 주세요');
      return false;
    }
    if($("#es-tel").val().length < 11) {
      alert('전화번호를 정확히 입력해 주세요');
      return false;
    }
    if($("#es-address").val() == "") {
      alert('주소를 입력해 주세요');
      return false;
    }
  }


  function pwCheck() {
    if($('#es-pw').val()!=$('#es-pwChk').val()) {
      $("#pwChk_str").html("비밀번호가 다릅니다.");
    }else {
      $("#pwChk_str").html("");
    }    
  } 
  </script>



  <script src="assets/js/login.js"></script>

  <script src="https://www.gstatic.com/firebasejs/5.6.0/firebase.js"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyB-kIuOkD3GTQhIB7NXBENrSuF3euiEfvU",
      authDomain: "memowebapp-6acfd.firebaseapp.com",
      databaseURL: "https://memowebapp-6acfd.firebaseio.com",
      projectId: "memowebapp-6acfd",
      storageBucket: "memowebapp-6acfd.appspot.com",
      messagingSenderId: "820364500891"
    };
    firebase.initializeApp(config);

    //get google login provider
    var authProvider = new firebase.auth.GoogleAuthProvider();

    //################//################
    // @ show popup signup and process
    document.getElementById('google_signup_btn').addEventListener("click",function() {
      firebase.auth().signInWithPopup(authProvider).then(function(result) {
      //login success
      var token = result.credential.accessToken;
      var user = result.user;
      document.getElementById('g_s_email').value=user.email;
      document.getElementById('g_s_name').value=user.displayName;
      document.getElementById('google_signup').submit();
      }).catch(function(error) {
        //login failed
        var errorCode = error.code;
        var errorMsg = error.message;

        var email = error.email;

        var credential = error.credential;
      });
    });


    //################//################
    // @ get google login and process
    document.getElementById('google_login_btn').addEventListener("click",function() {
      firebase.auth().signInWithPopup(authProvider).then(function(result) {
      //login success
      var token = result.credential.accessToken;
      var user = result.user;
      document.getElementById('g_l_email').value=user.email;
      document.getElementById('g_l_name').value=user.displayName;
      document.getElementById('google_login').submit();
      }).catch(function(error) {
        //login failed
        var errorCode = error.code;
        var errorMsg = error.message;

        var email = error.email;

        var credential = error.credential;
      });
    });
  </script>
</body>
</html>