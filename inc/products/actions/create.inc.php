<?php
print_r($filteredPost);
$sql="INSERT INTO products VALUES (null, ?, ?, ?, ?, ?, ?, ?, current_timestamp());";
$stmt=$Database->prepare($sql);
print_r($_SESSION);
if(!($stmt))
{
    echo "Fehler: ".$Database->error;
    die();
}
$stmt->bind_param("siiiiii", $filteredPost["name"], $filteredPost["generic"], $filteredPost["packaging"], $filteredPost["measures"], $filteredPost["basic_amount"], $filteredPost["durability"], $_SESSION["user"]["id"]);
$stmt->execute();
$stmt->close();
$_SESSION["message"]["info"][]="Produkt wurde erfolgreich eingetragen.";
?>
