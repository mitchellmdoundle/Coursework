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
$stmt = $conn->prepare("SELECT spells.name as spellname, spells.school as school, spells.spelllevel as spelllevel,
 spellhastags.tag as tag, spells.SpellID as id
FROM spellhastags
INNER JOIN spells
ON spells.SpellID=spellhastags.SpellID
ORDER BY id
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
?>
</table>

<br><br><br>
<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>