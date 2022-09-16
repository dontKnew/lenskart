<?php
	
	session_start();	
	error_reporting(E_ALL);
    ini_set('display_errors', 1);

	require_once("database/config.php");
	require_once('helper/define.php');

	$db = new lenskartDB("localhost", "root", "", "lenskart");
	
	// $url = 'http://'.$_SERVER['HTTP_HOST'].'/dashboard/login.php';
	$msg  = '';

	// if user not logged, redirect to login page
	if(!isset($_SESSION['is_login'])){
		$url =  ROOT.'dashboard/login.php';
		header('location:'."$url".'');
	}
	// delete table data
	if(isset($_POST['delete'])){
		$id =  $_POST['customer_id'];
	    $db->delete("customers", 'id = "'.$id.'"');
		$result = json_decode($db->getResult());
		$url =  ROOT.'dashboard/';
		$msg = "<span class='alert alert-success' role='alert' > Customer data Delete Successfully ! </span>";
		// header("location:$url");
		echo "<script> alert('delete data');</script>";
	}
	
	$db->select("customers");
	$data = json_decode($db->getResult());
	$data = $data[1]->get[0]->data;
?>

<?php 
	define("TITLE","Lenskart-Dashboard");
	require_once("include/header.php");
?>
  <div class="container-fluid my-2">
  <div class="d-flex justify-content-end">
	<a href="logout.php" class="btn btn-md btn-warning"> Logout </a>
  </div>
  <h1 class="text-center mb-2"> <u> Customer Records </u> </h1>
	<div class="d-flex w-100 justify-content-center responseMsg">
		<?php if(isset($msg)){ echo $msg;}?>
		<?php if(isset($_GET['update'])){ echo "<span class='alert alert-success' role='alert' > Customer data Update Successfully ! </span>";}?>
	</div>
  <div class="overflow-scroll w-100">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Father Name</th>
      <th scope="col">Phone No.</th>
	  <th scope="col">Email</th>
	  <th scope="col">Address.</th>
	  <th scope="col">City</th>
	  <th scope="col">Location</th>
	  <th scope="col">Pincode</th>
	  <th scope="col">Investment Details </th>
	  <th scope="col">Current Business</th>
	  <th scope="col"> Message </th>
	  <th scope="col">Apply Date </th>
	  <th scope="col">Action </th>
    </tr>
  </thead>
  <tbody>
  <?php 
if(gettype($data)=="integer"){
	echo '<tr> <th colspan=13> <div class="text-center alert alert-info" role="alert"> No Customer Record Found </tr> <th>';
}else {
	foreach($data as $customer ){
		echo '
		<tr> 
		  <th scope="row"> '.$customer->id.'</th>
		  <td> '.$customer->name.'</td>
		  <td> '.$customer->father_name.'</td>
		  <td> '.$customer->email.'</td>
		  <td> '.$customer->address.'</td>
		  <td> '.$customer->city.'</td>
		  <td> '.$customer->location.'</td>
		  <td> '.$customer->pincode.'</td>
		  <td> '.$customer->investment_details.'</td>
		  <td> '.$customer->current_business.'</td>
		  <td> '.$customer->message.'</td>
		  <td> '.$customer->apply_date.'</td>
		  <td> 
			  <form class="m-1">
				  <input type="button" name="customer_id" id="customer_id" data-customer-id="'.$customer->id.'" value="Delete" class="btn btn-danger deleteCustomer"/>
			  </form>
			  <form method="GET" action="'.ROOT.'/dashboard/update.php" class="m-1">
				  <input type="hidden" class="btn btn-success" name="customer_id" value="'.$customer->id.'" /> 
				  <button type="submit" name="edit" class="btn btn-success"> Edit </button>
			  </form>
		  </td>
		</tr>';
	}
}
?>
</tbody>
</table>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function(){
	$(".deleteCustomer").click(function(evt){
		let id = $(this).attr('data-customer-id');
		$.ajax({
			Type:'POST',
			url:'<?php echo ROOT.'/dashboard/database/delete.php?id='; ?>'+id,
			data:{"id":id},
			success:function(e){
				$(".responseMsg").html(e);
				setInterval(() => {
					location.reload();
					$(".responseMsg").html("");
				}, 3000);
			},
			error:function(){
				$(".responseMsg").append("<span class='alert alert-success' role='alert' >Something, Please try again later </span>");
				setInterval(() => {
					$(".responseMsg").html("");
				}, 3000);
			}
		});
	});
}) 
</script>
<?php require_once("include/footer.php") ?>
