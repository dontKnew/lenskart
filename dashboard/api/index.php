<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Max-Age: 10000");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	require_once("../database/config.php");
	
	$db = new lenskartDB("localhost", "root", "", "lenskart");
	
		if(isset($_POST['name'])){
			$name = $_POST['name']; 
			$father_name = $_POST['father_name']; 
			$phone_no = $_POST['phone_no']; 
			$email = $_POST['email']; 
			$address = $_POST['address']; 
			$city = $_POST['city']; 
			$pincode = $_POST['pincode']; 
			$location = $_POST['location']; 
			$investment_details = $_POST['investment_details']; 
			$current_business = $_POST['current_business']; 
			$message = $_POST['message']; 
			
			$result = $db->insert('customers',[
							"name"=>$name, "father_name"=>$father_name, "phone_no"=>$phone_no, 
							"email"=>$email, "address"=>$address, "city"=>$city, "location"=>$location, 
							"pincode"=>$pincode, "investment_details"=>$investment_details,
							 "current_business"=>$current_business, "message"=>$message
						]);
			if($result){
				echo json_encode(array("message=>Data insert successfully", "status"=>1));
			}else{
				echo json_encode(array("message=>Server side error occured", "status"=>0));
			}
		}else {
			echo json_encode(array("message=>could not get post data", "status"=>0));
		}
?>