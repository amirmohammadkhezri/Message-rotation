<?php
require_once 'connection.php';
include_once 'session.php';
$select_stmt = $db->prepare("SELECT * FROM tbl_messages WHERE section_id=:uid");
$select_stmt->execute(array(":uid" => $id));

$row_messages = $select_stmt->fetch(PDO::FETCH_ASSOC);