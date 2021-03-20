<?php
session_start();
include_once("connection.php");
header('Location: spells.php');
print_r($_POST);
#this lets the spells sheet know when it returns that the "show only prep spells" box was ticked
if (isset($_POST['prepspells'])){
    $_SESSION['prepspells']=1;
}
else{$_SESSION['prepspells']=0;}

#This sql deletes everything associated with that character already, so it can immediately replace it with the updated info
$spelldelete = $conn->prepare("DELETE
FROM charhasspell
WHERE CharID=:charid
");
$spelldelete->bindParam(':charid', $_SESSION['charid']);
$spelldelete->execute();

#This goes through each of the spells ticked and reassigns them to the character being checked.
$prepped=array_keys($_POST);
foreach($prepped as $spellid){
    if (is_int($spellid)){
        $spellinsert = $conn->prepare("INSERT INTO charhasspell (CharID, SpellID) 
            VALUES (:charid, :spellid)
        ");
        $spellinsert->bindParam(':charid', $_SESSION['charid']);
        $spellinsert->bindParam(':spellid', $spellid);
        $spellinsert->execute();
        $spellinsert->closeCursor();
    }
}
print_r($prepped)
?>
<br>
<a href="http://localhost/Coursework/spells.php">return</a>