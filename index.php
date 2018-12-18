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
                                </section>
						</div>
					</div>

				<!-- Sidebar -->
                <?php include "sidebar.php" ?>

			</div>

	</body>
</html>