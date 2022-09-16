<?php

if(isset($_POST['submit'])&&$_POST['submit']=='Submit')
{
//print_r($_POST);
//die;
    $name = $_POST['name']; // required
    $fathername = $_POST['fathername']; // required
    $phone = $_POST['phone']; // required
    $email = $_POST['email']; // required
    $address = $_POST['address']; // required
    $city = $_POST['city']; // required
    $pincode = $_POST['pincode']; // required
    $location = $_POST['location']; // required
	$investment= $_POST['investment']; // required
	$business = $_POST['business']; // required
	$msg = $_POST['msg']; // required

	
	$email_message = "Name: ".$name."<br>";
	$email_message = "Father Name: ".$fathername."<br>";
	$email_message = "Phone: ".$phone."<br>";
	$email_message = "Email: ".$email."<br>";
	$email_message = "Address: ".$address."<br>";
	$email_message = "City: ".$city."<br>";
	$email_message .= "Pincode: ".$pincode."<br>";
	$email_message .= " Location: ".$location."<br>";
	$email_message .= "Investment Details: ".$investment."<br>";
	$email_message .= "Current Business: ".$business."<br>";
	$email_message .= "Message: ".$msg."<br>";

   
    
	$subject="Contact Us"; 
	$to="neelam.globalheight@gmail.com";
	$headers = 'From:lenskartbusiness.com<neelam.globalheight@gmail.com>' . "\n";
    $headers .= 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	//echo $email_message;
	
	$send=@mail($to, $subject, $email_message, $headers);
	if($send==1)
	{
	$msg="Mail Send";
	header("location:index.php");
	}
     else{
         echo"failed";
     }	
	
   
}
?>