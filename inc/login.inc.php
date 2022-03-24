<?php
$stmt=$Database->prepare("SELECT id, username FROM users WHERE username=? AND password=PASSWORD(?);");
$stmt->bind_param("ss", $filteredPost["username"], $filteredPost["password"]);
$stmt->execute();
$result=$stmt->get_result();
$login=$result->fetch_assoc();
if(count($login)==2)
{
    $_SESSION["user"]["id"]=$login["id"];
    $_SESSION["user"]["username"]=$login["username"];
}
else
{
    echo "Kein Login.";
    die();
}
?>