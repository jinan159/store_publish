<?php session_start();?>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php

	include "dbconn.php";	

	include "detectDevice.php";

	$store_id = $_SESSION['s_store_id'];
	$sname = $_SESSION['s_sname'];

	
	if($mode=="menu") {
		$data = array(
			array('메뉴','매출'),
		);
		$options = array(
			'title' => $sname." 통계 차트",
			'width' => 800, 'height' => 500
		);
		if(detectDevice()=="Mobile") {
			$options = array(
				'title' => $sname." 통계 차트",
				'width' => 350, 'height' => 250
			);
		}
		
	
		$sql = " SELECT mname, sum(od.price) sum, m.store_id ";
		$sql .= " FROM webpos.order_detail od JOIN webpos.menu m ";
		$sql .= " ON od.menu_id=m.menu_id ";
		$sql .= " WHERE m.store_id='$store_id' ";
		$sql .= " GROUP BY (od.menu_id); ";
		
	
		$result = $dbconn->query($sql);
	
		
		while($row=$result->fetch_array()) {
			$sum = $row['sum'];
			$temp = array($row['mname'], intval($sum));  
				
			array_push($data, $temp);
		}
		$data = json_encode($data);
		$options = json_encode($options);
	
		
	} //end if($mode=menu)
	else if($mode=="date") {
		$data = array(
			array('메뉴','매출'),
		);
		$options = array(
			'title' => $sname." 통계 차트",
			'width' => 800, 'height' => 500
		);
		if(detectDevice()=="Mobile") {
			$options = array(
				'title' => $sname." 통계 차트",
				'width' => 350, 'height' => 250
			);
		}

		$start;
		$end;
		if(isset($_POST['startDate']) && isset($_POST['endDate'])) {
			$start = new DateTime($_POST['startDate']);
			$end = new DateTime($_POST['endDate']);
		}else {
			$start = new DateTime();
			$end = new DateTime();
		}
		$start->modify('-1 day');
		$end->modify('+1 day');
	
		$startDate = date_format($start, 'Y-m-d');
		$endDate = date_format($end, 'Y-m-d');		
	
		$sql = " SELECT DATE_FORMAT(o.order_time, '%Y-%m-%d') order_time, o.store_id, sum(od.price) sum ";
		$sql .= " FROM webpos.order o JOIN webpos.order_detail od ";
		$sql .= " ON (o.order_num=od.order_num) ";
		$sql .= " WHERE o.store_id='$store_id' ";
		$sql .= " GROUP BY (DATE_FORMAT(o.order_time, '%Y-%m-%d')) ";
		$sql .= " HAVING order_time>'$startDate' AND order_time<'$endDate'; ";
	
		$result = $dbconn->query($sql);
		
		while($row=$result->fetch_array()) {
			$sum = $row['sum'];
			$temp = array($row['order_time'], intval($sum));  
			
			array_push($data, $temp);
		}
		if(count($data)==1) {
			$temp = array('',0);  
			array_push($data, $temp);
		}

		$data = json_encode($data);
		$options = json_encode($options);
	
	}
?>