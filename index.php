<?php
require_once(__DIR__."/inc/consts.inc.php");
require_once(__DIR__."/inc/init.inc.php");
require_once(__DIR__."/inc/functions.inc.php");
require_once(__DIR__."/inc/classes.inc.php");
require_once(__DIR__."/inc/errors.inc.php");

//URL- und Methodenabfrage

$request_url = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL);
$request_method = $_SERVER["REQUEST_METHOD"];

//Action - Routing
if($request_method === "POST")
{
    $routes['/action/new_user'] = __DIR__.'/inc/new_user.inc.php';
    $routes['/action/login'] = __DIR__.'/inc/login.inc.php';

    $filteredPost=filter_input_array(INPUT_POST);

    foreach($routes as $url => $file)
    {
        if($request_url == $url)
        {
            include($file);
        }
    }
    header("Location: $request_url");
}
if($request_method === "GET")
{
    $routes['/action/logout'] = __DIR__.'/inc/logout.inc.php';
    
    foreach($routes as $url => $file)
    {
        if($request_url == $url)
        {
            include($file);
        }
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
    echo call_user_func($welcome);
}

?>