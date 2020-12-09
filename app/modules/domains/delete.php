<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Domains.php");

$database = new Database();
$db = $database->getConnection();
$domains = new Domains($db);

if(!empty($_POST['id']) && $_POST['action'] == "delete") {
    $dns = $domains->delete($_POST);
    if($dns) {
        echo json_encode(['res' => true, 'msg' => 'Domains removed successfully.']);
    } else {
        echo json_encode(['res' => false, 'msg' => 'Error removing domain.']);
    }
}
