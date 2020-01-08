<?php

session_start();
if (!isset($_SESSION['user_login']))	//check unauthorize user not access in "welcome.php" page
{
	header("location: index.php");
}

$id = $_SESSION['user_login'];
