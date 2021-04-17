<?php
session_start();
include_once("connection.php");
#this sets the charid variable to be null, so that if the user tries to skip to the character page without having selected a character properly, it'll send them back
$_SESSION['char']=NULL;
#if the user doesn't have permission to be here, it sends them to the login page
if (isset($_SESSION['Role'])){}
else {header("Location:Login.php");}

#echo("UserID is ".$_SESSION['loggedinuser'].".<br>");
#this pulls all the characters associated with the user for later usage
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
  <!-- this creates a dropdown list with all of the characters associated with the user as options
  with their charids as what is actually sent via post -->
  <?php
  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
  {
    echo('<option value="'.$row['charid'].'">'.$row['charname'].'</option>');
  }
  ?>
  </select><br>
  <input type="submit" value="Select Char">
</form><!--This is a simple textbox that projects what's written in it to makechar.php if the button is pressed-->
<form action="makechar.php" method="post">
  <input name="CharName" placeholder="Aelwyn the Wise">
  <input type="submit" value="Make New Character">
</form>
<br>
<!-- these are just direct links to other pages, as the logout page automatically logs you out-->
<a href="http://localhost/Coursework/deletechar.php">Delete a Character</a>
<br>
<a href="http://localhost/Coursework/login.php">Log Out</a>
</body>
</html>
