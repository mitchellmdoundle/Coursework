<?php
session_start();
$_SESSION = array();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<form action="logincheck.php" method="post">
  Username:<input type="text" name="username"><br>
  Password:<input type="password" name="passwd"><br>
  <input type="submit" value="Login">
</form>
</body>
</html>
<?php
#this shows all the current user accounts, and was used in testing in order to remember the passwords.
/*include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
echo("<br>");
echo("ID: Username, Email, Admin?, Password<br>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo($row["UserID"].': '.$row["Username"].', '.$row["Email"].', '.$row["Role"].', '.$row["Password"]."<br>");
}*/
?>