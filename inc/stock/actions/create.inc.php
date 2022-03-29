<?php
$result=$Database->query("SELECT NOW() + interval `durability` day AS `best_before_date`  FROM products WHERE name = '".$filteredPost["products"]."'");
$data=$result->fetch_assoc();
$date=$data["best_before_date"];
$stmt=$Database->prepare("INSERT INTO stock VALUES (null, ?, ?, ?, ?, NOW());");
if(isset($filteredPost["best_date_before"]) && !empty($filteredPost["best_date_before"]))
{
    $date=$filteredPost["best_date_before"];
}

$date=substr($date, 0, 10);

$stmt->bind_param("siss", $filteredPost["products"], $filteredPost["amount"], $date, $_SESSION["user"]["username"]);
$stmt->execute();
$stmt->close();
$_SESSION["info"][]="Das Produkt wurde erfolgreich in den Vorrat eingetragen.";
?>