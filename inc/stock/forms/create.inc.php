<h2>Produkt in Bestand einf&uuml;gen</h2>
<form action="/stock/create" method="post">
<?php
drop_down_list("name", "products");
?>
    <br>
    <input type="text" name="amount" placeholder="Anzahl"><br>
    <input type="date" name="best_date_before" title="Mindeshalbarkeitsdatum"><br>
    <input type="submit" value="In Bestand eintragen">
</form>