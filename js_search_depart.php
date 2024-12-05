<?php 
include_once('db/connection.php');
$sqldepart = "SELECT m_depid,m_depname
                FROM e_mdepart ORDER BY m_depname";

$sql=mysqli_query($conn,$sqldepart);
$data = array();
while($objResult = mysqli_fetch_assoc($result)){
    $a['dep']   = $objResult["m_depid"]; 
    $a['fulldep'] = $objResult["m_depid"].'-'.$objResult["m_depname"]; 
    array_push($data,$a);		
}
print json_encode($data);
oci_close($objConnect);
?>
