<?php

require_once './include/connection.php';
require_once './include/connect_to_users_table.php';

$_SESSION["user_login"] = "Guest";
if (isset($_REQUEST['btn_login']))	//button name is "btn_login" 
{
	$meliCode	= strip_tags($_REQUEST["txt_meliCode"]);	//textbox name "txt_username_email"
	$password	= strip_tags($_REQUEST["txt_password"]);			//textbox name "txt_password"

	if (empty($meliCode)) {
		$errorMsg[] = "please enter meliCode or email";	//check "username/email" textbox not empty 
	} else if (empty($password)) {
		$errorMsg[] = "please enter password";	//check "passowrd" textbox not empty 
	} else {
		try {
			$select_stmt = $db->prepare("SELECT * FROM tbl_users WHERE meliCode=:umeliCode"); //sql select query
			$select_stmt->execute(array(':umeliCode' => $meliCode));	//execute query with bind parameter
			$row_users = $select_stmt->fetch(PDO::FETCH_ASSOC);

			if ($select_stmt->rowCount() > 0)	//check condition database record greater zero after continue
			{
				if ($meliCode == $row_users["meliCode"]) //check condition user taypable "username or email" are both match from database "username or email" after continue
				{
					if (password_verify($password, $row_users["password"])) //check condition user taypable "password" are match from database "password" using password_verify() after continue
					{
						$_SESSION["user_login"] = $row_users["user_id"];	//session name is "user_login"
						$loginMsg = "با موفقیت وارد شدید...";		//user login success message
						header("refresh:2; welcome.php");			//refresh 2 second after redirect to "welcome.php" page
					} else {
						$errorMsg[] = "رمز عبور صحیح نیست";
					}
				} else {
					$errorMsg[] = "نام کاربری یا رمز عبور صحیح نیست";
				}
			} else {
				$errorMsg[] = "نام کاربری یا ایمیل صحیح نیست";
			}
		} catch (PDOException $e) {
			$e->getMessage();
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
					<span class="sr-only">منو</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">گیتی</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">بازگشت</a></li>
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
							<strong><?php echo $error; ?></strong>
						</div>
					<?php
					}
				}
				if (isset($loginMsg)) {
					?>
					<div class="alert alert-success">
						<strong><?php echo $loginMsg; ?></strong>
					</div>
				<?php
				}
				?>
				<center>
					<h2>صفحه لاگین</h2>
				</center>
				<form method="post" class="form-horizontal">

					<div class="form-group">
						<label class="col-sm-3 control-label">کد ملی</label>
						<div class="col-sm-6">
							<input type="text" name="txt_meliCode" class="form-control" placeholder="enter meliCode" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">رمز عبور</label>
						<div class="col-sm-6">
							<input type="password" name="txt_password" class="form-control" placeholder="enter passowrd" />
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							<input type="submit" name="btn_login" class="btn btn-success" value="ورود">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 m-t-15">
							اگر تا حالا ثبت نام نکرده اید بر روی ثبت نام کلیک کنید <a href="register.php">
								<p class="text-info">ثبت نام</p>
							</a>
						</div>
					</div>

				</form>

			</div>

		</div>

	</div>

</body>

</html>