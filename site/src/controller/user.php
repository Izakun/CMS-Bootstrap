<?php

include "../dbConnect.php";


class user extends dbConnect
{
    public function auth($username, $password){
    	$respons = false;
    	$db = $this->connectDb();
    	$req = $db->prepare("SELECT password FROM Utilisateur WHERE username = :USERNAME");
    	$req->bindParam("USERNAME", $username);
    	$req->execute();
    	$result = $req->fetchAll();
    	if(!isset($result) && !empty($result)){
			$this->checkPassword($password, $result);
		}
    	return $respons;
    }

    public function createUser($username, $password, $email){
		$respons = false;
		$db = $this->connectDb();
		if(!$this->checkUsername("username", $username)){
			if(!$this->checkEmail("email", $email)){
				$req = $db->prepare("INSERT INTO Utilisateur (username, password, email) VALUES (:USERNAME, :PASSWORD, :EMAIL)");
				$req->bindParam("USERNAME", $username);
				$req->bindParam("PASSWORD", $this->hashPassword($password));
				$req->bindParam("EMAIL", $email);
				$req->execute();
				$respons = true;
			}
		}
		return $respons;
	}

	private function hashPassword($password){

	}

	private function check($champ, $data){
		$respons = false;
		$db = $this->connectDb();
		$req = $db->prepare("SELECT :CHAMP FROM Utilisateur WHERE email = :DATA");
		$req->bindParam("CHAMP", $champ);
		$req->bindParam("DATA", $data);
		$result = $req->fetchAll();
		if(!isset($result) && !empty($result)){
			$respons = true;
		}
		$req->execute();
		return $respons;
	}

	private function checkPassword($password, $passwordHash){
		$respons = false;

		return $respons;
	}
}