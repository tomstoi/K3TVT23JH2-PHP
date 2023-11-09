<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted via POST

    // Ensure that the user is authenticated and authorized to make updates
    // You can add code here to check if the user has the necessary permissions

    // Validate and sanitize the form data (modify as needed)
    $userID = filter_input(INPUT_POST, "userID", FILTER_SANITIZE_NUMBER_INT);
    // $newUsername = filter_input(INPUT_POST, "newUsername", FILTER_SANITIZE_STRING);
    $newUsername = htmlspecialchars($_POST["newUsername"], ENT_QUOTES, 'UTF-8');

    // Add more fields as needed

    // Palvelimen nimi muuttujaan
    $servername ="localhost";
    $databasename = "eventdatabase";
    $username ="root"; // Tarkistetaan phpmyadmin sivulta käyttäjät
    $password =""; // Tarkistetaan phpmyadmin sivulta käyttäjät

    try {
        // Create a PDO connection
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare a SQL query to update user data
        $sql = "UPDATE users SET Username = :newUsername WHERE UserID = :userID";
        $kysely = $conn->prepare($sql);
        $kysely->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
        $kysely->bindParam(':userID', $userID, PDO::PARAM_INT);

        // Execute the prepared statement
        $kysely->execute();

        // Close the database connection
        $conn = null;

        // Redirect the user to a confirmation page or the user's profile page
        header("Location: edit_user.php?userID=" . $userID . "&success=true");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} 

else if (isset($_GET['userID']) && filter_var($_GET['userID'], FILTER_VALIDATE_INT)) {
 

// Palvelimen nimi muuttujaan
$servername ="localhost";
$databasename = "eventdatabase";
$username ="root"; // Tarkistetaan phpmyadmin sivulta käyttäjät
$password =""; // Tarkistetaan phpmyadmin sivulta käyttäjät

$userID = $_GET['userID'];

// Yritetään
try {
    // Luodaan yhteys, joka on PDO objekti
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

    // PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // isolla, koska ovat constant arvoja

    echo "SELECT * FROM users WHERE UserID = $userID";
    echo "<br>";

    $kysely = $conn->prepare("SELECT * FROM users WHERE UserID = $userID");

    // SQL injection
    // $sql = "SELECT * FROM users WHERE UserID = :userID";
    // $kysely = $conn->prepare($sql);
    // $kysely->bindParam(':userID', $userID, PDO::PARAM_INT);

    $kysely->execute();

    $user = $kysely->fetch();
    print_r($user);
}
catch(PDOException $e){
    // Yhteysepäonnistui
    echo "Connection failed: " . $e->getMessage();
}
}
else{
    header("Location: index.php?error=true"); // Harjoitus tähän, näytä virhe käyttäjälle
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<!-- if post update successful notice -->
<h2>Edit User Information</h2>
    <form method="post" action="edit_user.php">
        <input type="hidden" name="userID" value="<?php echo $user['UserID']; ?>">
        <label for="newUsername">First Name:</label>
        <input type="text" name="newUsername" value="<?php echo $user['Username'];?>">
        <br><br>

        <input type="submit" value="Update Information">
    </form>
</body>
</html>