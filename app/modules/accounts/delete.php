<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Accounts.php");

$database = new Database();
$db = $database->getConnection();
$accounts = new Accounts($db);

if(!empty($_POST['id']) && $_POST['action'] == "delete")
$account = $accounts->delete($_POST['id']);
if($account) {
    echo json_encode(['res' => true, 'msg' => 'Account removed successfully!']);
} else {
    echo json_encode(['res' => false, 'msg' => 'Error removing account!']);
}
