<?php 
    declare(strict_types=1);
    session_start();
    
    function str2ido(string $str) : int {
      $ora = substr($str, 0, 2);
      $perc = substr($str, 3, 2);
      return (int)$ora*60 + (int)$perc;
    }
    
    function ido2str(int $ido) : string {
      return sprintf("%02d", $ido/60).':'.sprintf("%02d", $ido%60);
    }
    
    function listaz() {
      if(count($_SESSION)) {
        echo "<ul>\n";
        foreach($_SESSION as $feladat) {
          echo "\t<li>".
              ido2str($feladat['kezdete']).
              " - ".
              ido2str($feladat['vege']).
              ": ".
              $feladat['megnevezes'].
              "</li>\n";
        }
        echo "</ul>\n";
      } else {
        echo "<p>Mára még nincsenek elfoglaltságai.</p>\n";
      }
    }
    
    function utkozes(array $uj) : bool {
      foreach($_SESSION as $feladat) {
        if($uj['vege']>=$feladat['kezdete'] && $uj['kezdete']<=$feladat['vege']) {
          return true;
        }
      }
      return false;
    }
    
    function ujAdat() {
      if(filter_has_var(INPUT_POST, 'kezdete') &&
        filter_has_var(INPUT_POST, 'vege') &&
        filter_has_var(INPUT_POST, 'megnevezes')) {
        $idoRegExp = array("options" => array("regexp" => '/^\d{2}:\d{2}$/'));
        $kezdete = filter_input(INPUT_POST, 'kezdete', FILTER_VALIDATE_REGEXP, $idoRegExp);
        $vege = filter_input(INPUT_POST, 'vege', FILTER_VALIDATE_REGEXP, $idoRegExp);
        $megnevezes = filter_input(INPUT_POST, 'megnevezes', FILTER_SANITIZE_STRING);
        if($kezdete && $vege && $megnevezes) {
          $kezdete = str2ido($kezdete);
          $vege = str2ido($vege);
          if($kezdete > $vege) {
            $csere = $kezdete;
            $kezdete = $vege;
            $vege = $csere;
          }
          $uj = [
            'kezdete' => $kezdete, 
            'vege' => $vege, 
            'megnevezes' => $megnevezes
          ];
          if(!utkozes($uj)) {
            $_SESSION['e'.count($_SESSION)] = $uj;
            uasort($_SESSION, function(array $a, array $b) : int {
              return $a['kezdete'] <=> $b['kezdete'];
            });
          } else {
            echo "<p>Az új elfoglaltság ütközik legalább egy korábban megadottal!</p>\n";
          }
        }
      }
    }
    
    function foglalt($ora, $perc) {
      $ido = $ora*60 + $perc;
      foreach($_SESSION as $feladat) {
        if($ido>=$feladat['kezdete'] && $ido<=$feladat['vege']) {
          return $feladat['megnevezes'];
        }
      }
      return false;
    }
    
    function tablazat() {
      echo "<table>\n";
      echo "\t<tr><td></td>";
      for($perc=0; $perc<60; $perc++) {
        echo "<th>$perc</th>";
      }
      echo "</tr>\n";
      for($ora=0; $ora<24; $ora++) {
        echo "\t<tr><th>$ora</th>";
        for($perc=0; $perc<60; $perc++) {
          echo "<td class=\"";
          if(($megnevezes=foglalt($ora, $perc))===false) {
            echo "szabad";
          } else {
            echo "foglalt\" title=\"$megnevezes";
          }
          echo "\"></td>";
        }
        echo "</tr>\n";
      }
      echo "</table>\n";
    }
?>
<!DOCTYPE html>
<head>
    <title>Naptár</title>
    <link rel="stylesheet" type="text/css" href="stilus.css">
    <meta charset="utf-8" />
</head>
<body>
    <h1>Személyes, napi elfoglaltságok</h1>
    <?php ujAdat(); listaz(); ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="urlap" method="post">
          <fieldset>
              <legend>Új elfoglaltság megadása</legend>
              <div><label>Kezdete: <input type="time" name="kezdete" required></label></div>
              <div><label>Vege: <input type="time" name="vege" required></label></div>
              <div><label>Megnevezés: <input type="text" name="megnevezes" required></label></div>
              <div><input type="submit" value="Küldés"></div>
        </fieldset>
    </form>
    <?php tablazat(); ?>
</body>
</html>
