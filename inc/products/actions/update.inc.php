<?php
$stmt = $Database->prepare("UPDATE products SET name=?, generic=?, packaging=?, measures=?, basic_amount=?, durability=?, username=? WHERE id=?;");
if(!$stmt)
{
    echo $Database->error;
    die();
}
$id=get_id();
print_r($filteredPost);
$stmt->bind_param("ssssiisi", $filteredPost["name"], $filteredPost["generic"], $filteredPost["packaging"], $filteredPost["measures"], $filteredPost["basic_amount"], $filteredPost["durability"], $_SESSION["user"]["username"], $id);
$stmt->execute();
$_SESSION["message"]["info"][]="Das Produkt wurde aktualisiert.";
?>