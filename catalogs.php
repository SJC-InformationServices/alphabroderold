<?php
include "archive/archive_config_inc.php";
include "archive/alpha_catalogs/alpha_catalogs.php";

$path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
$name = 'alpha_catalogs';

$path = substr($path,strpos($path,$name));
echo "$path";
/*
try{
	$API = new archive($path, null,$archiveconfig);
    echo $API->processAPI();
	
} 
catch (Exception $e){
	  echo json_encode(Array('error' => $e->getMessage()));
	}
*/	


?>