<?php

require_once "helper/define.php";

$db = new lenskartDB(HOST, USER, PASSWORD, DB_NAME);

if (!isset($_SESSION['is_login'])) {
    header('location:login.php');
}

if (isset($_POST['changePassword'])) {
    $email = trim($_POST['email']);
    $cpassword = trim($_POST['cpassword']);
    $password = trim($_POST['password']);
    if ($cpassword !== $password) {
        $msg = "<span class='alert alert-warning' role='alert' > Please enter same password </span>";
    } else {
		$db->select("admin", "*", null, "email = '".$email."'", null, 1);
		$data = $db->getResult();
        $data = json_decode($data);
        print_r($data);
		if(is_array($data)){
			$password = password_hash(($password), PASSWORD_DEFAULT);
			$data = ["password" => $password];
			$result = $db->update('admin', $data, "email = '".$email."'");

			if ($result) {
				$msg = "<span class='alert alert-success' role='alert' > Password changed successfully ! </span>";
				// header('location:'.$url.'');
			} else {
				$msg = "<span class='alert alert-warning' role='alert' > Password could not changed ! </span>";
			}
		}else {
			$msg = "<span class='alert alert-warning' role='alert' >Email does not exist!</span>";
		}
    }
}
?>

<?php
define("TITLE", "Lenskart-changePassword");
require_once "include/header.php";
?>
  <div class="container my-4">
  <h1 class="text-center text-success"> <u> Change Your Password </u> </h1>
		                <form method="POST" action="">
                            <div class="row g-3">
                                <div class="col-md-6 py-3">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" id="email" placeholder="Admin Email" required>
                                        <label for="email">Admin Email*</label>
                                    </div>
                                </div>
                               <div class="col-md-6 py-3">
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control"  id="address" placeholder="Your New Password" required>
                                        <label for="address">New Password*</label>
                                    </div>
                                </div>
								<div class="col-md-6 py-3">
                                    <div class="form-floating">
                                        <input type="password" name="cpassword" class="form-control"  id="address" placeholder="Your Confirm Password" required>
                                        <label for="address">Confirm Password*</label>
                                    </div>
                                </div>
								<?php if (isset($msg)) {echo $msg;};?>
                                <div class="col-12 d-flex justify-content-center">
                                    <input type="submit" name="changePassword" value="SUBMIT" class="btn btn-outline-success w-50 py-3" id="submit">
                                </div>
                            </div>
                        </form>
	</div>
<?php
require_once "include/footer.php";
?>