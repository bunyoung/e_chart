<!doctype html>
<!-- couter visit -->
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<?php
#write number
$page=basename($_SERVER['PHP_SELF']);
if (file_exists('_couter/'.$page.'.txt')) 
{
$fil = fopen('_couter/'.$page.'.txt', "r");
$dat = fread($fil, filesize('_couter/'.$page.'.txt')); 
#echo $dat+1;
fclose($fil);
$fil = fopen('_couter/'.$page.'.txt', "w");
fwrite($fil, $dat+1);
}
else
{
$fil = fopen('_couter/'.$page.'.txt', "w");
fwrite($fil, 1);
#echo '1';
fclose($fil);
}
#read number	
$myFile = "_couter/".$page.".txt";
$lines = file($myFile);//file in to an array
$count= $lines[0]; //line 2
?>
<?php
$error1='ไม่พบสิทธิในการเข้าถึง [bookout';
if(!isset($_SESSION)) {  session_start();  }
#ตรวจสอบสิทธิการเข้าใช้งาน
if (strpos( $_SESSION['privilage'], "[bookin]")==FALSE  ) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('ไม่พบสิทธิ [bookin]')
    window.location.href='sys_bookin.php';
    </SCRIPT>");
}
require_once("connection/connection.php");
require_once("connection/date_format.php");
#ชื่อสถานพยาบาล	
$sql = "SELECT CLIENT_NAME,CLIENT_ID FROM sys_book_url WHERE WEBSERVICE_TYPE=2";	// Download data name HPO
$resultd = mysqli_query($conn,$sql)or die(mysql_error()); 
$rsd=mysqli_fetch_array ($resultd, MYSQL_ASSOC );  
#ดึงประวัติเข้าใช้งาน กรณี login 
$sql2 = "SELECT concat(DATE_FORMAT(log_time,'%d/%m/'),DATE_FORMAT(log_time,'%Y')+543,' ',DATE_FORMAT(log_time,'%T')) as last_login FROM sys_log_login WHERE username ='".@$_SESSION['username']."' AND status = 'Success' ORDER BY log_time DESC limit 1,1";	// Download data LAST LOGIN
$resultd2 = mysqli_query($conn,$sql2)or die(mysql_error()); 
$rsd2=mysqli_fetch_array ($resultd2, MYSQL_ASSOC );

#login infomation	
$sql2 = "SELECT concat(DATE_FORMAT(log_time,'%d/%m/'),DATE_FORMAT(log_time,'%Y')+543,' ',DATE_FORMAT(log_time,'%T')) as last_login FROM sys_log_login WHERE username ='".@$_SESSION['username']."' AND status = 'Success' ORDER BY log_time DESC limit 1,1";	// Download data LAST LOGIN
$resultd2 = mysqli_query( $conn,$sql2)or die(mysql_error()); 
$rsd2=mysqli_fetch_array ($resultd2, MYSQL_ASSOC );
?>

<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
# $date_start_m_defult=date('m/');	
$date_start_m_defult='01/';	
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;
// 01/m/y+543

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;
// d/m/y+543

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;

$d_start_post = @$_POST['d_start'];
$d_end_post = @$_POST['d_end'];	
IF(!empty($d_start_post)){
$d_start = $d_start_post ;
}ELSE{
$d_start = $date_start_dmy_defult;
}
IF(!empty($d_end_post) ){
$d_end = $d_end_post ;
}ELSE{
$d_end = $date_end_dmy_defult;	
}
$d_start_cal = substr($d_start,0,2).substr($d_start,3,2).substr($d_start,6,4) ;
$d_end_cal =  substr($d_end,0,2).substr($d_end,3,2).substr($d_end,6,4) ;
$date_m= $d_end;
?>
<?php
#login infomation	
$sql2 = "SELECT concat(DATE_FORMAT(log_time,'%d/%m/'),DATE_FORMAT(log_time,'%Y')+543,' ',DATE_FORMAT(log_time,'%T')) as last_login,
                         depart,(SELECT sys_book_work.WORKNAME FROM sys_book_work WHERE  sys_book_work.did=sys_log_login.depart) AS deptname   FROM sys_log_login WHERE username ='".@$_SESSION['username']."' AND status = 'Success' ORDER BY log_time DESC limit 1,1";	// Download data LAST LOGIN
