<?php
if(isset($request_url_array[4]) && is_numeric($request_url_array[3]))
{
    include($_SERVER["DOCUMENT_ROOT"]."/inc/packaging/actions/delete.inc.php");
    $_SESSION["info"][]="Der Oberbegriff wurde erfolgreich gel&ouml;scht.";
}
?>
<p>Um einen Begriff zu löschen, diesen bitte ausw&auml;hlen.</p>
<p>Hinweis: Wird ein Begriff gel&ouml;scht, werden alle Produkte, die diesem Begriff zugeschrieben sind, ebenfalls gel&ouml;scht.</p>
<?php
echo self::create_deletionlist("packaging", "value");
?>
<form action="http://<?=$_SERVER["HTTP_HOST"]?>/settings/packaging/create" method="post">
    <input type="text" placeholder="Neuer Oberbegriff" name="value">
    <input type="submit" value="Neuen Begriff eintragen">
</form>