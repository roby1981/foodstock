<?php
if(isset($request_url_array[4]) && is_numeric($request_url_array[3]))
{
    include($_SERVER["DOCUMENT_ROOT"]."/inc/settings/amounts/actions/delete.inc.php");
    $_SESSION["info"][]="Der Oberbegriff wurde erfolgreich gel&ouml;scht.";
}
?>
<p>Bitte zu entfernenden Oberbegriff auswählen.</p>
<p>Hinweis: Wird ein Oberbegriff gel&ouml;scht, werden alle Produkte, die diesem Begriff zugeschrieben sind, ebenfalls gel&ouml;scht.</p>
<?php
echo create_deletionlist("measures", "value");
?>
<form action="http://<?=$_SERVER["HTTP_HOST"]?>/settings/amounts/create" method="post">
    <input type="text" placeholder="Name" name="value"><br>
    <input type="text" placeholder="Abk&uuml;rzung" name="shortcut"><br>
    <label><input type="checkbox" name="resizeable"> Vielfache k&ouml;nnen gebildet werden.</label><br>
    <input type="submit" value="Neuen Begriff eintragen">
</form>