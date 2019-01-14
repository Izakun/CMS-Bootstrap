<?php

include("/../dbConnect.php");


class user extends dbConnect
{
    public function auth($username, $password){
    	$respons = false;
		if($this->checkUsername($username)){
			$db = $this->connectDb();
			$req = $db->prepare("SELECT password FROM Utilisateur WHERE username = ?");
			$req->execute(array($username));
			$result = $req->fetchAll();
			if(sizeof($result) > 0){
				$this->checkPassword($password, $result[0]["password"]);
				$respons = true;
			}
		}
    	return $respons;
    }

    public function createUser($username, $password, $email){
		$respons = false;
		$db = $this->connectDb();
		if(!$this->checkUsername($username)){
			if(!$this->checkEmail($email)){
				$password_hash = $this->hashPassword($password);
				$req = $db->prepare("INSERT INTO Utilisateur (username, password, email) VALUES (?, ?, ?)");
				$req->execute(array($username, $this->hashPassword($password), $email));
				$respons = true;
			}
		}
		return $respons;
	}

	private function hashPassword($password){
    	//salted password
		return hash('sha256',$password);
	}

	private function checkUsername($username){
		$respons = false;
		$db = $this->connectDb();
		$req = $db->prepare("SELECT * FROM Utilisateur WHERE username = ?");
		$req->execute(array($username));
		$result = $req->fetchAll();
		if(sizeof($result) > 0){
			$respons = true;
		}
		return $respons;
	}

	private function checkEmail($email){
		$respons = false;
		$db = $this->connectDb();
		$req = $db->prepare("SELECT * FROM Utilisateur WHERE email = ?");
		$req->execute(array($email));
		$result = $req->fetchAll();
		if(sizeof($result) > 0){
			$respons = true;
		}
		return $respons;
	}

	private function checkPassword($password, $passwordHash){
		$respons = false;
		if($this->hashPassword($password) === $passwordHash)
			$respons = true;
		return $respons;
	}
}