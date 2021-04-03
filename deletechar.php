<?php
session_start();
include_once("connection.php");
if (isset($_SESSION['Role'])){}
else {header("Location:Login.php");}
if (isset($_POST['deletchar'])){
    $delete = $conn->prepare("DELETE
    FROM characters
    WHERE CharID=:charid
    ");
    $delete->bindParam(':charid', $_POST['deletchar']);
    $delete->execute();

    $delete2 = $conn->prepare("DELETE
    FROM charhasclass
    WHERE CharID=:charid
    ");
    $delete2->bindParam(':charid', $_POST['deletchar']);
    $delete2->execute();

    $delete3 = $conn->prepare("DELETE
    FROM charhasspell
    WHERE CharID=:charid
    ");
    $delete3->bindParam(':charid', $_POST['deletchar']);
    $delete3->execute();
}

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
<form action="deletechar.php" method="post"> 
  <select name="deletchar" id="deletchar">
  <?php
  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
  {
    echo('<option value="'.$row['charid'].'">'.$row['charname'].'</option>');
  }
  ?>
  </select><br>
  <input type="submit" value="Delete Char">
</form>
<br>
<a href="http://localhost/Coursework/selectchar.php">Return</a>
</body>
</html>