<?php

require_once './include/connection.php';
require_once './include/connect_to_users_table.php';

?>

<!-- /**
* start html code sidebar
*/ -->

<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
		<header class="logo-env">
			<!-- logo -->
			<div class="logo">
				<a href="index.php">
					<img src="assets/images/logo@2x.png" width="150" alt="23" />
				</a>
			</div>
			<br />
			<!-- logo collapse icon -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		<!-- start php code => ACL (access control list) users -->
		<?php
		if (($row_users['Responsible_id'] == null)) {
		?>
			<div class="alert alert-danger">
				<strong><?php echo "قفل"; ?></strong>
			</div>
		<?php
		} else {
		?>
			<ul id="main-menu" class="main-menu">
				<li class="active">
					<a href="welcome.php">
						<i class="entypo-gauge"></i>
						<span class="title">داشبورد</span>
					</a>
				</li>
				<?php
				if (($row_users['role'] == 2)) {
				?>
					<li class="has-sub root-level">
					<li>
						<a href="addSection.php">
							<span class="title">مدیریت بخش ها</span>
						</a>
					</li>
					<li>
						<a href="listMessages.php">
							<span class="title">لیست پیام ها</span>
						</a>
					</li>
				<?php
				}
				?>
			</ul>
		<?php
		}
		?>
		<!-- end php code => ACL (access control list) users -->
	</div>
</div>
<!-- /**
end html code sidebar
*/ -->