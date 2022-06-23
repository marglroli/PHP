const php = "http://xenia.sze.hu/~wajzy/fk/forum/forum.php";
var utolso = 0;

function frissit(e) {
  'use strict';
  if (typeof e === "undefined") e = window.event;
  var ajax = e.target || e.srcElement;
  if (ajax.readyState === 4) {
    var lista = document.getElementById("hszhelye");
    if ((ajax.status>=200 && ajax.status<300) 
      || (ajax.status===304) ) {
        var valasz = JSON.parse(ajax.responseText);
        var html = lista.innerHTML;
        for (var kulcs in valasz) {
            var ido = new Date(valasz[kulcs].ido*1000);
            html += "<div><p>Név: "+valasz[kulcs].nev+"</p>\n"+
                    "<p>Időpont: "+ido.toLocaleString()+"</p>\n"+
                    "<p>"+valasz[kulcs].hsz+"</p>\n</div>\n";
            if(valasz[kulcs].ido > utolso) utolso=valasz[kulcs].ido;
        }
        lista.innerHTML = html;
    } else {
      lista.innerHTML = ajax.statusText;
    }
  }
  ajax = null;
}

window.onload = function() {
  'use strict';

  var ajax = new XMLHttpRequest();

  if(ajax) {
    ajax.onreadystatechange = frissit;

    document.getElementById("uj").onsubmit = function() {
      var nev = encodeURIComponent(document.getElementById("nev").value);
      var hsz = encodeURIComponent(document.getElementById("hsz").value);
      ajax.open("POST", php+"?utolso="+utolso, true);
      ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      ajax.send("nev="+nev+"&hsz="+hsz);
      return false;
    };
  }
  
  setInterval(letolt, 1000);
};

function letolt() {
  var aFrissit = new XMLHttpRequest();
  if(aFrissit) {
    aFrissit.onreadystatechange = frissit;
    aFrissit.open("GET", php+"?utolso="+utolso, true);
    aFrissit.send(null);
  }
}

