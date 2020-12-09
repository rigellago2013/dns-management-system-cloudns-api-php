<?php
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Maintenance.php");

$database = new Database();
$db = $database->getConnection();
$maintenance = new Maintenance($db);
$data = $maintenance->syncAll();
$accounts = $maintenance->countAccounts();
$domains = $maintenance->countDomains();
$dns_records = $maintenance->countDnsRecords();

if($data) {
    $date=date_create($data->recorded_on);
    echo json_encode(['res' => true, 'msg' => 'Data successfully synced!', 'time' => ' Last updated: '.date_format($date,'g:ia \o\n l jS F Y'), 'acc_count' => $accounts, 'dom_count' => $domains, 'dns_count' => $dns_records]);
} else {
    echo json_encode(['res' => false, 'msg' => 'Error syncing all data.']);
}