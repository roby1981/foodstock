<?php
if(is_numeric(end(self::$request_url_array)))
    self::delete_from_database("generic", end(self::$request_url_array));
?>