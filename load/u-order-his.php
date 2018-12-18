<?php session_start();
    include "../process/dbconn.php";

    include "../process/detectDevice.php";

    $email = $_SESSION['s_email'];

    

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