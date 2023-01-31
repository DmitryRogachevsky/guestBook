<?php

class Database{
	protected static $serverName = "localhost";
	protected static $dbName = "guestBook";
	protected static $db_password = "root";
	protected static $db_login = "root";
	protected static $tableName = "reviewsBook";

	protected static $connect;

	public function __construct(){
		$this->createDatabase();
		self::createConnection();
		$this -> createTable();
		$this -> insertData();
	}
	
	private function createDatabase(){
		$connect = self::$connect;
		$connect = new mysqli(self::$serverName, self::$db_login, self::$db_password);
		if ($connect -> connect_error) die("Connection failed: " . $connect -> connect_error);
		$sql = "CREATE DATABASE IF NOT EXISTS `" . self::$dbName . "`";
		if ($connect->query($sql) !== TRUE)
		{
			echo "Error creating database: " . $connect->error;
		}
		$connect->close();
	}

	public static function createConnection(){
		$connect = self::$connect;
		$connect = new mysqli(self::$serverName, self::$db_login, self::$db_password, self::$dbName);
		if ($connect -> connect_error) die("Connection failed: $connect -> connect_error");
		return $connect;
	}

	public function createTable(){
	 	$sql = "CREATE TABLE IF NOT EXISTS `" . self::$tableName . "` (
	 	 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	 	 user_name VARCHAR(20) NOT NULL , 
	 	 message VARCHAR(256) NOT NULL , 
	 	 date DATETIME NOT NULL
	 	)";
	 	self::createConnection()->query($sql);
	 	self::createConnection()->close();
	}

	public function insertData(){
		$params = DataProcessing::sendDataFromFormByDB();
		if (!$params["user_name"] || !$params["message"]) return false;
		$sql = "INSERT INTO `" . self::$tableName . "` (`user_name`, `message`, `date`) VALUES ('" . $params['user_name'] . "', '" . $params["message"] . "', NOW())";
        self::createConnection()->query($sql);
        self::createConnection()->close();
        header('Location: ' . $_SERVER["REQUEST_URI"]);
	}

	public static function getDataFromDB(){
		$sql = "SELECT `user_name`, `message`, `date` FROM `" . self::$tableName . "`";
		if($result = self::createConnection()->query($sql)){
			$rows = $result->fetch_all(MYSQLI_ASSOC);
		}
		return $rows;
		self::createConnection()->close();
	}

}