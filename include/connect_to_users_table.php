<?php
require_once 'connection.php';
include_once 'session.php';

$select_stmt = $db->prepare("SELECT * FROM tbl_users WHERE user_id=:uid");
$select_stmt->execute(array(":uid" => $id));
$row_users = $select_stmt->fetch(PDO::FETCH_ASSOC);

$select_stmt = $db->prepare("SELECT * FROM tbl_users");
$select_stmt->execute();
$row_users_All = $select_stmt->fetchAll(PDO::FETCH_ASSOC);

$select_stmt = $db->prepare("SELECT * FROM tbl_users WHERE Responsible_id=0");
$select_stmt->execute();
$row_users_Responsible = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
