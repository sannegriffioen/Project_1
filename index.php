<?php

include 'connect.php';
session_start();
if (empty($_SESSION['loggedInUser'])) {
    header('location: login.php');
}
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Project 1</title>
</head>
<?php
    $gebruiker = $_SESSION["loggedInUser"];
    $resultst = $pdo->query("SELECT * FROM gebruikers WHERE type = 'student'");
    $rows = $resultst->fetch();

    $results = $pdo->query("SELECT * FROM gebruikers where id = $gebruiker AND type = 'coach'");
if ($gebruikertype = $results->fetch()) {
    $resultaat = $pdo->query("SELECT t.id, g.naam, t.begin_tijd, t.doel, t.type FROM gebruikers g INNER JOIN tijd t ON g.id = t.gebruiker_id");
    ?> 
    <body>
    <nav>
        <p>name side</p>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">|||</a>
                <ul>
                    <li><a href="gegevens_coach.php">Gegevens</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
        <div id="tijd"></div>
    </nav>
    <div class="container_gegevens">
        <div class="smal_container">
        <h1>Welkom: <?= $row['naam'] ?></h1>
        <?php
         while ($rowTijd = $resultaat->fetch()) {
             $naam = $rowTijd['naam'];
             $id = $rowTijd['id'];
            if (!empty($rowTijd['doel'])) {
                if ($rowTijd['type'] == 'niet_goed' || $rowTijd['type'] == NULL) {
                ?> <table class="tijden_gegevens">
                    <tr>
                        <td><?=  $rowTijd['naam']?></td>
                        <td> <?= date('d/m/y', strtotime($rowTijd['begin_tijd']))  . '    ';   ?></td>
                        <td> <?= date('H:i:s', strtotime($rowTijd['begin_tijd']))  . '    ';   ?></td>
                        <td> <?php echo $rowTijd['doel'] . ' '; ?></td>
                    <?php
                    ?>  <td> 
                        <form method="POST">
                            <select name="type" id="type">
	                            <option value="goed" >Goed</option>
	                            <option value="niet_goed">Niet goed</option>
                            </select></td> 
                            
                            <input type="hidden" id="typeid" name="typeid" value="<?php echo $id;?>">
                            <td><button type="submit" name="submit">Verstuur</button></td>
                        </tr>
                    </form>
                    
                </table>
    <?php
    } 
    } }
    ?>
     </div>
        </div>
    <?php
    if (isset($_POST["submit"])) {
    $typeid = $_POST['typeid'];
    $sql = $pdo->prepare("UPDATE tijd SET `type` = :type WHERE id = $typeid");
    $sql->bindParam(':type', $_POST['type']);
    $sql->execute();
    } 
?>
<script src="script.js"></script>
</body>
<?php
} else {           
?>
<body>
    <nav>
        <p>name side</p>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">|||</a>
                <ul>
                    <li><a href="doel.php">Doelen</a></li>
                    <li><a href="gegevens.php">Gegevens</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
            <li><h1>Welkom: <?= $row['naam'] ?></h1></li>
        </ul>
        <div id="tijd"></div>
    </nav>
    <div class="container">
        <table class="tijden">
        <tr>
            <th> Datum</th>
            <th> Inlog</th>
            <th> Uitlog</th>
        </tr>
        <?php
        $result = $pdo->query("SELECT * FROM tijd where gebruiker_id = $gebruiker ORDER BY id DESC LIMIT 7");
        while ($row = $result->fetch()) {
        ?>
            <tr>
                <td> <?= date('d/M/Y', strtotime($row['begin_tijd']))?></td>
                <td> <?= date('H:i:s', strtotime($row['begin_tijd']))?></td>
                <?php
                if ($row['eind_tijd'] === NULL) {
                    ?> <td></td>
                <?php
                } else {
                    ?>
                    <td> <?= date('H:i:s', strtotime($row['eind_tijd']))?></td>
                    <?php
                } 
            }
                    ?>
            </tr>
        </table>
        <div class="smal_container">
            <div class="doel">
            <?php
            if (empty($_SESSION["doel"])) {
                echo "vul een doel in!";
            } else {
                echo "Je doel van vandaag is: ";
                echo $_SESSION["doel"];
            }
            ?>
            </div>
            <table class="tijden_smal_container">
            <?php
                $result = $pdo->query("SELECT * FROM tijd where gebruiker_id = $gebruiker ORDER BY id DESC LIMIT 7");
                ?>
                <tr>
                    <th>Doel</th>
                    <th>Gekeurd</th>
                </tr>
                <tr>
                <?php
                while ($rowse = $result->fetch()) {
                  ?>
                
                    <td><?php echo $rowse['doel'];?></td>
                    <td> 
                    <?php
                    if ($rowse['type'] == "niet_goed") {
                        echo "afgekeurd: vul een nieuw doel in";
                    } else {
                        echo $rowse['type'];
                    }
                    ?>
                    </td>
                </tr>  
                <?php } ?>
                
            </table>
        </div>
        <div class="tijden_gegevens">
            <?php
            echo "Start tijd: " . $_SESSION["tijd"] . "<br>";
            $date = date_create($_SESSION["tijd"]);
            date_add($date,date_interval_create_from_date_string("6 hours 30 minutes"));
            echo "Eind tijd: " . date_format($date,"H:i:s") . "<br>";
            ?>
        </div>
    </div>
</body>
<script src="script.js"></script>

<?php 
} ?>
</html>