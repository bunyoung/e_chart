<?php
// Set the JSON header
header("Content-type: text/json");
include 'db/connection.php';

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
$sql="SELECT
a.dgroup AS dgroup, 
a.hyitem AS hyitem, 
a.assetcode AS assetcode, 
sa.assname AS assname, 
sa.asscolor AS asscolor, 
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
a.assetdet as tdet,
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
e.linenotify AS linenotify, 
a.peramt AS peramt, 
sys_unit.unit AS unit, 
a.assetdet AS assetdet, 
places.fullplace AS ntplace, 
pl.fullplace AS ftplace, 
sys_clean_argent.clean_argent AS clean_argent, 
a.firstplace AS firstplace, 
a.typeb, 
a.typea, 
a.perrend, 
pmk_places.pmkplace
FROM
(
    (
        (
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
                    LEFT JOIN
                    sys_asset AS sa
                    ON 
                        (
                            (
                                sa.assetid = a.assetcode
                            )
                        )
                )
                LEFT JOIN
                sys_unit
                ON 
                    (
                        (
                            a.unit = sys_unit.id
                        )
                    )
            )
            LEFT JOIN
            places
            ON 
                (
                    (
                        a.toplace = places.placecode
                    )
                )
        )
        LEFT JOIN
        places AS pl
        ON 
            (
                (
                    a.fromplace = pl.placecode
                )
            )
    )
    LEFT JOIN
    sys_clean_argent
    ON 
        (
            (
                a.other_argent = sys_clean_argent.id
            )
        )
)
LEFT JOIN
pmk_places
ON 
    a.firstplace = pmk_places.pmkcode
WHERE
(
    a.dgroup = 'C'
)
ORDER BY
a.hyitem DESC";
// $sql="SELECT * FROM v_asmonitor_c";
$query=mysqli_query($conn,$sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['dgroup']     = $rs['dgroup'].'-'.$rs['hyitem'];
    $a['assname']    = $rs['assname'];
    $a['firstplace'] = $rs['fplace'];
    $a['fplace']     = $rs['ftplace'];
    $a['tplace']     = $rs['ntplace'];
    $a['hdate']      = $rs['hdate'];
    $a['htime']      = $rs['htime'];
    $a['x1_pertime'] = $rs['x1_pertime'];
    $a['perto']      = $rs['perto'];
    $a['perfinish']  = $rs['perfinish'];
    $a['name']       = $rs['name'];
    $a['usetimeAll'] = $rs['usetimeAll'];
    $a['endjoba']    = $rs['typea'];
    $a['endjobb']    = $rs['typeb'];
    $a['endfinish']  = $rs['perrend'];
    $a['assetdet'] =$rs['assetdet'];
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