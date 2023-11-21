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
$day = (isset($_POST['day']) && !empty($_POST['day'])) ? $db->escapeString($_POST['day']) : "";
if (isset($_POST['all']) && $_POST['all'] == 1) {
    $sql = "SELECT * FROM `panchangam`";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if($num>=1){
        foreach ($res as $row) {
            $temp['id'] = $row['id'];
            $temp['date'] = $row['date'];
            $temp['sunrise'] = date('h:i a', strtotime($row['sunrise']));
            $temp['sunset'] = date('h:i a', strtotime($row['sunset']));
            $temp['moonrise'] = date('h:i a', strtotime($row['moonrise']));
            $temp['moonset'] = date('h:i a', strtotime($row['moonset']));
            $rows[] = $temp;
        }
     
        $response['success'] = true;
        $response['message'] = "Panchangam Listed Successfully";
        $response['data'] = $rows;
        print_r(json_encode($response));
    
    }
    else{
        $response['success'] = false;
        $response['message'] = "Data Not Found";
        print_r(json_encode($response));
    }

}