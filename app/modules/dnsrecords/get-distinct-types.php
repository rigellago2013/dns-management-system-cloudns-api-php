<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/DnsRecords.php");

$database = new Database();
$db = $database->getConnection();
$dns = new DnsRecords($db);

$doms = $dns->distinctTypes();

echo json_encode($doms);