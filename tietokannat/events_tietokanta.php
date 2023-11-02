<?php

// Palvelimen nimi muuttujaan
$servername ="localhost";
$username ="root"; // Tarkistetaan phpmyadmin sivulta käyttäjät
$password =""; // Tarkistetaan phpmyadmin sivulta käyttäjät

// Yritetään
try{
    // Luodaan yhteys, joka on PDO objekti
    $conn = new PDO("mysql:host=$servername;dbname=eventdatabase", $username, $password);

    // PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // isolla, koska ovat constant arvoja

    //Selaimeen osoitteen perään: ?EventId=1
    if (empty($_GET["EventId"])) {
        $kysely = $conn->prepare("SELECT * FROM events");
    } else {
        $eventId = filter_input(INPUT_GET, "EventId", FILTER_SANITIZE_NUMBER_INT);
        $kysely = $conn->prepare("SELECT * FROM events WHERE EventID = $eventId");
    }

    $kysely->execute();
}
catch(PDOException $e){
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
    <!-- Tehtävä: Listaa $tapahtumat taulukon sisältö <table> -taulukkona -->
    <table>
        <tr>
            <th>id</th>
            <th>EventName</th>
            <th>EventDate</th>
        </tr>
        <?php
            while($rivi = $kysely->fetch()) {
                echo "<tr>";
                echo "<td>" . $rivi["EventID"] . "</td>";
                echo "<td>" . $rivi["EventName"] . "</td>";
                echo "<td>" . $rivi["EventDate"] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>