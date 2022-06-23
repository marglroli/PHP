<?php

class Database{
    private $dbh = NULL;
    const SERVER = "xenia.sze.hu";
    const USER = "hallgato";
    const PASSWORD = "mysql";
    const SCHEMA = "hallgatok";
    const TABLE = "hallgatok";
    //const EXAMINEE = "NPTN12";

   
    public function __construct() {
        try {
            $this->dbh = new PDO("mysql:host=".self::SERVER.";dbname=".self::SCHEMA, self::USER, self::PASSWORD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Unable to connect to the database. Error code: {$e->getCode()}, error message: {$e->getMesaage()}");
        }
    }

    public function __destruct(){
        $this->dbh=NULL;
    }

    protected function error($m, $e) {
        echo "<p>$m<br />PDO error code: {$e->getCode()}, PDO error message: {$e->getMessage()}</p>\n";
    }


    //similar to previous options - option 3 fetchObject is tricky with type date/string conversions and 
    //(fetch object doesn't follow the constructor)
    public function getStudents(){
        try{
            $students=[];
            $stmt = $this->dbh->query("SELECT neptun, nev AS name, szuldatum AS birthDate FROM hallgatok ORDER BY nev");
            foreach($stmt as $sor) {
                $stu = new Student($sor["name"], $sor["neptun"], new DateTime($sor["birthDate"]));
                $students[] = $stu;
            }
            
            return $students;
        }
        catch(PDOException $e) {
            $this->error("Unable to query student data.", $e);
        }
    }

    public function getStudent($neptun){
        try{
            $stmt = $this->dbh->query("SELECT neptun, nev AS name, szuldatum AS birthDate FROM hallgatok WHERE neptun='$neptun'");
            
            $returnString = "";
            foreach($stmt as $onlyRow) {
                $stu = new Student($onlyRow["name"], $onlyRow["neptun"], new DateTime($onlyRow["birthDate"]));
                $returnString.="<h5>$stu</h5>\n";
            }
            
            return $returnString;
            
        }
        catch(PDOException $e) {
            $this->error("Unable to query student data.", $e);
        }
    }

}