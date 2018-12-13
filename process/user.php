<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php



    include_once "dbconn.php";

    $mode=$_GET['mode'];

    if($mode=='register') {//회원가입
        $sns_type = $_POST['sns_type'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        $name = $_POST['name'];
        // echo "email : ".$email.", pw : ".$password.", name : ".$name;
        if($sns_type=='google') {//구글회원가입
            $password = md5($email);
            
            $sql = " INSERT INTO user (email, password, sns, name, grant_id) VALUES ('$email', '$password', '$sns_type', '$name', 1); ";

            if($dbconn->query($sql)===TRUE){
                echo "<script>alert('회원가입 성공'); location.href='../login.php';</script>";
            } else {
                echo "<script>alert('구글 회원정보가 존재합니다. 로그인 해주세요'); history.back();</script>";
                // echo "<script>alert('$dbconn->error');";
                // echo "history.back();</script>";
            }
        }else {//일반 회원가입
            $tel = $_POST['tel'];
            $address = $_POST['address'];

            $sql = " INSERT INTO user (email, password, sns, name, tel, address, grant_id) ";
            $sql .= " VALUES ('$email', '$password', NULL, '$name', '$tel', '$address', 1);";

            if($dbconn->query($sql)===TRUE){
                echo "<script>alert('회원가입 완료');";
                echo "location.href='../login.php';</script>";
            } else {
                echo "<script>alert('회원가입이 완료되지 않았습니다.');";
                echo "history.back();</script>";
                // echo "<script>alert('$dbconn->error');";
                // echo "history.back();</script>";
            }
        }
        
    } // mode=register
    else if($mode=="owner") {//사업자 회원가입
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $brnum = $_POST['brnum'];
        $car_num = $_POST['car_num'];
        $address = $_POST['address'];

        $sql = " INSERT INTO owner (email, password, oname, tel, grant_id) ";
        $sql .= " VALUES ('$email', '$password', '$name', '$tel', 51);";

        if($dbconn->query($sql)===TRUE){
            echo "<script>alert('회원가입이 완료되었습니다. 로그인 후 사업장 등록을 해주세요.');location.href='../login.php';</script>";
        } else {
            echo "<script>alert(".$dbconn->error.");";
            echo "history.back();</script>";
            // echo "<script>alert('$dbconn->error');";
            // echo "history.back();</script>";
        }
        
    }
    else if($mode=='login') {//로그인
         
        $sns_type = $_POST['sns_type'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        if($sns_type=="google") {
            $password = md5($email);
        }
        $name = $_POST['name'];

        // echo "email : ".$email.", pw : ".$password.", name : ".$name;

        //유저테이블 조회
        $sql_user = " SELECT * FROM user WHERE email='$email' ;";

        $result = $dbconn->query($sql_user);

        if($result->num_rows > 0){//일반회원 로그인
            if($row = $result->fetch_array()) {
                if($password == $row['password']) {
                    $grant_id = $row['grant_id'];
                    $grant_name;
                    
                    $sql_grant = " SELECT * FROM webpos.grant WHERE grant_id=$grant_id ;";

                    $result = $dbconn->query($sql_grant);

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
                    echo "<script>alert('비밀번호가 다릅니다');";
                    echo "history.back();</script>";        
                }
            }else {
                echo "<script>alert('아이디를 찾을수 없습니다.');";
                echo "history.back();</script>";
            }
            
        } else {// 사업자 로그인
            //사업자 테이블 조회
            $sql_owner = " SELECT * FROM owner WHERE email='$email' ;";

            $result = $dbconn->query($sql_owner);

            if($row = $result->fetch_array()) {
                if($password == $row['password']) {
                    $grant_id = $row['grant_id'];
                    $_SESSION['s_email'] = $row['email'];
                    $_SESSION['s_name'] = $row['oname'];
                    $_SESSION['s_tel'] = $row['tel'];
                    //grant정보 가져옴
                    $sql_grant = " SELECT * FROM webpos.grant WHERE grant_id=$grant_id ;";

                    $result = $dbconn->query($sql_grant);

                    if($row_g = $result->fetch_array()) {
                        $_SESSION['s_grade'] = $row_g['grant_id'];
                        $_SESSION['s_grant_name'] = $row_g['grant_name'];
                    }



                    //grant정보 가져옴
                    $sql_store = " SELECT * FROM webpos.store WHERE owner_email='$email' ; ";

                    $result = $dbconn->query($sql_store);
                    if($dbconn->error) {
                        echo $dbconn->error;
                        exit;  
                    }
                    if($row_s = $result->fetch_array()) {
                        $_SESSION['s_store_id'] = $row_s['store_id'];
                        $_SESSION['s_sname'] = $row_s['sname'];
                    }

                    echo "<script>location.href='../index.php';</script>";
                }else {
                    echo "<script>alert('비밀번호가 다릅니다');";
                    echo "history.back();</script>";        
                }
            }else {
                echo "<script>alert('아이디를 찾을수 없습니다.');";
                echo "history.back();</script>";
            }
        }

    }// mode=login
    else if($mode=='logout') {//로그아웃
        session_destroy();
        echo "<script>location.href='../login.php';</script>";

    }else if($mode=='idcheck') {//id overlap check

    }else {
        echo "<script>alert('wrong access');";
            echo "location.href='../login.php';</script>";
    }

    
?>