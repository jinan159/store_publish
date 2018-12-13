  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <!-- <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.js"></script> -->
  <link rel="stylesheet" type="text/css" media="screen" href="css/sidebar.css" />
  <script src="js/sidebar.js"></script>
<aside class="sidebar-left-collapse">
    <a href="index.php" class="company-logo">POS</a>
    <div class="menu">
      <h2>'<?= $_SESSION['s_name'] ?>' 님 접속중</h2>
      <h2>등급 : <?= $_SESSION['s_grant_name'] ?></h2>
      <?php
        $grade = $_SESSION['s_grade'];
        if($grade==51) {//사업자
          if(!isset($_SESSION['s_store_id'])) {
            ?>
            <h2><a class="alert" href="register_store.php">점포 등록을 해주세요.</a> </h2>
            <?php
          }else if(!isset($_SESSION['s_store_id'])) {
            ?>
            <h2><a class="alert" href="register_store.php">메뉴 등록을 해주세요.</a> </h2>
            <?php
          }
          else {
            ?>
            <h2>점포명 : <?= $_SESSION['s_sname'] ?></h2>
            <?php
          }
        }else if($grade==1) { //일반유저
          ?>
          <h2><a href="load/selStore.php">주문하러가기</a> </h2>
          <?php
        }
      ?>

      <h2><a href="process/user.php?mode=logout">LOGOUT</a></h2>
      
    </div>
    <?php
      
      if($grade==99){
        ?>
          <div class="sidebar-links">
            <div class="link-blue">
              <a href="#">
                <i class="fa fa-picture-o"></i>회원 관리
              </a>
              <ul class="sub-links">
                <li><a href="#" id="a-mem-manage">일반 회원 관리</a></li>
                <li><a href="#" id="a-mem-manage">점주 정보 관리</a></li>
                <li><a href="#" id="a-mem-manage">주문 검색</a></li>
                <!-- <li><a href="#">Macros</a></li> -->
              </ul>
            </div>

            <div class="link-red">
              <a href="#">
                <i class="fa fa-heart-o"></i>통계
              </a>

              <ul class="sub-links">
                <li><a href="#" id="a-stat-store">점포별 통계</a></li>
                <li><a href="#" id="a-stat-time">기간 통계 검색</a></li>
              </ul>
            </div>

            <div class="link-yellow">
              <a href="#">
                <i class="fa fa-keyboard-o"></i>매장 정보 관리
              </a>

              <ul class="sub-links">
                <li><a href="#" id="a-store-manage">매장 등록 신청 관리</a></li>
                <!-- <li><a href="#">직원 관리</a></li> -->
                <!-- <li><a href="#">Link 3</a></li> -->
              </ul>
            </div>

            <!-- <div class="link-green">
              <a href="#">
                <i class="fa fa-map-marker"></i>회원관리
              </a>

              <ul class="sub-links">
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
                <li><a href="#">Link 4</a></li>
              </ul>
            </div>
          </div> -->
        <?php
      }// end if($grant && $grant==99)
      else if($grade==51) {//사업자
        ?>
          <div class="sidebar-links">
      <div class="link-blue">
        <a href="#">
          <i class="fa fa-picture-o"></i>주문관리
        </a>
        <ul class="sub-links">
          <li><a href="#" id="o-order-cur">현재 주문 내역</a></li>
          
          <li><a href="#" id="o-order-his">주문 기록</a></li>
          <!-- <li><a href="#">Macros</a></li> -->
        </ul>
      </div>

      <div class="link-red">
        <a href="#">
          <i class="fa fa-heart-o"></i>매출통계
        </a>

        <ul class="sub-links">
          <li><a href="#" id="o-stat-now">오늘 통계</a></li>
          
          <li><a href="#" id="o-stat">통계 확인</a></li>

          <li><a href="#" id="o-stat-m">메뉴별 통계</a></li>
          
          <!-- <li><a href="#">Link 4</a></li> -->
        </ul>
      </div>

      <div class="link-yellow">
        <a href="#">
          <i class="fa fa-keyboard-o"></i>매장관리
        </a>

        <ul class="sub-links">
          <li><a href="#" id="o-menu-manage">메뉴 관리</a></li>
          <!-- <li><a href="#" id="o-worker-manage">직원 관리</a></li> -->
          <li><a href="#" id="o-qrcode">매장 QR코드 보기</a></li>
        </ul>
      </div>

      <!-- <div class="link-green">
        <a href="#">
          <i class="fa fa-map-marker"></i>회원관리
        </a>

        <ul class="sub-links">
          <li><a href="#">Link 1</a></li>
          <li><a href="#">Link 2</a></li>
          <li><a href="#">Link 3</a></li>
          <li><a href="#">Link 4</a></li>
        </ul>
      </div> -->
    </div>
        <?php
      }// end if($grant && $grant==51)
      else if($grade && $grade==1) {//일반 회원
        ?>
        <div class="sidebar-links">
        <div id="myorder" class="link-blue">
          <a  class="myorder" href="#">
            <i class="fa fa-picture-o"></i>내 주문
          </a>
          <ul class="sub-links">
            <!-- <li><a href="#" id="o-order-confirm">대기순번 확인</a></li> -->
            <li><a href="#" id="u-order-his">주문 기록</a></li>
            <!-- <li><a href="#" id="o-order-stamp">스탬프</a></li> -->
            <!-- <li><a href="#">Macros</a></li> -->
          </ul>
        </div>
    
      </div>
      <?php
      }// end if($grant && $grant==1)
      else {
        echo "grant error";
      }
    ?>
    
  </aside>

  <div class="main-content">
    <div class="menu">
      <h1>푸트트럭 웹 POS</h1>
      <!-- <h2><a href="#">감사합니다.</a></h2> -->
    </div>
    </div>
    <!-- 관리자 메뉴 스크립트 -->
    <script>
      $('#a-mem-manage').click(function() {
        $("#loader").load(" ");
      });
      $('#o-order-his').click(function() {
        $("#loader").load(" ");
      });

      $('#a-stat-store').click(function() {
        $("#loader").load(" ");
      });
      $('#a-stat-time').click(function() {
        $("#loader").load(" ");
      });  

      $('#a-store-manage').click(function() {
        $("#loader").load(" ");
      });
      
    </script>


    <!-- 사업자 메뉴 스크립트 -->
    <script>
      $('#o-order-cur').click(function() {
        $("#loader").load("load/o-order-cur.php");
      });
      $('#o-order-his').click(function() {
        $("#loader").load("load/o-order-his.php");
      });

      $('#o-stat-now').click(function() {
        $("#loader").load(" ");
      });
      $('#o-stat').click(function() {
        $("#loader").load(" ");
      });
      $('#o-stat-m').click(function() {
        $("#loader").load(" ");
      });

      $('#o-menu-manage').click(function() {
        $("#loader").load("load/o-menu-manage.php");
      });
      // $('#o-worker-manage').click(function() {
      //   $("#loader").load(" ");
      // });
      $('#o-qrcode').click(function() {
        $("#loader").load("load/o-qrcode.php");
      });
      
    </script>

    <!-- 회원 메뉴 스크립트 -->
    <script>
      $('#u-order-confirm').click(function() {
        $("#loader").load("load/u-order-confirm.php");
      });
      $('#u-order-his').click(function() {
        $("#loader").load("load/u-order-his.php");
      });
      // $('#u-order-stamp').click(function() {
      //   $("#loader").load(" ");
      // });
    </script>