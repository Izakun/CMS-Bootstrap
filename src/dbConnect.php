<?php

class DbConnect {
    private $user= "root";
    private $pass = "pwroot";

    public function connexionBDD(){

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=DB_CMS', $this->user, $this->pass);
            foreach($dbh->query('SELECT * from CMS') as $row) {
                print_r($row);
                echo($row);
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}