<?php
session_start();
include_once("connection.php");
echo($_POST['experiencepoints'].'<br>');
echo($_SESSION['charid'].'<br>');

$char = $conn->prepare("UPDATE `characters` 
SET `Xp` = :xp, Charname = :charname
WHERE `characters`.`CharID` = :chara
;");
$char->bindParam(':chara', $_SESSION['charid']);
$char->bindParam(':charname', $_POST['charname']);
$char->bindParam(':xp', $_POST['experiencepoints']);
$char->execute();

$charclass = $conn->prepare("UPDATE `charhasclass` 
SET `ClassID` = :class, `Level` = :levels
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