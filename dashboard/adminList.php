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
    $result = $db->delete("admin", 'id = "'.$id.'"');
    if ($result) {
        $msg = "<span class='alert alert-success' role='alert' > Admin Delete Successfully ! </span>";
    } else {
        $msg = "<span class='alert alert-success' role='alert' > Admin delete could not Deleted ! </span>";
    }
}

$db->select("admin");
$data = json_decode($db->getResult());
$data = $data[1]->get[0]->data;

?>

<?php
	define("TITLE","Lenskart-AdminList");
	require_once "include/header.php";
?>
  <div class="container-fluid my-2">
  <div class="d-flex justify-content-end">
	<a href="logout.php" class="btn btn-md btn-warning"> Logout </a>
  </div>
  <h1 class="text-center mb-2"> <u> Admins Records </u> </h1>
	<div class="d-flex w-100 justify-content-center responseMsg">
		<?php if (isset($msg)) {echo $msg;}?>
	</div>
  <div class="w-100">
<table class="table table-responsive px-2">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
	  <th scope="col">Password</th>
	  <th scope="col">Reged_at</th>
	  <th scope="col">Action </th>
    </tr>
  </thead>
  <tbody>
  <?php
if (gettype($data) == "integer") {
    echo '<tr> <th colspan=13> <div class="text-center alert alert-info" role="alert"> No Admin Record Found </tr> <th>';
} else {
    foreach ($data as $admin) {
        echo '
		<tr>
		  <th scope="row"> ' . $admin->id . '</th>
		  <td> ' . $admin->name . '</td>
		  <td> ' . $admin->email . '</td>
		  <td> ***** </td>
		  <td> ' . date("d/m/Y g:i a", strtotime($admin->created_at)). '</td>
		  <td>
			<a href="'.ROOT.'dashboard/adminList.php?delete='.$admin->id .'" class="btn btn-danger"> Delete </a>
			<a href="#"  class="btn btn-success disabled">Edit</a>
		  </td>
		</tr>';
    }
}
?>
</tbody>
</table>
</div>
<?php require_once "include/footer.php"?>
