<?php
$stmt=$Database->prepare("INSERT INTO users VALUES (NULL, ?, PASSWORD(?), NULL, NOW());");
$stmt->bind_param("ss", $filteredPost["username"], $filteredPost["password"]);
$stmt->execute();
?>