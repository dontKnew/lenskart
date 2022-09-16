<?php
        session_start();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		
		require_once("database/config.php");
        require_once("helper/define.php");

		$db = new lenskartDB("localhost", "root", "", "lenskart");
		
        if(!isset($_SESSION['is_login'])){
			header('location:login.php');
		}

		if(isset($_GET['customer_id'])){
			$id = $_GET['customer_id'];
			$db->select("customers","*",null,'id = "'.$id.'"' ,null);				
			$data = json_decode($db->getResult());
			$data = $data[1]->get[0]->data;
			/*echo "<pre>";
			echo print_r($data);
			echo "<pre>";*/
		}else {
            $url = ROOT.'/dashboard/';
            header("locaton:");
        }

		if(isset($_POST['update']) && isset($_GET['customer_id'])){
			$id = $_GET['customer_id'];
			$name = $_POST['name']; // required
			$father_name = $_POST['fathername']; // required
			$phone_no = $_POST['phone']; // required
			$email = $_POST['email']; // required
			$address = $_POST['address']; // required
			$city = $_POST['city']; // required
			$pincode = $_POST['pincode']; // required
			$location = $_POST['location']; // required
			$investment_details= $_POST['investment']; // required
			$current_business = $_POST['business']; // required
			$message = $_POST['msg']; // required
			$data = [
							"name"=>$name, "father_name"=>$father_name, "phone_no"=>$phone_no, 
							"email"=>$email, "address"=>$address, "city"=>$city, "location"=>$location, 
							"pincode"=>$pincode, "investment_details"=>$investment_details,
							 "current_business"=>$current_business, "message"=>$message
						];
			$db->update('customers',$data, 'id= "'.$id.'"');
						
			$data = json_decode($db->getResult());
			$data = $data[0]->update[0]->data;
            $update = "";
			if($data===1){
				// echo "<script> alert('data Updated')";
                // $msg = "<span class='alert alert-success' role='alert' >Customer data updated ! </span>";
                $update = "true";
                $url = ROOT.'dashboard/?update='.$update;
				header('location:'."$url".'');
			}else {
				// echo "<script> alert('data could not updated, try again later')";
                // $msg = "<span class='alert alert-danger' role='alert' > Customer Data could not updated </span>";
                $update = "false";
                $url = ROOT.'dashboard/?update='.$update;
				header('location:'."$url".'');
			}
			
		}
		

?>

<?php 
	define("TITLE","Lenskart-Admin");
	require_once("include/header.php");
?>
  <div class="container my-4">
  <h1 class="text-center"> Update Customer Data </h1>

		 <form method="post">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name"  value="<?php echo $data[0]->name ?>" class="form-control" id="name" placeholder="Your Full Name" required>
                                        <label for="name"> Name*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="fathername" value="<?php echo $data[0]->father_name?>"  class="form-control" id="fname" placeholder="Your Father Name" required>
                                        <label for="fname">Father Name*</label>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="phone" value="<?php echo $data[0]->phone_no?>"  class="form-control" id="phone" placeholder="Your Phone No." required>
                                        <label for="Phone">Phone No.*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" value="<?php echo $data[0]->email?>"  id="email" placeholder="Your Email" required>
                                        <label for="email">Your Email*</label>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="address" class="form-control" value="<?php echo $data[0]->address ?>"  id="address" placeholder="Your address" required>
                                        <label for="address">Your Address*</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="city" class="form-control" value="<?php echo $data[0]->city ?>" id="subject" placeholder="Your City" required>
                                        <label for="city">Your City*</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="pincode" class="form-control" value="<?php echo $data[0]->pincode ?>" id="pincode" placeholder="Your Pincode" required>
                                        <label for="pincode">Your Pincode*</label>
                                    </div>
                                </div>
                               <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="location" class="form-control" value="<?php echo $data[0]->location ?>"  id="location" placeholder="Your Location" required>
                                        <label for="location">Your Location*</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="investment" class="form-control" value="<?php echo $data[0]->investment_details ?>" id="investment" placeholder="Investment Details" required>
                                        <label for="city">Investment Details*</label>
                                    </div>
                                </div>
                                
                                     <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" name="business" class="form-control" value="<?php echo $data[0]->current_business?>" id="business" placeholder="Current Business" required>
                                        <label for="business">Current Business*</label>
                                    </div>
                                </div>
                                
                                
                                   <div class="col-12">
                                        <div class="form-floating">
                                        <textarea type="messsage" name="msg" style="height:150px;"  class="form-control" id="message" placeholder="Message" required>
                                        <?php echo $data[0]->message; ?> </textarea>
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
	require_once("include/footer.php");
?>