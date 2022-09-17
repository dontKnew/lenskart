<?php

require_once "helper/define.php";

$db = new lenskartDB(HOST, USER, PASSWORD, DB_NAME);

if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $db->select("customers", "*", null, 'id = "' . $id . '"', null);
    $data = json_decode($db->getResult());
    $data = $data[1]->get[0]->data;
} else {
    $url = ROOT.'dashboard/';
    header('location:'."$url".'');
}

if (isset($_REQUEST['update'])) {
    $id = $_GET['edit'];
    $name = $_POST['name']; 
    $father_name = $_POST['fathername']; 
    $phone_no = $_POST['phone']; 
    $email = $_POST['email']; 
    $address = $_POST['address']; 
    $city = $_POST['city']; 
    $pincode = $_POST['pincode']; 
    $location = $_POST['location']; 
    $investment_details = $_POST['investment']; 
    $current_business = $_POST['business']; 
    $message = $_POST['msg']; 
    $data = [
        "name" => $name, "father_name" => $father_name, "phone_no" => $phone_no,
        "email" => $email, "address" => $address, "city" => $city, "location" => $location,
        "pincode" => $pincode, "investment_details" => $investment_details,
        "current_business" => $current_business, "message" => $message,
    ];
    $result = $db->update('customers', $data, 'id= "' . $id . '"');
    if ($result) {
        $msg = "<span class='alert alert-success' role='alert' > Customer data updated ! </span>";
        // header('location:'.$url.'');
        echo "<script> setInterval(()=>{location.href='".ROOT."dashboard/'},3000) </script>";
    } else {
        $msg = "<span class='alert alert-success' role='alert' > Customer data could not updated ! </span>";
        echo "<script> setInterval(()=>{location.href='".ROOT."dashboard/'},3000) </script>";
    }

}

?>

<?php
define("TITLE", "Lenskart-Admin");
require_once "include/header.php";
?>
  <div class="container my-4">
  <h1 class="text-center"> Update Customer Data </h1>
  <div class="d-flex w-100 justify-content-center responseMsg">
		<?php  if(isset($msg)) {echo $msg;} ?> 
	</div>
		                <form method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name"  value="<?php if(isset($data[0]->name)){echo $data[0]->name;} ?>" class="form-control" id="name" placeholder="Your Full Name" required>
                                        <label for="name"> Name*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="fathername" value="<?php if(isset($data[0]->father_name)){echo $data[0]->father_name;} ?>"  class="form-control" id="fname" placeholder="Your Father Name" required>
                                        <label for="fname">Father Name*</label>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="phone" value="<?php if(isset($data[0]->phone_no)){echo $data[0]->phone_no;} ?>"  class="form-control" id="phone" placeholder="Your Phone No." required>
                                        <label for="Phone">Phone No.*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" value="<?php if(isset($data[0]->email)){echo $data[0]->email;} ?>"  id="email" placeholder="Your Email" required>
                                        <label for="email">Your Email*</label>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="address" class="form-control" value="<?php if(isset($data[0]->address)){echo $data[0]->address;} ?>"  id="address" placeholder="Your address" required>
                                        <label for="address">Your Address*</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="city" class="form-control" value="<?php if(isset($data[0]->city)){echo $data[0]->city;} ?>" id="subject" placeholder="Your City" required>
                                        <label for="city">Your City*</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="pincode" class="form-control" value="<?php if(isset($data[0]->pincode)){echo $data[0]->pincode;} ?>" id="pincode" placeholder="Your Pincode" required>
                                        <label for="pincode">Your Pincode*</label>
                                    </div>
                                </div>
                               <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="location" class="form-control" value="<?php if(isset($data[0]->location)){echo $data[0]->location;} ?>"  id="location" placeholder="Your Location" required>
                                        <label for="location">Your Location*</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="investment" class="form-control" value="<?php if(isset($data[0]->investment_details)){echo $data[0]->investment_details;} ?>" id="investment" placeholder="Investment Details" required>
                                        <label for="city">Investment Details*</label>
                                    </div>
                                </div>

                                     <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="business" class="form-control" value="<?php if(isset($data[0]->current_business)){echo $data[0]->current_business;} ?>" id="business" placeholder="Current Business" required>
                                        <label for="business">Current Business*</label>
                                    </div>
                                </div>


                                   <div class="col-12">
                                        <div class="form-floating">
                                        <textarea type="messsage" name="msg" style="height:150px;"  class="form-control" id="message" placeholder="Message" required>
                                        <?php if(isset($data[0]->message)){echo $data[0]->message;}; ?> </textarea>
                                        <label for="business">Message</label>
                                    </div>
                                     </div>
                                <div class="col-12">
                                    <input type="submit" name="update" class="btn btn-primary w-100 py-3" id="submit">
                                </div>
                            </div>
                        </form>
	</div>
<?php
require_once "include/footer.php";
?>