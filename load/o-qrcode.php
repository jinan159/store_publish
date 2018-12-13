<?php session_start(); ?>
    <div id="qr_result" class="left-div">
        <a href="" id="downloadLink" download><img id="qrcodeimg" style="display:none;" ></a>
    </div>
    <div class="right-div">
        <br>
        [데스크탑에서 출력하기]
        <br>
        1. QR코드 클릭<br>
        2. QR코드 화면에서 Ctrl + P <br>으로 이미지로 출력가능
        
    </div>
    
    <script>
        $(document).ready(function () {
            var makeQRCodeUrl = "http://chart.apis.google.com/chart?cht=qr&chs=150&choe=UTF-8&chld=Hl0";

            var text = "http://webpos.ga/load/selMenu.php?store_id=<?=$_SESSION['s_store_id']?>&store_name=<?=$_SESSION['s_sname']?>&reload=selMenu";

            if(text != "") {
                var qrchl = makeQRCodeUrl+"&chl="+encodeURIComponent(text);

                var imgtag = document.createElement("img");

                imgtag.setAttribute("id","qrcodeimg");
                imgtag.setAttribute("src",qrchl);
                imgtag.setAttribute("style","display:none;");
                document.getElementById('downloadLink').setAttribute('href',qrchl);
                document.getElementById('downloadLink').setAttribute('download',qrchl);
                document.getElementById("downloadLink").removeChild(document.getElementById('qrcodeimg'));
                document.getElementById("downloadLink").appendChild(imgtag);
                $('#qrcodeimg').fadeIn(100);
            }else {
                alert('생성할 정보가 없음');
            }
        });

        
    </script>