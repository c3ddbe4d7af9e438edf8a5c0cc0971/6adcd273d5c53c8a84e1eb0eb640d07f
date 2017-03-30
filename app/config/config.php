<?php
date_default_timezone_set('Asia/Kolkata');


$config=[	
	'local'=>[
		'DB_NAME'	       =>'exam',
		'DB_USER'	       =>'root',
		'DB_PASSWORD'	   =>'',
		'DB_HOST'	       =>'127.0.0.1',
		'DRIVER'	       =>'mysql',
		'DOMAIN_URL'	   =>'http://test.com',
	],
];

if (!defined('env')) {
	define('env', 'local');
}
foreach ($config[env] as $key => $value) {
	define($key, $value);
}
?>