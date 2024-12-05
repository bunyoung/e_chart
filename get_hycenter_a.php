<?php
header("Content-type: text/json");
include 'db/connection.php';
?>
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
$sql="SELECT * FROM v_monitor  WHERE  hdate = $d_default order by name ";
$query=mysqli_query($conn,$sql);
print_r ($sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['hyitem']          = $rs['hyitem'];
    $a['hn']                = $rs['hn'];
    // $a['patients']        = $rs['patients'];
    // $a['fplace']          = $rs['fplace'];
    // $a['tplace']          = $rs['tplace'];
    // $a['assname']      = $rs['assname'];
    // $a['hassnamea']  = $rs['hassnamea'];
    // $a['hassnameb']  = $rs['hassnameb'];
    // $a['sick']            = $rs['sicka'].' '.$rs['sickb'].' '.$rs['sickc'].' '.$rs['sickd'].' '.$rs['sicke'].' '.$rs['sickf'].' '.$arr['sickg'];
    // $a['htime']         = $rs['htime'];
    // $a['x1_pertime'] = $rs['x1_pertime'];
    // $a['name']         = $rs['name'];
    // if($rs['x1'] =='C'){
    //     $a['stata'] = 'กำลังดำเนินการ';
    // }else{
    //     if($rs['x1']=='F'){
    //         $a['statb']    = 'ดำเนินการสิ้นสุด';
    //     }else{
    //             $a['statc']    = 'รอดำเนินการ';
    //     }
    // }    
    array_push($data,$a);
}

print json_encode($data); 
?>