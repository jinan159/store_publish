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
                <th>주문번호(대기중)</th>
                <th>주문자</th>
                <th>주문시간</th>
                <th>메뉴이름</th>
                <th>수량</th>
                <th>가격</th>
                <th>취소</th>
            </tr>
            <?php
                $pre_onum = "";
                while($row=$result->fetch_array()) {
                    if($row['isdone']=='n') {
                    $onum = $row['onum'];
            ?>  
                <tr>
                <?php
                    if($pre_onum!=$onum) {
                ?>
                    <td><?=$row['onum']?></td>    
                    <td><?=$row['email']?></td>
                <?php
                    }else {
                        echo "<td></td>";
                        echo "<td></td>";
                    }
                ?>
                    <td><?=$row['time']?></td>
                    <td><?=$row['mname']?></td>
                    <td><?=$row['count']?></td>
                    <td><?=$row['price']?></td>
                    <?php
                    if($pre_onum!=$onum) {
                ?>
                    <td><input type="button" onclick="deleteOrder('<?=$row['onum']?>')" value="취소"></td>
                <?php
                    $pre_onum=$onum;
                    }else {
                        echo "<td></td>";
                    }
                ?>
                    
                </tr>
            <?php
                }
            }
            ?>
            <tr>
                <th>주문번호(완료)</th>
                <th>주문자</th>
                <th>주문시간</th>
                <th>메뉴이름</th>
                <th>수량</th>
                <th>가격</th>
                <th>취소</th>
            </tr>
            <?php
                $result = $dbconn->query($sql);
                $pre_onum = "";
                while($row=$result->fetch_array()) {
                    if($row['isdone']=='y') {
                    $onum = $row['onum'];
            ?>  
                <tr>
                <?php
                    if($pre_onum!=$onum) {
                ?>
                    <td><?=$row['onum']?></td>    
                    <td><?=$row['email']?></td>
                <?php
                    }else {
                        echo "<td></td>";
                        echo "<td></td>";
                    }
                ?>
                    <td><?=$row['time']?></td>
                    <td><?=$row['mname']?></td>
                    <td><?=$row['count']?></td>
                    <td><?=$row['price']?></td>
                    <?php
                    if($pre_onum!=$onum) {
                ?>
                    <td><input type="button" onclick="deleteOrder('<?=$row['onum']?>')" value="취소"></td>
                <?php
                    $pre_onum=$onum;
                    }else {
                        echo "<td></td>";
                    }
                ?>
                    
                </tr>
            <?php
                }
            }
            ?>
        </table>
        <?php
    }else {
        $sqlm = " SELECT order_num onum, order_time time, email, isdone ";
        $sqlm .= " FROM webpos.order ";
        $sqlm .= " WHERE store_id='$store_id' ";
        $sqlm .= " ORDER BY time DESC; ";

        $result = $dbconn->query($sqlm);
        ?>
        <table>
            <tr>
                <th>주문번호(대기중)</th>
                <th>주문시간</th>
                <th></th>
            </tr>
            <?php
                while($row=$result->fetch_array()) {
                    if($row['isdone']=='n') {
            ?>  
                <tr>
                    <td><a href="load/confirm.php?order_num=<?=$row['onum']?>&from=a-order-his" target="new"><?=$row['onum']?></a></td>    
                    <td><?=$row['time']?></td>
                    <td><input type="button" onclick="deleteOrder('<?=$row['onum']?>')" value="취소"></td>
                </tr>
            <?php
                }
            }
            ?>
            <tr>
                <th>주문번호(완료)</th>
                <th>주문시간</th>
                <th></th>
            </tr>
            <?php
                $result = $dbconn->query($sqlm);
                while($row=$result->fetch_array()) {
                    if($row['isdone']=='y') {
            ?>  
                <tr>
                    <td><a href="load/confirm.php?order_num=<?=$row['onum']?>&from=a-order-his" target="new"><?=$row['onum']?></a></td>    
                    <td><?=$row['time']?></td>
                    <td><input type="button" onclick="deleteOrder('<?=$row['onum']?>')" value="취소"></td>
                </tr>
            <?php
                }
            }
            ?>
        </table>
        <?php
    }
    ?>
<script>
    function deleteOrder(onum) {
        if(confirm('정말 삭제하시겠습니까?')) {
            location.href="process/delete.php?mode=order&order_num="+onum;
        }
    }
</script>