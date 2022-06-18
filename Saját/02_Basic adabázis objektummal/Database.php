<?php
declare(strict_types=1);

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

    //basically a toString method
    public function getAll(){
        try {
            $stmt = $this->dbh->query("SELECT neptun, nev AS name, szuldatum AS birthDate FROM hallgatok ORDER BY nev");
            
            //fetch option 1
            /*
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $student = new Student($row["name"], $row["neptun"], new DateTime($row["birthDate"]));
                echo "<p> $student </p>";
            }
            */

            // option 2 - only one (?) gets fetched if more is in
            
            $returnString = "";
            foreach($stmt as $sor) {
                $stu = new Student($sor["name"], $sor["neptun"], new DateTime($sor["birthDate"]));
                $returnString.="<h5>$stu</h5>\n";
            }
            echo $returnString;
            //echo is needed because we aren't in to_string and it's not called with echo
            //if it was __toString, return would also work instead of echo

            //option 3 - if we need an array, for example for a select
            /*
            while($s = $stmt->fetchObject("Student")) {
                $students[] = $s;
            }
            return $students;
            */


        } catch(PDOException $e) {
            $this->error("Unable to query student data.", $e);
        }
    }
    
}