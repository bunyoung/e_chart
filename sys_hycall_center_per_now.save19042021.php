   <?php
   $date_curr_dm_defult=date('d/m/') ;
   $date_curr_y_defult=date('Y')+543 ;
   $date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
   $d_default=$date_curr_dmy_defult; 
   ?>

   <!doctype html>
   <html>

   <head>
       <meta http-equiv="refresh" content="6000;" />
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
           background-color: #87eebb;
           color: white;
       }
       .btn-blue {
           background-color: #0000FF;
           color: white;
       }

       .btn-orericu {
           background-color: #8B008B;
           color: white;
       }

       .btn-noorericu {
           background-color: #f3fafa;
           color: while;
       }
       .btn-SkyBlue1 {
           background-color: #91cfc9;
           color: black;
       }
      .btn-Mega {
           background-color: ##FF0033;
           color: black;
       }
       }
       </style>
   </head>
   <?php
       $rw='0';
       $rr='0';
       $rf='0';
       $rt='0';
       $s1="SELECT COUNT(*) as wtotal,hdate AS hdate  FROM v_monitor WHERE x1='W' GROUP BY hdate ORDER BY hdate";
       $result = mysqli_query( $conn,$s1);
       while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
       {
           $rw= $row["wtotal"];
       }
       $s2="SELECT COUNT(*) as rtotal,hdate AS hdate  FROM v_monitor WHERE x1='R' GROUP BY hdate ORDER BY hdate";
       $result1 = mysqli_query( $conn,$s2);
       while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC))
       {
           $rr= $row1["rtotal"];
       }
       $s3="SELECT COUNT(*) as ftotal,hdate AS hdate  FROM v_monitor WHERE x1='E' GROUP BY hdate ORDER BY hdate";
       $result2 = mysqli_query( $conn,$s3);
       while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC))
       {
           $rf= $row2["ftotal"];
       }

       $s4="SELECT COUNT(*) as ftotal,hdate AS hdate  FROM v_monitor WHERE hdate = '$d_default' GROUP BY hdate ORDER BY hdate";
       $result3 = mysqli_query( $conn,$s4);
       while($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
       {
           $rt= $row3["ftotal"];
       }
       ?>

   <body>
       <p>
       <div class="container-fluid">
           <div class="panel-group">
               <div class="panel panel-info">
                   <div class="panel-heading">
                       <i class='fa fa-wheelchair fa-1x yellow-color'></i><strong>ผู้ป่วยที่ รอรับบริการศูนย์เปล
                           ประจำวันที่ </strong>
                       <?php Echo $d_end .'  เวลา : '.date("H:i:s"); ?>
                       <!-- </a> -->
                       <button type="button" class="btn btn-SkyBlue1">
                           รวม :<span class="badge badge-light"><?php echo $rt ;?> &nbsp;คน</span>
                       </button>
                       <button type="button" class="btn btn-SkyBlue1">
                           ร้องขอ :<span class="badge badge-light"><?php echo $rw ;?> &nbsp;คน</span>
                       </button>
                       <button type="button" class="btn btn-SkyBlue1">
                           รอรับ :<span class="badge badge-primary"><?php echo $rr ;?> &nbsp;คน</span>
                       </button>
                       <button type="button" class="btn btn-SkyBlue1">
                           รอปิดงาน :<span class="badge badge-light"><?php echo $rf ;?> &nbsp;คน</span>
                       </button>
                   </div>
                   <p>
                   <table id="vfdataTable" class="cell-border compact stripe" style="width:100%">
                       <!-- <table id="vfdataTable" class="table-bordered table-sm table-condensed" style="width:100%"> -->
                       <thead>
                           <tr>
                               <td align='center'><strong>ลำดับ</strong></td>
                               <td align='center'><strong>เลขที่อ้างอิง</strong></td>
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
                           <tr>
                               <td>
                                   <center>
                                       <?php    
                                            $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else if(strlen($n)=='3'){echo '0';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}
                                        ?>
                                   </center>
                               </td>
                               <td>
                                   <?php
                           IF($arr['typeplace']=="1") {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                              class="btn btn-orericu btn-grad DISABLED">';
                          }
                          IF($arr['typeplace']=="2") {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-danger btn-grad DISABLED">';
                           }
                           if($arr['typeplace']=='3') {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-Mega btn-grad DISABLED">';
                           }
                           IF($arr['typeplace']=="0") {
                              echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                              class="btn btn-noorericu btn-grad DISABLED">';
                            }
                            echo '<i></i>'.$arr['hyitem'];
                            echo'</a>'; 
                           ?>
                               </td>
                               <td><?php echo $arr['hn']; ?> </td>
                               <td><?php echo $arr['patients']; ?></td>
                               <td><?php echo $arr['fplace'] ; ?></td>
                               <td><?php echo $arr['tplace']; ?></td>
                               <td><?php echo $arr['hassnamea']?></td>
                               <td><?php echo $arr['hassnameb']?></td>
                               <td><?php echo $arr['assname']?></td>
                               <td>
                                   <?php
                            IF($arr['pers']==""){
                                echo'<a href="#" data-toggle="modal"
                                data-id="'.$arr['hyitem'].'"
                                class="btn btn-success btn-grad DISABLED">'; 
                                echo '<i class="fa fa-bell-slash" style="color:mega"></i> ';}
                            ELSE {
                              echo'<a href="#myModal_change_person" data-toggle="modal"
                              data-id="'.$arr['hyitem'].'"
                              class="btn btn-success btn-grad">';
                            }
                            if($arr['pers']<>""){
                              echo '<i></i>  '.$arr['name'];
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
                           IF($arr['fasts_color']= 'B') {
                            echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                            class="btn btn-blue btn-grad DISABLED">';
                           }
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
                          echo '<i></i> '.$arr['fasts_name'];
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