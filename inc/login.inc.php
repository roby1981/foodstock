<?php
$stmt=$Database->prepare("SELECT username FROM users WHERE username=? AND password=PASSWORD(?);");
$stmt->bind_param("ss", $filteredPost["username"], $filteredPost["password"]);
$stmt->execute();
$result=$stmt->get_result();
$login=$result->fetch_assoc();
if(count($login)==1)
{
    $_SESSION["user"]["username"]=$login["username"];
}
else
{
    //FEHLERAUSGABE generieren
}
?>