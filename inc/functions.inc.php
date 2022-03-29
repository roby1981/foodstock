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

$setPage = function(string $page) {
    $Html = new StaticHTML();
    $Html->renderMain($page);
    unset($Html);
};

function show_radio_list(string $title, string $value, string $table, string $selected=null) {
    global $Database;
    echo "<label for=\"".$table."[]\">$title</label>";
    echo "<ul>";
    $result = $Database->query("SELECT id, $value FROM $table;");
    while($data=$result->fetch_assoc())
    {
        echo "<li><input type=\"radio\" name=\"".$table."\" value=\"".$data["value"]."\"";
        if($selected==$data["value"])
        {
            echo " checked=checked ";
        }
        echo "> ".$data["value"]."</li>";
    }
    echo "</ul>";
};

function get_id() {
    global $request_url;
    $id=explode("/",$request_url);
    return end($id);
}

function create_deletionlist(string $tablename, string $name)
{
    global $Database;
    $return='<ul>';
    $result=$Database->query("SELECT id, $name FROM $tablename ORDER BY $name;");
    while($data = $result->fetch_assoc())
    {
        $return.="<li><a onclick=\"return confirm('Den Eintrag inklusive entsprechendem Bestand l&ouml;schen?');\" href=\"/action/delete".$tablename."/".$data["id"]."\">".$data[$name]."</a></li>";
    }
    $return.="</ul>";
    return $return;
}

function delete_from_database(string $table, int $id) {
    if(is_numeric($id))
    {
        global $Database;
        $stmt = $Database->prepare("DELETE FROM $table WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>