<?php
if(!isset($_SESSION)) { 
	session_start(); 
} 
require_once 'framework/Route.php';
require_once 'framework/Model.php';
require_once 'framework/Database.php';
require_once 'framework/View.php';
require_once 'framework/Auth.php';




require_once 'helper/Helper.php';
require_once 'helper/Input.php';
require_once 'helper/Validator.php';
require_once 'helper/Json.php';

require_once 'config/config.php';
require_once 'config/error.php';



require_once 'lib/vendor.php';

function autoload($class){
	require_once '../app/model/'.$class.'.php';
}
spl_autoload_register('autoload');
?>