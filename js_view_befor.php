<?php
header("Content-type: text/json");
include("db/connection.php");
$sql="SELECT ecd.*, 
em.m_depname,es.s_ename,
 dd.prename AS prea, dd.name AS namea, dd.surname AS surnamea,
 dd1.prename AS preb,dd1.name AS nameb,dd1.surname AS surnameb,
 dd2.prename AS prec,dd2.name AS namec,dd2.surname AS sunamec,
 i.icd_desc AS icd_desca,i1.icd_desc AS icd_descb,i2.icd_desc AS icd_descc,
 pt.name as ptname
 FROM e_cons_detail ecd 
 LEFT JOIN e_mdepart em ON em.m_depid=ecd.hdep
 LEFT JOIN e_smdepart es ON es.s_edepart= ecd.sdep
 LEFT JOIN doc_dbfs dd ON dd.doc_code=ecd.hdoc
 LEFT JOIN doc_dbfs dd1 ON dd1.doc_code=ecd.fdoc
 LEFT JOIN doc_dbfs dd2 ON dd2.doc_code=ecd.mdoc
 LEFT JOIN icd10s i ON i.code=ecd.icda
 LEFT JOIN icd10s i1 ON i1.code=ecd.icdb
 LEFT JOIN icd10s i2 ON i2.code=ecd.icdc
 LEFT JOIN pt_types pt ON pt.type_id = ecd.pt_types
 ORDER BY cons_id DESC";
$query=mysqli_query($conn,$sql);
$data = array();
$i=1;
while($rs=mysqli_fetch_array($query)) {
    $a['cons_id'] = $rs['cons_id'];
    $a['cons_date'] = $rs['cons_date'];
    $a['an']      = $rs['an'];
    $a['hn']      = $rs['hn'];
    $a['pname']   = $rs['pname'];
    $a['sex']     = $rs['sex'];
    $a['age']     = $rs['age'];
    $a['places']  = $rs['places'];
    $a['beds']      = $rs['beds'];
    $a['date_admit']= $rs['date_admit'];
    $a['pt_types']   = $rs['pt_types'].' - '.$rs['ptname'];
    $a['hdep']      = $rs['hdep'].' - '.$rs['m_depname'];
    $a['sdep']      = $rs['sdep'].' - '.$rs['s_ename'];
    $a['a1']        = $rs['a1'];
    $a['a2']        = $rs['a2'];
    $a['a3']        = $rs['a3'];   
    $a['hdoc']      = $rs['hdoc'].' - '.$rs['prea'].''.$rs['namea'].'  '.$rs['surnamea'];
    $a['icda']      = $rs['icda'].' - '.$rs['icd_desca'];
    $a['icdb']      = $rs['icdb'].' - '.$rs['icd_descb'];
    $a['icdc']      = $rs['icdc'].' - '.$rs['icd_descc'];
    $a['ftext']     = $rs['ftext'];
    $a['exp']       = $rs['exp'];
    $a['mdoc']      = $rs['mdoc'].' - '.$rs['preb'].''.$rs['nameb'].'  '.$rs['surnameb'];
    $a['fdoc']      = $rs['fdoc'].' - '.$rs['prec'].''.$rs['namec'].'  '.$rs['surnamec'];
    $a['status']    = $rs['status'];
    array_push($data,$a);
}
print json_encode($data);