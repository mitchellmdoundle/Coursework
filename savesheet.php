<?php
session_start();
include_once("connection.php");
header('Location: sheet.php');
echo('xp '.$_POST['experiencepoints'].'<br>');
echo('charid '.$_SESSION['charid'].'<br>');
#this checks if each ability score is valid, and if it does, puts it in a variable to be put to a database later
#on in the page.
if (is_int(intval($_POST['strengthscore']))){
    if($_POST['strengthscore']<31 and $_POST['strengthscore']>-1){
        $strscore=$_POST['strengthscore'];
    }
    else{$strscore=10;}
}
else{$strscore=10;}

if (is_int(intval($_POST['dexterityscore']))){
    if($_POST['dexterityscore']<31 and $_POST['dexterityscore']>-1){
        $dexscore=$_POST['dexterityscore'];
    }
    else{$dexscore=10;}
}
else{$dexscore=10;}

if (is_int(intval($_POST['constitutionscore']))){
    if($_POST['constitutionscore']<31 and $_POST['constitutionscore']>-1){
        $conscore=$_POST['constitutionscore'];
    }
    else{$conscore=10;}
}
else{$conscore=10;}

if (is_int(intval($_POST['intelligencescore']))){
    if($_POST['intelligencescore']<31 and $_POST['intelligencescore']>-1){
        $intscore=$_POST['intelligencescore'];
    }
    else{$intscore=10;}
}
else{$intscore=10;}

if (is_int(intval($_POST['wisdomscore']))){
    if($_POST['wisdomscore']<31 and $_POST['wisdomscore']>-1){
        $wisscore=$_POST['wisdomscore'];
    }
    else{$wisscore=10;}
}
else{$wisscore=10;}

if (is_int(intval($_POST['charismascore']))){
    if($_POST['charismascore']<31 and $_POST['charismascore']>-1){
        $chascore=$_POST['charismascore'];
    }
    else{$chascore=10;}
}
else{$chascore=10;}
#this is the code that randomises stats using 4d6 drop lowest. it loops 6 times rolling stats, then assigns them in order
#to each stat
if (empty($_POST['randomstat'])){}
else{
    $stats=array();
    for ($x = 1; $x <= 6; $x++) {   
        $tot=0;
        $singlestat=array();
        for ($y = 1; $y <= 4; $y++) {
            array_push($singlestat, rand(1,6));
        }
        $key = array_search(min($singlestat), $singlestat);
        unset($singlestat[$key]);
        foreach($singlestat as $stat){
            $tot=$tot+$stat;
        }
        array_push($stats, $tot);
    }
    $strscore=$stats[0];
    $dexscore=$stats[1];
    $conscore=$stats[2];
    $intscore=$stats[3];
    $wisscore=$stats[4];
    $chascore=$stats[5];
}
#this is the code that updates the database with the new information put into the character sheet when it's updated
$char = $conn->prepare("UPDATE `characters` 
SET `Xp` = :xp, Charname = :charname, BackgroundID = :backgroundID, PlayerName = :playername, Strength = :strength, Dexterity = :dexterity, Constitution = :constitution, Intelligence = :intelligence, Wisdom = :wisdom, Charisma = :charisma
WHERE `characters`.`CharID` = :chara
;");
$char->bindParam(':chara', $_SESSION['charid']);
$char->bindParam(':charname', $_POST['charname']);
$char->bindParam(':xp', $_POST['experiencepoints']);
$char->bindParam(':backgroundID', $_POST['background']);
$char->bindParam(':playername', $_POST['playername']);
$char->bindParam(':strength', $strscore);
$char->bindParam(':dexterity', $dexscore);
$char->bindParam(':constitution', $conscore);
$char->bindParam(':intelligence', $intscore);
$char->bindParam(':wisdom', $wisscore);
$char->bindParam(':charisma', $chascore);
$char->execute();
#this updates a character's class to be whatever it is meant to be
$charclass = $conn->prepare("UPDATE `charhasclass` 
SET `ClassID` = :class, `CharLevel` = :levels
WHERE `charhasclass`.`CharID` = :chara
");
$charclass->bindParam(':chara', $_SESSION['charid']);
$charclass->bindParam(':class', $_POST['class']);
$charclass->bindParam(':levels', $_SESSION['level']);
$charclass->execute();

echo($_POST['class']);
echo("test");
?>
<br>
<a href="http://localhost/Coursework/sheet.php">Return</a>