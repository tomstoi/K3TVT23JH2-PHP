<?php
// === tarkistetaan onko arvot samat ja onko datatyypit samat
// esim. == tulkitsee 5 ja "5" ovat sama arvo
// mutta === vertaa datatyypin myös, jolloin 5 ja "5" eivät ole sama arvo
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    try {
        require_once 'db_connection.inc.php';
        require_once 'signup_model.inc.php'; // Model iclude ensin
        require_once 'signup_controller.inc.php'; // Sitten controller include
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}


// Include tiedostoissa yleensä jätetään php:n lopetus tagi pois