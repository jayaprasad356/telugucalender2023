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

if (empty($_POST['month']) || empty($_POST['year'])) {
    $response['success'] = false;
    $response['message'] = "Month or Year is Empty";
    print_r(json_encode($response));
    return false;
}

$monthName = $db->escapeString($_POST['month']);
$year = $db->escapeString($_POST['year']);

// Validate year
if (!preg_match('/^\d{4}$/', $year)) {
    $response['success'] = false;
    $response['message'] = "Invalid year format";
    print_r(json_encode($response));
    return false;
}

$start_date = date('Y-m-01', strtotime("$year-$monthName"));
$end_date = date('Y-m-t', strtotime($start_date));

$sql = "SELECT * FROM `festivals` WHERE date BETWEEN '$start_date' AND '$end_date'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    $rows = array();
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['date'] = $row['date'];
        $temp['festival'] = $row['festival'];
        $rows[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "Festivals Listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "Data Not Found";
    print_r(json_encode($response));
}
?>
