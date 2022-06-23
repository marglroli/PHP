window.onload = function() {
  'use strict';

  var ajax = getXHR();

  if(ajax) {
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4) {
        var eredmeny = document.getElementById("eredmeny");
        if ((ajax.status>=200 && ajax.status<300) 
          || (ajax.status==304) ) {
          var valasz = ajax.responseXML;
          var hiba = valasz.getElementsByTagName("hiba");
          if(hiba.length) {
            eredmeny.innerHTML = hiba[0].firstChild.nodeValue;
          } else {
            var alap = valasz.documentElement.children[0].firstChild.nodeValue;
            var kitevo = valasz.documentElement.childNodes[3].firstChild.nodeValue;
            var hatvany = valasz.documentElement.lastChild.previousSibling.firstChild.nodeValue;
            eredmeny.innerHTML = hatvany + " (" + alap + "<sup>" + kitevo + "</sup>)";
          }
        } else {
          eredmeny.innerHTML = ajax.statusText;
        }
      }
    };

    document.getElementById("urlap").onsubmit = function() {
      var szerver = "http://xenia.sze.hu/";
      var szam = encodeURIComponent(document.getElementById("szam").value);
      ajax.open("GET", szerver + "~wajzy/ajax/negyzet_xml.php?szam=" + szam, true);
      ajax.send(null);
      return false;
    };
  }
};