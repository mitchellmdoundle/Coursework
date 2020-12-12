<!DOCTYPE html>
<html>
<head>
<title>Sheet</title>
</head>
<body>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT spells.name as spellname, spells.school as school, spells.spelllevel as spelllevel,
 spellhastags.tag as tag
FROM spellhastags
INNER JOIN spells
ON spells.SpellID=spellhastags.SpellID
GROUP BY spellname
");
$stmt->execute();
echo("<table><tr><th>Spell Name</th><th>Spell Level</th><th>Tags</th></tr>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo("<tr><td>".$row['spellname']."</td><td>".$row['spelllevel']."</td><td>".$row['tag']."</td></tr>");
}
?>


<br><br><br>
<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>