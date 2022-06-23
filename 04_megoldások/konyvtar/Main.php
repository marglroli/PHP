<?php
    spl_autoload_register(function ($className) {
        require_once(str_replace('\\', '/', $className).".php");
    });

    /*
    $zab = new lib\Book("The Catcher in the Rye", "J. D. Salinger", 
            "9787543321724");
    $zab->addKeyword("Realistic fiction");
    $zab->addKeyword("Coming-of-age fiction");
    echo $zab;
    echo "Cím: ".$zab->getTitle();
    echo "Szerző: ".$zab->getAuthor();
    echo "ISBN: ".$zab->getIsbn();
    echo "Talált kulcsszavak száma: ".$zab->getKeywordsNum(
        ["Realistic fiction", "Science fiction"]);
    
    $nine = new lib\Book("Nine Stories", "J. D. Salinger", "9780316769501");
    $nine->addKeyword("Short stories");
    echo $nine;
    
    $l = new lib\Library;
    $l->addBook($zab);
    $l->addBook($nine);
     */
    $l = lib\Library::load("/home/feltoltes/www/lib.dat");
    
    echo "<p>Zabhegyezők</p>\n";
    foreach ($l->getByTitle("The Catcher in the Rye") as $b) {
        echo $b;
    }
    echo "<p>Salingerek:</p>\n";
    foreach ($l->getByAuthor("salinger") as $b) {
        echo $b;
    }
    echo $l->getByIsbn("1234567890123") ?? "Nincs ilyen könyv.";
    echo $l->getByIsbn("9780316769501") ?? "Nincs ilyen könyv.";
    echo "<p>Kulcsszavas keresés:</p>\n";
    foreach ($l->getByKeywords(["Realistic fiction", "Coming-of-age fiction", 
        "Short stories"]) as $b) {
        echo $b;
    }
    $l->save("/home/feltoltes/www/lib.dat");
    