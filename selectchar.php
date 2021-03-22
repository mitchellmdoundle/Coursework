<?php
session_start();
include_once("connection.php");
$_SESSION['char']=NULL;
if (isset($_SESSION['Role'])){}
else {header("Location:Login.php");}

echo("UserID is ".$_SESSION['loggedinuser'].".<br>");

$stmt2 = $conn->prepare("SELECT characters.CharID as charid, characters.CharName as charname, UserID as user
FROM characters
WHERE UserID=:user
");
$stmt2->bindParam(':user', $_SESSION['loggedinuser']);
$stmt2->execute();

?>
<!DOCTYPE html>
<html>
<body>
<form action="sheet.php" method="post"> 
  <select name="char" id="char">
  <?php
  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
  {
    echo('<option value="'.$row['charid'].'">'.$row['charname'].'</option>');
  }
  ?>
  </select><br>
  <input type="submit" value="Select Char">
</form>
<form action="makechar.php" method="post">
  <input name="CharName" placeholder="Aelwyn the Wise">
  <input type="submit" value="Make New Character">
</form>
<br>
<a href="http://localhost/Coursework/deletechar.php">Delete a Character</a>
<br>
<a href="http://localhost/Coursework/login.php">Log Out</a>
</body>
</html>
