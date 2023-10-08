<?php
    echo "<h1>Hellou world</h1>";

    // Yhden rivin kommentti
    /* 
        Tämä kommentti on
        usealla rivillä.
    */

    // Muuttujat
    $etunimi = "Teemu";

    echo "Etunimeni on $etunimi <br>";

    // Datatyypit
    // Int, float, string, boolean
    $kokonaisluku = 5;
    $liukuluku = 3.5;
    $teksti = "Tämä on tekstiä";
    $totuusarvo = true;

    echo "Kokonaisluku: $kokonaisluku <br>";
    echo "Liukuluku: $liukuluku<br>";
    echo "Teksti: $teksti<br>";
    echo "Totuusarvo: $totuusarvo<br>";
    echo var_dump($totuusarvo), "<br>";

    // Ehtolauseet
    if ($etunimi == "Tomi") {
        echo "Hei Tomi<br>";
    } else {
        echo "Hei joku muu<br>";
    }

    if ($totuusarvo) {
        echo "Arvo on true<br>";
    } else {
        echo "Arvo on false<br>";
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($totuusarvo) : ?>
    <p>Näytetään tämä teksti</p>
    <?php endif; ?>

    <?php
        for ($i=0; $i < 5; $i++) { 
            echo "<h3>Rivi $i</h3>";
        }

        $index = 0;
        while ($index <= 10) {
            echo "While arvo on $index <br>";
            $index++;
        }

        $work = true;
        do {
            echo "Toimii. <br>";
            $work = false;
        } while ($work);
    ?>
</body>
</html>

<?php
    //Matemaattiset operaattorit
    //Yhteenlasku
    $numero1 = 2;
    $numero2 = 1;
    $yhteensa = $numero1 + $numero2;
    echo "\$yhteensa ", $yhteensa, "<br>";

    //Erotus
    $erotus = $numero1 - $numero2;
    echo "Erotus: $erotus <br>";

    //Jakolasku
    $tulos = $numero2 / $numero1;
    echo "Jakolaskun tulos: $tulos <br>";

    //Jakojäännös
    $jakojaannos = $numero2 % $numero1;
    echo "Jakojäännös: $jakojaannos <br>";

    function tulostaViesti($viesti, $viesti2) {
        echo $viesti, $viesti2, "<br>";
    }

    tulostaViesti("Hellou world taas!!", "Hei vielä kerran.");

    //TEHTÄVÄ 1
    //  Kirjoita funktiot: laskeYhteen(), jaaLuvut()
    //  vahennysLasku(), laskeJakojaannos().
    //  Funktiot ottavat vastaan kaksi parametria.

    function laskeYhteen($luku1, $luku2) {
        $tulos = $luku1 + $luku2;
        echo "laskeYhteen(): $tulos <br>";
    }

    function jaaLuvut($luku1, $luku2) {
        $tulos = $luku1 / $luku2;
        echo "jaaLuvut(): $tulos <br>";
    }
    
    function vahennysLasku(int $luku1, $luku2) {
        $tulos = $luku1 - $luku2;
        echo "vahennysLasku(): $tulos <br>";
    }

    function laskeJakojaannos($luku1, $luku2) {
        $tulos = $luku1 % $luku2;
        echo "laskeJakojaannos(): $tulos <br>";
    }

    laskeYhteen(2, 2);
    vahennysLasku(5.5, 1);
    jaaLuvut(6.5, 2);
    laskeJakojaannos(5, 2);

    //TEHTÄVÄ 2
    //  yhdistaStringit(), joka ottaa vastaan kaksi
    //  parametria. Funktio palauttaa yhdistetyn
    //  stringin.
    //  Funktiota käytetään:
    //  echo ydistaStringit("Hei vaan!", "Terve terve!")

    function yhdistaStringit($string1, $string2) {
        $yhdistetty = $string1.$string2;

        return $yhdistetty;
    }

    echo yhdistaStringit("Hei vaan!", "Terve terve!");

    //TEHTÄVÄ 3
    //  Tee silmukka, joka tulostaa kaikki alkuluvut
    //  väliltä 1-100. Alkuluku on kokonaisluku, joka
    //  on jaollinen vain 1 tai itsellään.

    for($i=1; $i<=100; $i++) {
        if (alkuLuku($i)) {
            echo "$i on alkuluku <br>";
        }
    }

    function alkuLuku($numero) {
        if ($numero < 2) {
            return false;
        }

        for ($i=2; $i < $numero; $i++) {
            if ($numero%$i==0) {
                return false;
            }
        }

        return true;
    }
?>