<?php
header('Location: users.php');
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    switch($_POST["role"]){
        case "User":
            $role=0;
            break;
        case "Admin":
            $role=1;
            break;   
    }
    $stmt = $conn->prepare("INSERT INTO users (UserID,Username,Email,Password,Role)VALUES (null,:username,:email,:password,:role)");
            $stmt->bindParam(':username', $_POST["username"]);
            $stmt->bindParam(':email', $_POST["email"]);
            $stmt->bindParam(':password', $_POST["passwd"]);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            }
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>