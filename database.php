<?php

// Env configuration
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


class Database
{
	private $HOST;
	private $DB_NAME;
	private $USERNAME;
	private $PASSWORD;
	public $conn;

	public function __construct()
	{
		// Retrieve the environment variables and assign them to class properties
		$this->HOST = $_ENV['HOST'];
		$this->DB_NAME = $_ENV['DB_NAME'];
		$this->USERNAME = $_ENV['USER'];
		$this->PASSWORD = $_ENV['PASSWORD'];
	}


	// DB connection
	public function getConnection()
	{
		$this->conn = null;
		try {
			$this->conn = new PDO("mysql:host=" . $this->HOST . ";dbname=" . $this->DB_NAME, $this->USERNAME, $this->PASSWORD);
			$this->conn->exec("set names utf8");
		} catch (PDOException $exception) {
			echo "Connecting error: " . $exception->getMessage();
		}
		return $this->conn;
	}
}
