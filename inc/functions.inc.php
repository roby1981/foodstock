<?php
$create_first_user = function() {
    $Html= new StaticHtml();
    $Html->renderNewUser();
    unset($Html);
};

$login = function() {
    $Html = new StaticHtml();
    $Html->renderLogin();
    unset($Html);
};

$setPage = function($page) {
    $Html = new StaticHTML();
    $Html->renderMain($page);
    unset($Html);
};

function show_radio_list($title, $value, $table, $selected=null) {
    global $Database;
    echo "<label for=\"".$table."[]\">$title</label>";
    echo "<ul>";
    $result = $Database->query("SELECT id, $value FROM $table;");
    while($data=$result->fetch_assoc())
    {
        echo "<li><input type=\"radio\" name=\"".$table."\" value=\"".$data["id"]."\"";
        if($selected==$data["id"])
        {
            echo " checked=checked ";
        }
        echo "> ".$data["value"]."</li>";
    }
    echo "</ul>";
};

function get_id() {
    global $request_url;
    return end(explode("/",$request_url));
}
?>