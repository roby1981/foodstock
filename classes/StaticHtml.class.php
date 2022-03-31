<?php

class StaticHtml {
    
    public function renderLogin() {
        global $request_method;
        global $Database;
        global $filteredPost;
        if($request_method == "POST")
        {
            include(include($_SERVER["DOCUMENT_ROOT"]."/inc/login.inc.php"));
            header("Location:http://".$_SERVER["HTTP_HOST"]);
        }
        include($_SERVER["DOCUMENT_ROOT"]."/html/login.html");
    }

    public function renderLogout() {
        include($_SERVER["DOCUMENT_ROOT"]."/inc/logout.inc.php");
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
        $keys=count($request_url_array);
        
        $include_path=$request_url_array[$keys-2];
        $action_page=$request_url_array[$keys-1];
        
        if(is_numeric($request_url_array[$keys-1]))
        {
            $include_path=$request_url_array[$keys-3];
            $action_page=$request_url_array[$keys-2];
        }
        
        $request_path="";
        if(empty($include_path))
        {
            $include_path=$action_page;
        }
        $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/";
        if(!empty($include_path))
        {
            $module_path.=$include_path."/";
            $request_path.="forms";
        }
        $module_path.=$request_path."/".$page.".inc.php";
        
        if(!is_file($module_path))
        {
            $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/$include_path/forms/$action_page.inc.php";
        }

        if($request_method == "POST")
        {
            $post_request_path="actions";
            $action_module_path=str_replace($request_path, $post_request_path, $module_path);

            if(isset($_SERVER["HTTPS"]))
            {
                $protocoll="https:/";
            }
            else
            {
                $protocoll="http:/";
            }
            include($action_module_path);
            header("Location: http://".$_SERVER["HTTP_HOST"]."$request_url");
            die();
        }
        include($_SERVER["DOCUMENT_ROOT"]."/html/header.html");
        if($include_path==="logout")
        {
            include($_SERVER["DOCUMENT_ROOT"]."/inc/logout.inc.php");
            header("Location:http://".$_SERVER["HTTP_HOST"]);
        }
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