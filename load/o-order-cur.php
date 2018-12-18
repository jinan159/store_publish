<?php session_start(); ?>
<div>
    <h1>현재 주문 현황</h1>
    <table id="result"></table>
</div>
<script>
        var source = new EventSource("process/load_cur_order.php?");
        source.addEventListener("message",function(e) {
            document.getElementById("result").innerHTML = e.data; 
        });
</script>