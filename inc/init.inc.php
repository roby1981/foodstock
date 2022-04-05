<?php
// Re(start) Session
session_name(SESSION_NAME);
session_start();

$request_url = filter_input(
        INPUT_SERVER, 
        "REQUEST_URI", 
        FILTER_SANITIZE_URL);

$request_method = $_SERVER["REQUEST_METHOD"];

$filteredPost=array();

if($request_method=="POST")
{
    $filteredPost=filter_input_array(
            INPUT_POST, 
            $_POST,
            FILTER_DEFAULT);
}
?>