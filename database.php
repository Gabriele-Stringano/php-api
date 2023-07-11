<?php

// Env configuration
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


class Database
	{
		private $host;
		private $db_name;
		private $username;
		private $password;
		public $conn;
	
		public function __construct()
		{
			// Retrieve the environment variables and assign them to class properties
			$this->host = $_ENV['HOST'];
			$this->db_name = $_ENV['DB_NAME'];
			$this->username = $_ENV['USER'];
			$this->password = $_ENV['PASSWORD'];
		}

	
	// DB connection
	public function getConnection()
		{
		$this->conn = null;
		try
			{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
			}
		catch(PDOException $exception)
			{
			echo "Connecting error: " . $exception->getMessage();
			}
		return $this->conn;
		}
	} 
