<?php
  declare(strict_types = 1);

  class Adatbazis {
    private $dbh = false;
    // Figyeljünk arra, hogy legyen írási jogunk!
    const DBNEV = "/home/feltoltes/www/hlista";

    public function __construct() {
      $this->dbh = dba_open(self::DBNEV, "c", "db4") or 
        die("Nem sikerült megnyitni az adatbázist.");
    }

    public function __destruct() {
      if($this->dbh != false) {
      dba_close($this->dbh);
      }
    }

    public function __toString() : string {
      $s = "";
      $kulcs = dba_firstkey($this->dbh);
      while($kulcs != false) {
        $obj = unserialize(dba_fetch($kulcs, $this->dbh));
        $obj->setNeptun($kulcs);
        $s .= "<p>$obj</p>\n";
        $kulcs = dba_nextkey($this->dbh);
      }
      return $s;
    }

    public function beszur(Hallgato $h) {
      dba_insert($h->getNeptun(), serialize($h), $this->dbh) or
      print("<p>Nem sikerült az új objektum adatbázisba illesztése.</p>\n");
      // Az echo erre a célra a visszatérési érték hiánya miatt nem használható.
    }

    public function csere(Hallgato $h) {
      dba_replace($h->getNeptun(), serialize($h), $this->dbh) or
      print("<p>Nem sikerült az objektum módosítása.</p>\n");
    }

    public function torles(Hallgato $h) {
      if(dba_exists($h->getNeptun(), $this->dbh)) {
      dba_delete($h->getNeptun(), $this->dbh) or
        print("<p>Nem sikerült az objektum törlése.</p>\n");
      } else {
        echo "<p>A megadott kódú hallgató nem szerepel az adatbázisban.</p>\n";
      }
    }
  }
?>