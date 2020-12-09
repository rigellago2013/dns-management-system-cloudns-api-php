<?php
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Maintenance.php");

$database = new Database();
$db = $database->getConnection();
$check = new Maintenance($db);

$count = $check->countAccounts();

if($count >= 0) {
    echo json_encode(['res' => true, 'msg' => 'Success']);
} else {
    echo json_encode(['res' => false, 'msg' => 'Error']);
}