<?php
/**
* 
*/
class DB
{
	private static $instance=array();

	private function __construct($db){

		$instance=new PDO(DRIVER.':host='.DB_HOST.';dbname='.$db.';charset=utf8',DB_USER,DB_PASSWORD);
		$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		self::$instance[$db]=$instance;

	}

	public static function getInstance($name=''){
		if ($name=='') {
			$name=DB_NAME;
		}
		if (!isset(self::$instance[$name])) {
			new DB($name);
		}
		return self::$instance[$name];
	}
}
?>