<?php
//header( "Location: http://localhost/Coursework/login.php" );
include_once ("connection.php");
$one = $conn->prepare("DROP TABLE IF EXISTS users;
CREATE TABLE users (
    UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(20) NOT NULL,
    Email VARCHAR(20) NOT NULL,
    Password VARCHAR(20) NOT NULL,
    Role TINYINT(1) NOT NULL DEFAULT(0)
);
");
$one->execute();
$one->closeCursor();

$two = $conn->prepare("DROP TABLE IF EXISTS characters;
CREATE TABLE characters (
    CharID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    UserID INT(4) UNSIGNED NOT NULL,
    CharName VARCHAR(20),
    ClassID INT(2),
    SubclassID INT(2),
    BackgroundID INT(2),
    SubRaceID INT(2),
    Strength INT(2) DEFAULT(10),
    Dexterity INT(2) DEFAULT(10),
    Constitution INT(2) DEFAULT(10),
    Intelligence INT(2) DEFAULT(10),
    Wisdom INT(2) DEFAULT(10),
    Charisma INT(2) DEFAULT(10),
    Dsavespass INT(1) DEFAULT(0),
    Dsavesfail INT(1) DEFAULT(0),
    ArmorWorn VARCHAR(30),
    Athletics INT(1) DEFAULT(0),
    Acrobatics INT(1) DEFAULT(0),
    SleightofHand INT(1) DEFAULT(0),
    Stealth INT(1) DEFAULT(0),
    Arcana INT(1) DEFAULT(0),
    History INT(1) DEFAULT(0),
    Investigation INT(1) DEFAULT(0),
    Nature INT(1) DEFAULT(0),
    Religion INT(1) DEFAULT(0),
    AnimalHandling INT(1) DEFAULT(0),
    Insight INT(1) DEFAULT(0),
    Medicine INT(1) DEFAULT(0),
    Perception INT(1) DEFAULT(0),
    Survival INT(1) DEFAULT(0),
    Deception INT(1) DEFAULT(0),
    Intimidation INT(1) DEFAULT(0),
    Performance INT(1) DEFAULT(0),
    Persuasion INT(1) DEFAULT(0),
    CurrentHP INT(4),
    TempHP INT(2),
    MaxHPdiff INT(2),
    Alignment VARCHAR(20), 
    Inspiration INT(1),
    Personality VARCHAR(1000),
    Ideals VARCHAR(1000),
    Bonds VARCHAR(1000),
    Flaws VARCHAR(1000),
    Backstories VARCHAR(3000),
    Allies  VARCHAR(1000),
    Treasure INT(8),
    Age INT(4),
    Height VARCHAR(20),
    Weight VARCHAR(20),
    Eyes VARCHAR(20),
    Skin VARCHAR(20),
    Hair VARCHAR(20),
    Notes  VARCHAR(2000)
);
");
$two->execute();
$two->closeCursor();

echo("done");
$conn=null;

?>