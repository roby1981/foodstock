<h2>Produkt &auml;ndern</h2>
<p>Produkt ausw&auml;hlen</p>
<table>
    <thead><tr><th>Name</th></tr></thead>
    <tbody>
<?php
$sql="SELECT id, name FROM products;";
$result=$Database->query($sql);
while($data=$result->fetch_assoc())
{
       echo "<tr><td><a href=\"/change/".$data["id"]."\">".$data["name"]."</a></td></tr>\n";
}
?>
    </tbody>
</table>