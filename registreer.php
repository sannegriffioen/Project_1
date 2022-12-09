<?php
include 'connect.php';
?>
<!DOCTYPE html>

<head>
    <title> Registreren </title>
    <?php
    include 'includes.php';
    ?>
</head>

<body>
    <nav>
        <p>name side</p>
        <ul>
            <li><a href="login.php">Login</a></li>
        </ul>
        <div id="tijd"></div>
    </nav>
    <div class="container_gegevens">
        <div class="smal_container">
            <h1>Registreer</h1>
            <form method="POST">
                <input type="email" placeholder="Enter Email" name="email" required>
                <input type="password" placeholder="Enter Password" name="password" required>
                <input type="name" placeholder="Enter Name" name="naam" required>
                <input type="adress" placeholder="Enter Adress" name="adress" required>
                <input type="date" placeholder="Enter Geboortedatum" name="geboortedatum" required>
                <input type="telefoon" placeholder="Enter Tel number" name="telefoon" required>
                <select name="type" id="type">
	                <option value="student">Student</option>
	                <option value="coach">Coach</option>
                </select>
                <div class="login_button">
                    <button type="submit" name="registreer"> registreren</button>
                </div>
                <label>
            </form>
        </div>
    </div>
    <div class="popup">
    <?php
    if (isset($_POST['terug'])) {
        header('location: index.php');
    }
    if (isset($_POST["registreer"])) {

        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Geen geldig email adres";
        }
        $query = $pdo->prepare("SELECT * FROM gebruikers WHERE email = ?");
        $query->execute([$email]);
        $result = $query->rowCount();

        if ($result > 0) {
            $error = print("Email bestaat al kies een andere email.. ");
        }

        $password = $_POST['password'];
        $naam = $_POST['naam'];
        $adress = $_POST['adress'];
        $geboortedatum = $_POST['geboortedatum'];
        $telefoon = $_POST['telefoon'];
        $type = $_POST['type'];

        if (empty($error)) {
            $sql = $pdo->prepare("INSERT INTO gebruikers SET 
                    email = :email, 
                    password = :password,
                    naam = :naam,
                    adress = :adress,
                    geboortedatum = :geboortedatum,
                    telefoon = :telefoon,
                    type = :type
                ");
        
        
            $sql->bindParam(':email', $_POST['email']);
            $sql->bindParam(':password', $_POST['password']);
            $sql->bindParam(':naam', $_POST['naam']);
            $sql->bindParam(':adress', $_POST['adress']);
            $sql->bindParam(':geboortedatum', $_POST['geboortedatum']);
            $sql->bindParam(':telefoon', $_POST['telefoon']);
            $sql->bindParam(':type', $_POST['type']);
        
            if ($sql->execute()) {
                header('location: login.php');
            }     
        }
    }
    ?>
    </div>
    <script src="script.js"></script>
</body>