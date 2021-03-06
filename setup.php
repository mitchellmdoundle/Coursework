<?php
//header( "Location: http://localhost/Coursework/login.php" );
include_once ("connection.php");
#this entire page just exists to generate all the required relational databases for the project
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
    (null, "NoahCooper", "NoahEmail@email.com", "apple1", 0),
    (null, "JamesEgerton", "JamesEmail@email.com", "balogne", 0)
    ');
$pop->execute();
$pop->closeCursor();

$two = $conn->prepare("DROP TABLE IF EXISTS characters;
CREATE TABLE characters (
    CharID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    UserID INT(4) UNSIGNED NOT NULL,
    CharName VARCHAR(20),
    PlayerName VARCHAR(20),
    BackgroundID INT(2) DEFAULT(0),
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
    CastingTime VARCHAR(30),
    Description VARCHAR(2000),
    Duration VARCHAR(40),
    Verbal INT(1),
    Somatic INT(1),
    Material VARCHAR(200),
    RangeofSpell VARCHAR(40),
    RangeBounds INT(6),
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
    SpellID INT(4) UNSIGNED,
    Tag VARCHAR(20), 
    PRIMARY KEY (SpellID, Tag)
);
");
$five->execute();
$five->closeCursor();

$six = $conn->prepare("DROP TABLE IF EXISTS charhasspell;
CREATE TABLE charhasspell (
    CharID INT(6) UNSIGNED,
    SpellID INT(4) UNSIGNED,
    Often TINYINT(1),
    PRIMARY KEY (CharID, SpellID)
);
");
$six->execute();
$six->closeCursor();

$seven = $conn->prepare("DROP TABLE IF EXISTS class;
CREATE TABLE class (
    ClassID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ClassName VARCHAR(15),
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
    ClassID INT(2) UNSIGNED,
    CharLevel INT(2)
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
    SubclassID INT(4) UNSIGNED PRIMARY KEY
);
");
$eleven->execute();
$eleven->closeCursor();

$twelve = $conn->prepare("DROP TABLE IF EXISTS classhasspells;
CREATE TABLE classhasspells (
    ClassID INT(2) UNSIGNED,
    SpellID INT(4) UNSIGNED,
    PRIMARY KEY (ClassID,SpellID)
);
");
$twelve->execute();
$twelve->closeCursor();

$thirteen = $conn->prepare("DROP TABLE IF EXISTS subclassfeatures;
CREATE TABLE subclassfeatures (
    SubclassID INT(4) UNSIGNED PRIMARY KEY,
    CharLevel INT(2) UNSIGNED,
    Feature VARCHAR(3000)
);
");
$thirteen->execute();
$thirteen->closeCursor();

$fourteen = $conn->prepare("DROP TABLE IF EXISTS subancestryfeatures;
CREATE TABLE subancestryfeatures (
    SubAncestryID INT(2) UNSIGNED PRIMARY KEY,
    CharLevel INT(2) UNSIGNED,
    Feature VARCHAR(3000)
);
");
$fourteen->execute();
$fourteen->closeCursor();

$fifteen = $conn->prepare("DROP TABLE IF EXISTS classfeatures;
CREATE TABLE classfeatures (
    ClassID INT(2) UNSIGNED PRIMARY KEY,
    CharLevel INT(2) UNSIGNED,
    Feature VARCHAR(3000)
);
");
$fifteen->execute();
$fifteen->closeCursor();

$sixteen = $conn->prepare("DROP TABLE IF EXISTS subclasshasspells;
CREATE TABLE subclasshasspells (
    SubclassID INT(4) UNSIGNED PRIMARY KEY,
    SpellID INT(4) UNSIGNED
);
");
$sixteen->execute();
$sixteen->closeCursor();

$seventeen = $conn->prepare("DROP TABLE IF EXISTS backgrounds;
CREATE TABLE backgrounds (
    BackgroundID INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    BackgroundName VARCHAR(30),
    ProfOne INT(2),
    ProfTwo INT(2),
    LangTool VARCHAR(20),
    Feature VARCHAR(3000)
);
");
$seventeen->execute();
$seventeen->closeCursor();


#SPELLS
/*$spell = $conn->prepare("
");
$spell->execute();
$spell->closeCursor();*/

$spellone = $conn->prepare("INSERT INTO `spells` (`SpellID`, `Name`, `Spelllevel`, `School`, `CastingTime`, `Description`, `Duration`, `Verbal`, `Somatic`, `Material`, `RangeofSpell`, `Splash`, `Conc`, `Ritual`) VALUES (NULL, 'Fireball', '3', 'Evocation', '1 action', 'A bright streak flashes from your pointing finger to a point you choose within range and then blossoms with a low roar into an explosion of flame. Each creature in a 20-foot-radius sphere centered on that point must make a Dexterity saving throw. A target takes 8d6 fire damage on a failed save, or half as much damage on a successful one. The fire spreads around corners. It ignites flammable objects in the area that aren’t being worn or carried.', 'Instantaneous', '1', '1', 'A tiny ball of bat guano and sulfur', '150', '20ft radius sphere', '0', '0');
");
$spellone->execute();
$spellone->closeCursor();

$spelltwo = $conn->prepare("INSERT INTO `spells` (`SpellID`, `Name`, `Spelllevel`, `School`, `CastingTime`, `Description`, `Duration`, `Verbal`, `Somatic`, `Material`, `RangeofSpell`, `Splash`, `Conc`, `Ritual`) VALUES (NULL, 'Burning Hands', '1', 'Evocation', '1 action', 'As you hold your hands with thumbs touching and fingers spread, a thin sheet of flames shoots forth from your outstretched fingertips. Each creature in a 15-foot cone must make a Dexterity saving throw. A creature takes 3d6 fire damage on a failed save, or half as much damage on a successful one. The fire ignites any flammable objects in the area that aren’t being worn or carried.', 'Instantaneous', '1', '1', NULL, '-1', '15-foot cone', '0', '0');
");
$spelltwo->execute();
$spelltwo->closeCursor();

$spellthree = $conn->prepare("INSERT INTO `spells` (`SpellID`, `Name`, `Spelllevel`, `School`, `CastingTime`, `Description`, `Duration`, `Verbal`, `Somatic`, `Material`, `RangeofSpell`, `Splash`, `Conc`, `Ritual`) VALUES (NULL, 'Acid Splash', '0', 'Conjuration', '1 action', 'You hurl a bubble of acid. Choose one creature within range, or choose two creatures within range that are within 5 feet of each other. A target must succeed on a Dexterity saving throw or take 1d6 acid damage.', 'Instantaneous', '1', '1', NULL, '60', NULL, '0', '0');
");
$spellthree->execute();
$spellthree->closeCursor();

$spellfour = $conn->prepare("INSERT INTO `spells` (`SpellID`, `Name`, `Spelllevel`, `School`, `CastingTime`, `Description`, `Duration`, `Verbal`, `Somatic`, `Material`, `RangeofSpell`, `Splash`, `Conc`, `Ritual`) VALUES (NULL, 'Augury', '2', 'Divination', '1 minute', 'By casting gem-inlaid sticks, rolling dragon bones, laying out ornate cards, or employing some other divining tool, you receive an omen from an otherworldly entity about the results of a specific course of action that you plan to take within the next 30 minutes. The DM chooses from the following possible omens:\r\n\r\n<br>Weal, for good results\r\n<br>Woe, for bad results\r\n<br>Weal and woe, for both good and bad results\r\n<br>Nothing, for results that aren\'t especially good or bad<br>\r\nThe spell doesn\'t take into account any possible circumstances that might change the outcome, such as the casting of additional spells or the loss or gain of a companion.\r\n\r\nIf you cast the spell two or more times before completing your next long rest, there is a cumulative 25 percent chance for each casting after the first that you get a random reading. The DM makes this roll in secret.', 'Instantaneous', '1', '0', NULL, 'Self', NULL, '0', '1');
");
$spellfour->execute();
$spellfour->closeCursor();

$spellfive = $conn->prepare("INSERT INTO `spells` (`SpellID`, `Name`, `Spelllevel`, `School`, `CastingTime`, `Description`, `Duration`, `Verbal`, `Somatic`, `Material`, `RangeofSpell`, `Splash`, `Conc`, `Ritual`) VALUES (NULL, 'Charm Person', '1', 'Enchantment', '1 action', 'text', '1 hour', '1', '1', NULL, '30', NULL, '1', '0');
");
$spellfive->execute();
$spellfive->closeCursor();

$spellmore = $conn->prepare("INSERT INTO `spells` (`SpellID`, `Name`, `Spelllevel`, `School`, `CastingTime`, `Description`, `Duration`, `Verbal`, `Somatic`, `Material`, `RangeofSpell`, `Splash`, `Conc`, `Ritual`) 
VALUES (NULL, 'Hypnotic Pattern', '3', 'Illusion', '1 action', 'text', '1 minute', '0', '1', 'A glowing stick of incense or a crystal vial filled with phosphorescent material', '120', '30-foot cube', '1', '0');
");
$spellmore->execute();
$spellmore->closeCursor();


#this is a template for spells
/*$spellfive = $conn->prepare("INSERT INTO `spells` (`SpellID`, `Name`, `Spelllevel`, `School`, `CastingTime`, `Description`, `Duration`, `Verbal`, `Somatic`, `Material`, `RangeofSpell`, `Splash`, `Conc`, `Ritual`) VALUES (NULL, 'Charm Person', '1', 'Enchantment', '1 hour', 'text', 'Instantaneous', '1', '0', NULL, '30', NULL, '0', '1');
");
$spellfive->execute();
$spellfive->closeCursor();*/

#TAGS
/*$tag = $conn->prepare("
");
$tag->execute();
$tag->closeCursor();*/

$tags = $conn->prepare("INSERT INTO `tags` (`Tag`) VALUES ('Fire'), ('Healing'), ('AoE'), ('Damage'), ('Utility'), ('Social'), ('Acid');
");
$tags->execute();
$tags->closeCursor();

#GIVING SPELLS TAGS

$spelltags = $conn->prepare("INSERT INTO `spellhastags` (`SpellID`, `Tag`) 
VALUES (1, 'Fire'), (2, 'Fire'), (1, 'AoE'), (2, 'AoE'), (1,'Damage'), (2,'Damage'), (3,'Acid'), 
(3,'Damage'), (4,'Utility'), (5, 'Utility'), (5, 'Social'), (6, 'AoE'), (6, 'Utility');
");
$spelltags->execute();
$spelltags->closeCursor();

#CLASSES
$classes = $conn->prepare("INSERT INTO class (ClassName) 
    VALUES ('Sorcerer'), ('Bard'), ('Warlock'), ('Wizard'), ('Cleric'), ('Fighter'), ('Druid')
");
$classes->execute();
$classes->closeCursor();

#MAKING TEST CHARACTERS
$makingchars = $conn->prepare("INSERT INTO characters (UserID, CharName) 
    VALUES (2,'Joe'), (2,'Wilbur')
");
$makingchars->execute();
$makingchars->closeCursor();

#BACKGROUNDS
$background = $conn->prepare("INSERT INTO backgrounds (BackgroundName) 
    VALUES ('Sage'), ('Outlander'), ('Criminal'), ('Hermit'), ('Folk Hero')
");
$background->execute();
$background->closeCursor();

#ASSIGNING TEST CHARACTERS CLASSES
$givingclass = $conn->prepare("INSERT INTO charhasclass (CharId, ClassID, CharLevel) 
    VALUES (1,1,2), (2,2,1)
");
$givingclass->execute();
$givingclass->closeCursor();

#ASSIGNING SPELLS TO CLASSES
$classspells = $conn->prepare("INSERT INTO classhasspells (ClassId, SpellID) 
    VALUES (1,1), (1,2), (1,3), (1,5), (1,6), (2,5), (2,6), (3,5), (3,6), (4,1), (4,2), (4,3), (4,4), (4,5), (4,6), (5,4), (7,4)
");
$classspells->execute();
$classspells->closeCursor();

echo("done");
$conn=null;











?>

