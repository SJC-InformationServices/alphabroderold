<?php

$root = $_SERVER["DOCUMENT_ROOT"];
require_once "$root"."/vendor/autoload.php";
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\ValidationData;

$dir = sys_get_temp_dir();
session_save_path($dir);
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_errors', 'On');


$archiveconfig = array(
	"archivedbserver"=>'sjc-archive-prod.cluster-cpi3jpipzm32.us-east-1.rds.amazonaws.com',
	"archivedbuser"=>'',
	"archivedbpass"=>'',
	"archivedb"=>'sjcAlphaBroderArchive',
	"archiveUrl"=>'http://localhost/archive/',
	"ApiLogPath"=>"/archive_library/archive_logging/archive_logs/api_logs",
	"SysLogPath"=>"/archive_library/archive_logging/archive_logs/sys_logs",
	"archive_user"=>isset($_POST['email'])?$_POST['email'] : NULL,
	"archive_pass"=>isset($_POST['pass'])?$_POST['pass'] : NULL,
	"archive_file_storage_path"=>"/var/www/html/sjcPimitArchive/archive/archive_files/storage",
	"archive_file_tmp"=>"/tmp"
	);


function login($username, $password) {
	global $archiveconfig;
	$s = $archiveconfig['archivedbserver'];
	$d = $archiveconfig['archivedb'];
    try {
        $conn = @new Mysqli($s, $username, $password, $d, 3306);
    }catch(exception $e){
		print_r($e);
	}
  if (!$conn->connect_error) {
	$_SESSION['loggedin'] = "TRUE";
   return true; 
  } else {
	session_destroy();
    return false
  }
}

function validateToken($token) 
{
	$data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
	$data->setIssuer('https://sjcalphabroder.us-east-1.elasticbeanstalk.com');
	$data->setAudience('https://sjcalphabroder.us-east-1.elasticbeanstalk.com');
	$data->setId('4f1g23a12aa');
	return $token->validate($data);

}

?>
