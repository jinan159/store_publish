<?php session_start();
   include "../process/dbconn.php";

   include "../process/detectDevice.php";

   $store_id = $_SESSION['s_store_id'];
    
    if(detectDevice()!="Mobile") {
        $sql = " SELECT od.order_num onum, o.order_time time, s.store_id sid,s.sname sname, m.mname mname, od.count count, od.price price, o.email email, o.isdone isdone ";
        $sql .= " FROM webpos.order_detail od JOIN webpos.order o ";
        $sql .= " ON (od.order_num=o.order_num) JOIN webpos.store s ";
        $sql .= " ON (o.store_id=s.store_id) JOIN webpos.menu m ";
        $sql .= " ON (od.menu_id=m.menu_id) ";
        $sql .= " ORDER BY o.order_time DESC; ";

        $result = $dbconn->query($sql);
        ?>
        <table>
            <tr>
                <th>가게</th>
                <th>주문번호</th>
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
                    $onum = $row['onum'];
            ?>  
                <tr>
                <?php
                    if($pre_onum!=$onum) {
                ?>
                    <td><?=$row['sname']?></td> 
                    <td><a href="load/confirm.php?order_num=<?=$row['onum']?>&from=a-order-his" target="new"><?=$row['onum']?></a></td>    
                    <td><?=$row['email']?></td>
                    <td><?=$row['time']?></td>
                <?php
                    
                    }else {
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                    }
                ?>
                    
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
            ?>
        </table>
        <?php
    }else {
        $sql = " SELECT * ";
        $sql .= " FROM webpos.order";
        $sql .= " ORDER BY order_time DESC; ";

        $result = $dbconn->query($sql);
        ?>
        <table>
            <tr>
                <th>주문번호(대기중)</th>
                <th>주문시간</th>
                <th>취소</th>
                
            </tr>
            <?php
                $pre_onum="";
                while($row=$result->fetch_array()) {
                    if($row['isdone']=='n') {
                    $onum = $row['order_num'];
            ?>  
                <tr>
                    <td><a href="load/confirm.php?order_num=<?=$row['order_num']?>" target="new"><?=$row['order_num']?></a></td>    
                    <td><?=$row['order_time']?></td>
                    <?php
                        if($pre_onum!=$onum) {
                    ?>
                        <td><input type="button" onclick="deleteOrder('<?=$row['order_num']?>')" value="취소"></td>
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
                <th>주문번호(대기중)</th>
                <th>주문시간</th>
                <th>취소</th>
                
            </tr>
            <?php
                $pre_onum="";
                $result = $dbconn->query($sql);
                while($row=$result->fetch_array()) {
                    if($row['isdone']=='y') {
                    $onum = $row['order_num'];
            ?>  
                <tr>
                    <td><a href="load/confirm.php?order_num=<?=$row['order_num']?>" target="new"><?=$row['order_num']?></a></td>    
                    <td><?=$row['order_time']?></td>
                    <?php
                        if($pre_onum!=$onum) {
                    ?>
                        <td><input type="button" onclick="deleteOrder('<?=$row['order_num']?>')" value="취소"></td>
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
    }
    ?>
    <script>
    function deleteOrder(onum) {
        if(confirm('정말 삭제하시겠습니까?')) {
            location.href="process/delete.php?mode=order&order_num="+onum;
        }
    }
</script>