<?php
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Maintenance.php");

$database = new Database();
$db = $database->getConnection();
$maintenance = new Maintenance($db);

$data = $maintenance->getLatestSyncAllRecord();


if($data) {
    echo json_encode(['res' => true, 'msg' => 'Success', 'time' => date("jS F, Y", strtotime($data->recorded_on)) ]);
} else {
    echo json_encode(['res' => true, 'msg' => 'Success', 'time' => '']);
}