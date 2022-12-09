d<?php
include 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Doel</title>
</head>
<body>
<nav>
    <p>name side</p>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">|||</a>
            <ul>
                <li><a href="gegevens.php">Gegevens</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
    <div id="tijd"></div>
</nav>
<div class="container_gegevens">
    <div class="smal_container">
        <h1>Doel voor vandaag:</h1>
        <form method ="POST" class="from_doel"> 
            <textarea rows="10" cols="70" id="doel" name="doel"></textarea>
            <button type="submit" name="toevoegen" class="doel_button"> Voeg doel toe</button></br>
        </form>
    </div>
</div>
<?php
$gebruiker = $_SESSION["loggedInUser"];
if (isset($_POST["toevoegen"])) {
    $sql = $pdo->prepare("UPDATE tijd SET 
        doel = :doel
        WHERE gebruiker_id = $gebruiker 
        ORDER BY `id` DESC LIMIT 1");
    $sql->bindParam(':doel', $_POST['doel']);
    if ($sql->execute()) {
        header('location: index.php');
    }
    $_SESSION["doel"] = $_POST['doel'];
}    
?>
<script src="script.js"></script>
</body>
</html>