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

$welcome = function() {
    $Html = new StaticHTML();
    $Html->renderWelcome();
    unset($Html);
}
?>