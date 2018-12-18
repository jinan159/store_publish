<?php session_start();
    include "../process/dbconn.php";

    $email = $_SESSION['s_email'];

    // SELECT s.sname, SUM(od.price*od.count) sum, s.location, s.owner_email
    // FROM order_detail od JOIN order o
    // ON (od.order_num=o.order_num) JOIN store s
    // ON (o.store_id=s.store_id)
    // ORDER BY sum DESC

    // SELECT s.sname, SUM(od.price*od.count) sum, s.location, s.owner_email
    // FROM webpos.store s JOIN webpos.order o
    // ON (s.store_id=o.store_id) JOIN webpos.order_detail od
    // ON (o.order_num=od.order_num)
    // GROUP BY s.store_id

    
    

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
    