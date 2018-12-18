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
								</header>
                            <?php
                                $mode = "menu";
                                include "process/drawChart.php";
                            ?>
							<!-- Banner -->
								<section id="banner">
                                    <div class="main-container">
                                        <div class="container-fluid">
                                            <div class="container title">
                                                <h2 class="list-title">'<?= $_SESSION['s_sname'] ?>' 통계 현황</h2>	
                                                
                                            </div>
                                            <div class="container" >
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

	</body>
</html>

