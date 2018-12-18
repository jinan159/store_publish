<?php session_start();
   include "../process/dbconn.php";
    
        $sql = " SELECT * FROM webpos.store WHERE confirm='n'";
        $sql .= "ORDER BY confirm, register_date ASC ";

        $result = $dbconn->query($sql);
        ?>
        <div>
            <form action="process/update.php?mode=store" method="POST">
            <input type="submit" value="선택한 가게 승인/정지">
            <table>
                <tr>
                    <th></th>
                    <th>가게 이름</th>
                    <th>이메일</th>
                    <th>전화번호</th>
                    <th>지역</th>
                    <th>사업자 번호</th>
                    <th>가입일</th>
                </tr>
                
                <?php
                    $id=1;
                    while($row=$result->fetch_array()) {
                ?>  
                    <tr>
                        <td>
                            <input type="checkbox" id="not_confirmed<?=$id?>" name="confirm_store[]" value="<?=$row['store_id']?>">
                            <label for="not_confirmed<?=$id?>" style="color:red;">미승인</label>
                        </td>
                        <td><?=$row['sname']?></td>
                        <td><?=$row['owner_email']?></td>
                        <td><?=$row['stel']?></td>
                        <td><?=$row['location']?></td>
                        <td><?=$row['brnum']?></td>
                        <td><?=$row['register_date']?></td>                     
                    </tr>
                <?php
                    $id+=1;
                    }
                ?>
                <tr>
                    <th></th>
                    <th>가게 이름</th>
                    <th>이메일</th>
                    <th>전화번호</th>
                    <th>지역</th>
                    <th>사업자 번호</th>
                    <th>가입일</th>
                </tr>
                <?php
                    $sql = " SELECT * FROM webpos.store WHERE confirm='y'";
                    $sql .= "ORDER BY confirm, register_date ASC ";
            
                    $result = $dbconn->query($sql);

                    $id=1;
                    while($row=$result->fetch_array()) {
                ?>  
                    <tr>
                        <td>
                            <input type="checkbox" id="confirmed<?=$id?>" name="stop_store[]" value="<?=$row['store_id']?>">
                            <label for="confirmed<?=$id?>" style="color:green;">승인됨</label>
                        </td>
                        <td><?=$row['sname']?></td>
                        <td><?=$row['owner_email']?></td>
                        <td><?=$row['stel']?></td>
                        <td><?=$row['location']?></td>
                        <td><?=$row['brnum']?></td>
                        <td><?=$row['register_date']?></td>
                    </tr>
                <?php
                    $id+=1;
                    }
                ?>
                <?php
                    while($row=$result->fetch_array()) {
                ?>  
                    <tr>
                        <td>
                            <input type="checkbox" id="demo-copy" name="confirm_store[]" value="<?=$row['store_id']?>">
                            <label for="demo-copy"></label>
                        </td>
                        <td><?=$row['sname']?></td>
                        <td><?=$row['owner_email']?></td>
                        <td><?=$row['stel']?></td>
                        <td><?=$row['location']?></td>
                        <td><?=$row['brnum']?></td>
                        <td><?=$row['register_date']?></td>                                             
                    </tr>
                <?php
                    }
                ?>
            </table>
            </form>
        </div>
        
