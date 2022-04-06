<?php
if(is_numeric(end(self::$request_url_array)))
    self::delete_from_database("measures", end(self::$request_url_array));
?>