$resultd2 = mysqli_query( $conn,$sql2)or die(mysql_error()); 
$rsd2=mysqli_fetch_array ($resultd2, MYSQL_ASSOC );
$hos_depart = $rsd2['depart'];
$submit=$_GET['submit'];
$Select_ID=$_GET['Select_ID'];
$page=$_GET['page'];
$strSearch=$_GET['strSearch'];
?>

<!--  ส่วนการแก้ไขรายการข้อมูลหนังสือรับประจำวัน  -->
<?PHP
if(@$_POST['EDIT'])
{   
    $did=@$_POST['did'];
    $currdate=@$_POST['currdate'];
    $btype=@$_POST['btype'];
    $byear = @$_POST['byear'];
    $autoid=@$_POST['autoid'];
    $bookrec=@$_POST['bookrec'];
    $bookexpress=@$_POST['bookexpress'];
    $bookdate=@$_POST['bookdate'];
    $bookfrom=@$_POST['idfrom'];
    $bookto=@$_POST['idto'];
    $bookabout=@$_POST['bookabout'];
    $bookremark=@$_POST['bookremark'];
    $bookwork = @$_POST['idwork'];
    IF(@$_POST['delete_flag']=='1'){$delete_flag=1;}else{$delete_flag=0;}
    $delete_date=date("Y-m-d H:i:s");
    IF(@$_POST['user_level']=='1'){$user_level=1;}else{$user_level=0;}
    $create_user_id=@$_SESSION['name'];
    $c_cal_d=@$_POST['c_cal_d'];

    // Start Update
$sql_edit = "UPDATE sys_book_in
SET 
  CURRDATE='$currdate',
  BOOKREC = '$bookrec',
  BOOKEXPRESS='$bookexpress',
  BOOKDATE='$bookdate',
  BOOKFROM='$bookfrom',
  BOOKTO='$bookto',
  BOOKABOUT='$bookabout',
  BOOKREMARK='$bookremark',
  BOOKYEAR ='$byear',
  BOOKTYPE='$btype',
  BOOKWORK = '$bookwork',
  DELETE_FLAG='$delete_flag',
  DELETE_DATE='$delete_date',
  USER_LEVEL='$user_level',
  CREATE_USER_ID='$create_user_id' ,
  CURR_CALL_DATE='$c_cal_d'
  WHERE DID='$did'; ";
$result_sql_edit = mysqli_query($conn,$sql_edit);
mysql_error();
if ($result_sql_edit== TRUE) {
            //  บันทีกฝุ้ปฎิบ้ติ แบบ อะเรย์
$error1 = ' UPDATE successfully ';
$error2 = ' ระบบได้แก้ไขข้อมูล '.$bookrec.' เรียบร้อยแล้ว';
} else {
$error1 = ' UPDATE ERROR ';
$error2 = ' ไม่สามารถดำเนินการได้ กรุณาติดต่อผู้ดูแลระบบ';
}
echo '<script type="text/javascript">
           swal.fire("", " '.$error1.$error2.' ", "success");
         </script>';
}
 
?>
<!-- สิ้นสุดการแก้ไข -->


<html class="no-js">

<head>
    <?php  
include ('main_script.php');
?>
</head>

<body class="boxed">
    <div class="boxedd-wrapper">
        <div class="bg-bulue dker" id="wrap">
            <?php 
if (@$_SESSION['sess_userid'] <> session_id().@$_SESSION['web_login'].@$_SESSION['username']) {
require("main_top_panel.php"); 
}ELSE{
require("main_top_bookin_panel_session_setting.php");
}            
        ?>
            <?php
$sql = "SELECT * FROM sys_book_book WHERE  BOOKTYPE='1' AND DELETE_FLAG='0' ";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);
if ($count == 1) 
{
    $row = mysqli_fetch_array($query);
    $_SESSION['btype'] = $row['BOOKTYPE'];
    $_SESSION['byear'] = $row['BOOKYEAR'];
    $_SESSION['bstatus'] = $row['DELETE_FLAG'];
}
?>
            <?php
//เรียกเลขที่หนังสือล่าสุด  
$autoid = '';
$sql = "SELECT * 
from sys_book_book WHERE DELETE_FLAG = '$b_status' AND BOOKTYPE='$b_type' AND BOOKYEAR ='$b_year' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
   $row = mysqli_fetch_array($result);
   $autoid = $row['BOOKNO'];
}
?>

            <?php
