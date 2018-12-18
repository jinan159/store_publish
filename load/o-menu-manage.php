<?php session_start(); ?>
<?php
	if(!isset($_SESSION['s_store_id'])) {
		?>
<script>
    alert('점포등록을 먼저 해주세요.');
    location.href = 'register_store.php';
</script>

<?php
	}
?>
<div class="container-fluid list-title title">
    <h2 class="list-title">메뉴 관리</h2>
</div>
<form action="process/insert.php?mode=menu" method="POST" enctype="multipart/form-data">
    <table class="table" style="width:100%">
        <thead class="thead-dark">
            
            <!-- 메뉴 사진  -->
            <!-- <tr>
                <th scope="col">메뉴 사진</th>
                <td colspan="5">
                    <div>
                        <span>이미지 파일만(최대 2MB)</span>
                    </div>
                    <div>
                        <input type="file" name="menu_img" id="menu-img">

                    </div>
                </td>
            </tr> -->
            <tr>
                <th scope="col">메뉴 이름</th>
                <td colspan="5">
                    <!-- 메뉴 이름  -->
                    <div class="input-group mb-3">
                        <!-- <div class="input-group-prepend">
                    <span class="input-group-text text-danger" id="namen">사용불가</span>
                    <span class="input-group-text text-success" id="namey">사용가능</span>
                  </div> -->
                        <input type="text" id="menu-name" name="mname">
                        <!-- onkeydown="nameconfirm();" onkeyup="nameconfirm();" -->
                    </div>
                </td>
            </tr>
            <tr>
                <!-- 메뉴 가격  -->
                <th scope="col">가격</th>
                <td colspan="5">
                    <div>
                        <input type="number" name="price" id="menu-price">
                    </div>
                </td>
            </tr>
            <!-- 메뉴 설명  -->
            <!-- <tr>
                <th scope="col">메뉴 설명(옵션)</th>
                <td colspan="5">
                    
                    <div>
                        <input type="text" name="comment" id="menu-cmt">
                    </div>
                </td>
            </tr> -->
            <tr>
                <td colspan="6">
                    <div style="text-align:center;">
                        <input class="submit-btn" type="submit" onclick="return addCategory();" value="추가">
                    </div>
                </td>
            </tr>
            <tr>
                <th>메뉴 이름</th>
                <!-- <th>설명</th> -->
                <th>가격</th>
                <!-- <th>이미지</th> -->
                <th></th>
            </tr>

        </thead>
        <tbody>
            <?php
					include_once "../process/dbconn.php";

					$store_id = $_SESSION['s_store_id'];
					$sql = " SELECT * FROM webpos.menu WHERE store_id='$store_id' ; ";

					$result = $dbconn->query($sql);
					if($dbconn->error) {
							echo $dbconn->error;
							exit;  
					}
					while($row = $result->fetch_array()) {
						?>

            <tr>
                <td>
                    <?= $row['mname'] ?>
                </td>
                <!-- <td>보기<?= $row['mcomment'] ?></td> -->
                <td>
                    <?= $row['price'] ?>
                </td>
                <!-- <td><?= $row['menu_img'] ?></td> -->
                <td style="width:40px;"><input class="submit-btn" type="button" value="삭제" onclick="return deleteMenu('<?= $row['menu_id'] ?>');"></td>
            </tr>


            <?php
					}
				?>

        </tbody>
    </table>
</form>
<script>
    function deleteMenu(id) {
        if (confirm('정말 삭제하시겠습니까?')) {
            $.get("http://localhost/store_publish/process/delete.php?mode=menu&menu_id=" + id, function (jqXHR) {
                alert("success");
            }, 'json' /* xml, text, script, html */)
                .done(function (jqXHR) {
                    alert("성공");
                })
                .always(function (jqXHR) {
                    location.href = 'index.php?reload=o-menu-manage';;
                });
        } else {

        }
    }


</script>