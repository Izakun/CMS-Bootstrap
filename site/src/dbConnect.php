<?php

class dbConnect {
	private $host = "localhost";
	private $dbName = "db_cms";
	private $username= "root";
	private $password = "root";

	public function connectDb(){
		return new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->username, $this->password);
	}

}