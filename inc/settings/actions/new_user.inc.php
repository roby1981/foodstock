<?php
$stmt=self::$Database->prepare("INSERT INTO users VALUES (NULL, ?, PASSWORD(?), NULL, NOW());");
$stmt->bind_param("ss", self::$filteredPost["username"], self::$filteredPost["password"]);
$stmt->execute();
?>