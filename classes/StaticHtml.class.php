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
        global $request_url_array;
        
        $include_path=$request_url_array[1];
        $request_path="forms";
        
        if($request_method == "POST")
        {
            $filtered_Post=filter_input_array(INPUT_POST, FILTER_DEFAULT);
            print_r($filteredPost);
            $request_path="actions";
            die();
        }
        
        $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/".$include_path."/".$request_path."/".$page.".inc.php";
        include($_SERVER["DOCUMENT_ROOT"]."/html/header.html");
        if(is_file($module_path))
        {
            include($module_path);
        }
        else
        {
            echo "<p>Das Modul wurde nicht gefunden: ".$module_path;
        }
        
        include($_SERVER["DOCUMENT_ROOT"]."/html/footer.html");
    }
}