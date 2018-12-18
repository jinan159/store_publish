<?php session_start();
   include "../process/dbconn.php";

   include "../process/detectDevice.php";

   $store_id = $_SESSION['s_store_id'];
    
    if(detectDevice()!="Mobile") {
        $sql = " SELECT od.order_num onum, o.order_time time, s.store_id sid,s.sname sname, m.mname mname, od.count count, od.price price, o.email email, o.isdone isdone";
        $sql .= " FROM webpos.order_detail od JOIN webpos.order o ";
        $sql .= " ON (od.order_num=o.order_num) JOIN webpos.store s ";
        $sql .= " ON (o.store_id=s.store_id) JOIN webpos.menu m ";
        $sql .= " ON (od.menu_id=m.menu_id) ";
        $sql .= " WHERE o.store_id='$store_id' ";
        $sql .= " ORDER BY o.order_time DESC; ";

        $result = $dbconn->query($sql);
        ?>
        <table>
            <tr>
                <th>주문번호</th>
                <th>주문자</th>
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
                    <td><?=$row['onum']?></td>    
                    <td><?=$row['email']?></td>
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
        $sql = " SELECT o.order_num onum, o.order_time time, o.email email ";
        $sql .= " FROM webpos.order o JOIN webpos.user";
        $sql .= " WHERE o.store_id='$store_id' ";
        $sql .= " ORDER BY o.order_time DESC; ";

        $result = $dbconn->query($sql);
        ?>
        <table>
            <tr>
                <th>주문번호(확인)</th>
                <th>주문시간</th>
                
            </tr>
            <?php
                while($row=$result->fetch_array()) {
            ?>  
                <tr>
                    <td><a href="load/confirm.php?order_num=<?=$row['onum']?>&from=a-order-his" target="new"><?=$row['onum']?></a></td>    
                    <td><?=$row['time']?></td>
                </tr>
            <?php
                }
            ?>
        </table>
        <?php
    }
    ?>