<?php

class StaticHtml {

    public function renderLogin() {
        include($_SERVER["DOCUMENT_ROOT"]."/html/login.html");
    }

    public function renderNewUser() {
        include($_SERVER["DOCUMENT_ROOT"]."/html/firstuser.html");
    }
    
    public function renderMain($page) {
        global $Database;
        global $request_method;
        global $filteredPost;
        include($_SERVER["DOCUMENT_ROOT"]."/html/header.html");
        if(is_file($_SERVER["DOCUMENT_ROOT"]."/inc/$page.inc.php"))
        {
            include($_SERVER["DOCUMENT_ROOT"]."/inc/$page.inc.php");
        }
        else
        {
            echo "<p>Das Modul wurde nicht gefunden: $page";
        }
        include($_SERVER["DOCUMENT_ROOT"]."/html/footer.html");
    }
}