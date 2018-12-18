<?php session_start();?>

    
    
	<div class="container-fluid">
		<div class="container title">
			<h2 class="list-title">'<?= $_SESSION['s_sname'] ?>' 통계 현황</h2>	
			
		</div>
		<div class="container" >
            <?php
                include "../process/drawChart.php";
            ?>

			<form action="./index.php?reload=o-stat" method="get">
            <input type="hidden" name="reload" value="o-stat">
			<div class="container" style="width: 1000px; min-width: 300px;">
			    <div class="row">
			  	<div class="col">
			  		<div class="chart" id="chart_div">
					</div>	
					<div class="input-group date">
						<div class="input-group-prepend">
						  	<span class="input-group-text">시작 날짜/끝 날짜</span>
						</div>
							<input type="date" class="form-control" id="startDate" name="startDate">
							<input type="date" class="form-control" id="endDate" name="endDate">
							<input type="submit" value="검색" class="btn btn-primary" >	
							
                    </div>
                </div>
					
				</div>
			</div>
			</form>
		</div>
    </div>

<script src="//www.google.com/jsapi"></script>
<script>
    var data = <?= $data ?>;
    var options = <?= $options ?>;
    google.load('visualization', '1.0', {'packages':['corechart']});
    google.setOnLoadCallback(function() {
    var chart = new google.visualization.ColumnChart(document.querySelector('#chart_div'));
    chart.draw(google.visualization.arrayToDataTable(data), options);
    });
</script>
