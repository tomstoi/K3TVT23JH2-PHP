<?php

// Palvelimen nimi muuttujaan
$servername = "localhost";
$databasename = "eventdatabase";
$username = "root"; // Tarkistetaan phpmyadmin sivulta käyttäjät
$password = ""; // Tarkistetaan phpmyadmin sivulta käyttäjät

// Yritetään
try {
    // Luodaan yhteys, joka on PDO objekti
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

    // PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // isolla, koska ovat constant arvoja

    $kysely = $conn->prepare("SELECT * FROM users; drop database testtest;");

    $kysely->execute();
} catch (PDOException $e) {
    // Yhteysepäonnistui
    echo "Connection failed: " . $e->getMessage();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <th>id</th>
            <th>Username</th>
            <th>ProfilePicture</th>
        </tr>
        <?php
        // print_r($kysely->fetch());
        while ($rivi = $kysely->fetch()) {
            echo "<tr>";
            echo "<td>" . $rivi["UserID"] . "</td>";
            echo "<td>" . $rivi["Username"] . "</td>";

            // Tässä kohtaa lisätään kuva tietokannasta:
            echo "<td>" . "<img src='Uploads/" . $rivi["ProfilePicture"] . "'/>" . "</td>";

            // Edit -nappi käyttäjän muokkaussivulle. Käytetään GET metodia, 
            // joten käyttäjä voi syöttää itse ID:n url:iin. 
            // Voi käyttää linkin tilasta formia ja POST metodia
            echo "<td><a href='edit_user.php?userID=" . $rivi["UserID"] . "'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>