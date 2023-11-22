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

if (empty($_POST['date'])) {
    $response['success'] = false;
    $response['message'] = "Date is Empty";
    print_r(json_encode($response));
    return false;
}

$date_input = $db->escapeString($_POST['date']);
$date_obj = DateTime::createFromFormat('d-m-Y', $date_input);

if (!$date_obj) {
    $date_obj = DateTime::createFromFormat('Y-m-d', $date_input);
}

if (!$date_obj) {
    $response['success'] = false;
    $response['message'] = "Invalid date format";
    print_r(json_encode($response));
    return false;
}

$date = $date_obj->format('Y-m-d');

$sql = "SELECT * FROM `panchangam_new` WHERE date='$date'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    $rows = array();
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['date'] = DateTime::createFromFormat('Y-m-d', $row['date'])->format('d-m-Y');
        $temp['sunrise'] = date('h:i a', strtotime($row['sunrise']));
        $temp['sunset'] = date('h:i a', strtotime($row['sunset']));
        $temp['moonrise'] = date('h:i a', strtotime($row['moonrise']));
        $temp['moonset'] = date('h:i a', strtotime($row['moonset']));
        $temp['week & date'] = $row['week_date'];
        $temp['kalam'] = $row['kalam'];
        $temp['thidhi'] = $row['thidhi'];
        $temp['nakshatram'] = $row['nakshatram'];
        $temp['yogam'] = $row['yogam'];
        $temp['karanam'] = $row['karanam'];
        $temp['abhijith_muhurtham'] = $row['abhijith_muhurtham'];
        $temp['bhrama_muhurtham'] = $row['bhrama_muhurtham'];
        $temp['amrutha_kalam'] = $row['amrutha_kalam'];
        $temp['rahukalam'] = $row['rahukalam'];
        $temp['yamakandam'] = $row['yamakandam'];
        $temp['dhurmuhurtham'] = $row['dhurmuhurtham'];
        $temp['varjyam'] = $row['varjyam'];
        $temp['gulika'] =$row['gulika'];
        $rows[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "Panchangam New Listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "Data Not Found";
    print_r(json_encode($response));
}
?>
