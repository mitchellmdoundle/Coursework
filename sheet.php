<!DOCTYPE html>
<html>
<head>
<title>Sheet</title>
</head>
<body>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT user.Forename as FN, user.Surname as SN, user.House as H, orders.OrderID as Orid, orders.Dateneeded as dateneeded FROM user 
INNER JOIN orders ON orders.UserID= user.UserID 
where Complete = 0
ORDER BY Dateneeded ASC
");
$stmt->execute();
echo("<br>");

?>

<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>