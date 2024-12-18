<?php
include('db/connection.php');
?>
<div class="row">
    <div class="col-md-12" style="font-family: 'sarabun'; margin-top:0px;color:black">
        <table id="adataTable" class="display dataTable table-sm" role="grid"
            style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll; max-width: 100%; white-space: word-wrap: break-word;width:100%;" cellspacing="0">
            <thead style="background-color:#005F86;color:#B6CFD0;font-family:sarabun;font-size:18px;">
                <tr align="center">
                    <td>#</td>
                    <td>ลำดับ</td>
                    <?php
                    if($did==null) 
                    {
                        echo '<td>Ref No.</td>';
                    }
                    ?>
                    <td>วันที่</td>
                    <td>เวลา</td>
                    <!-- <td>ประเภทส่งต่อ</td> -->
                    <!-- <td>ประเภทสถานพยาบาล</td> -->
                    <td>HN</td>
                    <td>ชื่อ - สกุล</td>
                    <td>เพศ</td>
                    <td>
                        <center>อายุ (ปี)</center>
                    </td>
                    <td>สถานพยาบาลปลายทาง</td>
                    <td>แพทย์<br>ผู้ส่งต่อ</td>
                    <td>กลุ่มงานที่ส่งต่อ</td>
                    <td style="background-color:#6200EA;color:#ffff;">
                        <center>Approve <br>Refer</center>
                    </td>
                </tr>
            </thead>
            <tbody style="font-family:sarabun;font-size:18px;">
                <?php
                    $i=0;
					$sql="
                    SELECT 
					* 
					FROM v_rf_detail 
					WHERE rf_hospital='$hcode' AND
								m_doctor IN ('$did' ,'$f_code') AND 
                                rfgroup='2' AND rf_status <> '5' AND rf_conf_doctor_id='0'
					Order by rf_id DESC";
				$query=mysqli_query($conn,$sql);
				$i=1;
				while($rs=mysqli_fetch_array($query)) {
					$year=substr($rs["rf_birthdate"],6,4);
					$month=substr($rs["rf_birthdate"],3,2);
					$date=substr($rs["rf_birthdate"],0,2);
					$day=$year."-".$month."-".$date;
					$date = date("Y-m-d");
					$age=($date - $day);
					$rfhn=$rs['rf_hn'];
					$rfpatients=$rs['rf_patients'];
					$rfno=$rs['rf_id'];
            
                    //     Field = rf_status
                    //    0. รออนมัติ
                    //     1. อนุมัติโดยหัวหน้าแผนก
                    //     2.อนุมัติ Auto
                    //     3.ออกเลข Refer 
                    //     4.ตอบรับ Refer 
                    //     5.เตรียมการส่งผู้ป่วย 
                            
                    ?>
                <?php
                    $st='';
                    $fq='';
                    if($rs['rf_status']=='0' || $rs['rf_status']=='' && $did <> null){
                       $st="style=background-color:#FFEBEE;color:#E53935;";
                    }
                    ?>

                <tr <?php echo $st;?>>
                    <td style="color:#F3E5F5;background-color:#BA68C8;">
                        <center>
                            <?php
                            if($rs['hosp_recive_status']=='Y' && $rs['rf_status']<>'5')  
                            {
                                if($rs['hosp_recive_rem']=='1') {
                                    echo '<i class="fa fa-ambulance fa-lg" aria-hidden="true" style="color:#0B5345;"></i>';
                                }else{
                                    echo '<i class="fa fa-ambulance fa-lg" aria-hidden="true" style="color:#82E0AA;"></i>';
                                }
                            }
                            if($rs['rf_status']=='0')  
                            {
                                echo '<i class="fa fa-spinner fa-spin"></i>';
                            }
                            ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php  $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                        </center>
                    </td>
                    <?php
                        if($did==null) {
                        ?>
                    <td>
                        <?php echo $rs['rf_no_refer']; ?>
                    </td>
                    <?php
                        }
                        ?>
                    <td><?php echo $rs['rf_date']; ?></td>
                    <td><?php echo $rs['rf_time'];?> </td>
                    <!-- <td>
                        <center>
                            <?php echo $rs['namehostype']; ?>
                        </center>
                    </td> -->

                    <td><?php echo $rs['rf_hn']; ?></td>
                    <td><?php echo $rfpatients; ?></td>
                    <td>
                        <center><?php echo $rs['rf_sex']; ?></center>
                    </td>
                    <td>
                        <center><?php echo $age; ?></center>
                    </td>
                    <td>
                        <?php echo $rs['hossendto_name']; ?>
                    </td>
                    <td><?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                    <td><?php echo $rs['m_depname']; ?></td>
                    <!-- // กรณีที่ไม่ผ่่านการ Login มาจากแพทย์ -->
                    <td>
                        <center>
                            <?php
                                if($rs['rf_status']=='0' )
                                {
                                echo'
                                    <a href="#myModal_approve_confirm_refer" data-toggle="modal" data-id="'.$rs['rf_id'].'" 
                                        class="btn btn-"
                                                style="background-color:#30261c;color:#FFEBEE;font-weight:bold;font-size:16px">
                                        Pending Approval
                                    </a>';
                                }
                             ?>
                        </center>
                    </td>
                </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!---MODAL -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_confirm_refer').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_monitor_confirm.php', //Here you will fetch records 
            data: {
                'rid_p': rid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_approve_confirm_refer" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : ขออนุมัติ Refer Out
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>