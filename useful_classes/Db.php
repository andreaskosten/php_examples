<?php

class Db
{
	private static $instance = null;
	public static $accessLevel;
	public $pdo;
	
	
	protected function __construct(){}
	
	
	public static function getInstance($accessLevel)
	{
		if (isset(self::$accessLevel) && self::$accessLevel != $accessLevel) {
			return self::prepareNeededInstance($accessLevel);
		}
		
		if (!isset(self::$instance)) {
			return self::prepareNeededInstance($accessLevel);
		}
		
		return self::$instance;
	}
	
	
	private static function prepareNeededInstance($accessLevel)
	{
		if ($accessLevel == 'S') {
			$DB_USER = DB_USER_SELECTER;
			$DB_PASS = DB_PASS_SELECTER;
		}

		if ($accessLevel == 'SI') {
			$DB_USER = DB_USER_INSERTER;
			$DB_PASS = DB_PASS_INSERTER;
		}

		if ($accessLevel == 'SIU') {
			$DB_USER = DB_USER_UPDATER;
			$DB_PASS = DB_PASS_UPDATER;
		}

		if ($accessLevel == 'SIUD') {
			$DB_USER = DB_USER_DELETER;
			$DB_PASS = DB_PASS_DELETER;
		}

		if (!isset($DB_USER)) {
			exit('Db: accessLevel error!');
		} else {
			self::$accessLevel = $accessLevel;
		}

		self::$instance = new static();
		$dsn = "mysql:host=localhost;port=3306;dbname=" . DB_NAME . ";charset=utf8";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		];
		self::$instance->pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
		return self::$instance;
	}
}


/*
$request = Db::getInstance('S')->pdo->prepare($query);
$request = Db::getInstance('S')->pdo->query($query);
*/
