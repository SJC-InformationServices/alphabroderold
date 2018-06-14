<?php
$root = $_SERVER["DOCUMENT_ROOT"];
require_once "$root"."/vendor/autoload.php";

$dir = sys_get_temp_dir();
session_save_path($dir);

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_errors', 'On');


$archiveconfig = array(
	"archivedbserver"=>'sjcthearchive.cb1qb4plxjpf.us-east-1.rds.amazonaws.com',
	"archivedbuser"=>'abEasyCatalog',
	"archivedbpass"=>'15bentonroad!',
	"archivedb"=>'alphabrodermaster',
	"archiveUrl"=>'http://localhost/archive/',
	"ApiLogPath"=>"/archive_library/archive_logging/archive_logs/api_logs",
	"SysLogPath"=>"/archive_library/archive_logging/archive_logs/sys_logs",
	"archive_user"=>isset($_POST['email'])?$_POST['email'] : NULL,
	"archive_pass"=>isset($_POST['pass'])?$_POST['pass'] : NULL,
	"archive_file_storage_path"=>"/var/www/html/sjcPimitArchive/archive/archive_files/storage",
	"archive_file_tmp"=>"/tmp"
	);


?>
