<?php 
include_once('db/connection.php');
$pt="";
$jobid=$_POST['jboid'];

$jpl="SELECT * FROM sys_hys_mest WHERE hysm_code = '$jobid' AND hysm_status='0'";
$jres = mysqli_query($conn, $jpl);  
while($row = mysqli_fetch_array($jres) ){
    
}
?>