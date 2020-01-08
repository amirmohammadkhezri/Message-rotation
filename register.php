<?php

require_once "./include/connection.php";

if (isset($_REQUEST['btn_register'])) //button name "btn_register"
{
	$name	= strip_tags($_REQUEST['txt_name']);	    //textbox name "txt_email"
	$lastName	= strip_tags($_REQUEST['txt_lastName']);	//textbox name "txt_email"
	$role       = strip_tags($_REQUEST['txt_role']);    	//textbox name "txt_role"
	$meliCode		= strip_tags($_REQUEST['txt_meliCode']);	//textbox name "txt_email"
	$password	= strip_tags($_REQUEST['txt_password']);	//textbox name "txt_password"
	if ($role == 2) {  //  $role == 2 => Responsible"  ||  $role !== 2 => Employee"
		$Responsible_id = 0;   // Responsible"
	} else {
		$Responsible_id = null; // Employee"
	}

	if (empty($name)) {
		$errorMsg[] = "Please enter name";     	//check name textbox not empty 
	} else if (empty($lastName)) {
		$errorMsg[] = "Please enter lastName";	//check lastName textbox not empty 
	} else if (empty($role)) {
		$errorMsg[] = "Please enter role";    	//check role textbox not empty
	} else if (empty($meliCode)) {
		$errorMsg[] = "Please enter meliCode";	//check meliCode textbox not empty
	} else if (strlen($password) < 6) {
		$errorMsg[] = "Password must be atleast 6 characters";	//check passowrd must be 6 characters
	} else {
		try {
			$select_stmt = $db->prepare("SELECT meliCode FROM tbl_users 
										WHERE meliCode=:umeliCode"); // sql select query

			$select_stmt->execute(array(':umeliCode' => $meliCode)); //execute query 
			$row_users = $select_stmt->fetch(PDO::FETCH_ASSOC);

			if ($row_users["meliCode"] == $meliCode) {
				$errorMsg[] = "Sorry meliCode already exists";	//check condition username already exists 
			} else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
			{
				$new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()

				$insert_stmt = $db->prepare("INSERT INTO tbl_users	(name,lastName,role,Responsible_id,meliCode,password) VALUES
																(:uname,:ulastName,:urole,:uResponsible_id,:umeliCode,:upassword)"); 		//sql insert query					

				if ($insert_stmt->execute(array(
					':uname'	=> $name,
					':ulastName' => $lastName,
					':urole'	=> $role,
					':uResponsible_id'	=> $Responsible_id,
					':umeliCode' => $meliCode,
					':upassword' => $new_password
				))) {

					$registerMsg = "ثبت نام شما با موفقیت انجام شد لطفا از طریق لینک لاگین وارد شوید"; //execute query success message
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Message In rotation</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="js/jquery-1.12.4-jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

</head>

<body>


	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://www.onlyxcodes.com/">onlyxcodes</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="http://www.onlyxcodes.com/2019/04/login-and-register-script-in-php-pdo.html">Back to Tutorial</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<div class="wrapper">

		<div class="container">

			<div class="col-lg-12">

				<?php
				if (isset($errorMsg)) {
					foreach ($errorMsg as $error) {
				?>
						<div class="alert alert-danger">
							<strong>WRONG ! <?php echo $error; ?></strong>
						</div>
					<?php
					}
				}
				if (isset($registerMsg)) {
					?>
					<div class="alert alert-success">
						<strong><?php echo $registerMsg; ?></strong>
					</div>
				<?php
				}
				?>
				<center>
					<h2>Register Page</h2>
				</center>
				<form method="post" class="form-horizontal">


					<div class="form-group">
						<label class="col-sm-3 control-label">Name</label>
						<div class="col-sm-6">
							<input type="text" name="txt_name" class="form-control" placeholder="enter name" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">LastName</label>
						<div class="col-sm-6">
							<input type="text" name="txt_lastName" class="form-control" placeholder="enter lastName" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">meliCode</label>
						<div class="col-sm-6">
							<input type="text" name="txt_meliCode" class="form-control" placeholder="enter meliCode" />
						</div>
					</div>
					
						<!-- 					
					TODO:CHANGE INPUT TO RADIO BUTTON
					value 2 => Responsible
					value 1 => Employee
					 	-->
					<div class="form-group">
						<label class="col-sm-3 control-label">Role</label>
						<div class="col-sm-6">
							<input type="text" name="txt_role" class="form-control" placeholder="enter Role" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Password</label>
						<div class="col-sm-6">
							<input type="password" name="txt_password" class="form-control" placeholder="enter passowrd" />
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							<input type="submit" name="btn_register" class="btn btn-primary " value="Register">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							You have a account register here? <a href="index.php">
								<p class="text-info">Login Account</p>
							</a>
						</div>
					</div>

				</form>

			</div>

		</div>

	</div>

</body>

</html>