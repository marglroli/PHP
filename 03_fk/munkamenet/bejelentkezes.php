<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
  <fieldset>
    <legend>Adja meg bejelentkezési adatait!</legend>
    <div><label>Felhasználónév:
    <input type="text" name="nev"></label></div>
    <div><label>Jelszó:
    <input type="password" name="jelszo"></label></div>
    <div><input type="submit" value="Mehet"></div>
  </fieldset>
</form>