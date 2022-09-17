<?php
require_once 'helper/define.php';

$db = new lenskartDB(HOST, USER, PASSWORD, DB_NAME);
if (isset($_SESSION['is_login'])) {
    $url = ROOT . 'dashboard/login.php';
    header('location:' . "$url" . '');
}
$msg = '';
if (isset($_POST['login'])) {

    $email = htmlspecialchars(($_POST['email']));
    $password = $_POST['password'];

    $db->select("admin", "*", null, 'email = "' . $email . '"', null, 1);
    $data = json_decode($db->getResult());
    $result = $data[1]->get[0]->data;
    // print_r($data);
    if (is_array($result)) {
        header('location:./');
        $_SESSION['email'] = $email;
        $_SESSION['is_login'] = true;
    } else {
        // echo "<script>alert('Pleae enter valid email address')</script>";
        $msg = "<span class='alert alert-warning' role='alert mt-1' > Please enter valid email address and pssword </span> ";
    }

}

?>
<?php
define("TITLE", "Lenskart-login");
require_once "include/header.php";
?>
  <div class="container my-4">
  <h1 class="text-center"> <u> Login Admin </u> </h1>

	<form method="POST" action="" class="w-50">
	  <div class="mb-3">
		<label for="exampleInputEmail1" class="form-label">Email address</label>
		<input type="email" class="form-control" name="email"   value="admin@gamil.com" aria-describedby="emailHelp" required>
	  </div>
	  <div class="mb-3">
		<label for="exampleInputPassword1" class="form-label">Password</label>
		<input type="password" name="password" value="password"  class="form-control" id="exampleInputPassword1" required>
	  </div>
	  <button type="submit" name="login" class="btn btn-outline-success">Submit</button>
	</form>
	<div class="d-flex justify-content-start mt-1 responseMsg">
		<?php if (isset($msg)) {echo $msg;}?>
	</div>
  </div>
  <?php
require_once "include/footer.php";
?>

