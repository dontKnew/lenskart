<?php
	
	session_start();	
	error_reporting(E_ALL);
    ini_set('display_errors', 1);

	require_once("config.php");
	require_once('../helper/define.php');

	$db = new lenskartDB("localhost", "root", "", "lenskart");

	// if user not logged, redirect to login page
	if(!isset($_SESSION['is_login'])){
		$url =  ROOT.'dashboard/login.php';
		header('location:'."$url".'');
	}
	// delete table data
	if(isset($_GET['id'])){
		$id =  $_GET['id'];
	    $db->delete("customers", 'id = "'.$id.'"');
		// $result = json_decode($db->getResult());
		// return json_encode(array("status"=>1, "message"=>""));
		echo "<span class='alert alert-success' role='alert' > Customer data Delete Successfully ! </span>";
		
	}else {
		// return json_encode(array("status"=>0, "message"=>));
		echo "<span class='alert alert-success' role='alert' > Customer Data could not deleted ! </span>";
	}
	
	
?>