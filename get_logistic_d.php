<?php
// Set the JSON header
header("Content-type: text/json");
include 'db/connection.php';

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

// $sql="SELECT * FROM v_asmonitor_d";
$sql="SELECT
a.dgroup AS dgroup, 
a.hyitem AS hyitem, 
a.assetcode AS assetcode, 
sa.assname, 
sa.asscolor, 
a.hdate AS hdate, 
a.fromplace AS fromplace, 
a.toplace AS toplace, 
a.htime AS htime, 
a.pers AS pers, 
a.perstatus AS perstatus, 
a.perdate AS perdate, 
a.x1_pertime AS x1_pertime, 
a.perto AS perto, 
a.perfinish AS perfinish, 
a.x1 AS x1, 
a.x2 AS x2, 
a.x3 AS x3, 
e.`name` AS `name`, 
e.username AS username, 
ADDTIME(
    `a`.`x1_pertime`,
    - (
    CAST( `a`.`htime` AS time ))) AS metime, 
ADDTIME(
    `a`.`perfinish`,
    - (
    CAST( `a`.`htime` AS time ))) AS usetimeAll, 
e.linenotify, 
a.assetdet, 
a.other, 
places.fullplace AS ftplace, 
sys_clean_place.clean_place, 
a.floor, 
a.build, 
sys_building.`name` AS nbuild, 
a.clean_level, 
sys_clean_level.clean_level AS lvc, 
sys_clean_argent.clean_argent, 
a.firstplace, 
a.typeb, 
a.typea, 
a.perrend
FROM
(
    (
        (
            asssent AS a
            LEFT JOIN
            employee AS e
            ON 
                (
                    (
                        e.idcard = a.pers
                    )
                )
        )
    )
)
LEFT JOIN
sys_asset AS sa
ON 
    sa.assetid = a.assetcode
LEFT JOIN
places
ON 
    a.fromplace = places.placecode
LEFT JOIN
sys_clean_place
ON 
    a.clean_place = sys_clean_place.id
LEFT JOIN
sys_building
ON 
    a.build = sys_building.id
LEFT JOIN
sys_clean_level
ON 
    a.clean_level = sys_clean_level.id
LEFT JOIN
sys_clean_argent
ON 
    a.clean_argent = sys_clean_argent.id
WHERE
dgroup = 'D'
ORDER BY
hyitem DESC ";
$query=mysqli_query($conn,$sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['dgroup']     = $rs['dgroup'].'-'.$rs['hyitem'];
    if($rs['dgroup']=='D'){
        $a['assname']    = 'ขอใช้บริการทำความสะอาด';
    }
    $a['hyitem'] = $rs['hyitem'];
    $a['firstplace']    = $rs['ftplace'];
    $a['fplace']    = $rs['ftplace'];
    $a['clean_place']    = $rs['clean_place'];
    $a['hdate']    = $rs['hdate'];
    $a['htime']    = $rs['htime'];
    $a['nbuild']    = $rs['nbuild'];
    $a['x1_pertime']    = $rs['x1_pertime'];
    $a['perto']    = $rs['perto'];
    $a['perfinish']    = $rs['perfinish'];
    $a['name']    = $rs['name'];
    $a['usetimeAll']    = $rs['usetimeAll'];
    $a['endjoba']    = $rs['typea'];
    $a['endjobb']    = $rs['typeb'];
    $a['endfinish']    = $rs['perrend'];
    if($rs['x1'] =='F'){
        $a['status']    = 'จบงาน';
    }else{
        if($rs['x1']=='C'){
            $a['status']    = 'ยกเลิก';
        }else{
            if($rs['x1']=='W'){
                $a['status']    = 'รอดำเนินการ';
            }
        }
    }
    array_push($data,$a);
}

print json_encode($data); 
?>