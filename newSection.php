<?php

require_once './include/connection.php';
include_once './include/session.php';
require_once './include/connect_to_users_table.php';


if (isset($_REQUEST['btn_newSection'])) //button name "btn_message"
{
	$title	= strip_tags($_REQUEST['txt_title']);	    //textbox name "txt_email"
	$user_id = strip_tags($_REQUEST['txt_users_All']);    	//textbox name "users_All"
	$Responsible_id	= strip_tags($_REQUEST['txt_users_Responsible']);	//textbox name "users_Responsible"
	
		try {
			$insert_stmt = $db->prepare("INSERT INTO tbl_sections (title,user_id,Responsible_id) VALUES
			(:utitle,:uuser_id,:uResponsible_id)"); 
			$insert_stmt1 = $db->prepare("UPDATE tbl_users SET Responsible_id = $Responsible_id WHERE user_id=$user_id");	
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		if ($insert_stmt->execute(array(
			':utitle'	=> $title,
			':uuser_id' => $user_id,
			':uResponsible_id'	=> $Responsible_id,
			
		)))
		if ($insert_stmt1->execute(array(
			'Responsible_id'=> $Responsible_id,
			
		))){

			header("location:addSection.php");
		}
	}

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


	<script src="assets/js/jquery-1.11.3.min.js"></script>

</head>

<body class="page-body  page-fade" data-url="http://neon.dev">

	<div class="page-container">
		<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		<!-- side bar delete -->
		<!-- CODE -->
		<!-- side bar delete -->
		<div class="main-content">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="panel-title">
								ساخت پوشه
							</div>
						</div>
						<div class="panel-body">
							<form role="form" class="form-horizontal form-groups-bordered" action="" method="post" enctype="multipart/form-data">
								<div class="row-col">
									<div class="col-sm-4">
										<div class="form-group">
											<label class="col-sm-12 control-label">عنوان</label>
											<div class="col-sm-12">
												<input type="text" value="" name="txt_title" class="form-control" placeholder="title" required>

											</div>
										</div>
									</div>

									<div class="col-sm-8">
										<select name="txt_users_Responsible">
											<?php
											foreach ($row_users_Responsible as $row_role) {
											?>
												<option value="<?php echo $row_role['user_id']; ?>"><?php echo $row_role['name']; ?></option>
											<?php
											}
											?>
										</select>
										<select name="txt_users_All">
											<?php
											foreach ($row_users_All as $row_all) {
											?>
												<option value="<?php echo $row_all['user_id']; ?>"><?php echo $row_all['name']; ?></option>
											<?php
											}
											?>
										</select>


									</div>

								</div>
						</div>
						<br />
						<hr />
						<input type="submit" class="btn btn-success" name="btn_newSection" value="ساخت پوشه">
						</form>
					</div>
				</div>
			</div>
		</div>
		<br />
	</div>
	</div>

	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">
	<link rel="stylesheet" href="assets/js/rickshaw/rickshaw.min.css">
	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="assets/js/select2/select2.css">
	<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">

	<!-- Custom CSS File -->
	<link rel="stylesheet" href="assets/css/custom.css">
	<!-- Bottom scripts (common) -->
	<script src="assets/js/bootstrap.js"></script>
	<!-- Imported scripts on this page -->
	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>
	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>

</body>

</html>