<?php
include($_SERVER["DOCUMENT_ROOT"]."/html/stock_top_menu.html");
echo "<ul>";
$sql="SELECT product, full_amount, shortcut FROM survey_stock;";
$result=$Database->query($sql);
while($data=$result->fetch_assoc())
{
    echo "<li><a href=\"update/".$data["product"]."\">".$data["full_amount"].$data["shortcut"]." ".$data["product"]."</a></li>\n";
}
echo "</ul>";
?>