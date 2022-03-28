<h2>Produkt &auml;ndern</h2>
<?php
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