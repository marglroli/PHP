<?php
  declare(strict_types = 1);

  class Adatbazis {
    private $dbh = null;
    const SZERVER = "xenia.sze.hu";
    const FELHASZNALO = "hallgato";
    const JELSZO = "mysql";
    const ADATBAZIS = "hallgatok";
    const TABLA = "hallgatok";

    public function __construct() {
      try {
	$this->dbh = new PDO("mysql:host=".self::SZERVER.";dbname=".self::ADATBAZIS, self::FELHASZNALO, self::JELSZO);
	$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
	die("Nem sikerült megnyitni az adatbázist. Hibakód: ".$e->getCode().", hibaüzenet: ".$e->getMessage());
      }
    }

    public function __destruct() {
      $this->dbh = null;
    }

    protected function hiba($u, $e) {
      print("<p>$u<br />\nPDO hibakód: ".$e->getCode().", PDO hibaüzenet: ".$e->getMessage()."</p>\n");
    }

    public function __toString() :string {
      $s = "";
      try {
	$eredmeny = $this->dbh->query("select * from ".self::TABLA." order by nev");
	foreach($eredmeny as $sor) {
	  $hg = new Hallgato($sor["nev"], $sor["neptun"], new DateTime($sor["szuldatum"]));
	  $s.="<p>$hg</p>\n";
	}
      } catch(PDOException $e) {
	$this->hiba("Nem sikerült lekérdezni a hallgatók adatait.", $e);
      }
      return $s;
    }

    public function beszur(Hallgato $h) {
      try {
	$kif = $this->dbh->prepare("insert into ".self::TABLA." values (:neptun ,:nev, :szuldatum)");
        $kif->bindValue(":neptun", $h->getNeptun());
        $kif->bindValue(":nev", $h->getNev());
        $kif->bindValue(":szuldatum", $h->getSzuldatum()->format("Y-m-d"));
	$kif->execute();
      } catch(PDOException $e) {
	$this->hiba("Nem sikerült az új objektum adatbázisba illesztése.", $e);
      }
    }

    public function csere(Hallgato $h) {
      try {
	$kif = $this->dbh->prepare("update ".self::TABLA." set nev=?, szuldatum=? where neptun=?");
	$k = $h->getNeptun(); $n = $h->getNev(); $d = $h->getSzuldatum()->format("Y-m-d");
	$kif->bindParam(1, $n, PDO::PARAM_STR);
	$kif->bindParam(2, $d, PDO::PARAM_STR);
	$kif->bindParam(3, $k, PDO::PARAM_STR, 6);
	$kif->execute();
	if($kif->rowCount() == 0) throw new PDOException("Ismeretlen Neptun kód.");
      } catch(PDOException $e) {
	$this->hiba("Nem sikerült az objektum módosítása.", $e);
      }
    }

    public function torles(Hallgato $h) {
      try {
	$eredmeny = $this->dbh->query("delete from ".self::TABLA." where neptun=\"{$h->getNeptun()}\"");
	if($eredmeny->rowCount() == 0) throw new PDOException("Ismeretlen Neptun kód.");
      } catch(PDOException $e) {
	$this->hiba("Nem sikerült az objektum törlése.", $e);
      }
    }
  }
?>
