<!DOCTYPE html>
<html>
<head>
<?php
include_once('connection.php');
session_start();
?>
<title>Spells</title>
</head>
<body>
<a href="http://localhost/coursework/sheet.php">Back</a><br>
<?php
print_r($_SESSION['ClassID']);
?>
&lttable&gt
    &lttr&gt
        &ltth&gtSpell Name&lt/th&gt
        &ltth&gtSpell Level&lt/th&gt
        &ltth&gtTags&lt/th&gt
<?php
switch ($_SESSION['ClassID']) {
  case 1 or 2:
    $maxspell=ceil($_SESSION['level']/2);
    if ($maxspell>9){$maxspell=9;}
  case 3:
    $maxspell=ceil($_SESSION['level']/2);
    if ($maxspell>5){$maxspell=5;}
}
  
$spellclassA=array();

$spellclass = $conn->prepare("SELECT classhasspells.ClassID, classhasspells.SpellID, class.ClassID as cid, spells.Name as spn, spells.SpellID as spID, spells.Spelllevel as splev, charhasclass.CharLevel as lev, spells.school as spellschool, spellhastags.tag as tag
FROM classhasspells
INNER JOIN class
ON class.ClassID=classhasspells.ClassID
INNER JOIN spells
ON spells.spellID=classhasspells.spellID
INNER JOIN charhasclass
ON charhasclass.ClassID=classhasspells.ClassID
INNER JOIN spellhastags
ON spellhastags.SpellID=spells.SpellID
WHERE classhasspells.ClassID=:spellclass and spells.Spelllevel <= :maxspell
ORDER BY classhasspells.SpellID
");
$spellclass->bindParam(':spellclass', $_SESSION['ClassID']);
$spellclass->bindParam(':maxspell', $maxspell);
$spellclass->execute();

$uniquespIDs=array();
$tags=array();
while ($row = $spellclass->fetch(PDO::FETCH_ASSOC))
  {
    #print_r($row);
    if (in_array($row['spID'], $uniquespIDs))
    {
      #echo("Repeat");
      if (in_array($row['tag'], $tags)){}
      else
      {
        array_push($tags,$row['tag']);
        echo("&lttd&gt".$row['tag']."&lt/td&gt");
      }
    }
    else 
    {
      #print_r($tags);
      $tags=array();
      echo("&lt/tr&gt&lttr&gt&lttd&gt".$row['spn']."&lt/td&gt&lttd&gt".$row['splev']."&lt/td&gt");
      array_push($tags,$row['tag']);
      echo("&lttd&gt".$row['tag']."&lt/td&gt");
      #print_r($row);
      array_push($uniquespIDs,$row['spID']);
      #echo("&lttr&gt&lttd&gt".$row['spn']."&lt/td&gt&lttd&gt".$row['splev']."&lt/td&gt&lttd&gt".$row['tag'])."&lt/td&gt&lttd&gt";
    }
  }
echo("&lt/table&gt");

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

<br><br><br>
<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>