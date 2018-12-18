<?php session_start();
   include "../process/dbconn.php";
    
        $sql = " SELECT * FROM webpos.user ";
        $result = $dbconn->query($sql);

        ?>
        <div>
            <h3>유저 관리</h3>
            <table>
                <tr>
                    <th>이메일</th>
                    <th>sns여부</th>
                    <th>이름</th>
                    <th>전화번호</th>
                    <th>주소</th>
                </tr>
                
                <?php
                    $id=1;
                    while($row=$result->fetch_array()) {
                ?>  
                    <tr>
                        <td><a href="myinfo.php?mode=user&email=<?=$row['email']?>"><?=$row['email']?></a></td>
                        <td><?=$row['sns']?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['tel']?></td>
                        <td><?=$row['address']?></td>                     
                    </tr>
                <?php
                    $id+=1;
                    }
                ?>
            </table>
        </div>
        
