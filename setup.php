<?php
include_once ("connection.php");
$stmt = $conn->prepare("DROP TABLE IF EXISTS users;
CREATE TABLE users (
    UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(20) NOT NULL,
    Email VARCHAR(20) NOT NULL,
    Password VARCHAR(20) NOT NULL,
    Role TINYINT(1) NOT NULL DEFAULT(0)
);
");
$stmt->execute();
$stmt->closeCursor();

echo "done";
$conn=null;

?>