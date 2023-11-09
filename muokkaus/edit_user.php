<?php
// Tietokanta yhteys
// Palvelin, tietokanta, tunnukset palvelimelle (user, password)
// Osittain tietokantayhteyden haun, voisi laittaa erilliseen tiedostoon
// jota voidaan käyttää eri tiedostoissa
$servername = "localhost";
$databasename = "eventdatabase";
$username = "root";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haetaan ja sanitoidaan käyttäjän syötteet
    $userID = filter_input(INPUT_POST,"userID", FILTER_SANITIZE_NUMBER_INT);
    $newUsername = htmlspecialchars($_POST["newUsername"], ENT_QUOTES, 'UTF-8');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Valmistellaan SQL -lause
        $sql = "UPDATE users SET Username = :newUsername WHERE UserID = :userID";
        $kysely = $conn->prepare($sql);

        //Laitetaan parametrit paikalleen SQL lauseeseen
        $kysely->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
        $kysely->bindParam(':userID', $userID, PDO::PARAM_INT);

        //Suoritetaan tietokanta haku
        $kysely->execute();

        //Suljetaan yhteys
        $conn = null;

        //Uudelleenohjaus kun muutos on onnistunut
        header("Location: edit_user.php?userID=" . $userID . "&success=true");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
// Tarkistetaan, että requestin mukana tulee GET userID
else if (isset($_GET["userID"]) && filter_var($_GET['userID'], FILTER_VALIDATE_INT)) {
    $userID = $_GET['userID'];

    try {
        // Luodaan yhteys MySLi tai PDO
        $DBconn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        // Tässä objektissa on tallessa tietokantayhteys

        // Virhe asetuksia
        $DBconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Valmistellaan kysely
        // SQL injection harjoitus
        echo "SELECT * FROM users WHERE UserID = $userID";
        // $query = $DBconn->prepare("SELECT * FROM users WHERE UserID = $userID");

        // Toinen tapa välttää SQL injection
        $sql = "SELECT * FROM users WHERE UserID = :userID";
        $query = $DBconn->prepare($sql);
        $query->bindParam(':userID', $userID, PDO::PARAM_INT);

        // Suoritetaan kysely
        $query->execute();

        $DBconn = null; // Katkaistaan yhteys

        $user = $query->fetch();
        print_r($user);
    } catch (PDOException $e) {
        // Siirrytään tänne, jos try blokin sisällä tapahtuu virhe.
        echo "Connection failed:" . $e->getMessage();
    }

} else {
    // Siirretään käyttäjä takaisin
    header("Location: index.php?error=true");
    exit(); // Lopetetaan tiedoston suoritus
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Muokkaa käyttäjän tietoja:</h2>
    <!--Tehdään form, jossa voidaan muokata käyttäjän nimeä.
        Form kutsuu tätä php-tiedostoa.
        Käytetään POST metodia.
    -->
    <form method="post" action="edit_user.php">
        <input type="hidden" name="userID" value="<?php echo $user['UserID']; ?>">
        <label for="newUsername">Käyttäjän nimi:</label>
        <input type="text" name="newUsername" value="<?php echo $user['Username'];?>">
        <br><br>

        <input type="submit" value="Update Information">
    </form>

</body>

</html>