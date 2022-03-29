<pre>
<?php
$sql="INSERT INTO products VALUES (null, ?, ?, ?, ?, ?, ?, current_timestamp(), ?);";
$stmt=$Database->prepare($sql);
if(!($stmt))
{
    echo "Fehler: ".$Database->error;
    die();
}
$stmt->bind_param("ssssiis", $filteredPost["name"], $filteredPost["generic"], $filteredPost["packaging"], $filteredPost["measures"], $filteredPost["basic_amount"], $filteredPost["durability"], $_SESSION["user"]["username"]);
$stmt->execute();
if($stmt->error)
{
    echo $stmt->error;
    die();
};
$stmt->close();
$_SESSION["message"]["info"][]="Produkt wurde erfolgreich eingetragen.";
?>
