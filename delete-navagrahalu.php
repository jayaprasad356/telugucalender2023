<?php
include_once('includes/crud.php');
$db = new Database();
$db->connect();
	
	if (isset($_GET['id'])) {
		$ID = $db->escapeString($_GET['id']);
	} else {
		// $ID = "";
		return false;
		exit(0);
	}
	$data = array();

	$sql_query = "DELETE  FROM navagrahalu_tab WHERE id =" . $ID;
	$db->sql($sql_query);
	$sql_query = "DELETE  FROM navagrahalu_tab_variant WHERE navagrahalu_tab_id =" . $ID;
	$db->sql($sql_query);
	$res = $db->getResult();
	header("location:navagrahalu.php");
?>
