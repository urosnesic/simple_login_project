<?php
class Database {
	private static $_instance = null;
	private $_db;
	private $_error = null;

	private function __construct() {
		$this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($this->_db->connect_errno) {
			$this->_error = die("Something went wrong. Could not connect to database.");
			return $this->_error;
		}
	}

	public static function getInstance() {
		if (self::$_instance === null) {
			self::$_instance = new Database();
		}
		return self::$_instance->_db;
	}
}

?>