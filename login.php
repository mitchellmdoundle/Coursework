<?php
session_start();
$_SESSION = array();
?>
<!DOCTYPE html>
<html>
<head>
<title>Test</title>
</head>
<body>
<form action="logincheck.php" method="post">
  Forename:<input type="text" name="forename"><br>
  Surname:<input type="text" name="surname"><br>
  Password:<input type="password" name="passwd"><br>
  <input type="submit" value="Login">
</form>
</body>
</html>