<?php
class Router {
    public static $request_method;
    public static $request_url_array;
    public static $request_url;
    public static $filteredPost;
    public static $Database;

//Initialisieren der Grundparameter
    public function __construct(string $request_method, 
                                array $filteredPost, 
                                string $request_url) {
        self::$Database = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
        self::$request_method=$request_method;
        self::$request_url_array=explode("/", $request_url);
        self::$request_url=$request_url;
        self::$filteredPost=$filteredPost;
    }

    function post_login() {
        if(self::$request_method == "POST")
        {
            include(include($_SERVER["DOCUMENT_ROOT"]."/inc/login.inc.php"));
            header("Location:http://".$_SERVER["HTTP_HOST"]);
        }
    }
//Verarbeiten der POST-Eingaben    
    function postModules():void {
        if(self::$request_method == "POST")
        {
            $action=end(self::$request_url_array);
            $module=prev(self::$request_url_array);
            $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/".$module."/actions/".$action.".inc.php";

            if(isset($_SERVER["HTTPS"]))
            {
                $protocoll="https:/";
            }
            else
            {
                $protocoll="http:/";
            }
            
            if(!is_file($module_path))
                die("Modul nicht gefunden");
            
            include($module_path);
            header("Location: ".$_SERVER["HTTP_REFERER"]);
            die();
        }

    }
    
    function getModules():string {
        $keys=count(self::$request_url_array);
        $include_path=self::$request_url_array[$keys-2];
        $action_page=self::$request_url_array[$keys-1];
        $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/";
        
        if(is_numeric(self::$request_url_array[$keys-1]))
        {
            $include_path=self::$request_url_array[$keys-3];
            $action_page=self::$request_url_array[$keys-2];
        }
        
        if(empty($include_path) && !empty($action_page))
        {
            $include_path=$action_page;
        }
        
        if(!empty($include_path))
        {
            $module_path.=$include_path."/";
        }
        
        if(array_search("delete", self::$request_url_array) && 
                is_numeric(end(self::$request_url_array)))
        {
            $module_path.="actions/$action_page.inc.php";
        }

        if("/" === self::$request_url)
        {
            $module_path.="$include_path/start.inc.php";
        }
        
        if(!is_file($module_path))
        {
            $module_path=$_SERVER["DOCUMENT_ROOT"]."/inc/$include_path/forms/$action_page.inc.php";
        }
        
        if("logout" === $include_path)
        {
            include($_SERVER["DOCUMENT_ROOT"]."/inc/logout.inc.php");
            header("Location:http://".$_SERVER["HTTP_HOST"]);
            die();
        }
        
        return $module_path;
    }
}