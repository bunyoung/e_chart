<?php 
include_once('db/connect_pmk.php');
$sqlicd = "SELECT CODE,ICD_DESC
                FROM ICD10S WHERE DEL_FLAG IS NULL ORDER BY CODE";

$objParse = oci_parse($objConnect, $sqlicd);  
oci_execute ($objParse,OCI_DEFAULT); 
$data = array();
while($objResult= oci_fetch_array($objParse,OCI_BOTH)) {
    $a['code'] = $objResult["CODE"]; 
    $a['desc'] = $objResult["CODE"].'-'.iconv("tis-620","utf-8",$objResult["ICD_DESC"]); 
    array_push($data,$a);		
}
print json_encode($data);
oci_close($objConnect);
?>
