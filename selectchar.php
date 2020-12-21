<?php
session_start();
include_once("connection.php");
if (isset($_SESSION['Role'])){}
else {header("Location:Login.php");}

echo("UserID is ".$_SESSION['loggedinuser'].".<br>");
$stmt = $conn->prepare("SELECT users.UserID as id, users.Username as username, users.Email as email
FROM users
WHERE UserID=:user
");
$stmt->bindParam(':user', $_SESSION['loggedinuser']);
$stmt->execute();

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
<select name="class" id="cars">
<?php
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC))
{
  echo('<option value="'.$row['charid'].'">'.$row['charname'].'</option>');
}
?>
</select>
<br>
<a href="http://localhost/Coursework/login.php">Log Out</a>
</body>
</html>
