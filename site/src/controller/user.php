<?php

include("/../dbConnect.php");


class user extends dbConnect
{
    public function login($request){
    	$ok = false;
    	$result = null;
		if($this->checkUsername($request["username"])){
			$db = $this->connectDb();
			$req = $db->prepare("SELECT * FROM Utilisateur WHERE username = ?");
			$req->execute(array($request["username"]));
			$result = $req->fetchAll();
			if(sizeof($result) > 0){
				$this->checkPassword($request["password"], $result[0]["password"]);
				$ok = true;
			}
		}
		// retourne l'état de l'auth et si l'auth a réussit, retourne les informations de l'utilisateur pour la session
    	return array("ok"=>$ok, "user"=>$result[0]);
    }

    public function createUser($request){
		$respons = false;
		$db = $this->connectDb();
		if(!$this->checkUsername($request["username"]) && !$this->checkEmail($request["email"])){
			$req = $db->prepare("INSERT INTO Utilisateur (username, password, email) VALUES (?, ?, ?)");
			$req->execute(array($request["username"], $this->hashPassword($request["password"]), $request["email"]));
			$respons = true;
		}
		return $respons;
	}

	private function hashPassword($password){
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