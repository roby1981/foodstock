<?php
error_reporting(-1);
ini_set("display_errors", on);
require_once(__DIR__."/inc/consts.inc.php");
require_once(__DIR__."/inc/init.inc.php");
require_once(__DIR__."/inc/functions.inc.php");
require_once(__DIR__."/inc/classes.inc.php");
require_once(__DIR__."/inc/errors.inc.php");

//Check, ob User in DB vorhanden --> Wenn nicht, Initialisierung
$Database = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
$stmt=$Database->query("SELECT username FROM users");
unset($Database);
if($stmt->num_rows===0)
{
    echo call_user_func($create_first_user);
    die();
}

$Router=new Router($request_method, $filteredPost, $request_url);

if(!isset($_SESSION["user"]))
{
    $Router->post_login();
    echo call_user_func(
            $login, 
            $request_method, 
            $filteredPost);
    die();
}

$Router->postModules();
$module_path=$Router->getModules();

echo $setPage($module_path, $request_url);
?>