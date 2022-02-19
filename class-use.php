<?php  

require_once( 'class.db.php' );
$database = new DB(DB_HOST,DB_USER,DB_PASS,DB_NAME);
date_default_timezone_set('America/Sao_Paulo');


$query = $database->query("SELECT * FROM users");
if($database->num_rows($query) > 0){
	$results = $database->get_results($query);
	echo json_encode($results);
}






$observations = $database->escape($_REQUEST['observations']);
$email = $database->escape($_REQUEST['email']);
$names = array(
	'name' => "Aron",
	'lastname' => "Selhorst",
	'birthday' => "1992-12-26",
	'observations' => $observations,
	'email' => $email,
);
$add_query = $database->insert( 'clients', $names );
if( $add_query )$clientID = $database->lastid();







$clientID = $database->escape($_REQUEST['clientID']);
$sqldelete 	= "SELECT * FROM clients WHERE clients.clientID = '$clientID' LIMIT 1";
if ($database->num_rows($sqldelete) > 0) {
	$resultsdelete 	= $database->get_results($sqldelete);
	$delete 		= array('clientID' => $idpage);
	$deleted 		= $database->delete('clients',$delete,1);
	if($deleted)echo 'DELETED!';
	ELSE echo "ERROR";
}
else echo 'INVALID';








$observations = $database->escape($_REQUEST['observations']);
$email = $database->escape($_REQUEST['email']);
$update = array(
	'type' => "star",
	'observations' => $observations,
	'email' => $email,
);
$where_clause = array('clientID' => $clientID);
$sqlupdate 	= "SELECT * FROM clients WHERE clients.clientID = '$clientID' LIMIT 1";
if ($database->num_rows($sqlupdate) > 0) {
$resultsupdate = $database->get_results($sqlupdate);
$updated = $database->update( 'clients', $update, $where_clause, 1);

?>