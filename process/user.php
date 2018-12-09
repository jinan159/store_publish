<?php session_start();?>
<?php



    include_once "dbconn.php";

    $mode=$_GET['mode'];

    if($mode=='register') {
        $sns_type = $_POST['sns_type'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        $name = $_POST['name'];
        // echo "email : ".$email.", pw : ".$password.", name : ".$name;
        if($sns_type=='google') {
            $password = md5($email);
            
            $sql = "INSERT INTO user (email, password, sns, name, grant_id) VALUES ('$email', '$password', '$sns_type', '$name', 1);";

            if($dbconn->query($sql)===TRUE){
                echo "<script>alert('register success');";
                echo "location.href='../login.php';</script>";
            } else {
                echo "<script>alert('User Google Account is already exist! please login');";
                echo "history.back();</script>";
                // echo "<script>alert('$dbconn->error');";
                // echo "history.back();</script>";
            }
        }else {
            $tel = $_POST['tel'];
            $address = $_POST['address'];

            $sql = " INSERT INTO user (email, password, sns, name, tel, address, grant_id) ";
            $sql .= " VALUES ('$email', '$password', NULL, '$name', '$tel', '$address', 1);";

            if($dbconn->query($sql)===TRUE){
                echo "<script>alert('register success');";
                echo "location.href='../login.php';</script>";
            } else {
                echo "<script>alert(".$dbconn->error.");";
                echo "history.back();</script>";
                // echo "<script>alert('$dbconn->error');";
                // echo "history.back();</script>";
            }
        }
        
    } // mode=register
    else if($mode=="owner") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $brnum = $_POST['brnum'];
        $car_num = $_POST['car_num'];
        $address = $_POST['address'];

        $sql = " INSERT INTO owner (email, password, oname, tel, brnum, car_num, address, grant_id) ";
        $sql .= " VALUES ('$email', '$password', '$name', '$tel', '$brnum', '$car_num', '$address', 51);";

        if($dbconn->query($sql)===TRUE){
            echo "<script>alert('회원가입이 완료되었습니다. 로그인 후 사업장 등록을 해주세요.');location.href='../login.php';</script>";
        } else {
            echo "<script>alert(".$dbconn->error.");";
            echo "history.back();</script>";
            // echo "<script>alert('$dbconn->error');";
            // echo "history.back();</script>";
        }
        
    }
    else if($mode=='login') {
         
        $sns_type = $_POST['sns_type'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        if($sns_type=="google") {
            $password = md5($email);
        }
        $name = $_POST['name'];

        // echo "email : ".$email.", pw : ".$password.", name : ".$name;

        $sql = " SELECT * FROM user WHERE email='$email' ;";

        $result = $dbconn->query($sql);

        if($result->num_rows > 0){
            if($row = $result->fetch_array()) {
                if($password == $row['password']) {
                    $grant_id = $row['grant_id'];
                    $grant_name;
                    
                    $sql_g = " SELECT * FROM webpos.grant WHERE grant_id=$grant_id ;";

                    $result = $dbconn->query($sql_g);

                    if($row_g = $result->fetch_array()) {
                        $grant_name = $row_g['grant_name'];
                    }

                    $_SESSION['s_email'] = $row['email'];
                    $_SESSION['s_name'] = $row['name'];
                    $_SESSION['s_grade'] = $row_g['grant_id'];
                    $_SESSION['s_grant_name'] = $row_g['grant_name'];

                    if($sns_type && $sns_type=='google') {
                        $sns = $row['sns'];
                        $_SESSION['s_sns'] = $sns;
                    }
                    else {
                        echo "<script>location.href='../index.php';</script>";    
                    }
                    echo "<script>location.href='../index.php';</script>";
                }else {
                    echo "<script>alert('password is not correct');";
                    echo "history.back();</script>";        
                }
            }else {
                echo "<script>alert('no results for your id');";
                echo "history.back();</script>";
            }
            
        } else {// owner login
            $sql = " SELECT * FROM owner WHERE email='$email' ;";

            $result = $dbconn->query($sql);

            if($row = $result->fetch_array()) {
                if($password == $row['password']) {
                    $grant_id = $row['grant_id'];
                    $grant_name;
                    
                    $sql_g = " SELECT * FROM webpos.grant WHERE grant_id=$grant_id ;";

                    $result = $dbconn->query($sql_g);

                    if($row_g = $result->fetch_array()) {
                        $_SESSION['s_grade'] = $row_g['grant_id'];
                        $_SESSION['s_grant_name'] = $row_g['grant_name'];
                    }

                    $_SESSION['s_email'] = $row['email'];
                    $_SESSION['s_name'] = $row['oname'];
                    

                    if($sns_type && $sns_type=='google') {
                        $sns = $row['sns'];
                        $_SESSION['s_sns'] = $sns;
                    }
                    else {
                        echo "<script>location.href='../index.php';</script>";    
                    }
                    echo "<script>location.href='../index.php';</script>";
                }else {
                    echo "<script>alert('password is not correct');";
                    echo "history.back();</script>";        
                }
            }else {
                echo "<script>alert('no results for your id');";
                echo "history.back();</script>";
            }
        }

    }// mode=login
    else if($mode=='logout') {
        session_destroy();
        echo "<script>location.href='../login.php';</script>";

    }else if($mode=='idcheck') {//id overlap check

    }else {
        echo "<script>alert('wrong access');";
            echo "history.back();</script>";
    }

    
?>