<?php session_start();
    if(!isset($_SESSION['s_email'])) echo "<script>location.href='login.php';</script>";
?>
<?php session_start();
    // if(!isset($_SESSION['s_email'])) echo "<script>location.href='login.php';</script>";
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
        <script src="//www.google.com/jsapi"></script>
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
                            <?php
                                $mode = "admin-date";
                                include "process/drawChart.php";
                            ?>
							<!-- Banner -->
								<section id="banner">
                                    <div class="main-container">
                                        <div class="container-fluid">
                                            <div class="container title">
                                                <h2 class="list-title">'WEBPOS' 통계 현황</h2>	
                                                <?php
                                                    //위의 drawChart에서 날짜로 검색시, startDate는 -1해서
                                                    //endDate는 +1해서  startDate<주문날짜<endDate이렇게 검색함.
                                                    //그래서 표기해줄때는 다시 원상태로 복귀후 표시해줌
                                                    $start->modify('+1 day');
                                                    $end->modify('-1 day');
                                                    $start = date_format($start, 'Y-m-d'); 
                                                    $end = date_format($end, 'Y-m-d'); 
                                                    
                                                    echo "$start ~ $end";
                                                ?>
                                            </div>
                                            <div class="container" >
                                                <form action="./a-dateChart.php" method="post">
                                                <input type="hidden" name="reload" value="o-stat">
                                                <div class="container" style="width: 1000px; min-width: 300px;">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="chart" id="chart_div">
                                                            </div>	
                                                            <div >
                                                                <div>
                                                                    <span >시작 날짜/끝 날짜</span>
                                                                </div>
                                                                <input style="background-color:white;" type="date" id="startDate" name="startDate">
                                                                <input style="background-color:white;" type="date" id="endDate" name="endDate">
                                                                <input type="submit" value="검색" >	 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                <div class="chart" id="chart_div">
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>									
                                </section>
						</div>
					</div>

				<!-- Sidebar -->
                <?php include "sidebar.php" ?>
            </div>
            <script src="//www.google.com/jsapi"></script>
            <script>
                var data = <?= $data ?>;
                var options = <?= $options ?>;
                google.load('visualization', '1.0', {'packages':['corechart']});
                google.setOnLoadCallback(function() {
                var chart = new google.visualization.ColumnChart(document.querySelector('#chart_div'));
                chart.draw(google.visualization.arrayToDataTable(data), options);
                });
            </script>

		<!-- Scripts -->

	</body>
</html>

