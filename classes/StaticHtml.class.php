<?php

class StaticHtml {
    
        private static $Database;
        private static $request_method;
        private static $request_url_array;
        private static $request_url;
    
    public function __construct($Database, $request_method,  $request_url_array, $request_url)
    {
        self::$Database=$Database;
        self::$request_method=$request_method;
        self::$request_url_array=$request_url_array;
        self::$request_url=$request_url;
    }
    public function renderLogin():void {
        if(self::$request_method == "POST")
        {
            include(include($_SERVER["DOCUMENT_ROOT"]."/inc/login.inc.php"));
            header("Location:http://".$_SERVER["HTTP_HOST"]);
        }
        include($_SERVER["DOCUMENT_ROOT"]."/html/login.html");
    }

    public function renderLogout():void {
        include($_SERVER["DOCUMENT_ROOT"]."/inc/logout.inc.php");
    }
    public function renderNewUser():void {
        include($_SERVER["DOCUMENT_ROOT"]."/html/firstuser.html");
    }
    
    public function renderMain(string $page):void {
        
        $keys=count(self::$request_url_array);
        
        $include_path=self::$request_url_array[$keys-2];
        $action_page=self::$request_url_array[$keys-1];
        
        if(is_numeric(self::$request_url_array[$keys-1]))
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
        
        if(array_search("delete", self::$request_url_array) && is_numeric(end(self::$request_url_array)))
        {
            $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/$include_path/actions/$action_page.inc.php";
        }
        
        if(!is_file($module_path))
        {
            $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/$include_path/forms/$action_page.inc.php";
        }

        if(self::$request_method == "POST")
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
            header("Location: http://".$_SERVER["HTTP_HOST"].self::$request_url);
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