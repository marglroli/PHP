<?php
  use Egyetem\Hallgato;
  use Egyetem\NeptunException;
  
  spl_autoload_register(function ($osztaly) {
    require_once(substr($osztaly, strrpos($osztaly, '\\')+1).".php");
  });
  
  try {
    // $virag = new Hallgato("Cserepes Virág", "1234567890");
    $virag = new Hallgato("Cserepes Virág", "123456");
    // $toni = new Hallgato("Trab Antal", "123456");
    $toni = new Hallgato("Trab Antal", "ABCDEF");
    // $toni->setNeptun('qwertzuiop');
    $toni->setNeptun('ABCDEF');
    // $toni->setNeptun('123456');
    $toni->nincs();
  } catch(NeptunException $ne) {
    echo 'NeptunException: ',$ne->getMessage();
  } catch(\Error $e) {
    echo 'Error: ',$e->getMessage();
  } finally {
    echo "<p>Ez a sor mindig látszik.</p>\n";
  }