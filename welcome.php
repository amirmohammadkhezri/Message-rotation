<?php

require_once './include/connection.php';
include_once './include/session.php';
require_once './include/connect_to_users_table.php';

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">

	<title>Message In rotation</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/neon-rtl.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<style>
		body {
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 12px;
			direction: rtl;
		}

		.stats {
			color: #fff;
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 259px;
			height: auto;
			padding: 13px;
			line-height: 29px;
			margin-top: 10px;
		}
	</style>
</head>

<body class="page-body  page-fade" data-url="http://neon.dev">
	<div class="page-container">
		<?php
		include_once('sidebar.php');
		?>
		<div class="main-content">
			<div class="row">

				<!-- Profile Info and Notifications -->
				<div class="col-md-6 col-sm-8 clearfix">
					<ul class="user-info pull-left pull-none-xsm">
						<!-- Profile Info -->
						<li class="profile-info dropdown">
							<!-- add class "pull-right" if you want to place this from right -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="assets/images/thumb-1@2x.png" alt="" class="img-circle" width="44" />
								<?php
								if (isset($_SESSION['user_login'])) {
								?>
									خوش آمدید
								<?php
									echo $row_users['lastName'];
								}
								?>
							</a>
						</li>
					</ul>
				</div>
				<!-- Raw Links -->
				<div class="col-md-6 col-sm-4 clearfix hidden-xs">

					<ul class="list-inline links-list pull-right">
						<li>
							<a href="logout.php">
								خروج <i class="entypo-logout right"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<hr />
			<?php
			if (($row_users['Responsible_id'] == null)) {
			?>

				<div class="alert alert-danger">
					<strong><?php echo "عضویت شما باید توسط یک مدیر به یک بخش اضافه شود تا دکمه ارسال برای شما فعال شود"; ?></strong>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="col-sm-12 control-label">نام و نام خانوادگی</label>
						<div class="col-sm-12">
							<input type="text" value="<?php
									echo $row_users['lastName'];
								?>" name="txt_lastname" class="form-control" placeholder="fullname" disabled>
							<hr/>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<textarea id="field-ta" name="frm[run]" disabled></textarea>
						<script>
							$(function() {
								$('#field-ta').ckeditor();
							});
						</script>
					</div>
				</div>
			<?php
			} else {
			?>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="col-sm-12 control-label">نام و نام خانوادگی</label>
						<div class="col-sm-12">
							<input type="text" value="<?php
									echo $row_users['name'].'&nbsp;'.$row_users['lastName'];
								?>" name="txt_lastname" class="form-control" placeholder="fullname">
								<hr/>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<textarea id="field-ta" name="frm[run]"></textarea>
						<script>
							$(function() {
								$('#field-ta').ckeditor();
							});
						</script>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-12 control-label">&nbsp;</label>
					<div class="col-sm-12">
							<input type="submit" class="btn btn-success" name="btn_send_message" value="ارسال پیام برای مسئول">
					</div>
				</div>
			<?php
			}
			?>


		</div>

	</div>
	<!-- Imported styles on this page -->

	<!-- Custom CSS Link -->
	<link rel="stylesheet" href="assets/css/custom.css">
	<!-- Bottom scripts (common) -->

	<script src="assets/js/bootstrap.js"></script>

	<!-- Imported scripts on this page -->

	<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/adapters/jquery.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>
	<!-- Demo Settings -->


</body>

</html>