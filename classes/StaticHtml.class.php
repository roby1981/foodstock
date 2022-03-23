<?php

class StaticHtml {

    public function renderLogin() {
        include($_SERVER["DOCUMENT_ROOT"]."/html/login.html");
    }

    public function renderNewUser() {
        include($_SERVER["DOCUMENT_ROOT"]."/html/firstuser.html");
    }
    
    public function renderNewProduct() {
        echo "Hier wird eine Form für ein neues Produkt angezeigt.";
    }
    
    public function renderNewInventory() {
        echo "Hier wird ein neues Produkt eingetragen.";
    }
    
    public function renderWelcome() {
        include($_SERVER["DOCUMENT_ROOT"]."/html/header.html");
        include($_SERVER["DOCUMENT_ROOT"]."/inc/main.php");
        include($_SERVER["DOCUMENT_ROOT"]."/html/footer.html");
    }
}