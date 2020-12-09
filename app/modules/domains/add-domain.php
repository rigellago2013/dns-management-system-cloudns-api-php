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

$account = $accounts->show($_POST['acc_id']);
$data = callAPI('GET',base_url_add_domain.'?auth-id='.$account['auth_id'].'&auth-password='.$account['auth_password'].'&domain-name='.$_POST['dname'].'&tld='.$_POST['tld'].'&period='.$_POST['period'].'&mail='.$_POST['email'].'&name='.$_POST['name'].'&address='.$_POST['address'].'&city='.$_POST['city'].'&state='.$_POST['state'].'&zip='.$_POST['zip'].'&country='.$_POST['country'].'&telnocc='.$_POST['telnocc'].'&telno='.$_POST['telno'],false);
$array_data = json_decode($data, true);

if($array_data['status'] != "Failed") {
    //Get domain info
    $domain_name = $_POST['dname'].'.'.$_POST['tld'];
    $domain = callAPI('GET',base_url_domain_info."?auth-id={$account['auth_password']}&auth-password={$account['auth_id']}&domain-name={$domain_name}", false);
    
    $domain_data = json_decode($domain, true);

    //Insert to DB
    $arr = [
        'name' => $domain_data['name'],
        'status' => ($domain_data['status'] == 0 ? 'expired' :($domain_data['status'] == 1 ? 'active' :($domain_data['status'] == 2 ? 'transfer' :($domain_data['status'] == 3 ? 'transfer_faied' : '')))),
        'registered_on' => $domain_data['registered_on'],
        'expires_on' => $domain_data['expire_on'],
        'privacy_protection' => $domain_data['privacy_protection_status']
    ];

    $res = $domains->insert($arr);

    if($res) {
        echo json_encode(['res' => true, 'msg' => 'Domain successfully added!']);
    }

} else if($array_data['status'] === "Failed") {
    echo json_encode(['res' => false, 'msg' => $array_data['statusDescription']]);
}
