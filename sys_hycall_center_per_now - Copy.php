   <!doctype html>
   <html>

   <head>
       <meta http-equiv="refresh" content="60;" />
       <style>
       .btn-red {
           background-color: #ff0000;
           color: white;
       }

       .btn-orange {
           background-color: #ff8c00;
           color: white;
       }

       .btn-yellow {
           background-color: #FFFF00;
           color: black;
       }

       .btn-green {
           background-color: #00ff00;
           color: white;
       }

       .btn-skyblue {
           background-color: #87eeb;
           color: white;
       }

       }
       </style>
   </head>

   <body>
       <p>
       <div class="container-fluid">
           <div class="panel-group">
               <div class="panel panel-info">
                   <div class="panel-heading">
                       <i class='fa fa-wheelchair fa-1x'></i> ผู้ป่วยที่ รอรับบริการศูนย์เปล ประจำวันที่
                       <?php Echo $d_end .'  เวลา : '.date("H:i:s"); ?>
                   </div>
                   <p>
                   <table id="vfdataTable" class="cell-border compact stripe" style="width:100%">
                       <!-- <table id="vfdataTable" class="table-bordered table-sm table-condensed" style="width:100%"> -->
                       <thead>
                           <tr>
                               <td><strong>HN</strong></td>
                               <td><strong>ชื่อ-สกุล </strong></td>
                               <td><strong>รับจาก </strong></td>
                               <td><strong>ไปส่งที่</strong></td>
                               <td><strong>อุปกรณ์ที่มี</strong></td>
                               <td><strong>เพิ่ม</strong></td=>
                               <td><strong>ผป</strong></td=>
                               <td><strong>เปล</strong></td>
                               <td><strong>สถานะ</strong></td>
                               <td><strong>ร้องขอ</strong></td>
                               <td><strong>ทราบ</strong></td>
                               <td><strong>รับ ผป</strong></td>
                               <td align='center'><strong>ยืนยัน</strong></td>
                               <td align='center'><strong>ยกเลิก</strong></td>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
require_once("db/connection.php");
require_once("db/date_format.php");

#SQL
$sql ="SELECT * FROM v_monitor WHERE x1 not in ('F','X','C') ORDER BY hyass";
$result_sql = mysqli_query( $conn,$sql);
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                           <tr valign='top'>
                               <td><?php echo $arr['hn']; ?> </td>
                               <td><?php echo $arr['patients'] ?></td>
                               <td><?php echo $arr['fplace'] ?></td>
                               <td><?php echo $arr['tplace'] ?></td>
                               <td><?php echo $arr['hassnamea']?></td>
                               <td><?php echo $arr['hassnameb']?></td>
                               <td><?php echo $arr['assname']?></td>
                               <td>
                                   <?php
                            IF($arr['pers']==""){
                              echo '<i class="fa fa-bell-slash" style="color:red"></i> ';}
                            ELSE {
                              echo'<a href="#myModal_change_person" data-toggle="modal"
                              data-id="'.$arr['hyitem'].'"
                              class="btn btn-success btn-grad">';
                            }
                            if($arr['pers']<>""){
                              echo '<i class="fa fa-user"></i>  '.$arr['name'];
                              echo'</a>';
                            };
                            ?>
                               </td>

                               <td>
                                   <?php
                          IF($arr['fasts_color']=="R") {
                             echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                   class="btn btn-red btn-grad DISABLED">';
                          }
                          else
                              // กรณีที่มอบหมายงานไปแล้ว
                          IF($arr['fasts_color']=="O"){
                            echo'<a href="#" data-toggle="modal"
                                 data-id="'.$arr['hyitem'].'"
                                 class="btn btn-orange btn-grad DISABLED">';
                          }
                          else
                          // จบภาระกิจ
                          if($arr['fasts_color']=='Y'){
                             echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                  class="btn btn-yellow btn-grad DISABLED">';
                          }else
                          // กรณีที่มีการร้องขอ
                          IF($arr['fasts_color']=='G'){
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                 class="btn btn-green btn-grad DISABLED">';
                          }else
                          IF($arr['fasts_color']<> 'R') {
                            if($arr['fasts_color']<>'Y'){
                              if($arr['fasts_color']<>'G'){
                                if($arr['fasts_color']<>'B'){
                                  echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                     class="btn btn-skyblue btn-grad DISABLED">';
                                    }
                                }
                              }
                            }
                          {
                          }
                          echo '<i class="fa fa-wheelchair-alt" aria-hidden="true"></i> '.$arr['fasts_name'];
                          echo'</a>';
                          ?>
                               </td>

                               <td><?php echo $arr['htime']; ?></td>
                               <td><?php echo $arr['x1_pertime'] ?></td>
                               <td><?php echo $arr['perto'] ?></td>
                               <td align="center">
                                   <?php
                                /*
                                X1=’W’ = ระหว่างดำเนินการ  modal: myModal_receive_wait
                                                           program : sys_hycall_center_wait.php
                                X1=’R’ = เปลรับเรื่อง
                                X1=’E’ = จนท 0 เปล ดำเนินการ
                                X1=’F’ = จบงานให้ Update สถานะเจ้าหน้าที่เป็น พร้อม
                                */
                                IF($arr['x1']=="W") {
                                    echo'<a href="#myModal_receive_wait" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                         class="btn btn-info btn-grad">';
                                }
                                else
                                // กรณีที่มอบหมายงานไปแล้ว
                                IF($arr['x1']=="R"){
                                  echo'<a href="#myModal_receive_finish" data-toggle="modal"
                                        data-id="'.$arr['hyitem'].'"
                                        class="btn btn-warning btn-grad">';
                                }
                                else
                                // จบภาระกิจ
                                if($arr['x1']=='E')
                                {
                                    echo'<a href="#myModal_receive_end" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                         class="btn btn-danger btn-grad">';
                                }
                                // กรณีที่มีการร้องขอ
                                IF($arr['x1']=='W')
                                {
                                    echo '<i class="fa fa-plus-square"></i>  จ่ายงาน';
                                }
                                else

                                // กรณีที่มอบหมายงานไปแล้ว
                                if($arr['x1']=='R')
                                {
                                    echo '<i class="fa fa-plus-square"></i>  รับงาน';
                                }

                                // กรณีที่จบงาน
                                if($arr['x1']=='E')
                                {
                                    echo '<i class="fa fa-plus-square"></i>  ปิดงาน ';
                                    echo'</a>';
                                }
                                ?>
                               </td>
                               <td align="center">
                                   <!-- รายการที่จะทำการยกเลิก -->
                                   <?php
                          IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) {
                            echo'<a href="#myModal_receive_cancel" data-toggle="modal"
                                 data-id="'.$arr['hyitem'].'" class="btn btn-danger btn-grad">';}
                          IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) {
                            echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                            echo'</a>';
                          }
                          ?>
                               </td>
                           </tr>
                           <?php
                    }
                    ?>
                       </tbody>
                   </table>
               </div>
           </div>

           <script type="text/javascript">
           function getRefresh() {
               $("#auto").show("slow");
               $("#autoRefresh").load("sys_hycall_center_per_now.php", '', callback);
           }

           function callback() {
               $("#autoRefresh").fadeIn("slow");
               setTimeout("getRefresh();", 1500);
           }
           $(document).ready(getRefresh);
           </script>
       </div>
   </body>

   </html>