<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('Asia/Kolkata');

include_once('../includes/crud.php');
$db = new Database();
$db->connect();

if (empty($_POST['muhurtham'])) {
    $response['success'] = false;
    $response['message'] = "Muhurtham is Empty";
    print_r(json_encode($response));
    return false;
}

$muhurtham = $db->escapeString($_POST['muhurtham']);

$sql_muhurtham_id = "SELECT id FROM muhurtham WHERE muhurtham = '$muhurtham'";
$db->sql($sql_muhurtham_id);
$res_muhurtham_id = $db->getResult();

if (empty($res_muhurtham_id)) {
    $response['success'] = false;
    $response['message'] = "Muhurtham Not Found";
    print_r(json_encode($response));
    return false;
}

$muhurtham_id = $res_muhurtham_id[0]['id'];

$sql = "SELECT * FROM muhurtham_tab WHERE muhurtham_id = '$muhurtham_id'";
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
    $response['message'] = "Data Listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "Not Found";
    print_r(json_encode($response));
}
?>
