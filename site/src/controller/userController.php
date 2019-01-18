<?php

include("/../dbConnect.php");


class userController extends dbConnect
{
    public function login($request){
    	$ok = false;
    	$result = null;
    	$user = null;
		if($this->checkUsername($request["username"])){
			$db = $this->connectDb();
			$query = $db->prepare("SELECT a.id,a.username,a.password,a.email,b.admin,b.themeId FROM users a INNER JOIN preferences b ON a.id = b.userId where a.username = ?");
			$query->execute(array($request["username"]));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			if(sizeof($result) > 0){
				$ok = $this->checkPassword($request["password"], $result["password"]);
				$user = $this->setUserSession($result);
			}
		}
		// retourne l'état de l'auth et si l'auth a réussit, retourne les informations de l'utilisateur pour la session
    	return array("ok"=>$ok, "userController"=>$user);
    }

	private function setUserSession($request){
		return array(
			"id"=>$request["id"],
			"username"=>$request["username"],
			"email"=>$request["email"],
			"admin"=>$request["admin"],
			"theme"=>$request["themeId"],
		);
	}

    public function removeAccount($id){
		$db = $this->connectDb();
		$query = $db->prepare("DELETE FROM users WHERE id = ?");
		$query->execute(array($id));
	}

    public function createUser($request){
		$respons = false;
		$db = $this->connectDb();
		if(!$this->checkUsername($request["username"]) && !$this->checkEmail($request["email"])){
			$query = $db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
			$query->execute(array($request["username"], $this->hashPassword($request["password"]), $request["email"]));
			$query = $db->prepare("INSERT INTO preferences (userId, admin, themeId) VALUES (?, ?, ?)");
            $query->execute(array($db->lastInsertId(), 0, 1));
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
		$query = $db->prepare("SELECT * FROM users WHERE username = ?");
		$query->execute(array($username));
		$result = $query->fetchAll();
		if(sizeof($result) > 0){
			$respons = true;
		}
		return $respons;
	}

	private function checkEmail($email){
		$respons = false;
		$db = $this->connectDb();
		$query = $db->prepare("SELECT * FROM users WHERE email = ?");
		$query->execute(array($email));
		$result = $query->fetchAll();
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