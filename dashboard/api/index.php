<?php
	
	error_reporting(E_ALL);
    ini_set('display_errors', 1);

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 10000");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	require_once("../database/config.php");
	$db = new lenskartDB("localhost", "root", "", "lenskart");
	
		if(isset($_POST['name'])){
			$name = "Rahul"; 
			$father_name = "Raj Kumar";
			$phone_no = 7065221377;
			
			$email = "rahul@gmail.com";
			$address = "Kapashear";
			$city = "Delhi";
			
			$location = "Kapashera";
			$pincode =  110037;
			$investment_details = "investment details";
			
			$current_business = "current_business";
			$message = "Something new";
			
			$db->insert('customers',[
							"name"=>$name, "father_name"=>$father_name, "phone_no"=>$phone_no, 
							"email"=>$email, "address"=>$address, "city"=>$city, "location"=>$location, 
							"pincode"=>$pincode, "investment_details"=>$investment_details,
							 "current_business"=>$current_business, "message"=>$message
						]);
			echo $db->getResult();
			
		}else {
			echo json_encode(array("message=>could not get post data"), JSON_PRETTY_PRINT);
		}
?>