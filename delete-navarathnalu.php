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

	$sql_query = "DELETE  FROM navarathnalu_tab WHERE id =" . $ID;
	$db->sql($sql_query);
	$sql_query = "DELETE  FROM navarathnalu_tab_variant WHERE navarathnalu_tab_id =" . $ID;
	$db->sql($sql_query);
	$res = $db->getResult();
	header("location:navarathnalu.php");
?>
