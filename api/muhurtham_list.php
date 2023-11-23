<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('Asia/Kolkata');

include_once('../includes/crud.php');
$db = new Database();
$db->connect();

$month = isset($_REQUEST['month']) ? $db->escapeString($_REQUEST['month']) : '';
$year = isset($_REQUEST['year']) ? $db->escapeString($_REQUEST['year']) : '';
$muhurtham_id = isset($_REQUEST['muhurtham_id']) ? $db->escapeString($_REQUEST['muhurtham_id']) : '';

// Validate year
if (!preg_match('/^\d{4}$/', $year)) {
    $response['success'] = false;
    $response['message'] = "Invalid year format";
    print_r(json_encode($response));
    return false;
}

// Convert month name to month number
$dateObj = DateTime::createFromFormat('F', $month);
if (!$dateObj) {
    $response['success'] = false;
    $response['message'] = "Invalid month name";
    print_r(json_encode($response));
    return false;
}

$month = $dateObj->format('m');

// Construct date range for the entire month
$start_date = $year . '-' . $month . '-01';
$end_date = date('Y-m-t', strtotime($start_date));

$sql = "SELECT * FROM `muhurtham_tab` WHERE muhurtham_id = '$muhurtham_id' AND date BETWEEN '$start_date' AND '$end_date'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    $rows = array();
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['muhurtham_id'] = $row['muhurtham_id'];
        $temp['date'] = $row['date'];
        $temp['title'] = $row['title'];
        $temp['description'] = $row['description'];
        $rows[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "Muhurtham Listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "Data Not Found";
    print_r(json_encode($response));
}
?>
