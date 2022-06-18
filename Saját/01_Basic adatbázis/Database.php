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

    public function getAll(){
        try {
            $stmt = $this->dbh->query("select * from ".self::TABLE." order by nev");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                   echo $row['nev'] . '<br>';
            }
        } catch(PDOException $e) {
            $this->error("Unable to query student data.", $e);
        }
    }
    
}