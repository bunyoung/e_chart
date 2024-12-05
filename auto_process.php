<?php
// Simulate a long-running process
header('Content-Type: application/json');
header('Cache-Control: no-cache');
header('X-Accel-Buffering: no'); // Disable buffering for better real-time progress

$totalSteps = 10; // Number of steps in the process

// Initialize response
$response = [];

for ($i = 1; $i <= $totalSteps; $i++) {
    // Simulate processing time
    usleep(500000); // 0.5 seconds delay per step

    // Append progress to response
    $response['progress'] = ($i / $totalSteps) * 100;
    echo json_encode($response);
    ob_flush();
    flush();
}

// Send final response
$response['success'] = true;
echo json_encode($response);
