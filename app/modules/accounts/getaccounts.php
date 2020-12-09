<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Maintenance.php");
require_once("../../../app/models/Domains.php");
$database = new Database();
$db = $database->getConnection();
$maintenance = new Maintenance($db);
$domains = new Domains($db);
/**
 *  Convert to method using Accounts Model
 * 
 */
$query = '';
$output = array();
$query .= "SELECT * FROM accounts ";

if(isset($_POST["search"]["value"])){
	$query .= 'WHERE auth_id LIKE "%'.$_POST["search"]["value"].'%"';
}else {
	$query .= 'ORDER BY auth_id DESC ';
}

if($_POST["length"] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$filtered_rows = $statement->rowCount();
$rows = [];
$x = 0;

foreach ($result as $value) {
	$rows[$x++] = [
		'id' => $value['id'],
		'username' => $value['username'],
		'password' => '<input name="viewPass" type="password" value="'. $value['password'].'" readonly/>
		<button type="button" name="dynamicPass" class="btn btn-default" onclick="showHidePassword()"><i class="fa fa-eye" aria-hidden="true"></i></button>',
		'auth_id' => $value['auth_id'],
		'auth_password' => '<input name="viewAuthPass" type="password" value="'. $value['auth_password'].'" readonly/>
		<button type="button" name="dynamicAuthPass" class="btn btn-default" onclick="showHideAuthPassword()"><i class="fa fa-eye" aria-hidden="true"></i></button>',
		'domain_count' => $domains->countPerAccount($value['id']),
		'buttons' => '<center>'. '<button type="button" name="view-account" id="'.$value["id"].'" class="btn btn-primary btn-xs view-account" action="view">View</button>'. '&nbsp;'.'<button type="button" name="update-account" id="'.$value["id"].'" class="btn btn-success btn-xs update-account" action="edit">Update</button>'.'&nbsp;'.'<button type="button" name="delete-account" id="'.$value["id"].'" class="btn btn-danger btn-xs delete-account" action="delete">Remove</button></center>'
	];
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$maintenance->countAccounts(),
	"data"				=>	$rows
);
echo json_encode($output);
