<?php session_start();
   include "../process/dbconn.php";
    
        $sql = " SELECT * FROM webpos.owner ";
        $result = $dbconn->query($sql);

        ?>
        <div>
            <h3>점포 관리자 관리</h3>
            <table>
                <tr>
                    <th>이메일</th>
                    <th>이름</th>
                    <th>전화번호</th>
                    <th>주소</th>
                </tr>
                
                <?php
                    $id=1;
                    while($row=$result->fetch_array()) {
                ?>  
                    <tr>
                        <td><a href="myinfo.php?mode=owner&email=<?=$row['email']?>"><?=$row['email']?></a></td>
                        <td><?=$row['oname']?></td>
                        <td><?=$row['tel']?></td>
                        <td><?=$row['address']?></td>                     
                    </tr>
                <?php
                    $id+=1;
                    }
                ?>
            </table>
        </div>
        
