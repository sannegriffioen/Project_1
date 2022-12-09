<?php
include 'connect.php';
session_start();
$gebruiker = $_SESSION["loggedInUser"];
$result = $pdo->query("SELECT * FROM gebruikers where id = $gebruiker");
$row = $result->fetch()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gegevens</title>
</head>
<body>
<nav>
    <p>name side</p>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">|||</a>
            <ul>
                <li><a href="doel.php">Doelen</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
    <div id="tijd"></div>
</nav>
<div class="container_gegevens">
    <p>Gebruikers gegevens:</p>
    <div class="smal_container">
        <table class="tijden_gegevens">
            <?php
            $gebruiker = $_SESSION["loggedInUser"];
            $result = $pdo->query("SELECT * FROM gebruikers where id = $gebruiker");
            while ($row = $result->fetch()) {
            ?>
                <tr>
                    <td>Email</td>
                    <td> <?= $row['email'] . '    ';   ?></td>
                </tr>
                <tr>
                    <td>Naam</td>
                    <td> <?= $row['naam'] . '    ';   ?></td>
                </tr>
                <tr>
                    <td>Adress</td>
                    <td> <?= $row['adress'] . '    ';   ?></td>
                </tr>
                <tr>
                    <td>Geboortedatum</td>
                    <td> <?= date('d/M/Y', strtotime($row['geboortedatum'])) . '    ';   ?></td>
                </tr>
                <tr>
                    <td>Telefoonnummer</td>
                    <td> <?= $row['telefoon'] . '    ';   ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
    <script src="script.js"></script>
</body>
</html>