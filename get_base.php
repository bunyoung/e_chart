<?php
// Database connection
include('./db/connection.php');

// Read DataTables parameters sent by AJAX
$draw = intval($_POST['draw']);
$start = intval($_POST['start']);
$length = intval($_POST['length']);
$searchValue = $_POST['search']['value'];

// Total records count
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM e_charge";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Records with search filter
$filterQuery = "SELECT COUNT(*) AS total FROM e_charge WHERE ch_name LIKE '%$searchValue%' OR ch_surname LIKE '%$searchValue%'";
$filterResult = $conn->query($filterQuery);
$filteredRecords = $filterResult->fetch_assoc()['total'];

// Fetch paginated data
$dataQuery = "SELECT ch_id, ch_prename, ch_name, ch_surname
              FROM e_charge 
              WHERE ch_name LIKE '%$searchValue%' OR ch_surname LIKE '%$searchValue%'
              ORDER BY id ASC
              LIMIT $start, $length";

$dataResult = $conn->query($dataQuery);

$data = array();
while ($row = $dataResult->fetch_assoc()) {
    $data[] = $row;
}

// Return JSON response
$response = array(
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $filteredRecords,
    "data" => $data
);

echo json_encode($response);

$conn->close();
?>
