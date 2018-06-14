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
	"archivedbserver"=>'sjcthearchive.cb1qb4plxjpf.us-east-1.rds.amazonaws.com',
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
	$conn = @new Mysqli($s, $username, $password, $d, 3306);

  if (!$conn->connect_error) 
  {
	$token = (new Builder())
	->setIssuer('https://sjcalphabroder.us-east-1.elasticbeanstalk.com') // Configures the issuer (iss claim)
	->setAudience('https://sjcalphabroder.us-east-1.elasticbeanstalk.com') // Configures the audience (aud claim)
	->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
	->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
	->setNotBefore(time() + 1) // Configures the time that the token can be used (nbf claim)
	->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
	->set('uid', 1) // Configures a new claim, called "uid"
	->sign($signer, 'testing') // creates a signature using "testing" as key
	->getToken(); // Retrieves the generated token
	  $_SESSION['LOGGEDIN']=true;
	  $_SESSION['TOKEN'] = $token;
    return true;
  } else {
    return false;
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
