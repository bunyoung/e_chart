<?php
include('./db/connection.php');
?>
<?php
// include('main_script_loading_sys.php');
?>
<?php
$pno='0';
$q_promt="SELECT rf_id,rf_idcard,rf_patients,hossendto_name,rf_hn,send_promt 
                    FROM v_approve_success 
                    WHERE send_promt = '$pno' ";
$sprmt=mysqli_query($conn,$q_promt);
$myrow=mysqli_num_rows($sprmt);
if($myrow > '0' ) {
    while($rsw=mysqli_fetch_array($sprmt))
    {
        $rfid=$rsw['rf_id'];

        $cid=$rsw['rf_idcard'];
        $uri='http://192.168.99.17/e_nrefer/print_refer_out02.php?id='.$rfid;
        $flname=$rsw['rf_patients'];
        $hn=$rsw['rf_hn'];
        $hospital_to = $rsw['hossendto_name'];

        $endpoint_url = 'http://192.168.4.234:9222/Moph-promt/get-refer-noti.php';
        $data_to_post = [
            'cid'               => $cid,
            'uri'                => $uri,
            'flname'        => $flname,
            'hn'                => $hn,
            'hospital_to' => $hospital_to
        ];
          $options = [
              CURLOPT_URL       => $endpoint_url,  
              CURLOPT_POST     => true,
              CURLOPT_POSTFIELDS => $data_to_post,
          ];
    
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt_array($curl, $options);
          $results = curl_exec($curl);
          curl_close($curl);
        //   echo  $results;
    }
    $sqlup="UPDATE rf_detail set send_promt='1' WHERE rf_id = $rfid ";
    $rsuc=mysqli_query($conn,$sqlup);
}
?>