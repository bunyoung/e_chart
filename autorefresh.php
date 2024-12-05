<?php
$temp = file_get_contents('https://api.thingspeak.com/channels/2677297/feeds.json?api_key=SJ1SPMIYMYS93Y39&results=2');
echo  substr($temp,0,-3);
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Monitor</title>
</head>
<style type="text/css">
html {
    /* background-image: url('icon/bg.jpg'); */
    background-repeat: no-repeat;
    background-position: center center;
    background-attachment: fixed;
    -o-background-size: 100% 100%, auto;
    -moz-background-size: 100% 100%, auto;
    -webkit-background-size: 100% 100%, auto;
    background-size: 100% 100%, auto;
}
</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#usersa').load('user_sa.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {

        $('#userkas').load('user_kas.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {

        $('#usertip').load('user_tip.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#userdpro').load('user_dpro.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {

        $('#tempoutsite').load('temp_outsite.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#data_sa').load('datasa.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#temp_sa').load('tempsa.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#humi_sa').load('humisa.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#temp_kas').load('tempkas.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#humi_kas').load('humikas.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#data_kas').load('datakas.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#data_tip').load('datatip.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<script type="text/javascript">
var auto_refresh = setInterval(
    function() {
        $('#data_dpro').load('datadpro.php').fadeIn("slow");
    }, 200); // refresh every 10000 milliseconds
</script>

<body>

    <h1 align="center">
        <font color="blue"></font>
    </h1> <br>
    <table width="100%" border="0" align="center">
        <tr>
            <th width="91">
                <div align="center">ID </div>
            </th>
            <th width="110">
                <div align="center">TEMP </div>
            </th>
            <th width="110">
                <div align="center">Humidity </div>
            </th>
            <th width="110">
                <div align="center">DATE </div>
            </th>

            <td align="center" width="200" height="200"></td>
            <td align="center"><img src="icon/temp.PNG" /></td>
            <td align="center" width="100" height="200"></td>
            <td align="center"><img src="icon/sn.PNG" /></td>
            <!-- /*
            <td align="center" width="100" height="200"></td>
            <td align="center"><img src="icon/bandwidth.PNG" /></td>
            <td align="center" width="100" height="200"></td>
            <td align="center"><img src="icon/users.PNG" /></td>
            */ -->
        </tr>



        <tr>
            <td align="center" width="200" height="100">
                <font size="76" color="#088A29">ayuthaya</font>
            </td>
            <td align="center">
                <font size="80" color="green">
                    <div id="temp_sa"></div>
                </font>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="humi_sa"></div>
                </font>
            </td>
            <td align="center" width="100" height="100"></td>
            
            <td align="center">
                <font size="80" color="green">
                    <div id="data_sa"></div>
                </font>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="usersa"></div>
                </font>
            </td>
        </tr>
        
        <tr>
            <td align="center" width="200" height="100">
                <font size="76" color="#088A29">korat</font>
            </td>
            <td align="center">
                <font size="80" color="green">
                    <div id="temp_kas"></div>
                </font>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="humi_kas"></div>
                </font>
            </td>
            
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="data_kas"></div>
                </font>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="userkas"></div>
                </font>
            </td>
            
        </tr>

        <tr>
            <td align="center" width="200" height="100">
                <font size="76" color="#088A29">trad</font>
            </td>
            <td align="center"><img src="icon/smile2.PNG" /></td>
            <td align="center" width="100" height="100"></td>
            <td align="center"><img src="icon/smile2.PNG" /></td>
            <td align="center" width="100" height="100"></td>
    
            <td align="center">
                <font size="80" color="green">
                    <div id="data_tip"></div>
                </font>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="usertip"></div>
                </font>
            </td>
          </tr>
        <tr>
            <td align="center" width="200" height="100">
                <font size="76" color="#088A29">sukothai</font>
            </td>
            <td align="center"><img src="icon/smile2.PNG" /></td>
            <td align="center" width="100" height="100"></td>
            <td align="center"><img src="icon/smile2.PNG" /></td>
   
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="data_dprot"></div>
                </font>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <font size="80" color="green">
                    <div id="userdpro"></div>
                </font>
            </td>

        </tr>

        <tr>
            <td align="center" width="200" height="100">
                <font size="80" color="#F2F5A9"></font>
            </td>
            <td align="center">
                <h1>
                    <font color="#B40404">
                        <div id="tempoutsite"></div>
                    </font>
                </h1>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <h1>
                    <font color="#B40404">ความชื้น</font>
                </h1>
            </td>
            <td align="center" width="100" height="100"></td>
       
            <td align="center">
                <h1>
                    <font color="#B40404">อินเทอร์เน็ต</font>
                </h1>
            </td>
            <td align="center" width="100" height="100"></td>
            <td align="center">
                <h1>
                    <font color="#B40404">ผู้ใช้งาน</font>
                </h1>
            </td>
 
        </tr>

    </table>



</body>

</html>