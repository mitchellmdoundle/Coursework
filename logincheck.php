<?php
session_start();
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username=:username");
    $stmt->bindParam(':username', $_POST["username"]);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        if ($row['Password']==$_POST['passwd'])
        {
            //echo('accepted');
            $_SESSION["loggedinuser"]=$row["UserID"];
            $_SESSION["Role"]=$row["Role"];
            if ($row['Role']==0){
                header('Location: selectchar.php');   
            }
            else if ($row['Role']==1){
                header('Location: users.php');
            }
        }
        else {
            echo('Incorrect Credentials');
            header("Refresh:2; url= login.php");
            die();
        }
    }   
    echo('Incorrect Credentials');
    header("Refresh:2; url= login.php");
    die();
}
catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }

$conn=null;
?>