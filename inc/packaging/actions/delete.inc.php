<?php
if(is_numeric(end($request_url_array)))
    delete_from_database("packaging", end($request_url_array));
?>