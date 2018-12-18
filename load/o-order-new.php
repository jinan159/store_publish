<?php session_start(); ?>
<form action="process/insert.php?mode=order" method="POST">
    주문자 이메일<input type="email"  name="email" onkeydown="searchname(this)" onkeyup="searchname(this)" id="search2">
    <table id="container2" align="center" border="1">
    </table>
<table>
    <tbody>
        <?php
            include_once "../process/dbconn.php";

            $store_id = $_SESSION['s_store_id'];

            $sql = " SELECT * FROM webpos.menu WHERE store_id='$store_id'; ";

            $result = $dbconn->query($sql);
        ?>            
            <?php 
            $index = 1;
            while($row = $result->fetch_array()) {
            ?>
            
            <tr>
                <td>
                    <?= $row['mname'] ?>
                    <input type="hidden" name="menu_id[]" value="<?= $row['menu_id'] ?>">
                    <input type="hidden" name="price[]" value="<?= $row['price'] ?>">
                </td>
                <td><span id="price<?= $index ?>"><?= $row['price'] ?></span></td>
                <td>
                    <select onchange="calcTotal()" name="count[]" id="count<?= $index ?>" style="min-width:90px;">
                    <?php
                        for($i=0; $i<=10; $i++) {
                            ?>
                            <option value="<?=$i?>"><?=$i?>개</option>    
                            <?php
                        }
                    ?>
                    </select>
                </td>
                
            </tr>
            <?php
                $index++;
            }
            ?>
            <input type="hidden" name="store_id" value="<?= $store_id ?>"> <!--[store_id]--><br>
            <input type="hidden" name="index" value="<?=$index?>"><!--[인덱스]-->    
            <tr><td colspan="3"><input type="submit" class="button small" style="float:right;" value="주문 완료"> </td></tr>       
            
    </tbody>
</table>
</form>
<div class="search">
        <div>
            <!-- <h2>초성 검색</h2>
            <p>아직 마지막자리만 초성검색 가능</p> -->
            <table id="container2" align="center" style="width:70% ; min-width:300px; text-align='center';" border="1">
            </table>
        </div>
    </div>
<script>
    function searchname(text) {
            if(text.value=="") {
                $("#container2").empty();
                $("#container2").show();
            }else{
                $.get("process/getNameTable.php?mode=email&name="+text.value ,function (data, status) {
                    if(status=="success") {
                    // alert("Data: " + data + "\nStatus: " + status);
                    $("#container2").empty();
                    $("#container2").append(data);
                    }            
                });
            }
    }
    function setValue(span,id) {
        // alert(span.innerText);
        $('#snameBox').text(span.innerText);
        $('#search2').val(span.innerText);
        $('#store_id').val(id);
        $('#container2').hide();
        // alert(p);
    }
</script>