<?php
$stmt = self::$Database->prepare("UPDATE products SET name=?, generic=?, packaging=?, measures=?, basic_amount=?, durability=?, username=? WHERE id=?;");
if(!$stmt)
{
    echo self::$Database->error;
    die();
}
$id=get_id();
$stmt->bind_param("ssssiisi", self::$filteredPost["name"], self::$filteredPost["generic"], self::$filteredPost["packaging"], self::$filteredPost["measures"], self::$filteredPost["basic_amount"], self::$filteredPost["durability"], $_SESSION["user"]["username"], $id);
$stmt->execute();
$_SESSION["message"]["info"][]="Das Produkt wurde aktualisiert.";
?>