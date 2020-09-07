<?php
session_start();
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    $stmt = $conn->prepare("SELECT * FROM user WHERE Forename=:forename AND Surname =:surname");
    $stmt->bindParam(':forename', $_POST["forename"]);
    $stmt->bindParam(':surname', $_POST["surname"]);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
    if ($row['Password']==$_POST['passwd']){
        //echo('accepted');
        $_SESSION["loggedinuser"]=$row["UserID"];
        $_SESSION["Role"]=$row["Role"];
        if ($row['Role']==0){
            header('Location: order.php');   
        }
        else if ($row['Role']==1){
            header('Location: showorders.php');
        }
        else if ($row['Role']==2){
            header('Location: users.php');
        }
    }
    else {
        echo('Incorrect Credentials');
        header("Refresh:2; url= login.php");
    }
    }   
    echo('Incorrect Credentials');
    header("Refresh:2; url= login.php");
}
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>