$b_type = $_SESSION["btype"];
$b_status = $_SESSION["bstatus"];
$b_year = $_SESSION["byear"];
?>
            <div id="content3">
                <div class="outer">
                    <div class="row-fluid">
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='panel panel-success'>
                                    <div class='panel-body' align='center'>
                                        <div> </div>
                                        <?php  
										if($submit=="" or $_GET['show']=="OK"){
										if($page==''){
										$Search=$_POST['Search'];
										$Search2=$_POST['Search2'];
										}else{
										$Search=$_GET['Search'];
										$Search2=$_GET['Search2'];
										}
										?>
                                        <form name="form1" method="post"
                                            action="main_right_bookin_search.php?show=OK&strSearch=Y"
                                            class='navbar-form navbar-left' role='search'>
                                            <div class='form-group'>
                                                <select name='Search2' class='form-control'>
                                                    <option value="AUTOID"
                                                        <?php if($Search2=="AUTOID"){ echo 'selected'; }?>>
                                                        เลขที่รับอัตโนมัติ
                                                    </option>
                                                    <option value="CURRDATE"
                                                        <?php if($Search2=="CURRDATE"){ echo 'selected'; }?>>
                                                        วันที่รับในระบบ
                                                    </option>
                                                    <option value="BOOKREC"
                                                        <?php if($Search2=="BOOKREC"){ echo 'selected'; }?>>
                                                        เลขที่หนังสือ</option>
                                                    <option value="BOOKDATE"
                                                        <?php if($Search2=="BOOKDATE"){ echo 'selected'; }?>>
                                                        วันที่ในหนังสือ</option>
                                                    <option value="BOOKFROM"
                                                        <?php if($Search2=="BOOKFROM"){ echo 'selected'; }?>>
                                                        ผู้ส่ง</option>
                                                    <option value="BOOKABOUT"
                                                        <?php if($Search2=="BOOKABOUT"){ echo 'selected'; }?>>
                                                        เรื่อง
                                                    </option>
                                                    <option value="BOOKTO"
                                                        <?php if($Search2=="BOOKTO"){ echo 'selected'; }?>>
                                                        ส่งถึง</option>

                                                </select>
                                                <input name='Search' type='text' class='form-control' style='width:auto'
                                                    placeholder='ระบุข้อมูลการค้นหา ...' value='<?php echo $Search?>'
                                                    onFocus="this.value ='' ;">
                                                <button type='submit' class='btn btn-success' value='Search'><i
                                                        class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
                                            </div>
                                        </form>

                                        <?php
                                        $limit = '10';
                                                                                        $i=1;
                    
										if($strSearch=="Y"){
										$Qtotal = mysqli_query($conn,"select * from v_search_book Where ".$Search2." like '%".$Search."%'  ");
										}else{
										$Qtotal = mysqli_query($conn,"select * from v_search_book");
										}
										
										$total_data = mysqli_num_rows($Qtotal);
										$total_page= ceil($total_data/$limit);
										
										if($page>=$total_page) $page=$total_page;
										if($page<=0 or $page==''){
										$start = 0;
										$page=1;
										}
										
										$start=($page-1)*$limit;
										
										$from=$start+1;
										$to=$page*$limit;
										if($to>$total_data) $to=$total_data;
					?>
                                        <div class='alert alert-info' role='alert' style='font-weight:bold;'>
                                            <?php
												echo $from.' - '.$to;
												printf(' จาก %d  ',$total_data);
												printf(' | หน้า %d <br />',$page);
												?>
                                        </div>

                                        <table class='table table-bordered tablesorter'>
                                            <thead>
                                                <tr>
                                                    <td align="center"><strong>ลำดับ</strong></td>
                                                    <td align='center'><strong>เลขที่รับอัตโนมัติ </strong></td>
                                                    <td align='center'><strong>วันที่รับในระบบ </strong></td>
                                                    <td align='center'><strong>เลขที่หนังสือ</strong></td>
                                                    <td align='center'><strong>วันที่ในหนังสือ</strong></td>
                                                    <td align='center'><strong>ผู้ส่ง</strong></td>
                                                    <td align='center'><strong>เรื่อง</strong></td>
                                                    <td align='center'><strong>ส่งถึง</strong></td>
                                                    <td align='center'><strong>ปรับปรุง</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                   
														if($strSearch=="Y"){
                                                        $Query = mysqli_query($conn,
                                                        "SELECT CAST(AUTOID AS INT) AS D,AUTOID,CURRDATE,BOOKREC,BOOKDATE,BOOKABOUT,BOOKFROM,BOOKTO 
                                                        from v_search_book Where ".$Search2." like '".$Search."%' 
                                                            order by D LIMIT $start,$limit");
														}else{
                                                        $Query= mysqli_query($conn,
                                                        "SELECT CAST(AUTOID AS INT) AS D,AUTOID,CURRDATE,BOOKREC,BOOKDATE,BOOKABOUT,BOOKFROM,BOOKTO 
                                                        from v_search_book order by D LIMIT $start,$limit");
														}
														
														while($arr = mysqli_fetch_array($Query)){
														$autoid = $arr['AUTOID'];
														?>
                                                <tr valign='top'>
                                                    <td align="center"><?php $n=$i++; 
                                                          if(strlen($n)=='1'){echo '0000';echo $n;}
                                                          else if(strlen($n)=='2'){echo '000';echo $n;}
                                                          else if(strlen($n)=='3'){echo '00';echo $n;} 
                                                          else if(strlen($n)=='4'){echo '00';echo $n;}
                                                          else if(strlen($n)=='5'){echo '0';echo $n;}
                                                          else{echo $n;}?>
                                                    </td>
                                                    <td align='right'><?php echo $arr['AUTOID'] ?></td>
                                                    <td align='center'><?php echo $arr['CURRDATE'] ?></td>
                                                    <td><?php echo $arr['BOOKREC'] ?></td>
                                                    <td align='center'><?php echo $arr['BOOKDATE'] ?></td>
                                                    <td><?php echo $arr['BOOKFROM'] ?></td>
                                                    <td><?php echo $arr['BOOKABOUT'] ?></td>
                                                    <td align='center'><?php echo $arr['BOOKTO'] ?></td>
                                                    <td align="center">
                                                        <?php 
                                                    IF($rs_deb['DELETE_FLAG']==0){echo'<a href="#myModal_edit_book_in" data-toggle="modal" data-id="'.$arr['AUTOID'].'" class="btn btn-success btn-xs btn-grad">';}
                                                        ELSE{echo'<a href="#myModal_edit_book_in" data-toggle="modal" data-id="'.$arr['AUTOID'].'" class="btn btn-danger btn-xs btn-grad">';}
                                                    IF($arr['DELETE_FLAG']==0){echo '<i class="fa fa-thumbs-o-up"></i> : แก้ไข';}
                                                        ELSE{echo '<i class="fa fa-times"></i> : แก้ไข';}  
                                                        echo'</a>'; 
                                                    ?>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                        <nav>
                                            <ul class='pagination'>
                                                <li <?php if($page==1) echo "class='disabled' ";?>>
                                                    <a href='main_right_bookin_search.php?page=<?php echo $page-1?>&Search=<?php echo$Search?>&Search2=<?php echo $Search2?>&strSearch=<?php echo$strSearch?>'
                                                        aria-label='Previous'><span
                                                            aria-hidden='true'>&laquo;</span></a>
                                                </li>
                                                <?php for($i=1;$i<=$total_page;$i++){

																			if($page-2>=2 and ($i>2 and $i<$page-2)) {
																			echo "<li ><a href=''>...</a></li>";
																			$i=$page-2;
																			}
																			
																			if($page+5<=$total_page and ($i>=$page+3 and $i<=$total_page-2)) {
																			echo "<li ><a href='' >...</a></li>";
																			$i=$total_page-1;
																			}

															?>
                                                <li <?php if($page==$i) echo "class='active' ";?>><a
                                                        href='main_right_bookin_search.php?page=<?php echo $i?>&Search=<?php echo $Search?>&Search2=<?php echo $Search2?>&strSearch=<?php echo $strSearch?>'><?php echo $i?></a>
                                                </li>
                                                <?php }?>
                                                <li <?php if($page==$total_page) echo "class='disabled' ";?>><a href=''
                                                        main_right_bookin_search.php?page=<?php echo $page+1?>&Search=<?php echo $Search?>&Search2=<?php echo $Search2?>&strSearch=<?php echo $strSearch?>'
                                                        aria-label='Next'><span aria-hidden='true'>&raquo;</span></a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<!---MODAL EDIT USER -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_edit_book_in').on('show.bs.modal', function(e) {
        var oid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'main_right_bookin_edit01.php', //Here you will fetch records 
            data: {
                'oid_p': oid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_edit_book_in" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : แก้ไขข้อมูลทะเบียนหนังสือรับ (ภายนอก)
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

</html>