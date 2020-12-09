<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/DnsRecords.php");

$database = new Database();
$db = $database->getConnection();
$dnsrecords = new DnsRecords($db);

if(!empty($_POST['id']) && $_POST['action'] == "delete") {
    $dns = $dnsrecords->delete($_POST['id']);
    if($dns) {
        echo json_encode(['res' => true, 'msg' => 'Record removed successfully!']);
    } else {
        echo json_encode(['res' => false, 'msg' => 'Error removing record!']);
    }
}
