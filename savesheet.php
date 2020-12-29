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
?>