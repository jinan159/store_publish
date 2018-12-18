<?php session_start();
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');

    include_once "dbconn.php";

    $store_id = $_SESSION['s_store_id'];
    $email = $_SESSION['s_email'];

    $sql = " SELECT od.order_num onum, o.order_time time, s.store_id sid, ";
    $sql .= " s.sname sname, m.mname mname, od.count count, od.price price, o.email email, o.isdone isdone";
    $sql .= " FROM webpos.order_detail od JOIN webpos.order o ";
    $sql .= " ON (od.order_num=o.order_num) JOIN webpos.store s ";
    $sql .= " ON (o.store_id=s.store_id) JOIN webpos.menu m ";
    $sql .= " ON (od.menu_id=m.menu_id) ";
    $sql .= " WHERE s.store_id='$store_id' ";
    $sql .= " AND o.isdone='n' ";
    $sql .= " ORDER BY o.order_time ASC; ";

    $result = $dbconn->query($sql);


    
    $thead = "<tr>";
    // $thead .= "<th>주문번호</th>";
    $thead .= "<th>주문시간</th>";
    $thead .= "<th>메뉴이름</th>";
    $thead .= "<th>수량</th>";
    // $thead .= "<th>가격</th>";
    $thead .= "<th>주문자</th>";
    $thead .= "<th>완료</th>";
    $thead .= "</tr>";

    $table_row = "";
    $pre_time="";
    while($row = $result->fetch_array()) {
        $onum = $row['onum'];
        $time = $row['time'];
        $mname = $row['mname'];
        $count = $row['count'];
        // $price = $row['price'];
        $email = $row['email'];
        

        $sql_u = " SELECT * FROM webpos.user WHERE email='$email'; ";

        $result_u = $dbconn->query($sql_u);

        $row_u = $result_u->fetch_array();
        $user_name = $row_u['name'];

        $table_row .= "<tr onclick='return confirm(\"주문자:$user_name  주문완료하시겠습니까?\");'>";
        // $table_row .= "<td>$onum</td>";
        if($pre_time!=$time) {
            $table_row .= "<td>$time</td>";
        }else {
            $table_row .= "<td></td>";
        }
        

        $table_row .= "<td>$mname</td>";
        $table_row .= "<td>$count</td>";
        // $table_row .= "<td>$price</td>";
        $table_row .= "<td>$user_name</td>";
        if($pre_time!=$time) {
            $table_row .= "<td><a style='min-width:50px;' href='process/update.php?mode=order&order_num=$onum' class='submit-btn success'>X</a></td>";
            $pre_time = $time;
        }else {
            $table_row .= "<td></td>";
        }
        
        $table_row .= "</tr>";
        
    }
    

    echo "data: $thead.$table_row\n\n";
    flush();
?>