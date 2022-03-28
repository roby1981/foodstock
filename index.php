<?php
error_reporting(-1);
ini_set("display_errors", on);
require_once(__DIR__."/inc/consts.inc.php");
require_once(__DIR__."/inc/init.inc.php");
require_once(__DIR__."/inc/functions.inc.php");
require_once(__DIR__."/inc/classes.inc.php");
require_once(__DIR__."/inc/errors.inc.php");

//URL- und Methodenabfrage

$request_url = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL);
$request_url_array = explode("/", $request_url);
$request_method = $_SERVER["REQUEST_METHOD"];

   

//Render-Routing
//
//Check, ob User in DB vorhanden --> Wenn nicht, Initialisierung

$stmt=$Database->query("SELECT username FROM users");
if($stmt->num_rows===0)
{
    echo call_user_func($create_first_user);
}
elseif(!isset($_SESSION["user"]))
{
    echo call_user_func($login);
}
else
{
    // $product_change_pattern="/^(\/action)?\/change?\/[0-9]*$/";
    
    $routes['put'] = 'put';
    $routes['update'] = 'update';
    $routes['fetch'] = 'fetch';
    $routes['create'] = 'create';
    $routes['change'] = 'change';
    $routes['delete'] = 'deleteproduct';
    $routes['settings'] = 'settings';
    $routes[''] = 'start';
    $routes['login'] = 'start';
    $routes['deleteproducts'] = 'delete';
    $routes['deletegeneric'] = 'delete';
    if(isset($routes[$request_url_array[1]]))
    {
        echo $setPage($routes[$request_url_array[1]]);
    }
    elseif(isset($routes[$request_url_array[2]]))
    {
        
        echo $setPage($routes[$request_url_array[2]]);
    }
    else
    {
        echo $setPage("notfound");
    }
}
?>