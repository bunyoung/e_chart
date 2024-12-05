<?php
include('db/connection.php');
?>
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
// 
	$sql = "SELECT * FROM v_logistic_pie where hdate = '$d_default' ";
	
	$result = mysqli_query($conn, $sql);
	$content = [];
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
			$content[] = [
				'name' => $row['assname'],
				'value' => $row['tot']
			];
		}
	}
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
   <head>
       <meta charset="utf-8">
   </head>
   <body">
       <div id="container" style="height: 100%"></div>
       <script type="text/javascript" src="assets/js/echarts.min.js"></script>
       <script type="text/javascript">
				var dom = document.getElementById("container");
				var myChart = echarts.init(dom);

				var seriesData = <?=json_encode($content)?>;
				
				option = {
					title : {
						text: 'รายงานแสดงยอดขายตามช่วงวัน',
						subtext: 'เวลา 8:00 น  ถึง 16:00 น.',
						x:'center'
					},
					tooltip : {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},

					series : [
						{
							name: 'รายงานแสดงยอดขายตามช่วงวัน',
							type: 'pie',
							data: seriesData,
							itemStyle: {
								emphasis: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)'
								}
							}
						}
					]
				};

				if (option && typeof option === "object") {
					myChart.setOption(option, true);
				}
       </script>
   </body>
</html>
