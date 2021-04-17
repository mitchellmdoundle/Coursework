<?php
session_start();
include_once("connection.php");
header('Location: selectchar.php');
#
$makechars = $conn->prepare("INSERT INTO characters (UserID, CharName) 
    VALUES (:userid,:charname)
");
$makechars->bindParam(':charname', $_POST['CharName']);
$makechars->bindParam(':userid', $_SESSION['loggedinuser']);
$makechars->execute();

$checkcharid = $conn->prepare("SELECT MAX(CharID)
FROM characters
");
$checkcharid->execute();
while ($row = $checkcharid->fetch(PDO::FETCH_ASSOC))
  {
    $charid=$row['MAX(CharID)'];
  }

$givingclass = $conn->prepare("INSERT INTO charhasclass (CharId, ClassID, CharLevel) 
    VALUES (:charid,1,1)
");
$givingclass->bindParam(':charid', $charid);
$givingclass->execute();