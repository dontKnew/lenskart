<?php

	session_start();
	unset($_SESSION["is_login"]);
	unset($_SESSION["email"]);
	unset($_SESSION["msg"]);
	session_destroy();
	header("Location:login.php");

?>