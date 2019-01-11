<?php

class DbConnect {
    private $user= "root";
    private $pass = "pwroot";

    public function connexionBDD(){

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=DBCMS', $this->user, $this->pass);
            foreach($dbh->query('SELECT * from CMS') as $row) {
                print_r($row);
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}