<?php

require_once("/../dbConnect.php");

class articleController
{
    private $db;
    private $con;

    public function __construct(dbConnect $db)
    {
        $this->db = $db;
        $this->con = $db->connectDb();
    }

	public function create($request){
        $respons = false;
        $query = $this->con->prepare("INSERT INTO articles (title, content, comment, create_date, visible, authorId) VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?, ?)");
        $respons = $query->execute(array($request["title"], $request["subject"], $request["comment"], $request["show"], $request["author"]));
        $this->db->closeCon($this->db);
        var_dump($respons);die;
        return $respons;
	}

	public function update($request){
        $this->db->closeCon($this->db);
	}

	public function remove($id){
        $this->db->closeCon($this->db);
	}

	public function changeVisibility($request){
        $this->db->closeCon($this->db);
	}

	public function changeComment($request){
        $this->db->closeCon($this->db);
	}

}