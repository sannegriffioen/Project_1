DROP DATABASE IF EXISTS `project`;

CREATE DATABASE `project`;

USE `project`;

DROP TABLE IF EXISTS `gebruikers`;
CREATE TABLE gebruikers (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(30) NOT NULL,
    password varchar(30) NULL,
    naam VARCHAR(30) NOT NULL,
    adress text(100) NOT NULL,
    geboortedatum date NOT NULL,
    telefoon int(30) NOT NULL,
    type ENUM('coach', 'student')
    );
INSERT INTO gebruikers (email , password , naam, adress, geboortedatum, telefoon, type) VALUES ('test-user@gmail.com' , '123', 'test user', 'amstelstraat 10', '2010-02-10', '0614522395', 'student');

DROP TABLE IF EXISTS `tijd`;
CREATE TABLE tijd(
    id INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gebruiker_id int(4) NOT NULL,
    begin_tijd DATETIME,
    eind_tijd DATETIME NULL,
    doel ENUM('geen', 'matig', 'goed', 'uitstekend'),
    type ENUM('goed', 'niet_goed')
);



DROP DATABASE IF EXISTS `deepdive`;

CREATE DATABASE `deepdive`;

USE `deepdive`;

DROP TABLE IF EXISTS `gebruikers`;

CREATE TABLE gebruikers (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(30) NOT NULL,
    password varchar(30) NULL,
    naam VARCHAR(30) NOT NULL
    );
INSERT INTO gebruikers (email , password , naam) VALUES ('test-user@gmail.com' , '123', 'test user');

DROP TABLE IF EXISTS `talen`;

CREATE TABLE talen(
    id INT(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    gebruiker_id int(4) NOT NULL,
    PHP char(20),
    HTML char(20),
    CSS char(20),
    JS char(20),
    C char(20),
    Python char(20),
    JSON char(20),
    Java char(20)
);

<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <php>
            <form method ="POST" class="PHP"> 
            <select name="PHP" id="PHP">
	                <option value="goed">goed</option>
	                <option value="uitstekend">uitstekend</option>
                </select>
            <button type="submit" name="toevoegen" class="PHP"> Voeg doel toe</button></br>
        </form>
<?php
if (isset($_POST["toevoegen"])) {
    $sql = $pdo->prepare("UPDATE talen SET 
        PHP = :PHP
        HTML = :HTML,
        CSS = :CSS,
        JS = :JS,
        C char(20),
        Python char(20),
    JSON char(20),
    Java
        WHERE gebruiker_id = 1 
        ");

    $sql->bindParam(':PHP', $_POST['PHP']);
    
    $sql->execute();
   
} 
    ?>

</body>
</html>