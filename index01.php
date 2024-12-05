<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Custom Navbar Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div id="top">
    <nav class="navbar navbar-expand-lg navbar-inverse bg-success">
        <div class="container-fluid">
            <header class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img id="medlogo" src="img/hy.png" height="50px" alt"Brighter Solutions Logo" />

            </header>

            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="sys_hycall_center_now.php"><i class="fa fa-fw fa-bell-o"></i>เรียกเปล </a></li>
                    <li><a href="sys_hycall_center_return.php">ส่งกลับ<span class="sr-only"></span></a></li>
                    <li><a href="sys_hycall_center_view.php">มอนิเตอร์<span class="sr-only"></span></a></li>
                    <li><a href="sys_hycall_person_login.php">จนท.เปล<span class="sr-only"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ตั้งค่าระบบ <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><i class="fa fa-adjust"></i> รายชื่อเจ้าหน้าที่ศูนย์เปล</a></li>
                            <li><a href="#"><i class="fa fa-info-circle"></i>ประเภทคนไข้</a></li>
                            <li><a href="#"><i class="fa fa-inbox"></i>ประเภทอุปกรณ์</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
</body>
</html>