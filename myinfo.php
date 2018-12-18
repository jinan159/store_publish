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
                                        if($mode=="owner") {
                                            $email = $_GET['email'];

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
                                                    <table>
                                                        <tr>
                                                            <td>아이디</td>
                                                            <td><input type="text"  name="mem_pw" id="mem_id" value="<?= $row['email'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td >비밀번호</td>
                                                            <td><input type="password" disabled name="mem_pw" id="mem_pw" value="<?= $row['password'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>이름</td>
                                                            <td><input type="email"  name="mem_pw" id="mem_email" value="<?= $row['oname'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>전화번호</td>
                                                            <td><input type="email"  name="mem_pw" id="mem_phone" value="<?= $row['tel'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>주소</td>
                                                            <td><input type="email"  name="mem_pw" id="mem_phone" value="<?= $row['address'] ?>"></td>
                                                        </tr>
                                                    </table>        
                                                    <div style="text-align: center">
                                                        <div><button class="button">수정</button>
                                                        <button class="button">취소</button></div>
                                                    </div>
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
                                        else if ($mode=="user") {
                                            $email = $_GET['email'];

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
                                                    <table>
                                                        <tr>
                                                            <td>아이디</td>
                                                            <td><input type="text"  name="mem_pw" id="mem_id" value="<?= $row['email'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td >비밀번호</td>
                                                            <td><input type="password" disabled name="mem_pw" id="mem_pw" value="<?= $row['password'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>이름</td>
                                                            <td><input type="email"  name="mem_pw" id="mem_email" value="<?= $row['name'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>전화번호</td>
                                                            <td><input type="email"  name="mem_pw" id="mem_phone" value="<?= $row['tel'] ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>주소</td>
                                                            <td><input type="email"  name="mem_pw" id="mem_phone" value="<?= $row['address'] ?>"></td>
                                                        </tr>
                                                    </table>        
                                                    <div style="text-align: center">
                                                        <div><button class="button">수정</button>
                                                        <button class="button">취소</button></div>
                                                    </div>
                                                    
                                                    
                                                    </div>
                                            </div>
                                            <?php
                                        }
                                        
                                    }
                                ?>
                                </section>
						</div>
					</div>

				<!-- Sidebar -->
                <?php include "sidebar.php" ?>

			</div>

		

	</body>
</html>