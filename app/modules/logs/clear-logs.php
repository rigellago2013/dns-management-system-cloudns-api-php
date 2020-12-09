<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Logs.php");
$database = new Database();
$db = $database->getConnection();
$logs = new Logs($db);

if(isset($_POST['case']) == "all") {
    $res = $logs->clearAll();
    if($res) {
        echo json_encode(['res' => true, 'msg' => 'Logs successfully removed.']);
    } else {
        echo json_encode(['res' => false, 'msg' => 'Error removing logs.']);
    }
} else if (isset($_POST['case']) == "today") {
    $res = $logs->clearToday();
    if($res) {
        echo json_encode(['res' => true, 'msg' => 'Logs successfully removed.']);
    } else {
        echo json_encode(['res' => false, 'msg' => 'Error removing logs.']);
    }
} else  if (isset($_POST['case']) == "today" && isset($_POST['from']) && isset($_POST['to'])){
    $res = $logs->clearByDate($_POST['from'],$_POST['to']);
    if($res) {
        echo json_encode(['res' => true, 'msg' => 'Logs successfully removed.']);
    } else {
        echo json_encode(['res' => false, 'msg' => 'Error removing logs.']);
    }
}