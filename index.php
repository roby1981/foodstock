<?php
require_once(__DIR__."/inc/consts.inc.php");
require_once(__DIR__."/inc/init.inc.php");
require_once(__DIR__."/inc/functions.inc.php");
require_once(__DIR__."/inc/classes.inc.php");
require_once(__DIR__."/inc/errors.inc.php");

//URL- und Methodenabfrage

$request_url = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL);
$request_url_array = explode("/", $request_url);
$request_method = $_SERVER["REQUEST_METHOD"];

//Action - Routing
if($request_method === "POST")
{
    $routes['new_user'] = __DIR__.'/inc/new_user.inc.php';
    $routes['login'] = __DIR__.'/inc/login.inc.php';
    $routes['change'] = __DIR__.'/inc/actionchangeproductbyid.inc.php';
    $routes['create'] = __DIR__.'/inc/create_in_db.inc.php';
    $filteredPost=filter_input_array(INPUT_POST);
    
    //$product_change_pattern[]="/^\/action\/change?\/[0-9]*$/";
    
    if(is_file($routes[$request_url_array[2]]))
    {
        include ($routes[$request_url_array[2]]);
    }
    else
    {
        echo call_user_func($setPage("notfound"));   
    }
    header("Location: $request_url");
}

if($request_method === "GET")
{
    $routes['/action/logout'] = __DIR__.'/inc/logout.inc.php';
    
    if(isset($routes[$request_url]) && is_file($routes[$request_url]))
    {
        include ($routes[$request_url]);
        header("Location: http://".$_SERVER["HTTP_HOST"]);
    }
}
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
    $routes['deleteproducts'] = 'actiondeleteproductsbyid';
    $routes['deletegeneric'] = 'actiondeletegenericbyid';
    if(isset($routes[$request_url_array[1]]))
    {
        echo call_user_func($setPage($routes[$request_url_array[1]]));
    }
    elseif(isset($routes[$request_url_array[2]]))
    {
        echo call_user_func($setPage($routes[$request_url_array[2]]));
    }
    else
    {
        echo call_user_func($setPage("notfound"));
    }
}
?>