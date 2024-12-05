<?php
header("Content-type:text/html; charset=UTF-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
?>

<?php  
include('db/connect_pmk.php');   
include('function/conv_date.php');   
$q = strtoupper(urldecode($_GET["q"]));  
    $pagesize = 10; // จำนวนรายการที่ต้องการแสดง  
    $find_field="code"; // ฟิลที่ต้องการค้นหา  
	$sqledu="SELECT U_USER_ID,NAME FROM utables WHERE (U_USER_ID LIKE '$q%' OR NAME LIKE '$q%') AND ROWNUM <= 100";
	$objParse=oci_parse($objConnect,$sqledu);
    oci_execute($objParse,OCI_DEFAULT);
		while($objResult = oci_fetch_array($objParse,OCI_BOTH))
       {
        $id=$objResult["U_USER_ID"]; // ฟิลที่ต้องการส่งค่ากลับ  
        $tname=conv($objResult['NAME']); // ฟิลที่ต้องการแสดงค่า  
		// $tname = iconv("tis-620","utf-8",$objResult2['HALFPLACE']);
        $name=$objResult["U_USER_ID"].' - '. $tname; // ฟิลที่ต้องการแสดงค่า  
        $name = str_replace("'", "'", $name);  
        $display_name = preg_replace("/(" . $q . ")/i", "<b>$1</b>", $name);  
        echo "<li onselect=\"this.setText('$name').setValue('$id');\">$display_name</li>";  
    }  
   ?>