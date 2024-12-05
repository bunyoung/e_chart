<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-hycenter</title>
</head>
<?php
#write number
$page = basename($_SERVER['PHP_SELF']);
if (file_exists('_couter/' . $page . '.txt')) {
    $fil = fopen('_couter/' . $page . '.txt', "r");
    $dat = fread($fil, filesize('_couter/' . $page . '.txt'));
#echo $dat+1;
    fclose($fil);
    $fil = fopen('_couter/' . $page . '.txt', "w");
    fwrite($fil, $dat + 1);
} else {
    $fil = fopen('_couter/' . $page . '.txt', "w");
    fwrite($fil, 1);
#echo '1';
    fclose($fil);
}
#read number	
$myFile = "_couter/" . $page . ".txt";
$lines = file($myFile); //file in to an array
$count = $lines[0]; //line 2
?>

<body>
    <div id="content3">
        <div class="inner bg-light lter">
            <div class="container">
                <div class="panel-heading">
                    <i class="fa fa-commenting-o" aria-hidden="true"></i>
                    <strong>ระบบที่ได้ปรับปรุงเปลี่ยนแปลง</strong>
                </div>
                <!-- <hr> -->
                <ul>
                    <h5><strong>การเปลี่ยนแปลงระบบ</strong></h5>
                    <li>
                        <strong>การร้องขอ</strong>
                    </li>
                    <img src="img/news.png" width="18" height="18" alt="Android Messages" title="Android Messages" data-mime-type="image/png" data-alt-src="//lh3.googleusercontent.com/yqlXCbbfACQ3_KQQGizDOuXqsT_UigZSOS5Brr7ZVN6DtxU78EFKY65G8hNZIlUmfgA">
                    การร้องขอ ให้ระบุตัวบุคคลในการขอด้วย
                    <br>
                    <li>
                        <strong>ระบบการส่งคนไข้ซ้ำ</strong>
                    </li>
                    สามารถส่งซ้ำ ไปที่ส่งครั้งแรกได้มากกว่า 1 ครั้ง
                    <br>
                    <li>
                        <strong>ระบบใหม่</strong>
                        <?php
                                echo '<a href="http://192.168.99.15/e_logistic"><strong> ระบบโลจิสติกส์ </strong></a> 
                                <strong> คลิกเลย </strong>';
                            ?>
                    </li>
                    ไม่สะดวกต่อการใช้งาน โทร 2703,5432
                </ul>
            </div>
            <hr>
            <span class="help-block" style="color:#a9b0aa; font-size: 12px;">
                <i class="fa fa-hand-o-right "></i>
                การเข้าใช้บริการหน้านี้
                <?php echo $count;?> ครั้ง
            </span>
            <!--เลื่อนขึ้นบน -->
            <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                <i class="fa fa-angle-double-up">
                </i> ขึ้นข้างบน
            </a>
            <!-- </div> -->
        </div>

    </div>
</body>

</html>