<?php
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Domains.php");
require_once("../../../app/models/Accounts.php");

$database = new Database();
$db = $database->getConnection();
$accounts = new Accounts($db);
$domains = new Domains($db);

if(isset($_GET['a_id']) && isset($_GET['d_name']) ) {

    $account = $accounts->show($_GET['a_id']);
    $data = callAPI('GET',base_url_name_servers_list."?auth-id={$account['auth_id']}&auth-password={$account['auth_password']}&domain-name={$_GET['d_name']}", false);
    $domains = json_decode($data);
    $arr = [];
    $x = 0;

    foreach($domains as $value) {
        $arr[$x++] = [
            'id' => $x,
            'name' => $value
        ];
    }

    echo json_encode($arr);
}