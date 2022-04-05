<?php
$create_first_user = function():void {
    $Html= new StaticHtml();
    $Html->renderNewUser();
    unset($Html);
};

$login = function():void {
    $Html = new StaticHtml();
    $Html->renderLogin();
    unset($Html);
};

$setPage = function(string $module_path, string $request_url):void {
    $Html = new StaticHTML($request_url);
    $Html->renderMain($module_path);
    unset($Html);
};



function get_id():int {
    global $request_url;
    $id=explode("/",$request_url);
    return end($id);
}

function delete_from_database(string $table, 
                              int $id):void {
    if(is_numeric($id))
    {
        global $Database;
        $stmt = $Database->prepare("DELETE FROM $table WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

function resize(int $amount):string
{
    if($amount >= 1000)
    {
        $amount/=1000;
        $amount.="k";
    }
    elseif($amount < 1)
    {
        $mount*=1000;
        $amount.="m";
    }
    return $amount;
}
?>