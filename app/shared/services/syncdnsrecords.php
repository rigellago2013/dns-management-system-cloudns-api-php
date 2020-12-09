<?php
/**
 * Sync Domains 
 * Date: October 22, 2020 
 */
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Domains.php");
require_once("../../../app/models/Accounts.php");
require_once("../../../app/models/DnsRecords.php");
$database = new Database();
$db = $database->getConnection();
$domains = new Domains($db);
$accounts = new Accounts($db);
$dns = new DnsRecords($db);
$dns->clear();
$accs = $accounts->all();
$x = 0;
$rows_per_page = 10;
$new_arr = [];

if($dns) {
    foreach ($accs as $value) {
        //Count total page
        $pages_count = callAPI('GET', base_url_dns_records_pages_count . "?auth-id={$value->auth_id}&auth-password={$value->auth_password}&rows-per-page={$rows_per_page}", false);
        for ($i = $pages_count; $i <= $pages_count; $i++) {
            //Get zones list
            $zone_list = callAPI('GET', base_url_dns_list_zones . "?auth-id={$value->auth_id}&auth-password={$value->auth_password}&rows-per-page={$rows_per_page}&page={$i}", false);
            if (!empty($zone_list)) {
                // $zones = get_object_vars(json_decode($zone_list));
                foreach (json_decode($zone_list) as $key => $zone) {
                    //Get records for each zones
                    $dns_records = callAPI('GET', base_url_dns_records_list . "?auth-id={$value->auth_id}&auth-password={$value->auth_password}&domain-name={$zone->name}", false);
                    $vars = get_object_vars(json_decode($dns_records));
                    if (count($vars) > 0) {
                        // Convert to new array
                        foreach ($vars as $val) {
                            //Create record
                            $dns->create([
                                'id' => $val->id,
                                'domain_name' => $zone->name,
                                'type' => $val->type,
                                'host' =>  $val->host,
                                'record' =>  $val->record,
                                'failover' =>  $val->failover == '1' ? 'ON' : 'OFF',
                                'ttl' =>  $val->ttl,
                                'status' => $val->status == '1' ? 'ON' : 'OFF'
                            ]);
                            //Iterate to create new array;
                            $new_arr[$x++] = [
                                'id' => $val->id,
                                'domain_name' => $zone->name,
                                'type' => $val->type,
                                'host' =>  $val->host,
                                'record' =>  $val->record,
                                'failover' =>  $val->failover == '1' ? 'ON' : 'OFF',
                                'ttl' =>  $val->ttl,
                                'status' => $val->status == '1' ? 'ON' : 'OFF',
                                'actions' => '<button class="btn btn-primary btn-xs edit-record"> View </button>'
                            ];
                        }
                    }
                }
            }
        }
    }
    if(count($new_arr) > 0){
        echo json_encode(['res' => true, 'msg' => 'Success', 'data' => $new_arr]);
    } else {
        echo json_encode(['res' => false, 'msg' => 'Success', 'data' => []]);
    }
}

