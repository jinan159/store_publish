<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "webpos";
    
    // Create connection
    $dbconn = new mysqli($servername, $username, $password,$dbname);
    
    // Check connection
    if ($dbconn->connect_error) {
        die("Connection failed: " . $dbconn->connect_error);
    } 
    mysqli_set_charset($dbconn,"utf8");
    // echo "<script>console.log('Connected successfully');</script>";
?>