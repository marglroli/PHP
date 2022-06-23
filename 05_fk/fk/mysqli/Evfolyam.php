<?php
  declare(strict_types = 1);

  class Evfolyam {
    private $db;

    public function __construct() {
      $this->db = new Adatbazis();
    }

    public function urlap() {
      echo <<<HTML
    <form method="post" action="{$_SERVER["PHP_SELF"]}">
      <fieldset><legend>Válasszon üzemmódot!</legend>
      <input type="radio" id="beszuras" name="mod" value="beszur" />
        <label for="beszuras">Beszúrás</label>
      <input type="radio" id="modositas" name="mod" value="csere" checked="checked" />
        <label for="modositas">Módosítás</label>
      <input type="radio" id="torles" name="mod" value="torles" />
        <label for="torles">Törlés</label>
      </fieldset>
      <fieldset><legend>Adja meg a hallgató adatait!</legend>
      <label for="neptun">Neptun kód:</label>
        <input type="text" id="neptun" name="neptun" /><br />
      <label for="nev">Név:</label>
        <input type="text" id="nev" name="nev" /><br />
      <label for="szuldatum">Születési dátum:</label>
        <input type="text" id="szuldatum" name="szuldatum" /><br />
      </fieldset>
      <p><input type="submit" value="OK" /></p>
    </form>

HTML;
    }

    public function feldolgozas() {
      if(isset($_POST["mod"]) && 
        in_array($_POST["mod"], ['beszur', 'csere', 'torles'])) {
        $this->db->{$_POST["mod"]}(new Hallgato(
          $_POST["nev"], $_POST["neptun"], new DateTime($_POST["szuldatum"])));
      }
    }

    public function lista() {
      echo "<h1>A hallgatók listája:</h1>\n";
      echo $this->db;
    }
  }
?>