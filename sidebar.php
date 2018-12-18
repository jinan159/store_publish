<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
                                <div>
                                    <h4>'<?= $_SESSION['s_name'] ?>' 님 접속중</h4>
                                    <h4>등급 : <?= $_SESSION['s_grant_name'] ?></h4>
                                    <?php
                                        $grade = $_SESSION['s_grade'];
                                        if($grade==51) {//사업자
                                        if(!isset($_SESSION['s_store_id'])) {
                                            ?>
                                            <h2><a href="register_store.php" class="button big">점포 등록을 해주세요.</a></h2>
                                            <?php
                                        }else if(!isset($_SESSION['s_store_confirm']) || $_SESSION['s_store_confirm']!="y"){
                                            echo "<h4 style='color:blue;'>관리자가 점포 승인중입니다.</h4>";
                                        }else if(!isset($_SESSION['s_store_id'])) {
                                            ?>
                                            <h2><a class="button small" href="register_store.php">메뉴 등록을 해주세요.</a> </h2>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <h2>점포명 : <?= $_SESSION['s_sname'] ?></h2>
                                            <?php
                                        }
                                        }else if($grade==1) { //일반유저
                                        ?>
                                        <h2><a class="button small" href="load/selStore.php">주문하러가기</a> </h2>
                                        <?php
                                        }
                                    ?>

                                    <h2><a class="button small" href="process/user.php?mode=logout">LOGOUT</a></h2>
                                    
                                    </div>
								</section>

							<!-- Menu -->                                
                                <?php
                                if($grade==99){
                                ?>
                                <nav id="menu">
                                    <header class="major">
                                        <h2>Menu</h2>
                                    </header>
                                    <ul>
                                        <li>
                                            <span class="opener">회원/주문 관리</span>
                                            <ul>
                                                <li><a href="#" id="a-user-manage">일반 회원 관리</a></li>
                                                <li><a href="#" id="a-owner-manage">점주 정보 관리</a></li>
                                                <li><a href="#" id="a-order-his">주문 검색</a></li>
                                                <!-- <li><a href="#">Feugiat Veroeros</a></li> -->
                                            </ul>
                                        </li>
                                        <li>
                                            <span class="opener">통계</span>
                                            <ul>
                                                <li><a href="#" id="a-stat-store">점포별 통계</a></li>
                                                <li><a href="#" id="a-stat-time">기간 통계 검색</a></li>
                                                <!-- <li><a href="#">Tempus Magna</a></li>
                                                <li><a href="#">Feugiat Veroeros</a></li> -->
                                            </ul>
                                        </li>
                                        <li><a href="#" id="a-store-manage">매장 등록 신청 관리</a></li>
                                    </ul>
                                </nav>
                                <?php
                            }// end if($grant && $grant==99)
                            else if($grade==51) {//사업자
                                ?>
                                <nav id="menu">
                                    <ul>										
                                        <li>
                                            <span class="opener">주문관리</span>
                                            <ul>
                                                <li><a href="#" class="o-menu" id="o-order-cur">현재 주문내역</a></li>
                                                <li><a href="#" class="o-menu" id="o-order-his">주문 기록</a></li>
                                            </ul>
                                        </li>										
                                        <li>
                                            <span class="opener">매출통계</span>
                                            <ul>
                                                <li><a href="#" class="o-menu" id="o-stat">통계 확인</a></li>
                                                <li><a href="#" class="o-menu" id="o-stat-m">메뉴별 통계</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span class="opener">매장관리</span>
                                            <ul>
                                                <li><a href="#" class="o-menu" id="o-menu-manage">메뉴 관리</a></li>
                                                <li><a href="#" class="o-menu" id="o-qrcode">매장 QR코드 보기</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                <?php
                            }// end if($grant && $grant==51)
                            else if($grade && $grade==1) {//일반 회원
                                ?>
                                <nav id="menu">
                                    <ul>										
                                        <li><a href="#" id="u-order-his">주문 기록</a></li>										
                                    </ul>
                                </nav>    
                            <?php
                            }// end if($grant && $grant==1)
                            else {
                                echo "grant error";
                            }
                            ?>
							<!-- Footer -->
								<!-- <footer id="footer">
									<p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
								</footer> -->

                        </div>
                    
                    <!-- Scripts -->
                    <script src="assets/js/jquery.min.js"></script>
                    <script src="assets/js/browser.min.js"></script>
                    <script src="assets/js/breakpoints.min.js"></script>
                    <script src="assets/js/util.js"></script>
                    <script src="assets/js/main.js"></script>
                    

                    <!-- 관리자 메뉴 스크립트 -->
                    <script>
                    $('#a-user-manage').click(function() {
                        $("#banner").load("load/a-user-manage.php");
                    });
                    $('#a-owner-manage').click(function() {
                        $("#banner").load("load/a-owner-manage.php");
                    });
                    $('#a-order-his').click(function() {
                        $("#banner").load("load/a-order-his.php");
                    });

                    $('#a-stat-store').click(function() {
                        $("#banner").load("load/a-stat-store.php");
                    });
                    $('#a-stat-time').click(function() {
                        $("#banner").load("load/a-stat-time.php");
                    });  

                    $('#a-store-manage').click(function() {
                        $("#banner").load("load/a-store-manage.php");
                    });
                    
                    </script>

                    <!-- 사업자 메뉴 스크립트 -->
                    <script>
                    <?php 
                if(!isset($_SESSION['s_store_confirm']) || $_SESSION['s_store_confirm']!="y") {
                    ?>
                    $('.o-menu').click(function() {
                        alert('승인후 사용 가능합니다.');
                    });
                    <?php
                }else {
                    ?>
                    $('#o-order-cur').click(function() {
                        $("#banner").load("load/o-order-cur.php");
                    });
                    $('#o-order-his').click(function() {
                        $("#banner").load("load/o-order-his.php");
                    });
                    $('#o-stat').click(function() {
                        location.href = "datechart.php";
                    });
                    $('#o-stat-m').click(function() {
                        location.href = "menuchart.php";
                    });

                    $('#o-menu-manage').click(function() {
                        $("#banner").load("load/o-menu-manage.php");
                    });
                    // $('#o-worker-manage').click(function() {
                    //   $("#banner").load(" ");
                    // });
                    $('#o-qrcode').click(function() {
                        $("#banner").load("load/o-qrcode.php");
                    });
                    <?php
                        }
                    ?>            
                    
                    </script>

                    <!-- 회원 메뉴 스크립트 -->
                    <script>
                    $('#u-order-confirm').click(function() {
                        $("#banner").load("load/u-order-confirm.php");
                    });
                    $('#u-order-his').click(function() {
                        $("#banner").load("load/u-order-his.php");
                    });
                    // $('#u-order-stamp').click(function() {
                    //   $("#banner").load(" ");
                    // });
                    </script>
                    </div>