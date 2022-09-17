<?php
require_once 'helper/define.php';

$db = new lenskartDB(HOST, USER, PASSWORD, DB_NAME);

// $url = 'http://'.$_SERVER['HTTP_HOST'].'/dashboard/login.php';
// if user not logged, redirect to login page
if (!isset($_SESSION['is_login'])) {
    $url = ROOT . 'dashboard/login.php';
    header('location:' . "$url" . '');
}

$msg  = '';
// delete table data
if (isset($_GET['delete'])) {
    $id = trim($_GET['delete']);
    $result = $db->delete("customers", 'id = "' . $id . '"');
    if ($result) {
        $msg = "<span class='alert alert-success' role='alert' > Customer data Delete Successfully ! </span>";
    } else {
        $msg = "<span class='alert alert-success' role='alert' > Customer data could not Deleted ! </span>";
    }
}

$db->select("customers","*",null,null, "id DESC");
$data = json_decode($db->getResult());
$data = $data[1]->get[0]->data;
?>

<?php
define("TITLE", "Lenskart-Dashboard");
require_once "include/header.php";
?>
  <div class="container-fluid m-1">
  <h2 class='text-center text-primary'> <u> Customer Records </u> </h2>
  <div class="d-flex justify-content-between align-items-center">
	<div class="mx-1">
		<a href="export_to_excel.php" class="btn btn-md btn-outline-info"> Download Data </a>
	</div>
	<a href="logout.php" class="btn btn-md btn-warning"> Logout </a>
  </div>
	<div class="d-flex w-100 justify-content-center responseMsg">
		<?php echo $msg; ?> 
	</div>
  <div class="overflow-scroll w-100">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Father</th>
      <th scope="col">PhoneNo.</th>
	  <th scope="col">Email</th>
	  <th scope="col">Address</th>
	  <th scope="col">City</th>
	  <th scope="col">Location</th>
	  <th scope="col">Pincode</th>
	  <th scope="col">Investment_Info </th>
	  <th scope="col">Business</th>
	  <th scope="col"> Message </th>
	  <th scope="col">Apply Date </th>
	  <th scope="col">Action </th>
    </tr>
  </thead>
  <tbody>
  <?php
if (gettype($data) == "integer") {
    echo '<tr> <th colspan=13> <div class="text-center alert alert-info" role="alert"> No Customer Record Found </tr> <th>';
} else {
    foreach ($data as $customer) {
        echo '
		<tr>
		  <td> ' . $customer->name . '</td>
		  <td> ' . $customer->father_name . '</td>
		  <td> ' . $customer->phone_no . '</td>
		  <td> ' . $customer->email . '</td>
		  <td> ' . $customer->address . '</td>
		  <td> ' . $customer->city . '</td>
		  <td> ' . $customer->location . '</td>
		  <td> ' . $customer->pincode . '</td>
		  <td> ' . $customer->investment_details . '</td>
		  <td> ' . $customer->current_business . '</td>
		  <td> ' . $customer->message . '</td>
		  <td> ' .date("d/m/Y g:i a", strtotime($customer->apply_date)). '</td>
		  <td class="d-flex justify-content-center align-items-center">
			<a href="'.ROOT.'dashboard/?delete='.$customer->id.'"  value="Delete" class="btn btn-danger m-1"> Delete </a>
			<a href="'.ROOT.'dashboard/update.php?edit='.$customer->id.'"  value="Edit" class="btn btn-success ">  Edit </a>
		  </td>
		</tr>';
    }
}
?>
</tbody>
</table>
</div>
<?php require_once "include/footer.php"?>
