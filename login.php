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