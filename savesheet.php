<?php
session_start();
include_once("connection.php");
header('Location: sheet.php');
echo('xp '.$_POST['experiencepoints'].'<br>');
echo('charid '.$_SESSION['charid'].'<br>');

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