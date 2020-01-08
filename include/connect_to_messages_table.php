<?php
require_once 'connection.php';
include_once 'session.php';
$select_stmt = $db->prepare("SELECT * FROM tbl_messages");
$select_stmt->execute();

$row_messages = $select_stmt->fetchAll(PDO::FETCH_ASSOC);