<?php
if(isset($request_url_array[3]) && is_numeric($request_url_array[3]))
{
    include($_SERVER["DOCUMENT_ROOT"]."/inc/stock/actions/delete.inc.php");
    $_SESSION["info"][]="Das Produkt wurde erfolgreich gel&ouml;scht.";
}
?>

<h2>Produkt aus Bestand entfernen</h2>
<?php
echo self::create_deletionlist("stock", "product");
?>