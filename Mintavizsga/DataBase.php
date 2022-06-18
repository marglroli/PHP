<?php
declare(strict_types=1);

class DataBase {
    private $dbh = NULL;
    const SERVER = "xenia.sze.hu";
    const USER = "hallgato";
    const PASSWORD = "mysql";
    const SCHEMA = "vizsga";
    const EXAMINEE = "NPTN12";

    public function __construct() {
        try {
            $this->dbh = new PDO("mysql:host=".self::SERVER.";dbname=".self::SCHEMA, self::USER, self::PASSWORD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Unable to connect to the database. Error code: {$e->getCode()}, error message: {$e->getMesaage()}");
        }
    }

    public function __destruct() {
        $this->dbh = NULL;
    }

    protected function error($m, $e) {
        echo "<p>$m<br />PDO error code: {$e->getCode()}, PDO error message: {$e->getMessage()}</p>\n";
    }

    public function getStudents() : array {
        $students = [];
        try {
            $stmt = $this->dbh->query(
                "SELECT neptun, nev AS name ".
                "FROM Hallgatok ".
                "ORDER BY nev");
            while($s = $stmt->fetchObject("Student")) {
                $students[] = $s;
            }
            return $students;
        } catch(PDOException $e) {
            $this->error("Unable to query student data.", $e);
        }
    }

    public function getApplication(string $neptun) {
        try {
            $stmt = $this->dbh->query(
                "SELECT j.neptun, h.nev AS name, j.pontszam AS point, z.idopont AS time ".
                "FROM jelentkezesek j, Hallgatok h, ZHidopontok z ".
                "WHERE h.neptun=j.neptun AND j.zh=z.id AND j.vizsgazo='".self::EXAMINEE."' AND j.neptun='$neptun'");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row===false ? false : new Application(new Student($row["name"], $row["neptun"]), $row["time"], (int)$row["point"]);
        } catch(PDOException $e) {
            $this->error("Unable to query the choosen test of $neptun.", $e);
        }  
    }

    public function getTestTimes() : array {
        $testTimes = [];
        try {
            $stmt = $this->dbh->query(
                "SELECT id, idopont AS time, letszamkorlat AS capacity ".
                "FROM ZHidopontok ".
                "LEFT JOIN (SELECT zh, COUNT(zh) as db FROM jelentkezesek WHERE vizsgazo='".self::EXAMINEE."' GROUP BY zh) AS j ".
                "ON ZHidopontok.id=j.zh ".
                "WHERE j.db IS NULL OR j.db<ZHidopontok.letszamkorlat"
            );
            while($t = $stmt->fetchObject("TestTime")) {
                $testTimes[] = $t;
            }
            return $testTimes;
        } catch(PDOException $e) {
            $this->error("Unable to query the list of available tests.", $e);
        } 
    }

    public function addApplication(string $neptun, int $testId) : bool {
        try {
            $ar = $this->dbh->exec(
                "INSERT INTO jelentkezesek (neptun, zh, vizsgazo) VALUES ('$neptun', $testId, '".self::EXAMINEE."')"
            );
            return $ar===1;
        } catch(PDOException $e) {
            $this->error("Unable to apply for the test.", $e);
        }
    }

    public function clearApplication(string $neptun) : bool {
        try {
            $ar = $this->dbh->exec(
                "DELETE FROM jelentkezesek WHERE neptun='$neptun' AND vizsgazo='".self::EXAMINEE."'"
            );
            return $ar===1;
        } catch(PDOException $e) {
            $this->error("Unable to clear the application.", $e);
        }
    }

    public function getAllTestTimes() : array {
        $testTimes = [];
        try {
            $stmt = $this->dbh->query(
                "SELECT id, idopont AS time, letszamkorlat AS capacity FROM ZHidopontok"
            );
            while($t = $stmt->fetchObject("TestTime")) {
                $testTimes[] = $t;
            }
            return $testTimes;
        } catch(PDOException $e) {
            $this->error("Unable to query the list of tests.", $e);
        }
    }

    public function getApplications(int $testId = NULL) : array {
        $applications = [];
        try {
            $sql = "SELECT j.neptun, h.nev AS name, z.idopont AS time, j.pontszam AS point ".
                   "FROM jelentkezesek j, ZHidopontok z, Hallgatok h ".
                   "WHERE j.neptun=h.neptun AND j.zh=z.id AND j.vizsgazo='".self::EXAMINEE."'";
            if($testId !== NULL) {
                $sql .= " AND j.zh=$testId";
            }
            $stmt = $this->dbh->query($sql);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $applications[] = new Application(new Student($row["name"], $row["neptun"]), $row["time"], (int)$row["point"]);
            }
            return $applications;
        } catch(PDOException $e) {
            $this->error("Unable to query the list of applications.", $e);
        }
    }

    public function setPoints(string $neptun, int $points) {
        try {
            $ar = $this->dbh->exec(
                "UPDATE jelentkezesek SET pontszam=$points WHERE neptun='$neptun' AND vizsgazo='".self::EXAMINEE."'"
            );
            return $ar===1;
        } catch(PDOException $e) {
            $this->error("Unable to set points.", $e);
        }
    }
}