<?php
$value=self::$filteredPost["value"];
$shortcut=self::$filteredPost["shortcut"];
isset(self::$filteredPost["resizeable"])?$resizeable=1:$resizeable=0;
$sql="INSERT INTO measures VALUES (null, ?, ?, ?)";
$stmt=self::$Database->prepare($sql);
if(!$stmt)
{
    echo $Database->error;
    die();
}
$stmt->bind_param('ssi', $value, $shortcut, $resizeable);
$result=$stmt->execute();
if(!$result)
{
    echo $stmt->error;
    die();
}