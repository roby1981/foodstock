<h2>Dashboard</h2>
<?php
$sql="SELECT id FROM survey_stock;";
$result=self::$Database->query($sql);
echo "<p>Vorrätige Produkte: ".$result->num_rows."</p>";

$sql="SELECT id FROM survey_stock WHERE best_before_date < NOW() + INTERVAL 7 day;";
$result=self::$Database->query($sql);
echo "<p>Produkte, die Haltbarkeit in einer Woche &uuml;berschreiten: ".$result->num_rows."</p>";

$sql="SELECT id FROM survey_stock WHERE best_before_date < NOW();";
$result=self::$Database->query($sql);
echo "<p>Produkte, die Halbarkeit &uuml;berschritten haben: ".$result->num_rows."</p>";


$sql="SELECT id FROM products;";
$result=self::$Database->query($sql);
echo "<p>Eingetragene Produkte: ".$result->num_rows."</p>";
?>