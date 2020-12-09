<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/DnsRecords.php");

$database = new Database();
$db = $database->getConnection();
$dns_records = new DnsRecords($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['operation'])) {
        if($_POST['operation'] == "Add") {
            $res = $dns_records->create($_POST);
            if(!empty($res)) {
                echo json_encode(['res' => true, 'msg' => 'Record added successfully.']);
            } else {
                echo json_encode(['res' => false, 'msg' => 'Error adding record.']);
            }
        }
        if($_POST['operation'] == "Edit") {
            $res = $dns_records->update($_POST);
            if(!empty($res)) {
                echo json_encode(['res' => true, 'msg' => 'Record updated successfully.']);
            } else {
                echo json_encode(['res' => false, 'msg' => 'Error updating record.']);
            }
        }
    }
}