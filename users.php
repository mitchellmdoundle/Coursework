<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Users</title>
</head>
<body>
<form action="addusers.php" method="post">
  Username:<input type="text" name="username"><br>
  Password:<input type="password" name="passwd"><br>
  Email:<input type="text" name="email"><br>
  <input type="radio" name="role" value="User" checked> User<br>
  <input type="radio" name="role" value="Admin"> Admin<br>
  <input type="submit" value="Add User">
</form>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
echo("<br>");
echo("ID: Username, Email, Admin?, Password<br>");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo($row["UserID"].': '.$row["Username"].', '.$row["Email"].', '.$row["Role"].', '.$row["Password"]."<br>");
}
?>
<a href="http://localhost/Coursework/selectchar.php">Characters</a><br>
<a href="http://localhost/Coursework/login.php">Log Out</a>
</body>
</html>
