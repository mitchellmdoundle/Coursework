<!DOCTYPE html>
<html>
<head>
<title>Sheet</title>
</head>
<body>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT spells.name as spellname, spells.school as school, spells.spelllevel as spelllevel, spellhastags.tag as tag
FROM spellhastags
INNER JOIN spells
ON spells.SpellID=spellhastags.SpellID
WHERE school='Evocation'
");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    print_r($row);
}
?>
<br><br><br>
<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>