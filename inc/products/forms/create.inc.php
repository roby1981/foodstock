<h2>Neues Produkt anlegen</h2>
<form action="/products/create" method="post">
    <input type="text" name="name" placeholder="Produktname"><br>
    <?php
    echo self::show_radio_list("Oberbegriff", "value", "generic");
    echo self::show_radio_list("Verpackungsform", "value", "packaging");
    echo self::show_radio_list("Maßeinheit", "value", "measures");
    ?>
    <input type="text" name="basic_amount" placeholder="Grundmenge"><br>
    <input type="text" name="durability" placeholder="Standard-Halbtbarkeit in Tagen"><br>
    <input type="submit" value="Produkt eintragen">
</form>