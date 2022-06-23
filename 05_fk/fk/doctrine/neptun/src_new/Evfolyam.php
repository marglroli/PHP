<?php
  declare(strict_types = 1);
  
  use Doctrine\ORM\EntityManager;

  class Evfolyam {
    private $em;
    
    public function __construct(EntityManager $em) {
      $this->em = $em;
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
      <label for="elerhetosegek">Elérhetőségek:</label>
        <input type="text" id="elerhetosegek" name="elerhetosegek" /><br />
      </fieldset>
      <p><input type="submit" value="OK" /></p>
    </form>

HTML;
    }

    public function feldolgozas() {
      if(isset($_POST["mod"]) && 
        in_array($_POST["mod"], ['beszur', 'csere', 'torles'])) {
        try {
          switch($_POST["mod"]) {
            case 'beszur':
              $hg = new Hallgato($_POST["neptun"], $_POST["nev"], new DateTime($_POST["szuldatum"]));
              $hg->addElerhetosegek($_POST["elerhetosegek"]);
              $this->em->persist($hg);
              break;
            case 'csere':
              $hg = $this->em->find('Hallgato', $_POST["neptun"]);
              if ($hg === null) {
                throw new Exception("Módosítás");
              }
              $hg->setNev($_POST["nev"]);
              $hg->setSzulDatum(new DateTime($_POST["szuldatum"]));
              $hg->clearElerhetosegek();
              $hg->addElerhetosegek($_POST["elerhetosegek"]);
              break;
            case 'torles':
              $hg = $this->em->find('Hallgato', $_POST["neptun"]);
              if ($hg === null) {
                throw new Exception("Törlés");
              }
              $this->em->remove($hg);
              break;
          }
          $this->em->flush();
        } catch(Exception $e) {
          echo "<p style=\"color: red\">{$e->getMessage()}: ".
               "{$_POST["neptun"]} kódú hallgató nem létezik.</p>\n";
        }
      }
    }

    public function lista() {
      echo "<h1>A hallgatók listája:</h1>\n";
      $hallgatoRepository = $this->em->getRepository('Hallgato');
      $hallgatok = $hallgatoRepository->findAll();

      foreach ($hallgatok as $hg) {
        echo '<p>', $hg, "</p>\n";
      }
    }
  }
?>