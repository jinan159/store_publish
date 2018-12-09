  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <link rel="stylesheet" type="text/css" media="screen" href="css/sidebar.css" />
  <script src="js/sidebar.js"></script>
<aside class="sidebar-left-collapse">
    <a href="index.php" class="company-logo">POS</a>
    <div class="menu">
      <h2>'<?= $_SESSION['s_name'] ?>' 님 접속중</h2>
      <h2>등급 : <?= $_SESSION['s_grant_name'] ?></h2>
      <h2><a href="process/user.php?mode=logout">LOGOUT</a></h2>
    </div>
    <?php
      $grade = $_SESSION['s_grade'];
      if($gade && $grade==99){
        ?>
          <div class="sidebar-links">
            <div class="link-blue">
              <a href="#">
                <i class="fa fa-picture-o"></i>회원 관리
              </a>
              <ul class="sub-links">
                <li><a href="#">회원 조회</a></li>
                <li><a href="#">주문 기록</a></li>
                <!-- <li><a href="#">Macros</a></li> -->
              </ul>
            </div>

            <div class="link-red">
              <a href="#">
                <i class="fa fa-heart-o"></i>통계
              </a>

              <ul class="sub-links">
                <li><a href="#">일간통계</a></li>
                <li><a href="#">주간통계</a></li>
                <li><a href="#">월간통계</a></li>
              </ul>
            </div>

            <div class="link-yellow">
              <a href="#">
                <i class="fa fa-keyboard-o"></i>매장 관리
              </a>

              <ul class="sub-links">
                <li><a href="#">메뉴 관리</a></li>
                <li><a href="#">직원 관리</a></li>
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
      else if($grade && $grade==51) {
        ?>
          <div class="sidebar-links">
      <div class="link-blue">
        <a href="#">
          <i class="fa fa-picture-o"></i>주문관리
        </a>
        <ul class="sub-links">
          <li><a href="#">현재 주문 내역</a></li>
          <li><a href="#">주문 기록</a></li>
          <!-- <li><a href="#">Macros</a></li> -->
        </ul>
      </div>

      <div class="link-red">
        <a href="#">
          <i class="fa fa-heart-o"></i>매출통계
        </a>

        <ul class="sub-links">
          <li><a href="#">일간통계</a></li>
          <li><a href="#">주간통계</a></li>
          <li><a href="#">월간통계</a></li>
          <li><a href="#">Link 4</a></li>
        </ul>
      </div>

      <div class="link-yellow">
        <a href="#">
          <i class="fa fa-keyboard-o"></i>매장관리
        </a>

        <ul class="sub-links">
          <li><a href="#">메뉴 관리</a></li>
          <li><a href="#">직원 관리</a></li>
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
      </div> -->
    </div>
        <?php
      }// end if($grant && $grant==51)
      else if($grade && $grade==1) {
        ?>
        <div class="sidebar-links">
        <div id="myorder" class="link-blue">
          <a  class="myorder" href="#">
            <i class="fa fa-picture-o"></i>내 주문
          </a>
          <ul class="sub-links">
            <li><a href="#">주문 내역</a></li>
            <li><a href="#">스탬프</a></li>
            <!-- <li><a href="#">Macros</a></li> -->
          </ul>
        </div>
    
      </div>
      <?php
      }// end if($grant && $grant==1)
    ?>
    
  </aside>

  <div class="main-content">
    <div class="menu">
      <h1>푸트트럭 웹 POS</h1>
      <!-- <h2><a href="#">감사합니다.</a></h2> -->
    </div>
    </div>