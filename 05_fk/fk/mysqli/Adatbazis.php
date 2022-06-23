<?php
  declare(strict_types = 1);

  class Adatbazis {
    private $mysqli = null;
    const SZERVER = "xenia.sze.hu";
    const FELHASZNALO = "hallgato";
    const JELSZO = "mysql";
    const ADATBAZIS = "hallgatok";
    const TABLA = "hallgatok";

    public function __construct() {
      @$kapcs = new mysqli(self::SZERVER, self::FELHASZNALO, self::JELSZO, self::ADATBAZIS);
      if($kapcs->connect_error) {
        die("Nem sikerült megnyitni az adatbázist. Hibakód: ".$kapcs->connect_errno.", hibaüzenet: ".$kapcs->connect_error);
      } else {
        $this->mysqli = $kapcs;
      }
    }

    public function __destruct() {
      if($this->mysqli != null) {
        $this->mysqli->close();
        $this->mysqli = null;
      }
    }

    protected function hiba($u) {
      print("<p>$u<br />\nMySQL hibakód: {$this->mysqli->errno}, MySQL hibaüzenet: {$this->mysqli->error}</p>\n");
    }

    public function __toString() {
      $s = "";
      if($eredmeny = $this->mysqli->query("select * from ".self::TABLA." order by nev")) {
        while($sor = $eredmeny->fetch_object("Hallgato")) {
          //$hg = new Hallgato($sor->nev, $sor->neptun, $sor->szuldatum);
          $s.="<p>$sor</p>\n";
        }
      } else {
        $this->hiba("Nem sikerült lekérdezni a hallgatók adatait.");
      }
      return $s;
    }

    public function beszur(Hallgato $h) {
      if($kif = $this->mysqli->prepare("insert into ".self::TABLA." values (?, ?, ?)")) {
        $k = $h->getNeptun();
        $n = $h->getNev();
        $d = $h->getSzuldatum()->format("Y-m-d");
        $kif->bind_param("sss", $k, $n, $d);
        if(!$kif->execute()  || $kif->affected_rows == 0) {
          $this->hiba("Nem sikerült az új objektum adatbázisba illesztése.");
        }
        $kif->close();
      } else {
        $this->hiba("Nem sikerült létrehozni az SQL kifejezést.");
      }
    }

    public function csere(Hallgato $h) {
      if(!$this->mysqli->query("update ".self::TABLA." set nev=\"{$h->getNev()}\", szuldatum=\"{$h->getSzuldatum()->format("Y-m-d")}\" where neptun=\"{$h->getNeptun()}\"")) {
        $this->hiba("Nem sikerült az objektum módosítása.");
      } elseif($this->mysqli->affected_rows == 0) {
        $this->hiba("A megadott kódú hallgató nem szerepel az adatbázisban, ezért nem módosítható.");
      }
    }

    public function torles(Hallgato $h) {
      if(!$this->mysqli->query("delete from ".self::TABLA." where neptun=\"{$h->getNeptun()}\"")) {
        $this->hiba("Nem sikerült az objektum törlése.");
      } elseif($this->mysqli->affected_rows == 0) {
        $this->hiba("A megadott kódú hallgató nem szerepel az adatbázisban, ezért nem törölhető.");
      }
    }
  }
?>
