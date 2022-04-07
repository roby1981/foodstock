<?php

class StaticHtml {

    public static $Database;
    public static $request_url;
    public static $request_url_array;
    
    private static function delete_from_database(string $table, 
                              int $id):void {
        if(is_numeric($id))
        {
            $stmt = self::$Database->prepare("DELETE FROM $table WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
    
    private static function show_radio_list(string $title,
                         string $value,
                         string $table,
                         string $selected=null):string {
        $return="<label for=\"".$table."[]\">$title</label>";
        $return.= "<ul>";
        $result = self::$Database->query("SELECT id, $value FROM $table;");
        
        while($data=$result->fetch_assoc())
        {
            $return.= "<li><input type=\"radio\" name=\"".$table."\" value=\"".$data["value"]."\"";
            if($selected==$data["value"])
            {
                $return.= " checked=checked ";
            }
            $return.= "> ".$data["value"]."</li>";
        }
        $return.= "</ul>";
        return $return;
    }
    
    private static function create_deletionlist(string $tablename,
                             string $name):string {
        $return='<ul>';
        $result=self::$Database->query("SELECT id, $name FROM $tablename ORDER BY $name;");
        if(!$result)
        {
            return self::$Database->error;
        }
        while($data = $result->fetch_assoc())
        {
            $return.="<li><a onclick=\"return confirm('Den Eintrag inklusive entsprechendem Bestand l&ouml;schen?');\" href=\"".self::$request_url."/delete/".$data["id"]."\">".$data[$name]."</a></li>";
        }
        $return.="</ul>";
        return $return;
    }
    
    private static function drop_down_list(string $value,
                        string $table, 
                        string $selected=null): string {
        $result = self::$Database->query("SELECT $value FROM $table;");

        $return="<select name=\"$table\"><option></option>";
        while($data=$result->fetch_assoc())
        {
            $return.="<option";
            if($data["$value"]==$selected)
            {
                $return.= " selected=\"selected\" ";
            }
            $return.=">".$data[$value]."</option>";
        }
        $return.="</select>";
        return $return;
    }
    
    public function __construct($request_url=null) {
        self::$Database = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);
        self::$request_url=$request_url;
        self::$request_url_array=explode("/", $request_url);
    }
    
    public function renderLogin():void {
        include($_SERVER["DOCUMENT_ROOT"]."/html/login.html");
    }

    public function renderLogout():void {
        include($_SERVER["DOCUMENT_ROOT"]."/inc/logout.inc.php");
    }
    
    public function renderNewUser():void {
        include($_SERVER["DOCUMENT_ROOT"]."/html/firstuser.html");
    }
    
    public function renderMain(string $module_path):void {
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
?>