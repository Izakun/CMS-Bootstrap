<?php

class dbConnect {
	private $host = "localhost";
	private $dbName = "DB_CMS";
	private $username= "root";
	private $password = "root";

	public function connectDb(){
		return new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->username, $this->password);
	}

}