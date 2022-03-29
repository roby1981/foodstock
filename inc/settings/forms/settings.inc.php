<h2>Einstellungen</h2>
<?php
$children["user"]="Benutzereinstellungen";
$children["generic"]="Oberbegriffe";
$children["amounts"]="Mengenangaben";
$children["packages"]="Verpackungsformen";

if(isset($request_url_array[2]) && array_key_exists($request_url_array[2], $children))
{
    echo "<h2>".$children[$request_url_array[2]]."</h2>";
    include($_SERVER["DOCUMENT_ROOT"]."/inc/".$request_url_array[2].".inc.php");
}
else
{
    echo "<ul>";
    foreach($children as $url => $name)
    {
        echo "<li><a href=\"".$request_url_array[1]."/$url\">$name</a></li>";
    }
}
?>
</ul>