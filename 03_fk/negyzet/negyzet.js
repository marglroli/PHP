window.onload = function() {
  'use strict';

  var ajax = getXHR();

  if(ajax) {
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
        var eredmeny = document.getElementById("eredmeny");
        if ((ajax.status>=200 && ajax.status<300) 
          || (ajax.status==304) ) {
          eredmeny.innerHTML = ajax.responseText;
        } else {
          eredmeny.innerHTML = ajax.statusText;
        }
      }
    };

    document.getElementById("urlap").onsubmit = function() {
      var szerver = "http://xenia.sze.hu/";
      var szam = encodeURIComponent(document.getElementById("szam").value);
      ajax.open("GET", szerver + "~wajzy/ajax/negyzet.php?szam=" + szam, true);
      ajax.send(null);
      return false;
    };
  }
};