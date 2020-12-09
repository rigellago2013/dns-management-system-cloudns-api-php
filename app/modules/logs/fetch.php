<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Logs.php");
$database = new Database();
$db = $database->getConnection();
$logs = new Logs($db);
$log = $logs->show($_POST['id']);
echo json_encode($log);
