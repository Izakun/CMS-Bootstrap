<?php

require_once("/../dbConnect.php");


class userController
{
    private $id;
    private $username;
    private $email;
    private $admin;
    private $theme;
    private $db;
    private $con;

    public function __construct(dbConnect $db)
    {
        $this->db = $db;
        $this->con = $db->connectDb();
    }

    public function login($request){
    	$ok = false;
    	$result = null;
    	$user = null;
		if($this->checkUsername($request["username"])){
			$query = $this->con->prepare("SELECT a.id,a.username,a.password,a.email,a.admin,b.themeId FROM users a INNER JOIN preferences b ON a.id = b.userId where a.username = ?");
			$query->execute(array($request["username"]));
			$result = $query->fetch(PDO::FETCH_ASSOC);
			if(sizeof($result) > 0){
				$ok = $this->checkPassword($request["password"], $result["password"]);
				$this->setId($result["id"]);
				$this->setUsername($result["username"]);
				$this->setEmail($result["email"]);
				$this->setAdmin($result["admin"]);
				$this->setTheme($result["themeId"]);
				$user = $this->setUserSession();
			}
		}
		// retourne l'état de l'auth et si l'auth a réussit, retourne les informations de l'utilisateur pour la session
        $this->db->closeCon($this->db);
    	return array("ok"=>$ok, "userController"=>$user);
    }

	private function setUserSession(){
		return array(
			"id"=>$this->getId(),
			"username"=>$this->getUsername(),
			"email"=>$this->getEmail(),
			"admin"=>$this->getAdmin(),
			"theme"=>$this->getTheme(),
		);
	}

    public function removeAccount($id){
		$query = $this->con->prepare("DELETE FROM users WHERE id = ?");
		$query->execute(array($id));
        $this->db->closeCon($this->db);
	}

    public function createUser($request){
		$respons = false;
		if(!$this->checkUsername($request["username"]) && !$this->checkEmail($request["email"])){
			$query = $this->con->prepare("INSERT INTO users (username, password, email, admin) VALUES (?, ?, ?, ?)");
			$query->execute(array($request["username"], $this->hashPassword($request["password"]), $request["email"], 0));
			$query = $this->con->prepare("INSERT INTO preferences (userId, themeId) VALUES (?, ?)");
            $respons = $query->execute(array($this->db->connectDb()->lastInsertId(), 1));
		}
        $this->db->closeCon($this->db);
		return $respons;
	}

	private function hashPassword($password){
		return hash('sha256',$password);
	}

	private function checkUsername($username){
		$respons = false;
		$query = $this->con->prepare("SELECT * FROM users WHERE username = ?");
		$query->execute(array($username));
		$result = $query->fetchAll();
		if(sizeof($result) > 0){
			$respons = true;
		}
        $this->db->closeCon($this->db);
		return $respons;
	}

	private function checkEmail($email){
		$respons = false;
		$query = $this->con->prepare("SELECT * FROM users WHERE email = ?");
		$query->execute(array($email));
		$result = $query->fetchAll();
		if(sizeof($result) > 0){
			$respons = true;
		}
		$this->db->closeCon($this->db);
		return $respons;
	}

	private function checkPassword($password, $passwordHash){
		$respons = false;
		if($this->hashPassword($password) === $passwordHash)
			$respons = true;
		return $respons;
	}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getAdmin()
    {
        return $this->admin;
    }

    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }
}