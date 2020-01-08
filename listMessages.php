<?php

require_once './include/connection.php';
include_once './include/session.php';
require_once './include/connect_to_users_table.php';
require_once './include/connect_to_messages_table.php';

?>
<?php

if (($row_users['role'] != 2)) {
	header("location:403.php");
} else {
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

	<body class="page-body" data-url="http://neon.dev">

		<div class="page-container">
			<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

			<?php
			include_once('sidebar.php');
			?>

			<div class="main-content">

				<div class="row">

					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">




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
					</div>
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">

						<ul class="list-inline links-list pull-right">


							<li>
								<a href="login.php">
									خروج <i class="entypo-logout right"></i>
								</a>
							</li>
						</ul>

					</div>

				</div>

				<hr />
				<?php
				if (isset($registerMsg)) {
				?>
					<div class="alert alert-success">
						<strong><?php echo $registerMsg; ?></strong>
					</div>
				<?php
				}
				?>

				<br />

				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var $table1 = jQuery('#table-1');

						// Initialize DataTable
						$table1.DataTable({
							"aLengthMenu": [
								[10, 25, 50, -1],
								[10, 25, 50, "All"]
							],
							"bStateSave": true
						});

						// Initalize Select Dropdown after DataTables is created
						$table1.closest('.dataTables_wrapper').find('select').select2({
							minimumResultsForSearch: -1
						});
					});

					$('#send').setTimeout(function() {
						button.removeAttr('enable');
					}, 1000);;
				</script>

				<table class="table table-bordered datatable" id="table-1">
					<thead>
						<a href="newSection.php">

							<button type="button" class="btn btn-success"><i class="entypo-folder"> </i>ایجاد بخش</button>
						</a>
						<br />
						<br />
						<tr>
							<th>ردیف</th>

							<th>عنوان</th>
						</tr>
					</thead>
					<tbody>

						<?php
						foreach ($row_messages as $row_message) {
						?>
							<td><?php echo $row_message['message_id']; ?></td>

							<td><?php echo $row_message['title']; ?></td>
							</tr>
						<?php
						}
						?>
						<!-- <p>Input field: <input type="text" id="test3"></p>

						<button id="btn3" type="submit" onclick="Copy();" class="btn btn-blue btn-xs" name="btnx" value="کپی لینک">Set Value</button> -->
					</tbody>
				</table>
			</div>



			<!-- Imported styles on this page -->
			<link rel="stylesheet" href="assets/js/datatables/datatables.css">


			<!-- Custom CSS File -->
			<link rel="stylesheet" href="assets/css/custom.css">

			<!-- Bottom scripts (common) -->

			<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
			<script src="assets/js/bootstrap.js"></script>



			<!-- Imported scripts on this page -->
			<script src="assets/js/datatables/datatables.js"></script>



			<!-- JavaScripts initializations and stuff -->
			<script src="assets/js/neon-custom.js"></script>


			<!-- Demo Settings -->


	</body>

	</html>
<?php
}
?>