<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Accounts.php");

$database = new Database();
$db = $database->getConnection();
$accounts = new Accounts($db);
$account = $accounts->show($_POST['id']);

echo json_encode($account);
