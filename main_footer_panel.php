<!-- <div>
  <p>
</div> -->
<footer class="Footer">
    <p>2021 &copy; E-charge : Bunyoung thongsrijain | WEB APP Version :
        <a href="#modal_www_v" type="button" data-toggle="modal" data-id="modal_www_v">
            <i class="fa fa-wordpress">
            </i>
            <?php echo $www_version;?>
        </a> | DATABASE Version :
        <a href="#modal_db_v" type="button" data-toggle="modal" data-id="modal_db_v">
            <i class="fa fa-database">
            </i>
            <?php echo $db_version;?>
        </a>
    </p>
</footer>
<!-- /#footer -->

<div id="modal_www_v" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title text-success">
                    <i class="fa fa-wordpress">
                    </i> WEB APP Version :
                    <?php echo $www_version;?>
                </h4>
            </div>
            <div class="modal-body text-danger">
                <div id="collapse4" class="body">
                    <table id="dataTable3" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Version
                                </th>
                                <th>รายละเอียด
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
$sqliwww ="SELECT version,detail from sys_eclaim_report_version where type='www' ORDER BY date_version DESC";	
$result_iwww = mysqli_query($conn,$sqliwww);
while($rs_www=mysqli_fetch_array($result_iwww)) 
{
?>
                            <tr>
                                <td>
                                    <?php echo $rs_www['version']; ?>
                                </td>
                                <td>
                                    <?php echo $rs_www['detail'] ; ?>
                                </td>
                            </tr>
                            <?php         
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="modal_db_v" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title text-success">
                    <i class="fa fa-database">
                    </i> Database Version :
                    <?php echo $db_version;?>
                </h4>
            </div>

            <div class="modal-body text-danger">
                <div id="collapse4" class="body">
                    <table id="dataTable2" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Version
                                </th>
                                <th>รายละเอียด
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
$sqliwww ="SELECT version,detail from sys_eclaim_report_version where type='db' or  type='sql_restore' ORDER BY date_version DESC";	
$result_iwww = mysqli_query($conn,$sqliwww);
while($rs_www=mysqli_fetch_array($result_iwww)) 
{
?>
                            <tr>
                                <td>
                                    <?php echo $rs_www['version']; ?>
                                </td>
                                <td>
                                    <?php echo $rs_www['detail'] ; ?>
                                </td>
                            </tr>
                            <?php         
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal 
<!-- /#helpModal -->