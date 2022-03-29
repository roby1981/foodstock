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
        global $request_url;
        
        $include_path=$request_url_array[1];
        $request_path="";
        $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/";
        if(!empty($include_path))
        {
            $module_path.=$include_path."/";
            $request_path="forms";
        }
        $module_path.=$request_path."/".$page.".inc.php";
        
        if($request_method == "POST")
        {
            $post_request_path="actions";
            $action_module_path=str_replace($request_path, $post_request_path, $module_path);
            include($action_module_path);
            if($_SERVER["https"]=="on")
            {
                $protocol="https://";
            }
            else
            {
                $protocol="http://";
            }
            header("Location: $protocoll$request_url");
        }
        
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