<!DOCTYPE html>
<html>
<head>
<?php
include_once('connection.php');
session_start();
if(isset($_SESSION['prepspells'])){}
else{$_SESSION['prepspells']=0;}
print_r($_SESSION['prepspells']);
?>
<title>Spells</title>
</head>
<body>
<a href="http://localhost/coursework/sheet.php">Back</a><br>
<form class="charsheet" action="savespells.php" method="post">
<?php
print_r($_SESSION['ClassID']);
$preppedspellsA=array();

$preppedspells=$conn->prepare("SELECT SpellID
FROM charhasspell
WHERE CharID=:charid
");
$preppedspells->bindParam(':charid',$_SESSION['char']);
$preppedspells->execute();
while ($row = $preppedspells->fetch(PDO::FETCH_ASSOC)){
  array_push($preppedspellsA,$row['SpellID']);
}

?>
<table>
    <tr>
        <th>Prepared?</th>
        <th>Spell Name</th>
        <th>Spell Level</th>
        <th>Tags</th>
<?php
switch ($_SESSION['ClassID']) {
  case 1 or 2:
    $maxspell=ceil($_SESSION['level']/2);
    if ($maxspell>9){$maxspell=9;}
  case 3:
    $maxspell=ceil($_SESSION['level']/2);
    if ($maxspell>5){$maxspell=5;}
}

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
    if (in_array($row['spID'], $uniquespIDs))
    {
      if (in_array($row['tag'], $tags)){}
      else
      {
        array_push($tags,$row['tag']);
        echo("<td>".$row['tag']."</td>");
      }
    }
    else 
    {
      $tags=array();
      array_push($tags,$row['tag']);
      array_push($uniquespIDs,$row['spID']);
      if (in_array($row['spID'], $preppedspellsA)){
        echo("</tr><tr><td><input name='".$row['spID']."' type='checkbox' checked/></td><td>".$row['spn']."</td><td>".$row['splev']."</td><td>".$row['tag']."</td>");
      }
      elseif($_SESSION['prepspells']==0){
        echo("</tr><tr><td><input name='".$row['spID']."' type='checkbox' /></td><td>".$row['spn']."</td><td>".$row['splev']."</td><td>".$row['tag']."</td>");
      }
    }
  }
echo("</tr></table>");
echo("Show prepped spells only? <input name='prepspells' type='checkbox' ");
if($_SESSION['prepspells']==1){echo("checked");}
echo(" /><br>");
?>

<input type="submit" value="Save">
<br><br><br>
<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>