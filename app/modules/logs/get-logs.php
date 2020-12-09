<?php
require_once("../../../app/lib/database.php");
require_once("../../../app/models/Logs.php");
$database = new Database();
$db = $database->getConnection();
$logs = new Logs($db);
/**
 *  Get Logs
 * 	Date: Octoner 17, 2020
 */
$query = '';
$output = array();
$query .= "SELECT * FROM logs ";

if(isset($_POST["search"]["value"])){
	$query .= 'WHERE table_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR request_method LIKE "%'.$_POST["search"]["value"].'%" ';
}else {
	$query .= 'ORDER BY id DESC ';
}

if($_POST["length"] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->prepare($query);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);
$filtered_rows = $statement->rowCount();
$data = [];
$x = 0;

foreach($result as $value) {
	$data[$x++] = [
		'id' => $value->id,
		'table_name' => $value->table_name,
		'request_method' => $value->request_method,
		'data' => substr($value->data,0,10).'...',
		'recorded_on' => $value->recorded_on,
		'button' => '<button class="btn btn-xs btn-primary view-log"> View </button> &nbsp;',
	];
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	$logs->countLogs(),
	"data"				=>	$data
);
echo json_encode($output);

