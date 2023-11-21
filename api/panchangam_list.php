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

$sql = "SELECT * FROM `panchangam` WHERE date='$date'";
$db->sql($sql);
$res_panchangam = $db->getResult();
$num = $db->numRows($res_panchangam);

if ($num >= 1) {
    $rows = array(); // Initialize the array to store Panchangam data

    foreach ($res_panchangam as $row_panchangam) {
        $temp = array(); // Initialize the temporary array for each iteration
        $temp['id'] = $row_panchangam['id'];
        $temp['date'] = DateTime::createFromFormat('Y-m-d', $row_panchangam['date'])->format('d-m-Y');
        $temp['sunrise'] = date('h:i a', strtotime($row_panchangam['sunrise']));
        $temp['sunset'] = date('h:i a', strtotime($row_panchangam['sunset']));
        $temp['moonrise'] = date('h:i a', strtotime($row_panchangam['moonrise']));
        $temp['moonset'] = date('h:i a', strtotime($row_panchangam['moonset']));

        // Fetch Panchangam variant data
        $panchangam_id = $row_panchangam['id'];
        $sql_variant = "SELECT * FROM `panchangam_variant` WHERE panchangam_id = '$panchangam_id'";
        $db->sql($sql_variant);
        $res_variant = $db->getResult();
        $temp['panchangam_variant'] = $res_variant;

        $rows[] = $temp;
    }

    $response['success'] = true;
    $response['message'] = "Panchangam List Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "Data Not Found";
    print_r(json_encode($response));
}
?>
