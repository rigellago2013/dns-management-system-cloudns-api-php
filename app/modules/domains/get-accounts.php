<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Domains.php");
require_once("../../../app/models/Accounts.php");

$database = new Database();
$db = $database->getConnection();
$accounts = new Accounts($db);

$accs = $accounts->all();

echo json_encode($accs);