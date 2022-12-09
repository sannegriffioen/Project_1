<?php
session_start();
include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Uitlog</title>
</head>

<body>
    <div class="container_gegevens">
        <div class="smal_container">
            <form method="POST" class="logout_form">
                <h1>weet je zeker dat je wilt uitloggen?</h1>
                <div class="btn_form_logout">
                    <button type="submit" name="ja" onclick="logout" class="btn_logout">Ja</button>
                    <button type="submit" name="nee" onclick="logout" class="btn_logout">Nee</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
$gebruiker = $_SESSION["loggedInUser"];
if (isset($_POST["ja"])) {
    $sql = $pdo->prepare("UPDATE tijd SET eind_tijd = NOW() WHERE gebruiker_id = $gebruiker ORDER BY `id` DESC LIMIT 1");
    if ($sql->execute()) {
        header('location: login.php');
        session_destroy();
    }
}
if (isset($_POST["nee"])) {
    header('location: index.php');
}
?>
