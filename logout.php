<?php    
	if(!isset($_SESSION)) {  session_start();  }
#update logout	
	require_once("db/connection.php");
	$session=@$_SESSION['sess_userid'];
	$session_log_time=@$_SESSION['sess_log_time'];
	
	$timezone = "Asia/Bangkok";	
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$thistime = date("Y-m-d H:i:s");
	
	$sql2 = "update sys_log_login 
			set logout='Logout',
				logout_time='$thistime'
			WHERE session='$session' and log_time='$session_log_time' " ;
	$result2 = mysqli_query($conn,$sql2);
	session_destroy();
#KILL Session
		unset($_SESSION['user_name']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_idx']);

		echo "<meta http-equiv=\"refresh\" content=\"0;URL=dashboard.php\">";
		exit(); 
	
?>