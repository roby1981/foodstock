<h2>Produkt &auml;ndern</h2>
<?php
if((isset($request_url_array[2]) && is_numeric($request_url_array[2])) || (isset($request_url_array[3]) && is_numeric($request_url_array[3])))
{
    $stmt=$Database->prepare("SELECT name, generic, packaging, measures, basic_amount, durability FROM products WHERE id=?;");
    if(!$stmt)
    {
        echo $Database->error;
    }
    $stmt->bind_param('i', get_id());
    $stmt->execute();
    $result=$stmt->get_result();
    $stmt->close();
    $data=$result->fetch_assoc();
?>
<form action="/action/change/<?php echo get_id();?>" method="post">
    <input type="text" name="name" value="<?php echo $data["name"];?>" placeholder="Produktname"><br>
    <?php
    show_radio_list("Oberbegriff", "value", "generic", $data["generic"]);
    show_radio_list("Verpackungsform", "value", "packaging", $data["packaging"]);
    show_radio_list("Maßeinheit", "value", "measures", $data["measures"]);
    ?>
    <input type="text" name="basic_amount" placeholder="Grundmenge" value="<?php echo $data["basic_amount"];?>"><br>
    <input type="text" name="durability" placeholder="Standard-Halbtbarkeit in Tagen" value="<?php echo $data["durability"];?>"><br>
    <input type="submit" value="Produkt aktualisieren">
</form>
<?php
}
else
{
?>
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
<?php
}
?>