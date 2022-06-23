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

    public function __toString(){
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
            return $returnString;
            //echo is needed if we aren't in to_string 

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

    //function could return with a boolean value based on the number of affected rows - see Mintavizsga
    public function insertStudent($name, $neptun, $birthdate){
        try {
            //option 1
            //exec is needed, everything between ' ' in this version - even date!
            /*
            $stmt=$this->dbh->exec(
            "INSERT INTO hallgatok (neptun, nev, szuldatum) VALUES ('$neptun', '$name', '$birthdate')");
            */

            //option 2 - also Traversy Crash Course
            //the function parameter can also be an object and then we would use getter functions instead of variables
            $stmt = $this->dbh->prepare("insert into ".self::TABLE." values (:neptun ,:name, :birthdate)");
            $stmt->bindValue(":neptun", $neptun);
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":birthdate", $birthdate);//there could be formats: see Adatbáziskezelés/PDO
            $stmt->execute();

        } catch(PDOException $e) {
        $this->error("Unable to insert student into database.", $e);
        } 
    }

    //function could return with a boolean value based on the number of affected rows - see Mintavizsga
    public function deleteStudent ($neptun){
        try {
            $stmt= $this->dbh->exec(
                "DELETE FROM hallgatok WHERE neptun='$neptun'"
            );
        } catch(PDOException $e) {
            $this->error("Unable to delete student.", $e);
        }
    }
    
    public function updateStudent ($oldNeptun, $name, $neptun, $birthdate){
        try {
            //option 1
            /*
            $stmt = $this->dbh->prepare("update ".self::TABLE." set neptun=?, nev=?, szuldatum=? where neptun=?");
            $stmt->bindParam(1, $neptun, PDO::PARAM_STR);
            $stmt->bindParam(2, $name, PDO::PARAM_STR);
            $stmt->bindParam(3, $birthdate, PDO::PARAM_STR);
            $stmt->bindParam(4, $oldNeptun, PDO::PARAM_STR, 6);
            $stmt->execute();
            if($stmt->rowCount() == 0) throw new PDOException("Unkown neptun code!");
            */

            //option 2
            $ar = $this->dbh->exec(
                "UPDATE hallgatok SET neptun='$neptun', nev='$name', szuldatum='$birthdate' WHERE neptun='$oldNeptun' "
            );
            if($ar !==1) throw new PDOException("Unkown neptun code!");
        } catch(PDOException $e) {
            $this->error("Unable to update student.", $e);
        }       
    }
}