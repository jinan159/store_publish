<?php session_start();
    if(!isset($_SESSION['s_email'])) echo "<script>location.href='login.php';</script>";
?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Editorial by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
        <script src="assets/js/jquery.min.js"></script>
	</head>
	<body class="is-preload">
        <?php
            
            $reload = $_GET['reload'];
            
                if(isset($reload)) {
                ?>
                <script>
                    $(document).ready(function() {
                        $("#banner").load("load/<?=$reload?>.php");     
                    });
                    // $(document).on("mobileinit", function() {
                    //     $.mobile.loadPage("load/<?= $reload ?>.php");
                    // });
                </script>
                <?php
                }
        ?>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.php" class="logo"><strong>WebPos</strong> by Jinwan</a>
									<!-- <ul class="icons">
										<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
									</ul> -->
								</header>

							<!-- Banner -->
								<section id="banner">
                                <?php

                                    include "process/dbconn.php";

                                    // $row;
                                    if(isset($_GET['mode'])) {
                                        
                                        
                                        
                                        $mode = $_GET['mode'];
                                        if($mode=='SiteAdmin') $mode="user";

                                        if($mode=="owner") {                    //사업자
                                            
                                            $email = $_GET['email'];
                                            $s_email = $_SESSION['s_email'];
                                            //관리자가 아닌사람이 자신의 아이디가 아닌 아이디로 
                                            // 접근하려할때 막음
                                            if($email!=$s_email) {
                                                if(!isset($_SESSION['s_grade']) || $_SESSION['s_grade']!=99) {
                                                    echo "<script>alert('비정상적인 접근입니다.');</script>";
                                                    echo "<script>location.href='index.php';</script>";
                                                }
                                            }

                                            $sql = " SELECT * FROM webpos.owner "; 
                                            $sql .= " WHERE email='$email';" ;

                                            $result = $dbconn->query($sql);

                                            $row = $result->fetch_assoc();
                                            if($result && $result->num_rows > 0) {
                                                echo("<script>console.log('data load success');</script>");
                                            }
                                            else {
                                                echo("<script>console.log('data load failed');</script>");
                                            }
                                            ?>
                                            <div>
                                                <div>
                                                    <form action="process/update.php?mode=owner"  method="post">
                                                    <table>
                                                        <tr>
                                                            <td>아이디</td>
                                                            <td><p><?= $row['email']?></p><input type="hidden" name="email" id="email" value="<?= $row['email']?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td >비밀번호</td>
                                                            <td>
                                                                <input type="password" disabled name="password" id="password" value="<?= $row['password'] ?>">
                                                                <input type="button" onclick="resetPassword();" class="button small" value="초기화">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>이름</td>
                                                            <td><input type="text"  name="oname" id="mem_email" value="<?= $row['oname'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>전화번호</td>
                                                            <td><input type="text"  name="tel" id="mem_phone" value="<?= $row['tel'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>주소</td>
                                                            <td><input type="text"  name="address" id="mem_phone" value="<?= $row['address'] ?>"></td>
                                                        </tr>
                                                    </table>        
                                                    <div style="text-align: center">
                                                        <div><input type="submit" class="button" value="수정">
                                                        <button class="button">취소</button></div>
                                                    </div>
                                                    </form>
                                                </div>
                                                <div>
                                                    <table>
                                                        <tr>
                                                            <th>가게이름</th>
                                                            <th>승인여부</th>
                                                            <th>등록일</th>
                                                            <th>사업자 번호</th>
                                                            <th>가게 전화번호</th>
                                                        </tr>
                                                        <?php
                                                            $sql = " SELECT * FROM webpos.store WHERE owner_email='".$row['email']."' ";
                                                            $result = $dbconn->query($sql);
                                                            $row = $result->fetch_assoc();
                                                        ?>
                                                        <tr>
                                                            <td><?=$row['sname']?></td>
                                                            <td>
                                                                <?php 
                                                                    $confirm = $row['confirm'];
                                                                    if($confirm=="y") {
                                                                        echo "<span style='color:green'>승인됨</span>";
                                                                    }else {
                                                                        echo "<span style='color:red'>미승인</span>";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><?=$row['register_date']?></td>
                                                            <td><?=$row['brnum']?></td>
                                                            <td><?=$row['stel']?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div>
                                                <table>
                                                    <tr>
                                                        <th>메뉴</th>
                                                        <th>가격</th>
                                                    </tr>
                                                    <?php
                                                        $sql = " SELECT * FROM webpos.menu WHERE store_id='".$row['store_id']."' ";
                                                        $result = $dbconn->query($sql);
                                                        while($row = $result->fetch_assoc()) {
                                                        ?>
                                                            <tr>
                                                                <td><?=$row['mname']?></td>
                                                                <td><?=$row['price']?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    ?>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                            <?php

                                        }// if($mode=="owner")
                                        else if ($mode=="user") {                    //일반 회원
                                            $email = $_GET['email'];
                                            $s_email = $_SESSION['s_email'];
                                            //관리자가 아닌사람이 자신의 아이디가 아닌 아이디로 
                                            // 접근하려할때 막음
                                            if($email!=$s_email) {
                                                if(!isset($_SESSION['s_grade']) || $_SESSION['s_grade']!=99) {
                                                    echo "<script>alert('비정상적인 접근입니다.');</script>";
                                                    echo "<script>location.href='index.php';</script>";
                                                }
                                            }

                                            $sql = " SELECT * FROM webpos.user "; 
                                            $sql .= " WHERE email='$email';" ;

                                            $result = $dbconn->query($sql);

                                            $row = $result->fetch_assoc();
                                            if($result && $result->num_rows > 0) {
                                                echo("<script>console.log('data load success');</script>");
                                            }
                                            else {
                                                echo("<script>console.log('data load failed');</script>");
                                            }
                                            ?>
                                            <div>
                                                <div>
                                                    <form action="process/update.php?mode=user" onsubmit="" method="post">
                                                    <table>
                                                        <tr>
                                                            <td>아이디</td>
                                                            <td><p><?= $row['email']?></p><input type="hidden" name="email" id="email" value="<?= $row['email']?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td >비밀번호</td>
                                                            <td>
                                                                <input type="password" disabled name="password" id="password" value="<?= $row['password'] ?>">
                                                                <input type="button" onclick="resetPassword();" class="button small" value="초기화">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>이름</td>
                                                            <td><input type="text"  name="name" id="name" value="<?= $row['name'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>전화번호</td>
                                                            <td><input type="text"  name="tel" id="tel" value="<?= $row['tel'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>주소</td>
                                                            <td><input type="text"  name="address" id="address" value="<?= $row['address'] ?>"></td>
                                                        </tr>
                                                        
                                                    </table>        
                                                    <div style="text-align: center">
                                                        <div><input type="submit" class="button" value="수정">
                                                        <button class="button">취소</button></div>
                                                    </div>
                                                    </form>
                                                    </div>
                                                    <div>
                                                    <?php
                                                        $email = $row['email'];
                                                        include "process/dbconn.php";

                                                        include "process/detectDevice.php";                                                        

                                                        if(detectDevice()!="Mobile") {
                                                            $sql = " SELECT od.order_num onum, o.order_time time, s.store_id sid,s.sname sname, m.mname mname, od.count count, od.price price, o.email email, o.isdone isdone";
                                                            $sql .= " FROM webpos.order_detail od JOIN webpos.order o ";
                                                            $sql .= " ON (od.order_num=o.order_num) JOIN webpos.store s ";
                                                            $sql .= " ON (o.store_id=s.store_id) JOIN webpos.menu m ";
                                                            $sql .= " ON (od.menu_id=m.menu_id) ";
                                                            $sql .= " WHERE o.email='$email' ";
                                                            $sql .= " ORDER BY o.order_time DESC; ";

                                                            $result = $dbconn->query($sql);

                                                            ?>
                                                            <table>
                                                                <tr>
                                                                    <th>가게이름</th>
                                                                    <th>주문번호(대기순번 확인)</th>
                                                                    <th>주문시간</th>
                                                                    <th>메뉴이름</th>
                                                                    <th>수량</th>
                                                                    <th>가격</th>
                                                                </tr>
                                                                <?php
                                                                    $pre_onum = "";
                                                                    while($row=$result->fetch_array()) {
                                                                        $onum = $row['onum'];
                                                                ?>  
                                                                    <tr>
                                                                    <?php


                                                                        if($pre_onum!=$onum) {
                                                                    ?>
                                                                        <td><?=$row['sname']?></td>
                                                                        <td><a href="load/confirm.php?order_num=<?=$row['onum']?>" target="new"><?=$row['onum']?></a></td>    
                                                                    <?php
                                                                        $pre_onum=$onum;
                                                                        }else {
                                                                            echo "<td></td>";
                                                                            echo "<td></td>";
                                                                        }
                                                                    ?>
                                                                        
                                                                        <td><?=$row['time']?></td>
                                                                        <td><?=$row['mname']?></td>
                                                                        <td><?=$row['count']?></td>
                                                                        <td><?=$row['price']?></td>
                                                                    </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </table>
                                                            <?php
                                                        }else {
                                                            $sql = " SELECT o.order_num onum, o.order_time time, s.sname sname";
                                                            $sql .= " FROM webpos.order o JOIN webpos.store s ";
                                                            $sql .= " ON (o.store_id=s.store_id)";
                                                            $sql .= " WHERE o.email='$email' ";
                                                            $sql .= " ORDER BY o.order_time DESC; ";

                                                            $result = $dbconn->query($sql);
                                                            ?>
                                                            
                                                            <table>
                                                                <tr>
                                                                    <th>가게이름 </th>
                                                                    <th>주문시간</th>
                                                                    <th>상세확인</th>
                                                                </tr>
                                                                <?php
                                                                    $pre_onum = "";
                                                                    while($row=$result->fetch_array()) {
                                                                        $onum = $row['onum'];
                                                                ?>  
                                                                <tr>
                                                                    <td><?=$row['sname']?></td>
                                                                    <td><?=$row['time']?></td>
                                                                    <td><a href="load/confirm.php?order_num=<?=$row['onum']?>" target="new">확인 (새창)</a></td>    
                                                                </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </table>
                                                        <?php
                                                        }
                                                    ?>
                                                    
                                                    </div>
                                            </div>
                                            <?php
                                        }                                        
                                    }
                                    else {

                                    }
                                ?>
                                </section>
						</div>
					</div>

				<!-- Sidebar -->
                <?php include "sidebar.php" ?>

			</div>

		
        <script>
            function resetPassword() {
                if(confirm('비밀번호를 초기화 하시겠습니까?')) {
                    $('#password').val('1234');
                }
            }
        </script>
	</body>
</html>



