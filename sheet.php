<!DOCTYPE html>
<html>
<head>
<title>Sheet</title>
</head>
<body>
<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT characters.CharID, charhasspell.CharID
FROM characters
INNER JOIN charhasspell 
ON characters.charID = charhasspell.CharID;
");
$stmt->execute();
include_once('connection.php');

?>

<a href="http://localhost/coursework/login.php">Log Out</a><br>
</body>
</html>