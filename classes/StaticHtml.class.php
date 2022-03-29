<?php

class StaticHtml {
    
    public function renderLogin() {
        global $request_method;
        global $Database;
        global $filteredPost;
        if($request_method == "POST")
        {
            include(include($_SERVER["DOCUMENT_ROOT"]."/inc/login.inc.php"));
        }
        include($_SERVER["DOCUMENT_ROOT"]."/html/login.html");
    }

    public function renderNewUser() {
        include($_SERVER["DOCUMENT_ROOT"]."/html/firstuser.html");
    }
    
    public function renderMain(string $page) {
        global $Database;
        global $request_method;
        global $filteredPost;
        global $request_url_array;
        
        $include_path=$request_url_array[1];
        $request_path="";
        
        if($request_method == "POST")
        {
            $filtered_Post=filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $request_path="actions";
            ---> HIER MÜSSEN DOCH DIE SKRIPTE AUFGERUFEN UND DIE SEITE NEU GELADEN WERDEN!!!!
        }
        
        $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/";
        if(!empty($include_path))
        {
            $module_path.=$include_path."/";
            $request_path="forms";
        }
        $module_path.=$request_path."/".$page.".inc.php";
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