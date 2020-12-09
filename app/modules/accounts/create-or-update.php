<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Accounts.php");

$database = new Database();
$db = $database->getConnection();
$accounts = new Accounts($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['operation'])) {
        if($_POST['operation'] == "Add") {
            $res = $accounts->create($_POST['auth_id'], $_POST['auth_password'], $_POST['username'], $_POST['password']);
            if(!empty($res)) {
                echo json_encode(['res' => true, 'msg' => 'Account added successfully!']);
            } else {
                echo json_encode(['res' => false, 'msg' => 'Error adding account!']);
            }
        }
        if($_POST['operation'] == "Update") {
            $res = $accounts->update($_POST['authpassword'], $_POST['id'], $_POST['username'], $_POST['password']);
            if(!empty($res)) {
                echo json_encode(['res' => true, 'msg' => 'Account updated successfully!']);
            } else {
                echo json_encode(['res' => false, 'msg' => 'Error updating account!']);
            }
        }
    }
}