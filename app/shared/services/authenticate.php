<?php
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Accounts.php");

$database = new Database();
$db = $database->getConnection();
$account = new Accounts($db);
$account = $account->authenticate($_POST['username'],$_POST['password']);

if($account) {   
    $rawToken = [
        'user_id' => $account->id,
        'exp' => date('Y-m-d', strtotime('+1 day'))
    ];
    $encodedPayload = base64_encode(json_encode($rawToken));
    $secret = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(64/strlen($x)) )),1,64);
    $signature = hash_hmac('sha256',$encodedPayload,$secret);
    $signedToken = [
        'user_id' => $account->id,
        'exp' => date('Y-m-d', strtotime('+1 day')),
        'signature' => $signature
    ];
    
    $authenticationToken = base64_encode(json_encode($signedToken));
    setcookie('auth_token', $authenticationToken, time() + (86400 * 30), "/");
    echo json_encode(['user' => ['username' => $account->username, 'auth_id' => $account->auth_id], 'auth_token' => $authenticationToken, 'success' => true]);
} else {
    echo json_encode(['user' => null, 'auth_token' => null, 'success' => false]);
}
