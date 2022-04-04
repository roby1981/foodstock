<pre>
<?php
$sql="INSERT INTO products VALUES (null, ?, ?, ?, ?, ?, ?, current_timestamp(), ?);";
$stmt=self::$Database->prepare($sql);
if(!($stmt))
{
    echo "Fehler: ".$Database->error;
    die();
}
$stmt->bind_param("ssssiis", self::$filteredPost["name"], self::$filteredPost["generic"], self::$filteredPost["packaging"], self::$filteredPost["measures"], self::$filteredPost["basic_amount"], self::$filteredPost["durability"], $_SESSION["user"]["username"]);
$stmt->execute();
if($stmt->error)
{
    echo $stmt->error;
    die();
};
$stmt->close();
$_SESSION["message"]["info"][]="Produkt wurde erfolgreich eingetragen.";
?>
