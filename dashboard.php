<!doctype html>
<?php
	if(!isset($_SESSION)) {  session_start();  }
		unset($_SESSION['user_name']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_idx']);
?>
<?php
require_once("db/connection.php");
require_once("db/date_format.php");
?>
<html class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-charge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style-font.css">
</head>
<?php
    include ("main_script_loading.php");
    include ("main_script.php");
?>

<body class="bai-jamjuree-semibold ">
    <?php
    include("main_top_panel_head.php");
    ?>
    <div class="container" style="margin-top:0px">
        <div class="col-md-2 col-md-offset-7">
            <div><img src="img/logo.jpg" style="width:500px;height:400px;border:0px;float:left;margin-top:25px;" />
            </div>
        </div>
        <div class="col-md-2 col-md-offset-5">
            <div>
                <!-- <img src="img/poster.jpg" style="width:500px;height:auto;border:0px;margin-top:15px;" /> -->
            </div>
        </div>
    </div>
</body>

</html>