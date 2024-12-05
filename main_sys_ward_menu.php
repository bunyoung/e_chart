<nav class="navbar navbar-default">
        <ul class="nav navbar-nav"  style="font-size: 20px;">
            <li>
                <a href="sys_hycall_center_now.php" style="font-size: 20px;font-color:hsl(71, 100%, 87%);"> 
                    <i class="fa fa-stack-overflow" aria-hidden="true"></i>
                    คืนสรุป Charge
                </a>
            </li>

            <li>
                <a href="sys_hycall_center_stati.php"  style="font-size: 20px;font-color:hsl(71, 100%, 87%);">
                    <i class="fa fa-building-o" aria-hidden="true"></i>
                    สถิติรับ Charge คืน
                </a>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right"  >
            <li>
                <a href="#"  style="font-size: 20px;">
                    <?php
                if(empty($user_name)) {
                    ?>
                    <i class="fa fa-user-circle-o" aria-hidden="true" ></i> ผู้ใช้ระบบ : ทั่วไป </a>
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
