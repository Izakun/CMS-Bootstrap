<?php

class adminController
{
    private $db;
    private $con;

    public function __construct(dbConnect $db)
    {
        $this->db = $db;
        $this->con = $db->connectDb();
    }

	public function getAllUser(){
		$query = $this->con->prepare("SELECT * FROM users ORDER BY username ASC");
		$query->execute();
		$this->db->closeCon($this->db);
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function removeUser($id){
		$query = $this->con->prepare("DELETE FROM users WHERE id = ?");
        $this->db->closeCon($this->db);
		return $query->execute(array($id));
	}

	public function upgradeUser($id){
        $query = $this->con->prepare("UPDATE users SET admin = 1 WHERE id = ?");
        $this->db->closeCon($this->db);
        return $query->execute(array($id));
	}

	public function downgradeUser($id){
        $query = $this->con->prepare("UPDATE users SET admin = 0 WHERE id = ?");
        $this->db->closeCon($this->db);
        return $query->execute(array($id));
	}
}