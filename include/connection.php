<?php
$db_host="localhost"; //localhost server 
$db_user="root";	//database username
$db_password="";	//database password   
$db_name="giti";	//database name

try
{
	$db=new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e->getMessage();
}




