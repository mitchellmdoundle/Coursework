<?php
session_start();
try{
    include_once("connection.php");
    array_map("htmlspecialchars", $_POST);
    #this checks the users database for any users with the submitted username
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username=:username");
    $stmt->bindParam(':username', $_POST["username"]);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        #this checks if the user has the correct password associated with the username
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
    }   
    #if either the username or password is wrong, it shows "incorrect credentials", then waits and sends the user back
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