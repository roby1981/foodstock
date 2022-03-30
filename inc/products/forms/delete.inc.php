<?php
if(isset($request_url_array[3]) && is_numeric($request_url_array[3]))
{
    include($_SERVER["DOCUMENT_ROOT"]."/inc/products/actions/delete.inc.php");
    $_SESSION["info"][]="Das Produkt wurde erfolgreich gel&ouml;scht.";
}
?>

<h2>Produkt entfernen</h2>
<p>Bitte zu entfernendes Produkt auswählen:</p>
<?php
echo create_deletionlist("products", "name");
?>