<p>Bitte zu entfernenden Oberbegriff auswählen.</p>
<p>Hinweis: Wird ein Oberbegriff gel&ouml;scht, werden alle Produkte, die diesem Begriff zugeschrieben sind, ebenfalls gel&ouml;scht.</p>
<?php
echo create_deletionlist("generic", "value");
?>
<form action="http://<?=$_SERVER["HTTP_HOST"]?>/settings/generic" method="post">
    <input type="text" placeholder="Neuer Oberbegriff">
    <input type="submit" value="Neuen Begriff eintragen">
</form>