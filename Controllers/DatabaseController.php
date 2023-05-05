<?php

namespace Controllers;

use PDO;


class DatabaseController {

	private $host;
	private $dbname;
	private $username;
	private $password;
	public $pdo;

	public function __construct($host, $dbname, $username, $password) {
		$this->host = $host;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->password = $password;
		$this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	}

	// Database query method
	public function query($query, $params = array()) {
		$stmt = $this->pdo->prepare($query);
		$stmt->execute($params);
		return $stmt;
	}
	
}

?>