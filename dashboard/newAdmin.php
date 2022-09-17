<?php

require_once "helper/define.php";

$db = new lenskartDB(HOST, USER, PASSWORD, DB_NAME);

if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}

if (isset($_POST['newAdmin'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    if ($cpassword !== $password) {
        $msg = "<span class='alert alert-warning' role='alert' > Please enter same password </span>";
    } else {
		$db->select("admin", "*", null, "email = '".$email."'", null, 1);
		$data = $db->getResult();
		if(!is_array($data)){
			$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
			$data = [
				"name" => $name,
				"email" => $email,
				"password" => $password,
			];
			$result = $db->insert('admin', $data);
			if ($result) {
				$msg = "<span class='alert alert-success' role='alert' > Admin added successfully ! </span>";
				// header('location:'.$url.'');
			} else {
				$msg = "<span class='alert alert-warning' role='alert' > Admin could not add ! </span>";
			}
		}else {
			$msg = "<span class='alert alert-warning' role='alert' > This is email address already exist. </span>";
		}
    }
}
?>

<?php
define("TITLE", "Lenskart-NewAdmin");
require_once "include/header.php";
?>
  <div class="container my-4">
  <h1 class="text-center text-success"> <u> Create New Admin </u> </h1>
		                <form method="POST" action="">
                            <div class="row g-3">
                                <div class="col-md-6 py-3">
                                    <div class="form-floating">
                                        <input type="text" name="name"  class="form-control" id="name" placeholder="Admin Full Name" required>
                                        <label for="name"> Full Name*</label>
                                    </div>
                                </div>
                                <div class="col-md-6 py-3">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control"  id="email" placeholder="Admin Email" required>
                                        <label for="email">Admin Email*</label>
                                    </div>
                                </div>
                               <div class="col-md-6 py-3">
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control"  id="address" placeholder="Admin New Password" required>
                                        <label for="address">Admin Password*</label>
                                    </div>
                                </div>
								<div class="col-md-6 py-3">
                                    <div class="form-floating">
                                        <input type="password" name="cpassword" class="form-control"  id="address" placeholder="Admin Confirm Password" required>
                                        <label for="address">Confirm Password*</label>
                                    </div>
                                </div>
								<?php if (isset($msg)) {echo $msg;};?>
                                <div class="col-12 d-flex justify-content-center">
                                    <input type="submit" name="newAdmin" value="ADD ADMIN" class="btn btn-outline-primary w-50 py-3" id="submit">
                                </div>
                            </div>
                        </form>
	</div>
<?php
require_once "include/footer.php";
?>