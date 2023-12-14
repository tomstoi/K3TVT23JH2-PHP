<?php

// Estetään "Session Hijack/Fixation" hyökkäyksiä

// Estetään session kaappaus URL:n kautta (hyökkääjä syöttää oman sessionID:n) linkkiin
// ja lähettää sen uhrille). Session kulkee vain keksien matkassa.
ini_set("session.use_only_cookies", 1);
// Ei hyväksytä SessionID:tä käyttäjältä, vaan generoi tilanne uuden turvallisen id:n
// Joten hyökkääjä ei voi syöttää käyttäjälle ennalta tiedetttyä id:tä, jolla hän voi
// kaapata käyttäjän Session.
ini_set("session.use_strict_mode", 1);

session_set_cookie_params([
    "lifetime" => 1800,
    // Session vanhenee 1800 sekunnin jälkeen. Ei jätetä kirjautumisia aktiiviseksi liian
    // kauan.

    "domain" => "localhost",
    // Rajoitetaan session meidän verkkotunnukseen "localhost"

    "path" => "/",
    // Millä polulla sessio on aktiivinen, "/" tarkoittaa koko verkkotunnusta localhost/
    // Session voisi rajoittaa vain tietylle alueelle. Esim. localhost/admin

    "secure" => true,
    // Vain HTTPS yhteys (data on salattu, encrypted),
    // jotta paketteja on vaikeampi lukea luvattomasti selaimen ja palvelimen välillä

    "httponly" => true
    // Keksejä ei voi muokata JavaScriptillä, eli XSS hyökkäys ei voi lukea tai muokata
    // Session arvoja
]);

session_start();

// Jos "last_generation" arvoa ei vielä ole, generoidaan id ja luodaan
// ["last_generation"] arvo.
if(!isset($_SESSION["last_generation"])) {
    regenerate_session_id();
} else { // "last_generation" on jo olemassa
    $interval = 60 * 30; // 60 sekunttia * 30 minuuttia = sekunttien määrä, jolloin
                         // päivitetään id
    
    // Tarkistetaan onko sessio yli 30 minuuttia vanha
    if(time() - $_SESSION["last_generation"] >= $interval) {
        regenerate_session_id();
    }
}

// Käytetään tätä if else sisällä, ei toisteta koodia
function regenerate_session_id() {
    session_regenerate_id();
    $_SESSION["last_generation"] = time();
}

// Include tiedostoissa ei yleensä käytetä php:n lopetus tagiä