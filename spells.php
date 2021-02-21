<!DOCTYPE html>
<html>
<head>
<title>Spells</title>
</head>
<body>
<table>
    <tr>
        <th>Spell Name</th>
        <th>Spell Level</th>
        <th>Tags</th>
    </tr>
<?php
include_once('connection.php');
session_start();

$spellclassA=array();

$spellclass = $conn->prepare("SELECT class.ClassID as classid, spells.SpellID as spells
FROM classhasspells
INNER JOIN class
ON class.ClassID=classhasspells.ClassID
FROM classhasspells
INNER JOIN spells
ON spells.SpellID=classhasspells.SpellID
ORDER BY id
WHERE 
");
$spellclass->bindParam(':spellclass', $_SESSION['Class']);
$spellclass->execute();
while ($row = $spellclass->fetch(PDO::FETCH_ASSOC))
  {
    array_push($spellclassA, $row['ClassID'], $row['SpellID']);
  }

$stmt = $conn->prepare("SELECT spells.name as spellname, spells.school as school, spells.spelllevel as spelllevel,
 spellhastags.tag as tag, spells.SpellID as id
FROM spellhastags
INNER JOIN spells
ON spells.SpellID=spellhastags.SpellID
ORDER BY id
WHERE 
");
$stmt->execute();

$uniqueIDs=array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    if (in_array($row['id'], $uniqueIDs))
    {
        echo($row['tag']."</td><td>");
    }
    else
    {
        echo("<tr><td>".$row['spellname']."</td><td>".$row['spelllevel']."</td><td>".$row['tag'])."</td><td>";
        array_push($uniqueIDs,$row['id']);
    }
}
echo("</td></tr>");
/*print_r($uniqueIDs);*/

$charA=array();

$char = $conn->prepare("SELECT *
FROM charhasclass
INNER JOIN characters
ON characters.CharID=charhasclass.CharID
WHERE charhasclass.CharID=:chara
");
$char->bindParam(':chara', $_SESSION['charid']);
$char->execute();

while ($row = $char->fetch(PDO::FETCH_ASSOC))
  {
    #print_r($row);
    array_push($charA, $row['CharName'], $row['Xp']);
  }


?>
</table>

<br><br><br>
<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>