<?php 
// session_start();
?>

<!doctype html>
<html>

<head>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=K2D&display=swap');
    </style>
    <style>
    .body {
        font-family: "K2D", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    #navcolor {
        background-color: hsl(197, 93%, 29%);
    }

    #navlink a:link {
        color: #FFFFFF;
    }

    #navlink a:visited {
        color: #FFFFFF;
    }

    div.img-resize img {
        margin-top: 5px;
        margin-bottom: 5px;
        margin-left: -23px;
        width: 105px;
        height: 100px;
        float: left;
    }

    div.img-logo img {
        margin-top: 10px;
        margin-bottom: 5px;
        margin-right: -23px;
        width: 80px;
        height: 80px;
        float: right;
       border-radius:50%;
    }

    div.img-logistic img {
        margin-top: 15px;
        margin-bottom: 5px;
        margin-right: -23px;
        width: 120px;
        height: 80px;
        float: right;
        border-radius: 50%;
    }
    </style>
</head>
<?php
    include('main_script.php');
?>

<body style="font-family:K2D;font-size:18px;">
    <div class="container-fluid" id="navcolor">
        <div class="col-md-1">
            <div class="img-resize"><img src="img/logo.jpg" height="80"/></div>
        </div>
        <div class="col-md-10" id="text-head" style="color: white;  text-shadow: 1px 1px 2px blue, 0 0 25px white, 0 0 5px green; margin-top:14px;
                    font-weight:bold;font-size: 30px;">
            <strog>ระบบคืนแฟ้มผู้ป่วยใน กลุ่มงานเวชระเบียนและข้อมูลทางการแพทย์</strog>
            <p>
                <strong>โรงพยาบาลหาดใหญ่ : TRUSTED US, WE Can</strong>
            </p>
        </div>
        <div class="col-md-1">
            <a href="http://www.hatyaihospital.go.th">
                <div class="img-logo"><img src="img/hyh.png" /></div>
            </a>
        </div>
    </div>
    
    <nav class="navbar navbar-"style="background-color:#FFFDE7;">
        <ul class="nav navbar-nav"  style="font-size: 20px;">
            <li>
                <a href="sys_hycall_login_ward.php" style="font-size: 20px;"> 
                    <i class="fa fa-stack-overflow" aria-hidden="true"></i>
                    [Ward] คืนสรุปแฟ้ม
                </a>
            </li>

            <li>
                <a href="sys_hycall_login_static.php"  style="font-size: 20px;">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    สถิติรับแฟ้มและคืนแฟ้ม [PMK]
                </a>
            </li>

            <li>
                <a href="sys_hycall_login_coder.php"  style="font-size: 20px;">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    แฟ้ม Coder และ สแกน / รอสแกน
                </a>
            </li>
            
            <li>
                <a href="new_stati_return_card.php"  style="font-size: 20px;">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    แฟ้มรอสรุปภายในเวลา [5,7,10] วัน
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right"  >
            <li>
               <?php
                if(empty($user_name)) 
                {
                ?>
                <i class="fa fa-user-circle-o" aria-hidden="true" ></i> 
                <a class="text text-success">ผู้ใช้ระบบ : ทั่วไป </a>
            </li>
            <?php
            }else{
                ?>
            <i class="fa fa-user-circle-o" aria-hidden="true" ></i> ผู้ใช้ระบบ : <?php echo $user_name;?></a>
            </li>
            <?php
                }
                ?>
            <li>
            <li>
                <a href="logout.php"  style="font-size: 20px;">
                    <span class="glyphicon glyphicon-log-in"></span> Log-Out &nbsp;
                </a>
            </li>
        </ul>
    </nav>
</body>

</html>