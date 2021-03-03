<?php
error_reporting(-1);
session_start();
header('Content-Type: application/json');
date_default_timezone_set("Asia/Tehran");
require_once('inc/db.php');
$conn = db_conn();
require_once('inc/functions.php');
?>
