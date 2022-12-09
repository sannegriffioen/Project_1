<?php
include 'connect.php';
$pdo = new PDO("mysql:host=localhost;dbname=project", 'bit_academy', 'bit_academy')
?>
<!DOCTYPE html>

<head>
    <title> Login </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
    session_start();
    $error = '';
    if (isset($_POST["login"])) {
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["password"] = $_POST["password"];
        $sql = $pdo->prepare("SELECT * FROM gebruikers WHERE email = :email AND password= :password ");
        $sql->bindParam("email", $_POST["email"]);
        $sql->bindParam("password", $_POST["password"]);
        $sql->execute();
        $Resultaat = $sql->fetchAll();

        if (count($Resultaat) > 0) {
            $_SESSION["loggedInUser"] = $Resultaat[0]['id'];
            $gebruiker = $_SESSION["loggedInUser"];
            $sql = $pdo->prepare("INSERT INTO tijd (gebruiker_id, begin_tijd) VALUES ($gebruiker, Now())");
            $_SESSION["tijd"] = date("H:i:s"); 
            if ($sql->execute()) {
                header('location: index.php');
            };
        } else {
            $error = "Gebruikersnaam of wachtwoord ongeldig";
        }
    }
    ?>
<body>
    <div class="container_gegevens">
        <div class="smal_container">
            <h1> Welkom</h1>
            <form method="POST">
                <input type="email" placeholder="Enter Email" name="email" required>
                <input type="password" placeholder="Enter Password" name="password" required>
                <div class="knoppen">
                    <button type="submit" id="loginbutton" name="login"> Login</button>
                    <p><?= $error?></p>
                    <a href="registreer.php">Registreren</a>
                </div>
                <label>
            </form>
        </div>
    </div>
</body>

</html>