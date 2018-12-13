<?php session_start();
    if(!isset($_SESSION['s_email'])) echo "<script>location.href='login.php';</script>";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    
</head>
<body>
    <?php
        include_once "header.php";
        
        $reload = $_GET['reload'];
        
            if(isset($reload)) {
            ?>
            <script>
                $(document).ready(function() {
                    $("#loader").load("load/<?= $reload ?>.php");     
                });
                // $(document).on("mobileinit", function() {
                //     $.mobile.loadPage("load/<?= $reload ?>.php");
                // });
            </script>
            <?php
            }
        
    ?>
    <div class="main-container" id="loader">
        
    </div>
</body>
</html>