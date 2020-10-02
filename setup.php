<?php
//header( "Location: http://localhost/Coursework/login.php" );
include_once ("connection.php");
$one = $conn->prepare("DROP TABLE IF EXISTS users;
CREATE TABLE users (
    UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(20) NOT NULL,
    Email VARCHAR(40) NOT NULL,
    Password VARCHAR(20) NOT NULL,
    Role TINYINT(1) NOT NULL DEFAULT(0)
);
");
$one->execute();
$one->closeCursor();

$pop = $conn->prepare('
INSERT INTO users(UserID,Username,Email,Password,Role)
VALUES 
    (null, "MatthewMitchell", "MattEmail@email.com", "banana1", 1),
    (null, "NoahCooper", "NoahEmail@email.com", "apple1", 0)
    ');
$pop->execute();
$pop->closeCursor();

$two = $conn->prepare("DROP TABLE IF EXISTS characters;
CREATE TABLE characters (
    CharID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    UserID INT(4) UNSIGNED NOT NULL,
    CharName VARCHAR(20),
    BackgroundID INT(2),
    SubAncestryID INT(2),
    Xp Int(4) DEFAULT(0),
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
    Inspiration TINYINT(1),
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

$three = $conn->prepare("DROP TABLE IF EXISTS spells;
CREATE TABLE spells (
    SpellID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(20),
    Spelllevel INT(1),
    School VARCHAR(15),
    Description VARCHAR(2000),
    Duration VARCHAR(40),
    Verbal INT(1),
    Somatic INT(1),
    Material VARCHAR(200),
    RangeofSpell INT(6),
    Splash VARCHAR(30),
    Conc TINYINT(1),
    Ritual TINYINT(1)
);
");
$three->execute();
$three->closeCursor();

$four = $conn->prepare("DROP TABLE IF EXISTS tags;
CREATE TABLE tags (
    Tag VARCHAR(20) PRIMARY KEY
);
");
$four->execute();
$four->closeCursor();

$five = $conn->prepare("DROP TABLE IF EXISTS spellhastags;
CREATE TABLE spellhastags (
    SpellID INT(4) UNSIGNED PRIMARY KEY,
    Tag VARCHAR(20)
);
");
$five->execute();
$five->closeCursor();

$six = $conn->prepare("DROP TABLE IF EXISTS charhasspell;
CREATE TABLE charhasspell (
    CharID INT(6) UNSIGNED PRIMARY KEY,
    SpellID INT(4) UNSIGNED,
    Often TINYINT(1)
);
");
$six->execute();
$six->closeCursor();

$seven = $conn->prepare("DROP TABLE IF EXISTS class;
CREATE TABLE class (
    ClassID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ProfNum INT(2),
    Hitdie INT(2),
    Savingthrow1 INT(1),
    Savingthrow2 INT(1),
    Ritual TINYINT(1)  
);
");
$seven->execute();
$seven->closeCursor();

$eight = $conn->prepare("DROP TABLE IF EXISTS subclass;
CREATE TABLE subclass (
    SubclassID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR (20)
);
");
$eight->execute();
$eight->closeCursor();

$nine = $conn->prepare("DROP TABLE IF EXISTS charhasclass;
CREATE TABLE charhasclass (
    CharID INT(6) UNSIGNED PRIMARY KEY,
    ClassID INT(4) UNSIGNED,
    Level INT(4)
);
");
$nine->execute();
$nine->closeCursor();

$ten = $conn->prepare("DROP TABLE IF EXISTS charhassubclass;
CREATE TABLE charhassubclass (
    CharID INT(6) UNSIGNED PRIMARY KEY,
    SubclassID INT(4) UNSIGNED
);
");
$ten->execute();
$ten->closeCursor();

$eleven = $conn->prepare("DROP TABLE IF EXISTS classhassubclass;
CREATE TABLE classhassubclass (
    ClassID INT(4) UNSIGNED PRIMARY KEY,
    SubclassID INT(4) UNSIGNED
);
");
$eleven->execute();
$eleven->closeCursor();

$twelve = $conn->prepare("DROP TABLE IF EXISTS classhasspells;
CREATE TABLE classhasspells (
    ClassID INT(4) UNSIGNED PRIMARY KEY,
    SpellID INT(4) UNSIGNED
);
");
$twelve->execute();
$twelve->closeCursor();

$thirteen = $conn->prepare("DROP TABLE IF EXISTS subclassfeatures;
CREATE TABLE subclassfeatures (
    SubclassID INT(4) UNSIGNED PRIMARY KEY,
    Level INT(2) UNSIGNED,
    Feature VARCHAR(3000) UNSIGNED
);
");
$thirteen->execute();
$thirteen->closeCursor();

$fourteen = $conn->prepare("DROP TABLE IF EXISTS subancestryfeatures;
CREATE TABLE subancestryfeatures (
    SubAncestryID INT(2) UNSIGNED PRIMARY KEY,
    Level INT(2) UNSIGNED,
    Feature VARCHAR(3000) UNSIGNED
);
");
$fourteen->execute();
$fourteen->closeCursor();

$fifteen = $conn->prepare("DROP TABLE IF EXISTS classfeatures;
CREATE TABLE classfeatures (
    ClassID INT(4) UNSIGNED PRIMARY KEY,
    Level INT(2) UNSIGNED,
    Feature VARCHAR(3000) UNSIGNED
);
");
$fifteen->execute();
$fifteen->closeCursor();

echo("done");
$conn=null;

?>