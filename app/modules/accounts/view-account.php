<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Accounts.php");
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');

$database = new Database();
$db = $database->getConnection();
$accounts = new Accounts($db);
$account = $accounts->show($_POST['id']);


$account_balance = callAPI('GET', base_url_account_balance.'?auth-id='.$account['auth_id'].'&auth-password='.$account['auth_password'], false);
$acc_balance = json_decode($account_balance);
$acc = [
    'auth_id' => $account['auth_id'],
    'auth_password' => $account['auth_password'],
    'username' => $account['username'],
    'password' => $account['password'],
    'account_balance' => isset($acc_balance->funds) ? $acc_balance->funds : '0.00'
    
];
echo json_encode($acc);
