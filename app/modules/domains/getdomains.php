<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Maintenance.php");
$database = new Database();
$db = $database->getConnection();
$maintenance = new Maintenance($db);

/**
 *  Convert to method using Domains Model
 * 
 */

$query = '';
$output = array();
$query .= "SELECT 
			d.id AS d_id, d.name AS d_name, d.status AS d_status, d.registered_on AS d_registered_on, d.expires_on AS d_expires_on,
			d.privacy_protection AS d_privacy_protection, d.account_id as d_acc_id, a.username AS a_username
			FROM domains d LEFT JOIN accounts a ON d.account_id = a.id ";

if(isset($_POST["search"]["value"])){
	$query .= 'WHERE d.name LIKE "%'.$_POST["search"]["value"].'%"';
	$query .= 'OR a.username LIKE "%'.$_POST["search"]["value"].'%" ';
} else {
	$query .= 'ORDER BY d_id DESC ';
}
// if(isset($_POST["order"]))
// {
// 	$query .= 'ORDER BY '.$_POST['columns']['0']['name'].' '.$_POST['order']['0']['dir'].' ';
// }

if($_POST["length"] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = [];
$x = 0;

foreach($result as $value) {
	$curr_date = date_create(date("Y-m-d"));
	$expires_on = date_create($value['d_expires_on']);
	$interval = date_diff($curr_date, $expires_on);
	$data[$x++] = [
		'd_id' => $value['d_id'],
		'name' => $value['d_name'],
		'status' => $value['d_status'],
		'registered_on' => $value['d_registered_on'],
		'expires_on' => $value['d_expires_on'],
		'privacy_protection' => $value['d_privacy_protection'] == '1' ? 'ON' : 'OFF',
		'username' => $value['a_username'],
		'days_remaining' => $interval->format('%R%a days'),
		'buttons' => '<center>'.
					'<button type="button" data-toggle="modal" data-target="#nameServersModal" name="btn-view-name-server" data="'.$value['d_name'].'" id="'.$value["d_acc_id"].'" class="btn btn-primary btn-xs btn-view-name-server" action="view">View Name Servers</button>'. 
					'<button type="button" name="btn-view-dns-records" id="'.$value["d_name"].'" data="'.$value['d_name'].'" class="btn btn-success btn-xs btn-view-dns-records" action="view-dns">View DNS Records</button>'.
					'<button type="button" name="btn-delete-domain" id="'.$value["d_id"].'" data="'.$value['d_name'].'" class="btn btn-danger btn-xs btn-delete-domain" action="delete">Delete</button>'.
					'</center>'
	];
}



$filtered_rows = $statement->rowCount();
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$maintenance->countDomains(),
	"data"				=>	$data
);
echo json_encode($output);

