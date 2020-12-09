<?php
require_once("../../../app/shared/constants.php");
require_once('../../../app/lib/api-request.php');
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Domains.php");
require_once("../../../app/models/Maintenance.php");
$database = new Database();
$db = $database->getConnection();
$domains = new Domains($db);
$maintenance = new Maintenance($db);
$query = '';
$output = array();
$query .= "SELECT * FROM dns_records ";

if(isset($_POST["search"]["value"])){
	$query .= 'WHERE domain_name LIKE "%'.$_POST["search"]["value"].'%"';
    $query .= 'OR type LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR host LIKE "%'.$_POST["search"]["value"].'%" ';
}else {
	$query .= 'ORDER BY id DESC ';
}

if($_POST["length"] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);
$data = [];
$x = 0;

foreach($result as $value) {
	$data[$x++] = [
        // 'id' => $value->id,
        'domain_name' => $value->domain_name,
        'type' => $value->type,
        'host' => $value->host,
        'record' => substr($value->record,0,10).'...',
        'failover' => $value->fail_over,
        'ttl' => $value->ttl,
        'status' => $value->status,
        'buttons' => '<button class="btn btn-xs btn-primary edit-record"> Edit </button> &nbsp;',
	];  
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	count($data),
	"recordsFiltered"	=>	$maintenance->countDnsRecords(),
	"data"				=>	$data
);

echo json_encode($output);