<?php
    $taulukko = array(1, 2, 3, "neljä");
    var_dump($taulukko[0]);

    echo "<br>";

    $taulukko2 = [0, 1, 2, 3];
    var_dump($taulukko2[2]);

    echo "<br>";

    echo "Taulukon pituus: " . count($taulukko2) . "<br>";

    for ($i=0; $i < count($taulukko2); $i++) {
        echo "$taulukko2[$i]";
    }

    echo "<br>";
    echo "Foreach silmukka: ";
    foreach ($taulukko as $alkio) {
        echo $alkio;
    }

    echo "<br>";
    echo "Näyttelijät: ";
    $nayttelijat = ["John Wayne", "Sylvester Stallone", "Esko Kovero"];

    

    echo "<br>";

    for ($i=0; $i < count($nayttelijat); $i++) {
        echo "$nayttelijat[$i]";
    }

    echo "<br>";

    foreach ($nayttelijat as $nayttelija) {
        echo $nayttelija;
    }

    echo "<br>";

    array_push($nayttelijat, "Aku Hirviniemi", "Crisp Ratt", "Kari Hietalahti");

    foreach ($nayttelijat as $nayttelija) {
        echo $nayttelija . " ";
    }

    echo "<br>";

    for ($i=0; $i < count($nayttelijat); $i++) {
        echo "$nayttelijat[$i]";

        if ($i !== (count($nayttelijat) - 1)) {
            echo ", ";
        } else {
            echo ".";
        }
    }
    echo "<br>";

    array_splice($nayttelijat, 3, 1);
    var_dump($nayttelijat);

    //Tehtävä: Kirjoita koodi, joka etsii taulukosta "Esko Kovero" arvon indeksin
    //         ja poistaa "Esko Kovero" arvon taulukosta.
    $eskoIndex = 0;
    for ($i=0; $i < count($nayttelijat); $i++) {
        if ($nayttelijat[$i] == "Esko Kovero") {
            $eskoIndex = $i;
        }
    }
    array_splice($nayttelijat, $eskoIndex, 1);

    echo "<br>";
    var_dump($nayttelijat);


    //Tehtävä: Etsi PHP:n manuaalista funktio, jolla saat $nayttelijat taulukon
    //         arvot (näyttelijät) aakkosjärjestykseen ja tulosta echolla näyttelijät
    //         aakkosjärjestyksessä.
    sort($nayttelijat);
    echo "<br>";
    foreach ($nayttelijat as $nayttelija) {
        echo $nayttelija . ", ";
    }


    //Tehtävä: Kirjoita funktiot:
    //         addActor(string $name): void - Lisää taulukkoon $actors arvon
    //         removeActor(string $name): void - Poistaa taulukosta annetun arvon
    //         getActorIndex(string $name): int - Palauttaa annetun arvon indexin
    //         printActors(): void - Tulostaa taulukon arvot

    $actors = [];

    function addActor($name) {
        global $actors;
        array_push($actors, $name);
    }

    function removeActor($name) {
        global $actors;
        //$actorIndex = getActorIndex($name);
        //array_splice($actors, $actorIndex, 1);
        array_splice($actors, getActorIndex($name), 1);
    }

    function getActorIndex($name) {
        global $actors;
        $index = null;

        for ($i=0; $i < count($actors); $i++) {
            if ($actors[$i] == $name) {
                $index = $i;
            }
        }

        return $index;
    }

    function printActors() {
        global $actors;
        for ($i=0; $i < count($actors); $i++) {
            echo "$actors[$i]";
    
            if ($i !== (count($actors) - 1)) {
                echo ", ";
            } else {
                echo ".";
            }
        }
    }

    echo "<br>";

    addActor("Vesa Vierikko");
    addActor("Vesku Loiri");
    addActor("Aku Hirviniemi");
    addActor("Riku Nieminen");

    printActors();

    removeActor("Aku Hirviniemi");

    echo "<br>";

    printActors();

    var_dump($actors);
?>
