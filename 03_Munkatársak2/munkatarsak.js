window.addEventListener("load", function() {
    "use strict";

    let ajax = new XMLHttpRequest();

    if(ajax) {
        ajax.addEventListener("readystatechange", function() {
            if(ajax.readyState == 4) {
                if((ajax.status>=200 && ajax.status<300) || ajax.status==304) {
                    let adatok = JSON.parse(ajax.responseText);
                    let details = document.getElementById("m_" + adatok.id);
                    details.classList.remove("hianyos");
                    let lent = document.createElement("div");
                    lent.className = "lent";
                    lent.innerHTML = 
                        `<div class="bal">
                            <picture>
                                <source media="(min-width: 400px)" />
                                <img />
                            </picture>
                        </div>
                        <div class="jobb">
                            <table class="adatok">
                            </table>
                        </div>`;
                    lent.getElementsByTagName("source")[0].srcset = adatok.seged.nagy;
                    let img = lent.getElementsByTagName("img")[0];
                    img.src = adatok.seged.kicsi;
                    img.alt = adatok.seged.nev;
                    let table = lent.getElementsByTagName("table")[0];
                    for(const kulcs in adatok.tablazat) {
                        let tr = document.createElement("tr");
                        let td = document.createElement("td");
                        td.textContent = kulcs;
                        tr.appendChild(td);
                        td = document.createElement("td");
                        td.textContent = adatok.tablazat[kulcs];
                        tr.appendChild(td);
                        table.appendChild(tr);
                    }
                    details.appendChild(lent);
                } else {
                    alert(ajax.statusText);
                }
            }
        });

        document.querySelectorAll(".munkatars").forEach(elem => {
            elem.addEventListener("click", event => {
                let os = event.target.parentNode;
                if(os.classList.contains("hianyos")) {
                    ajax.open("GET", "munkatarsak.php?id=" + os.id.slice(2));
                    ajax.send();
                }
            });
        });
    }
});