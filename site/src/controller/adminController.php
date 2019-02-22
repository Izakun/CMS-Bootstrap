<?php

class adminController extends dbConnect
{
	public function getAllUser(){
		$db = $this->connectDb();
		$query = $db->prepare("SELECT * FROM users ORDER BY username ASC");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function removeUser($id){
		$db = $this->connectDb();
		$query = $db->prepare("DELETE FROM users WHERE id = ?");
		return $query->execute(array($id));
	}

	public function upgradeUser($id){

	}

	public function downgradeUser($id){
        $db = $this->connectDb();
        $query = $db->prepare("DELETE FROM users WHERE id = ?");
        return $query->execute(array($id));
	}
}