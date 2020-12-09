<?php
/**
 * Sync Domains 
 * Date: October 17, 2020 
 * 
 */
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Domains.php");
require_once("../../../app/models/Accounts.php");

$database = new Database();
$db = $database->getConnection();
$accounts = new Accounts($db);
$domains = new Domains($db);
$accs = $accounts->all();
$rows_per_page = 10;
if ($domains->clear()) {
    foreach ($accs as $value) {
        $pages_count = callAPI('GET', base_url_pages_count . '?auth-id=' . $value->auth_id . '&auth-password=' . $value->auth_password . '&rows-per-page=' . $rows_per_page, false);
        for ($i = $pages_count; $i <= $pages_count; $i++) {
            $data = callAPI('GET', base_url_domains_list . '?auth-id=' . $value->auth_id . '&auth-password=' . $value->auth_password . '&rows-per-page=' . $rows_per_page . '&page=' . $i, false);
            $res =  $domains->checkDuplicateDeleteorCreate($data, $value->id);
        }
    }
    if ($res) {
        echo json_encode(['res' => true, 'msg' => 'Domains successfully synced.']);
    } else {
        echo json_encode(['res' => true, 'msg' => 'Domains successfully synced.']);
    }
}
