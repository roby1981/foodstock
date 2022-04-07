<h2>Produkt &auml;ndern</h2>
<?php
if(in_array("update", self::$request_url_array) &&  is_numeric(end(self::$request_url_array)))
{
    $stmt=self::$Database->prepare("SELECT name, generic, packaging, measures, basic_amount, durability FROM products WHERE id=?;");
    if(!$stmt)
    {
        echo self::$Database->error;
    }
    $id=get_id();
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result=$stmt->get_result();
    $stmt->close();
    $data=$result->fetch_assoc();
    if(!is_array($data))
    {
        echo "<p>Das Produkt wurde nicht gefunden.</p>";
        die();
    }
?>
<form action="/products/update/<?php echo get_id();?>" method="post">
    <input type="text" name="name" value="<?php echo $data["name"];?>" placeholder="Produktname"><br>
    <?php
        echo self::show_radio_list("Oberbegriff", "value", "generic", $data["generic"]);
        echo self::show_radio_list("Verpackungsform", "value", "packaging", $data["packaging"]);
        echo self::show_radio_list("Maßeinheit", "value", "measures", $data["measures"]);
    ?>
    <input type="text" name="basic_amount" placeholder="Grundmenge" value="<?php echo $data["basic_amount"];?>"><br>
    <input type="text" name="durability" placeholder="Standard-Halbtbarkeit in Tagen" value="<?php echo $data["durability"];?>"><br>
    <input type="submit" value="Produkt aktualisieren">
</form>
<?php
}
else
{
echo "<ul>";
$sql="SELECT id, name FROM products;";
$result=self::$Database->query($sql);
while($data=$result->fetch_assoc())
{
       echo "<li><a href=\"update/".$data["id"]."\">".$data["name"]."</a></li>\n";
}
echo "</ul>";
}
?>