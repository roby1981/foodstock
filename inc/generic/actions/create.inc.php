<?php
$value=self::$filteredPost["value"];
$sql="INSERT INTO generic VALUES (null, ?)";
$stmt=self::$Database->prepare($sql);
$stmt->bind_param('s', $value);
$result=$stmt->execute();
if(!$result)
{
    echo $stmt->error;
}
