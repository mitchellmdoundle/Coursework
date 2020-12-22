<?php
session_start();
include_once("connection.php");
echo($_POST['experiencepoints'].'<br>');
echo($_SESSION['charid'].'<br>');
$char = $conn->prepare("UPDATE `characters` 
SET `Xp` = :xp
WHERE `characters`.`CharID` = :chara;
");
$char->bindParam(':chara', $_SESSION['charid']);
$char->bindParam(':xp', $_POST['experiencepoints']);
$char->execute();
?>