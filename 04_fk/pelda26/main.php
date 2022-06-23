<?php
  use Egyetem\Hallgato;
  
  /*
  function __autoload($osztaly) {
    require_once(substr($osztaly, strrpos($osztaly, '\\')+1).".php");
  }
  */
  
  spl_autoload_register(function ($osztaly) {
    require_once(substr($osztaly, strrpos($osztaly, '\\')+1).".php");
  });
  
  // $virag = new Egyetem\Hallgato("Cserepes Virág", "1234567890");
  $virag = new Hallgato("Cserepes Virág", "1234567890");
  echo "<p>", $virag, "</p>\n";