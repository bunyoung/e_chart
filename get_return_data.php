<?php
// bconnect Database
require_once("db/connection.php");
?>

<?php
$fid = $_POST['fs'];   // department id
$sql = "SELECT * FROM fast_sick_a WHERE hyass=".$fid;
$result = mysqli_query($conn,$sql);
$users_arr = array();
while( $row = mysqli_fetch_array($result) ){
    $id = $row['fasts_id'];
    $name = $row['fasts_name'];

    $users_arr[] = array("fasts_id" => $id,
                         "fasts_name" => $name);
}
// encoding array to json format
echo json_encode($users_arr);